<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Sg\Company as SgCompany;
use App\Models\Sg\Report as SgReport;

use App\Models\Mx\Company as MxCompany;
use App\Models\Mx\ReportState as MxReportState;

use App\Models\Ph\Company as PhCompany;
use App\Models\Ph\Report as PhReport;
use App\Models\Ph\ReportType as PhReportType;

use App\Models\My\Company as MyCompany;
use App\Models\My\Report as MyReport;

class CompanyController extends Controller
{
    /**
     * Show company details and available reports (country-specific logic).
     * country param expected values: sg, mx, ph, my
     */
    public function show(Request $request, $country, $id)
    {
        $country = Str::upper($country);
        $company = null;
        $reportsPayload = collect();

        switch ($country) {
            case 'SG':
                $company = SgCompany::with('reports')->findOrFail($id);
                $reportsPayload = $company->reports->map(function ($r) {
                    return [
                        'id' => $r->id,
                        'title' => $r->title ?? $r->name ?? 'Report',
                        'price' => (float) ($r->price ?? 0),
                        'meta' => [],
                        'country' => 'SG',
                    ];
                });
                break;

            case 'MX':
                $company = MxCompany::with('state')->findOrFail($id);
                $stateId = $company->state_id;

                $rs = MxReportState::where('state_id', $stateId)
                    ->with('report') // assumes ReportState->report() relation exists
                    ->get();

                $reportsPayload = $rs->map(function ($r) {
                    return [
                        'id' => $r->id,
                        'title' => optional($r->report)->title ?? optional($r->report)->name ?? 'Report',
                        'price' => (float) ($r->amount ?? 0),
                        'meta' => ['report_id' => $r->report_id, 'state_id' => $r->state_id],
                        'country' => 'MX',
                    ];
                });
                break;

            case 'PH':
                $company = PhCompany::findOrFail($id);
                $reports = $company->reports()->with(['reportPrice.reportType'])->get();

                $grouped = [];
                foreach ($reports as $rep) {
                    $rp = $rep->reportPrice;
                    $rt = $rp?->reportType;
                    $typeId = $rp?->report_type_id ?? ($rt?->id ?? 'unknown');

                    if (!isset($grouped[$typeId])) {
                        $grouped[$typeId] = [
                            'id' => $rep->id,
                            'report_type_id' => $typeId,
                            'report_type_name' => $rt?->name ?? 'Unknown',
                            'price' => (float) ($rt?->price ?? 0),
                            'periods' => [],
                            'country' => 'PH',
                        ];
                    }

                    $grouped[$typeId]['periods'][] = [
                        'report_id' => $rep->id,
                        'period_date' => (string) $rep->period_date,
                        'report_price_id' => $rep->report_price_id,
                    ];
                }

                $reportsPayload = collect(array_values($grouped));
                break;

            case 'MY':
                // MY: company has company_type_id; reports linked to company_type_id; only status=enabled
                $company = MyCompany::findOrFail($id);
                $reports = MyReport::where('company_type_id', $company->company_type_id)
                    ->where('status', 'enabled')
                    ->get();

                $reportsPayload = $reports->map(function ($r) {
                    return [
                        'id' => $r->id,
                        'title' => $r->title ?? $r->name ?? 'Report',
                        'price' => (float) ($r->price ?? 0),
                        'meta' => [],
                        'country' => 'MY',
                    ];
                });
                break;

            default:
                abort(404, 'Unknown country');
        }

        $data = [
            'company' => $company,
            'reports' => $reportsPayload,
            'country' => $country,
        ];

        if ($request->wantsJson()) {
            return response()->json($data);
        }

        return view('companies.show', $data);
    }
}
