<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sg\Company as SgCompany;
use App\Models\Mx\Company as MxCompany;
use App\Models\Ph\Company as PhCompany;
use App\Models\My\Company as MyCompany;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');
        $results = collect();

        if ($q) {
            $sg = SgCompany::selectRaw("
                id, name, slug, registration_number,
                MATCH(name, slug, registration_number) AGAINST (? IN BOOLEAN MODE) AS relevance
            ", [$q])
                ->whereRaw("MATCH(name, slug, registration_number) AGAINST (? IN BOOLEAN MODE)", [$q])
                ->orderByDesc('relevance')
                ->get()
                ->map(fn($c) => array_merge($c->toArray(), ['country' => 'SG']));

            $mx = MxCompany::selectRaw("
                id, name, slug, registration_number,
                MATCH(name, slug, registration_number) AGAINST (? IN BOOLEAN MODE) AS relevance
            ", [$q])
                ->whereRaw("MATCH(name, slug, registration_number) AGAINST (? IN BOOLEAN MODE)", [$q])
                ->orderByDesc('relevance')
                ->get()
                ->map(fn($c) => array_merge($c->toArray(), ['country' => 'MX']));

            $ph = PhCompany::selectRaw("
                id, name, slug, registration_number,
                MATCH(name, slug, registration_number) AGAINST (? IN BOOLEAN MODE) AS relevance
            ", [$q])
                ->whereRaw("MATCH(name, slug, registration_number) AGAINST (? IN BOOLEAN MODE)", [$q])
                ->orderByDesc('relevance')
                ->get()
                ->map(fn($c) => array_merge($c->toArray(), ['country' => 'PH']));

            $my = MyCompany::selectRaw("
                id, name, slug, registration_number,
                MATCH(name, slug, registration_number) AGAINST (? IN BOOLEAN MODE) AS relevance
            ", [$q])
                ->whereRaw("MATCH(name, slug, registration_number) AGAINST (? IN BOOLEAN MODE)", [$q])
                ->orderByDesc('relevance')
                ->get()
                ->map(fn($c) => array_merge($c->toArray(), ['country' => 'MY']));

            $results = $sg->concat($mx)->concat($ph)->concat($my)->sortByDesc('relevance')->values();
        }

        

        if ($request->wantsJson()) {
            return response()->json(['data' => $results]);
        }

        return view('search.index', ['results' => $results, 'q' => $q]);
    }

}
