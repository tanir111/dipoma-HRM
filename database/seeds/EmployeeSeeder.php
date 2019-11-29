<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('employees')->insert([
            'photo' => '',
            'code' => 'HR0001',
            'status' => '1',
            'name' => 'HR Manager',
            'gender' => '1',
            'date_of_birth' => '01/01/1990',
            'date_of_joining' => '11/30/2019',
            'number' => '+7 (000) 000-00-00',
            'qualification' => 'B.Com',
            'emergency_number' => '+7 (000) 000-00-00',
            'current_address' => 'Zhandosova',
            'permanent_address' => 'Manasa',
            'formalities' => '1',
            'offer_acceptance' => '1',
            'probation_period' => '0',
            'date_of_confirmation' => '11/30/2019',
            'department' => 'IT',
            'salary' => '900000',
            'account_number' => '7777-7777-7777-7777',
            'bank_name' => 'American National Bank',
            'pf_status' => '1',
            'date_of_resignation' => '11/29/2019',
            'notice_period' => '1',
            'last_working_day' => '03/31/2020',
            'full_final' => '1',
            'user_id' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
