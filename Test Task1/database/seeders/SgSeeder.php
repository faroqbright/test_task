<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sg\Company;
use App\Models\Sg\Report;

class SgSeeder extends Seeder
{
    public function run(): void
    {
        Company::on('sg')->truncate();
        Report::on('sg')->truncate();

        $company = Company::on('sg')->create([
            'name' => 'Orion Systems Pte Ltd',
            'slug' => 'orion-systems',
            'registration_number' => 'SG987654',
            'address' => '10 Raffles Place, Singapore'
        ]);

        Report::on('sg')->create([
            'company_id' => $company->id,
            'title' => 'Annual Report 2024',
            'price' => 150,
            'type' => 'PDF'
        ]);

        Report::on('sg')->create([
            'company_id' => $company->id,
            'title' => 'Financial Statement Q2 2024',
            'price' => 95,
            'type' => 'Excel'
        ]);
    }
}
