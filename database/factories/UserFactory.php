<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => $this->faker->userName,
            'surname' => $this->faker->lastName,
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->firstName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => $this->faker->randomElement(['employee']),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'date_of_birth' => $this->faker->date,
            'civil_status' => $this->faker->randomElement(['single', 'married', 'separated', 'widowed']),
            'height' => $this->faker->randomFloat(2, 150, 200),
            'weight' => $this->faker->randomNumber(2, false),
            'blood_type' => $this->faker->randomElement(['A+', 'B+', 'AB+', 'O+', 'A-', 'B-', 'AB-', 'O-']),
            'sss_id_no' => $this->faker->numerify('#########'),
            'pag_ibig_id_no' => $this->faker->numerify('#########'),
            'philhealth_no' => $this->faker->numerify('#########'),
            'tin_no' => $this->faker->numerify('#########'),
            'mdc_id' => $this->faker->numerify('MD######'),
            'place_of_birth' => $this->faker->city,
            'residential_house_no' => $this->faker->buildingNumber,
            'residential_street' => $this->faker->streetName,
            'residential_subdivision' => $this->faker->word,
            'residential_barangay' => $this->faker->word,
            'residential_city' => $this->faker->city,
            'residential_province' => $this->faker->state,
            'residential_zip_code' => $this->faker->postcode,
            'permanent_house_no' => $this->faker->buildingNumber,
            'permanent_street' => $this->faker->streetName,
            'permanent_subdivision' => $this->faker->word,
            'permanent_barangay' => $this->faker->word,
            'permanent_city' => $this->faker->city,
            'permanent_province' => $this->faker->state,
            'permanent_zip_code' => $this->faker->postcode,
            'telephone_number' => $this->faker->phoneNumber,
            'mobile_number' => $this->faker->phoneNumber,
            'messenger_account' => $this->faker->userName,
            'spouse_surname' => $this->faker->lastName,
            'spouse_first_name' => $this->faker->firstName,
            'spouse_name_extension' => $this->faker->suffix,
            'spouse_middle_name' => $this->faker->firstName,
            'spouse_occupation' => $this->faker->word,
            'spouse_employer' => $this->faker->company,
            'spouse_business_address' => $this->faker->address,
            'spouse_telephone' => $this->faker->phoneNumber,
            'father_surname' => $this->faker->lastName,
            'father_first_name' => $this->faker->firstName,
            'father_name_extension' => $this->faker->suffix,
            'father_middle_name' => $this->faker->firstName,
            'mother_maiden_surname' => $this->faker->lastName,
            'mother_first_name' => $this->faker->firstName,
            'mother_middle_name' => $this->faker->firstName,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
