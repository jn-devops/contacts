<?php

namespace Homeful\Contacts\Database\Factories;

use Faker\Provider\en_PH\PhoneNumber;
use Homeful\Contacts\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        return [
            'reference_code' => $this->faker->uuid(),
            'first_name' => $this->faker->firstName(),
            'middle_name' => $this->faker->lastName(),
            'last_name' => $this->faker->lastName(),
            'name_suffix' => $this->faker->nameSuffix(),
            'civil_status' => $this->faker->randomElement(['Single', 'Married', 'Annulled/Divorced', 'Legally Seperated', 'Widow/er']),
            'sex' => $this->faker->randomElement(['Male', 'Female']),
            'nationality' => 'Filipino',
            'date_of_birth' => $this->faker->date(),
            'email' => $this->faker->email(),
            'mobile' =>  $this->faker->phoneNumber(),
            'other_mobile' =>  $this->faker->phoneNumber(),
            'help_number' =>  $this->faker->phoneNumber(),
            'landline' =>  $this->faker->phoneNumber(),
            'mothers_maiden_name' => $this->faker->lastName().', '.$this->faker->firstName().' '.$this->faker->lastName(),
            'spouse' => [
                'first_name' => $this->faker->firstName(),
                'middle_name' => $this->faker->lastName(),
                'last_name' => $this->faker->lastName(),
                'name_suffix' => $this->faker->nameSuffix(),
                'civil_status' => $this->faker->randomElement(['Single', 'Married', 'Annulled/Divorced', 'Legally Seperated', 'Widow/er']),
                'sex' => $this->faker->randomElement(['Male', 'Female']),
                'nationality' => 'Filipino',
                'date_of_birth' => $this->faker->date(),
                'email' => $this->faker->email(),
                'mobile' => $this->faker->phoneNumber(),
                'other_mobile' => $this->faker->phoneNumber(),
                'help_number' => $this->faker->phoneNumber(),
                'landline' => $this->faker->phoneNumber(),
                'mothers_maiden_name' => $this->faker->lastName().', '.$this->faker->firstName().' '.$this->faker->lastName(),
            ],
            'addresses' => [
                [
                    'type' => 'primary',
                    'ownership' => $this->faker->word(),
                    'address1' => $this->faker->address(),
                    'locality' => $this->faker->city(),
                    'administrative_area' => $this->faker->randomElement(['NCR', 'Metro Manila', 'Cebu']),
                    'postal_code' => $this->faker->postcode(),
                    'country' => 'PH',
                ],
                [
                    'type' => 'secondary',
                    'ownership' => $this->faker->word(),
                    'address1' => $this->faker->address(),
                    'locality' => $this->faker->city(),
                    'postal_code' => $this->faker->postcode(),
                    'country' => 'PH',
                ],
            ],
            'employment' => [
                'employment_status' => $this->faker->word(),
                'monthly_gross_income' => $this->faker->numberBetween(12000, 25000) * 100,
                'current_position' => $this->faker->word(),
                'employment_type' => $this->faker->word(),
                'employer' => [
                    'name' => $this->faker->word(),
                    'industry' => $this->faker->word(),
                    'nationality' => $this->faker->word(),
                    'address' => [
                        'type' => 'work',
                        'ownership' => $this->faker->word(),
                        'address1' => $this->faker->address(),
                        'locality' => $this->faker->city(),
                        'postal_code' => $this->faker->postcode(),
                        'country' => 'PH',
                    ],
                    'contact_no' => $this->faker->word(),
                ],
                'id' => [
                    'tin' => $this->faker->word(),
                    'pagibig' => $this->faker->word(),
                    'sss' => $this->faker->word(),
                    'gsis' => $this->faker->word(),
                ],
            ],
            'co_borrowers' => [
                [
                    'first_name' => $this->faker->firstName(),
                    'middle_name' => $this->faker->lastName(),
                    'last_name' => $this->faker->lastName(),
                    'civil_status' => $this->faker->randomElement(['Single', 'Married', 'Annulled/Divorced', 'Legally Seperated', 'Widow/er']),
                    'sex' => $this->faker->randomElement(['Male', 'Female']),
                    'nationality' => 'Filipino',
                    'date_of_birth' => $this->faker->date(),
                    'email' => $this->faker->email(),
                    'mobile' => $this->faker->phoneNumber(),
                ],
                [
                    'first_name' => $this->faker->firstName(),
                    'middle_name' => $this->faker->lastName(),
                    'last_name' => $this->faker->lastName(),
                    'civil_status' => $this->faker->randomElement(['Single', 'Married', 'Annulled/Divorced', 'Legally Seperated', 'Widow/er']),
                    'sex' => $this->faker->randomElement(['Male', 'Female']),
                    'nationality' => 'Filipino',
                    'date_of_birth' => $this->faker->date(),
                    'email' => $this->faker->email(),
                    'mobile' => $this->faker->phoneNumber(),
                ],
            ],
            'order' => [
                'sku' => $this->faker->word(),
                'seller_commission_code' => $this->faker->word(),
                'property_code' => $this->faker->word(),
                'payment_scheme'=>[
                    'payments'=>[],
                    'fess'=>[],
                ],
            ],
            'idImage' => null,
            'selfieImage' => null,
            'payslipImage' => null,
            'voluntarySurrenderFormDocument' => null,
            'usufructAgreementDocument' => null,
            'contractToSellDocument' => null,
        ];
    }
}
