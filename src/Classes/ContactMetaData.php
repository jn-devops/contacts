<?php

namespace Homeful\Contacts\Classes;

use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;
use Spatie\LaravelData\Attributes\{WithCast, WithTransformer};
use Homeful\Contacts\Enums\{AddressType,
    CivilStatus,
    CoBorrowerType,
    Employment,
    EmploymentStatus,
    EmploymentType,
    Industry,
    Nationality,
    Ownership,
    Sex};
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\{Data, DataCollection};
use Homeful\Contacts\Models\Contact;
use Homeful\Common\Traits\WithAck;
use Illuminate\Support\Carbon;

class ContactMetaData extends Data
{
    use WithAck;

    public string $name;

    public function __construct(
        public string $first_name,
        public ?string $middle_name,
        public string $last_name,
        public ?string $name_suffix,
        public ?string $mothers_maiden_name,
        public string $email,
        public string $mobile,
        public ?string $other_mobile,
        public ?string $help_number,
        public ?string $landline,
        public CivilStatus|null $civil_status,
        public Sex|null $sex,
        public Nationality|null $nationality,
        #[WithTransformer(DateTimeInterfaceTransformer::class, format: 'Y-m-d')]
        #[WithCast(DateTimeInterfaceCast::class, timeZone: 'Asia/Manila', format: 'Y-m-d')]
        public Carbon|null $date_of_birth,
        /** @var AddressMetadata[] */
        public ?DataCollection $addresses,
        /** @var EmploymentMetadata[] */
        public ?DataCollection $employment,
        public ?SpouseMetadata $spouse,
        /** @var CoBorrowerMetadata[] */
        public ?DataCollection $co_borrowers,
        public ?AIFMetadata $aif
    ) {
        $this->name = implode(' ', array_filter([$this->first_name, $this->middle_name, $this->last_name, $this->name_suffix]));
    }

//    public static function fromModel(Contact $model): self
//    {
//        return new self(
//            first_name: $model->first_name,
//            middle_name: $model->middle_name,
//            last_name: $model->last_name,
//            name_suffix: $model->name_suffix,
//            mothers_maiden_name: $model->mothers_maiden_name,
//            email: $model->email,
//            mobile: $model->mobile,
//            other_mobile: $model->other_mobile,
//            help_number: $model->help_number,
//            landline: $model->landline,
//            civil_status: CivilStatus::from($model->civil_status),
//            sex: Sex::from($model->sex),
//            nationality: Nationality::from($model->nationality),
//            date_of_birth: $model->date_of_birth,
//            addresses: new DataCollection(
//                dataClass: AddressMetadata::class,
//                items: array_map(
//                    fn($address) => new AddressMetadata(
//                        type: AddressType::from($address['type']),
//                        ownership: Ownership::from($address['ownership']),
//                        address1: $address['address1'],
//                        locality: $address['locality'],
//                        administrative_area: $address['administrative_area'] ?? '',
//                        postal_code: $address['postal_code'],
//                        region: $address['region'],
//                        country: $address['country']
//                    ),
//                    $model->addresses
//                )
//            ),
//            employment: new DataCollection(
//                dataClass: EmploymentMetadata::class,
//                items: array_map(
//                    fn($employment) => new EmploymentMetadata(
//                        type: Employment::from($employment['type']),
//                        monthly_gross_income: $employment['monthly_gross_income'],
//                        employment_status: EmploymentStatus::from($employment['employment_status']),
//                        employer: $employment['employer'] ? new EmployerMetadata(
//                            name: $employment['employer']['name'],
//                            email: $employment['employer']['email'] ?? null,
//                            contact_no: $employment['employer']['contact_no'] ?? null,
//                            nationality:$employment['employer']['nationality'] ? Nationality::from($employment['employer']['nationality']) : null,
//                            industry: $employment['employer']['industry'] ? Industry::from($employment['employer']['industry']) : null,
//                            address: $employment['employer']['address'] ? new AddressMetadata(
//                                type: AddressType::from($employment['employer']['address']['type']),
//                                ownership: Ownership::from($employment['employer']['address']['ownership']),
//                                address1: $employment['employer']['address']['address1'],
//                                locality: $employment['employer']['address']['locality'],
//                                administrative_area: $employment['employer']['address']['administrative_area'] ?? '',
//                                postal_code: $employment['employer']['address']['postal_code'],
//                                region: $employment['employer']['address']['region'],
//                                country: $employment['employer']['address']['country']
//                            ) : null
//                        ) : null,
//                        employment_type: $employment['employment_type'] ? EmploymentType::from($employment['employment_type']) : null,
//                        current_position: $employment['current_position'] ?? null,
//                        id: $employment['id'] ? new IdMetadata(
//                            tin: $employment['id']['tin'], // Assuming the 'tin' key exists in the array
//                            pagibig: $employment['id']['pagibig'] ?? null,
//                            sss: $employment['id']['sss'] ?? null,
//                            gsis: $employment['id']['gsis'] ?? null
//                        ) : null
//                    ),
//                    $model->employment
//                )
//            ),
//            spouse: $model->spouse ? new SpouseMetadata(
//                first_name: $model->spouse['first_name'],
//                middle_name: $model->spouse['middle_name'],
//                landline: $model->spouse['last_name'],
//                name_suffix: $model->spouse['name_suffix'] ?? null,
//                mothers_maiden_name: $model->spouse['mothers_maiden_name'] ?? null,
//                civil_status: CivilStatus::from($model->spouse['civil_status']),
//                sex: Sex::from($model->spouse['sex']),
//                nationality: Nationality::from($model->spouse['nationality']),
//                date_of_birth: $model->spouse['date_of_birth'],
//                employment: new DataCollection(
//                    dataClass: EmploymentMetadata::class,
//                    items: array_map(
//                        fn($employment) => new EmploymentMetadata(
//                            type: Employment::from($employment['type']),
//                            monthly_gross_income: $employment['monthly_gross_income'],
//                            employment_status: EmploymentStatus::from($employment['employment_status']),
//                            employer: null,
//                            employment_type: null,
//                            current_position: $employment['current_position'] ?? null,
//                            id: null
//                        ),
//                        $model->spouse['employment'] ?? []
//                    )
//                ),
//                email: $model->spouse['email'] ?? null,
//                mobile: $model->spouse['mobile'] ?? null,
//                other_mobile: $model->spouse['other_mobile'] ?? null,
//                last_name: $model->spouse['landline'] ?? null
//            ) : null,
//            co_borrowers: new DataCollection(
//                dataClass: CoBorrowerMetadata::class,
//                items: array_map(
//                    fn($co_borrower) => new CoBorrowerMetadata(
//                        type: CoBorrowerType::from($co_borrower['type'] ?? 'Primary'), // Default to 'Primary' if type is not provided
//                        first_name: $co_borrower['first_name'],
//                        middle_name: $co_borrower['middle_name'],
//                        last_name: $co_borrower['last_name'],
//                        name_suffix: $co_borrower['name_suffix'] ?? null,
//                        mothers_maiden_name: $co_borrower['mothers_maiden_name'] ?? null,
//                        civil_status: CivilStatus::from($co_borrower['civil_status']),
//                        sex: Sex::from($co_borrower['sex']),
//                        nationality: Nationality::from($co_borrower['nationality']),
//                        date_of_birth: $co_borrower['date_of_birth'],
//                        employment: new DataCollection(
//                            EmploymentMetadata::class,
//                            array_map(
//                                fn($employment) => new EmploymentMetadata(
//                                    type: Employment::from($employment['type']),
//                                    monthly_gross_income: $employment['monthly_gross_income'],
//                                    employment_status: EmploymentStatus::from($employment['employment_status']),
//                                    employer: $employment['employer'] ? new EmployerMetadata(
//                                        name: $employment['employer']['name'],
//                                        email: $employment['employer']['email'] ?? null,
//                                        contact_no: $employment['employer']['contact_no'] ?? null,
//                                        nationality: $employment['employer']['nationality'] ? Nationality::from($employment['employer']['nationality']) : null,
//                                        industry: $employment['employer']['industry'] ? Industry::from($employment['employer']['industry']) : null,
//                                        address: $employment['employer']['address'] ? new AddressMetadata(
//                                            AddressType::from($employment['employer']['address']['type']),
//                                            Ownership::from($employment['employer']['address']['ownership']),
//                                            $employment['employer']['address']['address1'],
//                                            $employment['employer']['address']['locality'],
//                                            $employment['employer']['address']['administrative_area'] ?? '',
//                                            $employment['employer']['address']['postal_code'],
//                                            $employment['employer']['address']['region'],
//                                            $employment['employer']['address']['country']
//                                        ) : null
//                                    ) : null,
//                                    employment_type: $employment['employment_type'] ? EmploymentType::from($employment['employment_type']) : null,
//                                    current_position: $employment['current_position'] ?? null,
//                                    id: $employment['id'] ? new IdMetadata(
//                                        tin: $employment['id']['tin'],
//                                        pagibig: $employment['id']['pagibig'] ?? null,
//                                        sss: $employment['id']['sss'] ?? null,
//                                        gsis: $employment['id']['gsis'] ?? null
//                                    ) : null
//                                ),
//                                $co_borrower['employment'] ?? []
//                            )
//                        ),
//                        email: $co_borrower['email'] ?? null,
//                        mobile: $co_borrower['mobile'] ?? null,
//                        other_mobile: $co_borrower['other_mobile'] ?? null,
//                        landline: $co_borrower['landline'] ?? null
//                    ),
//                    $model->co_borrowers
//                )
//            ),
//            aif: $model->aif ? new AIFMetadata(
//                first_name: $model->aif['first_name'],
//                middle_name: $model->aif['middle_name'],
//                last_name: $model->aif['last_name'],
//                name_suffix: $model->aif['name_suffix'] ?? null,
//                mothers_maiden_name: $model->aif['mothers_maiden_name'] ?? null,
//                civil_status: CivilStatus::from($model->aif['civil_status']),
//                sex: Sex::from($model->aif['sex']),
//                nationality: Nationality::from($model->aif['nationality']),
//                date_of_birth: $model->aif['date_of_birth'],
//                email: $model->aif['email'] ?? null,
//                mobile: $model->aif['mobile'] ?? null,
//                other_mobile: $model->aif['other_mobile'] ?? null,
//                landline: $model->aif['landline'] ?? null
//            ) : null
//        );
//    }
}
