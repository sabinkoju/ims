<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        \App\Role::insert([
            'name' => 'Admin'
        ]);

        \App\Role::insert([
            'name' => 'Staff'
        ]);
        \App\Role::insert([
            'name' => 'Teacher'
        ]);
        \App\Role::insert([
            'name' => 'Student'
        ]);

        \App\User::insert([
            'name' => 'IMS Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'phone' => '9803961735',
            'address' => 'Anamanagar, Kathamandu',
            'role_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        \App\EnquiryCategory::insert([
            'cat_name'=>'Normal Enquiry',
            'status'=> 1,
            'slug' => 'normal-enquiry'
        ]);

        \App\EnquirySource::insert([
            'name'=>'Online',
            'status'=>1,
           
        ]);


        \App\SiteSetting::insert([
            'company_name' => 'Green Computing Nepal',
            'short_name'=>'GCN'
        ]);

        \App\Shift::insert([
            ['shift_available'=>'Morning'],
            ['shift_available'=>'Day'],
            ['shift_available'=>'Evening'],
            ['shift_available'=>'Night'],
           
        ]);

         \App\Section::insert([
            'section_name' => "A",
            'no_of_students' => 25
        ]);

        
        \App\Section::insert([
            'section_name' => "B",
            'no_of_students' => 30
        ]);

        


         \App\Course::insert([

             'name'=>'MBBS',
             'code'=>'mb12',
             'slug'=>'mbbs',
             'duration'=>'4',
             'fees'=>'2000',
             'status'=>'1',
             'description'=>'thanks'
         ]);

        \App\Batch::insert([

            'batch_name'=>'MBBS2019',
            'year'=>'2019',
            'month'=>'April',
            'section'=>1


        ]);

        \App\ExpenseCategory::insert([

            ['expense_category_name'=>'Salary'],
            ['expense_category_name'=>'Rent'],
            ['expense_category_name'=>'Internet'],
            

        ]);



        \App\TeacherCategory::insert([
            [
                'cat_name'=>'Permanent',
                'status'=>'Active',

            ],
            [
                'cat_name'=>'Volunteer',
                'status'=>'Active',

            ],
            [
                'cat_name'=>'Temporary',
                'status'=>'Active',

            ],
            [
                'cat_name'=>'Visiting',
                'status'=>'Active',

            ]]

        );

        \App\StudentCategory::insert([
                [
                    'name'=>'Doctor',
                    'status'=>'1',

                ],
                [
                    'name'=>'Nurse',
                    'status'=>'1',

                ]
              ]

        );

    }
}
