<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\My\Company;
use App\Models\My\CompanyType;
use App\Models\My\Report;

class MySeeder extends Seeder
{
    public function run(): void
    {
        Company::on('my')->truncate();
        CompanyType::on('my')->truncate();
        Report::on('my')->truncate();

        $type = CompanyType::on('my')->create(['name' => 'Public Limited']);

        $company = Company::on('my')->create([
            'name' => 'Orion Tech MY',
            'slug' => 'orion-tech',
            'registration_number' => 'MY987654',
            'company_type_id' => $type->id
        ]);

        Report::on('my')->create([
            'company_type_id' => $type->id,
            'title' => 'Annual Statement Report',
            'price' => 300,
            'status' => 'enabled'
        ]);

        Report::on('my')->create([
            'company_type_id' => $type->id,
            'title' => 'Compliance Audit Report',
            'price' => 400,
            'status' => 'disabled'
        ]);
    }
}
