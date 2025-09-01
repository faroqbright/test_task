<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ph\Company;
use App\Models\Ph\ReportType;
use App\Models\Ph\ReportPrice;
use App\Models\Ph\Report;

class PhSeeder extends Seeder
{
    public function run(): void
    {
        Company::on('ph')->truncate();
        ReportType::on('ph')->truncate();
        ReportPrice::on('ph')->truncate();
        Report::on('ph')->truncate();

        $company = Company::on('ph')->create([
            'name' => 'Nova Enterprises PH',
            'slug' => 'nova-enterprises',
            'registration_number' => 'PH112233',
            'address' => 'Quezon City, Philippines'
        ]);

        $type1 = ReportType::on('ph')->create(['name' => 'Financial Summary', 'price' => 75]);
        $type2 = ReportType::on('ph')->create(['name' => 'Full Audit Report', 'price' => 200]);

        $price1 = ReportPrice::on('ph')->create(['report_type_id' => $type1->id, 'pages' => 20]);
        $price2 = ReportPrice::on('ph')->create(['report_type_id' => $type2->id, 'pages' => 100]);

        Report::on('ph')->create([
            'company_id' => $company->id,
            'report_price_id' => $price1->id,
            'period_date' => '2024-01-31'
        ]);

        Report::on('ph')->create([
            'company_id' => $company->id,
            'report_price_id' => $price1->id,
            'period_date' => '2024-04-30'
        ]);

        Report::on('ph')->create([
            'company_id' => $company->id,
            'report_price_id' => $price2->id,
            'period_date' => '2023-09-30'
        ]);
    }
}
