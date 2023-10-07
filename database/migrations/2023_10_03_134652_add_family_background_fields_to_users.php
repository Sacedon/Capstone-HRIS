<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Spouse's Information
            $table->string('spouse_surname')->nullable();
            $table->string('spouse_first_name')->nullable();
            $table->string('spouse_name_extension')->nullable();
            $table->string('spouse_middle_name')->nullable();
            $table->string('spouse_occupation')->nullable();
            $table->string('spouse_employer')->nullable();
            $table->string('spouse_business_address')->nullable();
            $table->string('spouse_telephone')->nullable();

             // Father's Information
             $table->string('father_surname')->nullable();
             $table->string('father_first_name')->nullable();
             $table->string('father_name_extension')->nullable();
             $table->string('father_middle_name')->nullable();

             // Mother's Information
            $table->string('mother_maiden_surname')->nullable();
            $table->string('mother_first_name')->nullable();
            $table->string('mother_middle_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'spouse_surname',
                'spouse_first_name',
                'spouse_name_extension',
                'spouse_middle_name',
                'spouse_occupation',
                'spouse_employer',
                'spouse_business_address',
                'spouse_telephone',
                'father_surname',
                'father_first_name',
                'father_name_extension',
                'father_middle_name',
                'mother_maiden_surname',
                'mother_first_name',
                'mother_middle_name',
            ]);
        });
    }
};
