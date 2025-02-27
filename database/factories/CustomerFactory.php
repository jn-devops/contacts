<?php

namespace Homeful\Contacts\Database\Factories;

use Homeful\Contacts\Enums\{AddressType, CivilStatus, CoBorrowerType, Employment, EmploymentStatus,
    EmploymentType, Industry, Nationality, Ownership, Sex, Suffix};
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as BaseGenerator;
use Homeful\Contacts\Models\Customer;
use InvalidArgumentException;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition()
    {
        $customFaker = new CustomFakerGenerator;

        return [
            'first_name' => $this->faker->firstName(),
            'middle_name' => $this->faker->lastName(),
            'last_name' => $this->faker->lastName(),
            'name_suffix' => Suffix::random()->value,
            'civil_status' => CivilStatus::random()->value,
            'sex' => Sex::random()->value,
            'nationality' => Nationality::random()->value,
            'date_of_birth' => $this->faker->date(),
            'email' => $this->faker->email(),
            'mobile' => $customFaker->phoneNumber(),
            'mothers_maiden_name' => $this->faker->lastName().', '.$this->faker->firstName().' '.$this->faker->lastName(),
            'addresses' => [
                [
                    'type' => AddressType::PRIMARY->value,
                    'ownership' => Ownership::OWNED->value,
                    'address1' => $this->faker->address(),
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
            'spouse' => [
                'first_name' => $this->faker->firstName(),
                'middle_name' => $this->faker->lastName(),
                'last_name' => $this->faker->lastName(),
                'name_suffix' => Suffix::random()->value,
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
            'co_borrowers' => [
                [
                    'type' => CoBorrowerType::PRIMARY->value,
                    'first_name' => $this->faker->firstName(),
                    'middle_name' => $this->faker->lastName(),
                    'last_name' => $this->faker->lastName(),
                    'civil_status' => CivilStatus::random()->value,
                    'sex' => Sex::random()->value,
                    'nationality' => Nationality::random()->value,
                    'date_of_birth' => $this->faker->date(),
                    'email' => $this->faker->email(),
                    'mobile' => $customFaker->phoneNumber(),
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
                    'spouse' => [
                        'first_name' => $this->faker->firstName(),
                        'middle_name' => $this->faker->lastName(),
                        'last_name' => $this->faker->lastName(),
                        'name_suffix' => Suffix::random()->value,
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
                            'locality' => $this->faker->city(),
                            'postal_code' => $this->faker->postcode(),
                            'region' => $this->faker->word(),
                            'country' => 'PH',
                        ],
                    ],
                ],
                [
                    'type' => CoBorrowerType::SECONDARY->value,
                    'first_name' => $this->faker->firstName(),
                    'middle_name' => $this->faker->lastName(),
                    'last_name' => $this->faker->lastName(),
                    'civil_status' => CivilStatus::random()->value,
                    'sex' => Sex::random()->value,
                    'nationality' => Nationality::random()->value,
                    'date_of_birth' => $this->faker->date(),
                    'email' => $this->faker->email(),
                    'mobile' => $customFaker->phoneNumber(),
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
                    'spouse' => [
                        'first_name' => $this->faker->firstName(),
                        'middle_name' => $this->faker->lastName(),
                        'last_name' => $this->faker->lastName(),
                        'name_suffix' => Suffix::random()->value,
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
                            'locality' => $this->faker->city(),
                            'postal_code' => $this->faker->postcode(),
                            'region' => $this->faker->word(),
                            'country' => 'PH',
                        ],
                    ],
                ],
            ],
            'aif' => [
                'first_name' => $this->faker->firstName(),
                'middle_name' => $this->faker->lastName(),
                'last_name' => $this->faker->lastName(),
                'name_suffix' => Suffix::random()->value,
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
            'idImage' => null,
            'selfieImage' => null,
            'payslipImage' => null,
            'voluntarySurrenderFormDocument' => null,
            'usufructAgreementDocument' => null,
            'contractToSellDocument' => null,
        ];
    }

    /**
     * Include the `id` attribute in the factory on demand.
     *
     * @param string|null $customId If null, it will generate a random UUID.
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withId(?string $customId = null): Factory
    {
        return $this->state(fn(array $attributes) => [
            'id' => $customId ?? $this->faker->uuid(),
        ]);
    }

    /**
     * Customize the `employment` attribute of the factory with user-defined overrides.
     *
     * This method allows overriding the `employment` sub-arrays within the factory definition dynamically.
     * If any overrides are missing required attributes, they will be filled using the default values
     * from the factory's `definition()` method.
     *
     * Example Usage:
     * ```php
     * Customer::factory()->withEmployment([
     *     0 => [
     *         'type' => 'Primary',
     *         'monthly_gross_income' => 50000,
     *         'current_position' => 'Developer',
     *     ],
     *     1 => [
     *         'type' => 'Sideline',
     *         'monthly_gross_income' => 20000,
     *         'current_position' => 'Freelancer',
     *     ]
     * ])->create();
     * ```
     *
     * How it Works:
     * - For each sub-array provided in `$employmentOverrides`, it fetches the corresponding default
     *   sub-array based on the index (0, 1, etc.) from the factory definition.
     * - If the specified index does not exist, it falls back to the default sub-array at index 0.
     * - It merges the user-provided overrides with the default values, ensuring any missing fields
     *   are filled in automatically.
     *
     * @param array $employmentOverrides An array of employment overrides where the keys represent
     *                                   sub-array indices (e.g., 0 for primary employment).
     *                                   Each override array may include fields like:
     *                                   - 'type': Employment type (e.g., 'Primary', 'Sideline').
     *                                   - 'monthly_gross_income': Custom income value.
     *                                   - 'current_position': Custom position.
     *                                   Other fields not provided will be auto-filled from defaults.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withEmployment(array $employmentOverrides): Factory
    {
        return $this->state(fn(array $attributes) => [
            'employment' => array_map(function ($overrides, $index) {
                // Fetch the default sub-array based on the index or fallback to the first sub-array default.
                $defaultEmployment = $this->definition()['employment'][$index] ?? $this->definition()['employment'][0];

                // Merge user overrides with the default employment data.
                return array_merge($defaultEmployment, $overrides);
            }, $employmentOverrides, array_keys($employmentOverrides)),
        ]);
    }

    /**
     * Customize the `co_borrowers` attribute of the factory with user-defined overrides,
     * including nested `employment` overrides within each co-borrower.
     *
     * This method allows overriding co-borrower attributes, and for each co-borrower,
     * it further supports overriding their nested `employment` attributes dynamically.
     *
     * Example Usage:
     * ```php
     * Customer::factory()->withCoBorrowers([
     *     0 => [
     *         'type' => 'Primary',
     *         'first_name' => 'John',
     *         'last_name' => 'Doe',
     *         'employment' => [
     *             0 => [
     *                 'type' => 'Primary',
     *                 'monthly_gross_income' => 50000,
     *                 'current_position' => 'Manager',
     *             ]
     *         ]
     *     ],
     *     1 => [
     *         'type' => 'Secondary',
     *         'first_name' => 'Jane',
     *         'last_name' => 'Smith',
     *         'employment' => [
     *             0 => [
     *                 'type' => 'Secondary',
     *                 'monthly_gross_income' => 30000,
     *                 'current_position' => 'Analyst',
     *             ]
     *         ]
     *     ]
     * ])->create();
     * ```
     *
     * How it Works:
     * - The method first merges co-borrower attributes with their respective defaults.
     * - If an `employment` sub-array override is provided, it further merges it with the
     *   default employment values to handle any missing fields automatically.
     *
     * @param array $coBorrowerOverrides An array of co-borrower overrides where the keys represent sub-array indices.
     *                                   Each co-borrower override may include:
     *                                   - `type`: Co-borrower type (e.g., 'Primary', 'Secondary').
     *                                   - `first_name`, `last_name`, etc.: Other co-borrower fields.
     *                                   - `employment`: Nested array of employment overrides, similar to `withEmployment`.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withCoBorrowers(array $coBorrowerOverrides): Factory
    {
        return $this->state(fn(array $attributes) => [
            'co_borrowers' => array_map(function ($overrides, $index) {
                // Fetch the default co-borrower data based on the index or fallback to the first default.
                $defaultCoBorrower = $this->definition()['co_borrowers'][$index] ?? $this->definition()['co_borrowers'][0];

                // Merge the co-borrower overrides with the default.
                $mergedCoBorrower = array_merge($defaultCoBorrower, $overrides);

                // Handle nested employment overrides if provided.
                if (isset($overrides['employment'])) {
                    $mergedCoBorrower['employment'] = array_map(function ($employmentOverrides, $employmentIndex) {
                        // Fetch the default employment data based on the index or fallback to the first employment default.
                        $defaultEmployment = $this->definition()['employment'][$employmentIndex] ?? $this->definition()['employment'][0];

                        // Merge employment overrides with the default employment data.
                        return array_merge($defaultEmployment, $employmentOverrides);
                    }, $overrides['employment'], array_keys($overrides['employment']));
                }

                return $mergedCoBorrower;
            }, $coBorrowerOverrides, array_keys($coBorrowerOverrides)),
        ]);
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
        $mobile = '9537' . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        return phone($mobile, 'PH')->formatForMobileDialingInCountry('PH');
    }
}
