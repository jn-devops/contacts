<?php

namespace Homeful\Contacts\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as BaseGenerator;
use Homeful\Contacts\Models\Contact;
use InvalidArgumentException;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        $customFaker = new CustomFakerGenerator;

        return [
            'reference_code' => $this->faker->uuid(),
            'first_name' => $this->faker->firstName(),
            'middle_name' => $this->faker->lastName(),
            'last_name' => $this->faker->lastName(),
            'name_suffix' => $customFaker->nameSuffix(),
            'civil_status' => $this->faker->randomElement(['Single', 'Married', 'Annulled/Divorced', 'Legally Seperated', 'Widow/er']),
            'sex' => $this->faker->randomElement(['Male', 'Female']),
            'nationality' => 'Filipino',
            'date_of_birth' => $this->faker->date(),
            'email' => $this->faker->email(),
            'mobile' => $customFaker->phoneNumber(),
            'other_mobile' => $customFaker->phoneNumber(),
            'help_number' => $customFaker->phoneNumber(),
            'landline' => $customFaker->phoneNumber(),
            'mothers_maiden_name' => $this->faker->lastName().', '.$this->faker->firstName().' '.$this->faker->lastName(),
            'spouse' => [
                'first_name' => $this->faker->firstName(),
                'middle_name' => $this->faker->lastName(),
                'last_name' => $this->faker->lastName(),
                'name_suffix' => $customFaker->nameSuffix(),
                'civil_status' => $this->faker->randomElement(['Single', 'Married', 'Annulled/Divorced', 'Legally Seperated', 'Widow/er']),
                'sex' => $this->faker->randomElement(['Male', 'Female']),
                'nationality' => 'Filipino',
                'date_of_birth' => $this->faker->date(),
                'email' => $this->faker->email(),
                'mobile' => $customFaker->phoneNumber(),
                'other_mobile' => $customFaker->phoneNumber(),
                'help_number' => $customFaker->phoneNumber(),
                'landline' => $customFaker->phoneNumber(),
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
                    'region' => $this->faker->word(),
                    'country' => 'PH',
                ],
                [
                    'type' => 'secondary',
                    'ownership' => $this->faker->word(),
                    'address1' => $this->faker->address(),
                    'locality' => $this->faker->city(),
                    'postal_code' => $this->faker->postcode(),
                    'region' => $this->faker->word(),
                    'country' => 'PH',
                ],
            ],
            'employment' => [
                [
                    'type' => 'buyer',
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
                [
                    'type' => 'spouse',
                    'employment_status' => $this->faker->word(),
                    'monthly_gross_income' => (string) ($this->faker->numberBetween(12000, 25000) * 100),
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
                    'mobile' => $customFaker->phoneNumber(),
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
                    'mobile' => $customFaker->phoneNumber(),
                ],
            ],
            'order' => [
                'sku' => $this->faker->word(),
                'seller_commission_code' => $this->faker->word(),
                'property_code' => $this->faker->word(),
                'loan_term'=>(string)$this->faker->numberBetween(180, 360),
                'lot_area'=>$this->faker->numberBetween(23, 150),
                'exec_tin_no' => $this->faker->numerify('###-###-###-###'),
                'payment_scheme' => [
                    'payments' => [],
                    'fess' => [],
                ],
                'seller' => [
                    'chief_seller_officer'=>$this->faker->firstName().' '.$this->faker->lastName(),
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
class CustomFakerGenerator extends BaseGenerator
{
    /**
     * Get a random element from an array.
     *
     * @return mixed
     */
    public function randomElement(array $array)
    {
        if (empty($array)) {
            throw new InvalidArgumentException('Array cannot be empty.');
        }

        $index = array_rand($array);

        return $array[$index];
    }

    public function nameSuffix()
    {
        $suffixes = ['Jr.', 'Sr.', 'I', 'II', 'III', 'IV', 'V'];

        return $this->randomElement($suffixes);
    }

    public function phoneNumber(): string
    {
        $randomNumber = str_pad(rand(0, 999999999), 9, '0', STR_PAD_LEFT);

        return '+639'.$randomNumber;
    }
}
