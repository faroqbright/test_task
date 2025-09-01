<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mx\Company;
use App\Models\Mx\State;
use App\Models\Mx\Report;
use App\Models\Mx\ReportState;

class MxSeeder extends Seeder
{
    public function run(): void
    {
        Company::on('mx')->truncate();
        State::on('mx')->truncate();
        Report::on('mx')->truncate();
        ReportState::on('mx')->truncate();

        $state = State::on('mx')->create(['name' => 'Guadalajara']);

        $company = Company::on('mx')->create([
            'name' => 'Alpha Industries Ltd',
            'slug' => 'alpha-industries',
            'registration_number' => 'MX123987',
            'state_id' => $state->id
        ]);

        $report1 = Report::on('mx')->create(['title' => 'Financial Audit Report']);
        $report2 = Report::on('mx')->create(['title' => 'Regulatory Compliance Report']);

        ReportState::on('mx')->create([
            'state_id' => $state->id,
            'report_id' => $report1->id,
            'amount' => 250
        ]);
        ReportState::on('mx')->create([
            'state_id' => $state->id,
            'report_id' => $report2->id,
            'amount' => 180
        ]);
    }
}
