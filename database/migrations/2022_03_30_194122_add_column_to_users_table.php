<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('company_name');
            $table->string('company_address')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('dob')->nullable();
            $table->string('home_address')->nullable();
            $table->string('spouse_first_name')->nullable();
            $table->string('spouse_middle_name')->nullable();
            $table->string('spouse_last_name')->nullable();
            $table->string('company_phone', 30)->nullable();
            $table->string('company_email')->nullable();
            $table->string('contact_info')->nullable();
            $table->string('user_name', 20);
            $table->enum('marital_status', ['single', 'married', 'widowed','seperated']);
            $table->string('present_employer_name', 20);
            $table->string('present_employer_address', 250);
            $table->string('present_employer_position', 30);
            $table->date('present_employer_since', 20);
            $table->integer('present_employer_phone');
            $table->string('previous_employer_name', 20);
            $table->string('previous_employer_address', 250);
            $table->string('previous_employer_position', 30);
            $table->date('previous_employer_since', 20);
            $table->integer('previous_employer_phone');
            $table->string('spouse_present_employer_name', 20);
            $table->string('spouse_present_employer_address', 250);
            $table->string('spouse_present_employer_position', 30);
            $table->date('spouse_present_employer_since', 20);
            $table->integer('spouse_present_employer_phone');
            $table->string('spouse_previous_employer_name', 20);
            $table->string('spouse_preious_employer_address', 250);
            $table->string('spouse_previous_employer_position', 30);
            $table->date('spouse_previous_employer_since', 20);
            $table->integer('spouse_previous_employer_phone');
            $table->integer('own_salary');
            $table->integer('spouse_salary');
            $table->integer('other_income');
            $table->integer('total_income');
            $table->integer('fixed_obligations');
            $table->integer('other_living_expense');
            $table->integer('net_monthly_income');
            $table->string('refference_first_name', 20);
            $table->string('refference_last_name', 20);
            $table->string('refference_company_name', 20);
            $table->string('refference_position', 20);
            $table->string('refference_address', 250);
            $table->integer('refference_mobile');
            $table->integer('verified')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
