<?php

namespace Homeful\Contacts\Database\Factories;

use Homeful\Contacts\Enums\{AddressType, CivilStatus, Employment, EmploymentStatus, EmploymentType, Industry, Nationality, Ownership, Sex};
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
            'civil_status' => CivilStatus::random()->value,
            'sex' => Sex::random()->value,
            'nationality' => Nationality::random()->value,
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
                'civil_status' => CivilStatus::random()->value,
                'sex' => Sex::random()->value,
                'nationality' => Nationality::random()->value,
                'date_of_birth' => $this->faker->date(),
                'email' => $this->faker->email(),
                'mobile' => $customFaker->phoneNumber(),
                'other_mobile' => $customFaker->phoneNumber(),
                'help_number' => $customFaker->phoneNumber(),
                'landline' => $customFaker->phoneNumber(),
                'mothers_maiden_name' => $this->faker->lastName().', '.$this->faker->firstName().' '.$this->faker->lastName(),
            ],
            'aif' => [
                'first_name' => $this->faker->firstName(),
                'middle_name' => $this->faker->lastName(),
                'last_name' => $this->faker->lastName(),
                'name_suffix' => $customFaker->nameSuffix(),
                'civil_status' => CivilStatus::random()->value,
                'sex' => Sex::random()->value,
                'nationality' => Nationality::random()->value,
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
                    'type' => AddressType::PRIMARY->value,
                    'ownership' => Ownership::OWNED->value,
                    'address1' => $this->faker->address(),
                    'sublocality' => $this->faker->city(),
                    'locality' => $this->faker->city(),
                    'administrative_area' => $this->faker->randomElement(['NCR', 'Metro Manila', 'Cebu']),
                    'postal_code' => $this->faker->postcode(),
                    'region' => $this->faker->word(),
                    'country' => 'PH',
                ],
                [
                    'type' => AddressType::SECONDARY->value,
                    'ownership' => Ownership::OWNED->value,
                    'address1' => $this->faker->address(),
                    'sublocality' => $this->faker->city(),
                    'locality' => $this->faker->city(),
                    'postal_code' => $this->faker->postcode(),
                    'region' => $this->faker->word(),
                    'country' => 'PH',
                ],
            ],
            'employment' => [
                [
                    'type' => Employment::PRIMARY->value,
                    'employment_status' => EmploymentStatus::REGULAR->value,
                    'monthly_gross_income' => $this->faker->numberBetween(12000, 25000) * 100,
                    'current_position' => $this->faker->word(),
                    'employment_type' => EmploymentType::LOCALLY_EMPLOYED->value,
                    'employer' => [
                        'name' => $this->faker->word(),
                        'industry' => Industry::random()->value,
                        'nationality' => Nationality::random()->value,
                        'address' => [
                            'type' => AddressType::PRIMARY->value,
                            'ownership' => Ownership::random()->value,
                            'address1' => $this->faker->address(),
                            'sublocality' => $this->faker->city(),
                            'locality' => $this->faker->city(),
                            'postal_code' => $this->faker->postcode(),
                            'region' => 'NCR',
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
                    'type' => Employment::SIDELINE->value,
                    'employment_status' => EmploymentStatus::CONTRACTUAL->value,
                    'monthly_gross_income' => (string) ($this->faker->numberBetween(12000, 25000) * 100),
                    'current_position' => $this->faker->word(),
                    'employment_type' => EmploymentType::LOCALLY_EMPLOYED->value,
                    'employer' => [
                        'name' => $this->faker->word(),
                        'industry' => Industry::random()->value,
                        'nationality' => Nationality::random()->value,
                        'address' => [
                            'type' => AddressType::PRIMARY->value,
                            'ownership' => Ownership::random()->value,
                            'address1' => $this->faker->address(),
                            'sublocality' => $this->faker->city(),
                            'locality' => $this->faker->city(),
                            'postal_code' => $this->faker->postcode(),
                            'region' => 'NCR',
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
                    'civil_status' => CivilStatus::random()->value,
                    'sex' => Sex::random()->value,
                    'nationality' => Nationality::random()->value,
                    'date_of_birth' => $this->faker->date(),
                    'email' => $this->faker->email(),
                    'mobile' => $customFaker->phoneNumber(),
                ],
                [
                    'first_name' => $this->faker->firstName(),
                    'middle_name' => $this->faker->lastName(),
                    'last_name' => $this->faker->lastName(),
                    'civil_status' => CivilStatus::random()->value,
                    'sex' => Sex::random()->value,
                    'nationality' => Nationality::random()->value,
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
