<?php

namespace Homeful\Contacts\Data;

use Homeful\Contacts\Models\Contact;
use PhpOption\Option;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Optional;

class ContactData extends Data
{
    public function __construct(
        public string $reference_code, //buyers reference number or brn
        public PersonData $profile,
        public ?PersonData $spouse,
        /** @var AddressData[] */
        public DataCollection $addresses,
        /** @var ContactEmploymentData[] */
        public DataCollection $employment,
        /** @var PersonData[] */
        public DataCollection|Optional $co_borrowers,
        public ?ContactOrderData $order,
        /** @var UploadData[] */
        public DataCollection|Optional $uploads,


    ) {}

    //    public static function from(...$payloads): static
    //    {
    //        $attribs = (object) $payloads[0];
    //
    //        return new self(
    //            uid: $attribs->uid,
    //            profile: new PersonData(
    //                first_name: $attribs->first_name,
    //                middle_name: $attribs->middle_name,
    //                last_name: $attribs->last_name,
    //                civil_status: $attribs->civil_status,
    //                sex: $attribs->sex,
    //                nationality: $attribs->nationality,
    //                date_of_birth: $attribs->date_of_birth,
    //                email: $attribs->email,
    //                mobile: $attribs->mobile
    //            ),
    //            spouse: $attribs->spouse ? PersonData::from($attribs->spouse) : null,
    //            addresses: new DataCollection(AddressData::class, $attribs->addresses),
    //            employment: $attribs->employment ? ContactEmploymentData::from($attribs->employment) : null,
    //            co_borrowers: new DataCollection(PersonData::class, $attribs->co_borrowers),
    //            order: $attribs->order ? ContactOrderData::from($attribs->order) : null,
    //            uploads: new DataCollection(
    //                dataClass: UploadData::class,
    //                items: collect($attribs->media)
    //                    ->mapWithKeys(function ($item, $key) {
    //                        return [
    //                            $key => [
    //                                'name' => $item['name'],
    //                                'url' => $item['original_url']
    //                            ]
    //                        ];
    //                    })
    //                    ->toArray()
    //            ),
    //            reference_code: $attribs->reference_code ?: null
    //        );
    //    }

    public static function fromModel(Contact $model): self
    {
        return new self(
            reference_code: $model->reference_code,
            profile: new PersonData(
                first_name: $model->first_name,
                middle_name: $model->middle_name,
                last_name: $model->last_name,
                name_suffix: $model->name_suffix,
                civil_status: $model->civil_status,
                sex: $model->sex,
                nationality: $model->nationality,
                date_of_birth: $model->date_of_birth->format('Y-m-d'),
                email: $model->email,
                mobile: $model->mobile->formatNational(),
                other_mobile: $model->other_mobile,
                help_number: $model->help_number,
                landline: $model->landline,
                mothers_maiden_name: $model->mothers_maiden_name,
            ),
            spouse: $model->spouse ? PersonData::from($model->spouse) : null,
            addresses: new DataCollection(AddressData::class, $model->addresses),
            employment: new DataCollection(ContactEmploymentData::class, $model->employement) ,
            co_borrowers: new DataCollection(PersonData::class, $model->co_borrowers),
            order: $model->order ? ContactOrderData::from($model->order) : null,
            uploads: new DataCollection(UploadData::class, $model->uploads),
        );
    }
}

class ContactOrderData extends Data
{
    public function __construct(
        public string $sku,
        public string $seller_commission_code,
        public string $property_code,
        //for GNC
        public ?string $company_name,
        public ?string $project_name,
        public ?string $project_code,
        public ?string $property_name,
        public ?string $phase,
        public ?string $block,
        public ?string $lot,
        public ?string $lot_area,
        public ?string $floor_area,
        public ?string $loan_term,
        public ?string $loan_interest_rate,
        public ?string $tct_no,
        public ?string $project_location,
        public ?string $project_address,
        public ?string $mrif_fee,
        public ?string $reservation_rate,
        //for GNC
        public ?string $property_type,
        public ?string $os_status,
        public ?string $class_field,
        public ?string $segment_field,
        public ?string $rebooked_id_form,
        public ?string $buyer_action_form_number, //buyer_action_form
        public ?string $buyer_action_form_date,

        public ?string $cancellation_type,
        public ?string $cancellation_reason,
        public ?string $cancellation_remarks,

        public ?string $unit_type,
        public ?string $unit_type_interior,
        public ?string $house_color,
        public ?string $construction_status,
        public ?string $transaction_reference,
        public ?string $reservation_date,
        public ?string $circular_number,


        //out of place fields
        public ?string $date_created,
        public ?string $ra_date,
        public ?string $date_approved,
        public ?string $date_expiration,
        public ?string $os_month,
        public ?string $due_date,
        public ?string $total_payments_made,
        public ?string $transaction_status,
        public ?string $staging_status,
        public ?string $period_id, //PeriodID (RE,DP,BP,MF,Fully Paid)
        public ?string $date_closed,
        public ?string $closed_reason,
        public ?string $date_cancellation,

        public PaymentSchemeData|Optional $payment_scheme,
        public SellerData|Optional $seller_data,


    ) {}
}

class ContactEmploymentData extends Data
{
    public function __construct(
        public string $employment_status,
        public string $monthly_gross_income,
        public string $current_position,
        public string $employment_type,
        public ContactEmploymentEmployerData $employer,
        public ContactEmploymentIdData|Optional $id,
        //for GNC
        public ?string $years_in_service,
        public ?string $salary_range,
        public ?string $industry,
        public ?string $department_name,
        public ?string $type, //spouse, coborrower, buyer
    ) {}
}

class ContactEmploymentEmployerData extends Data
{
    public function __construct(
        public string $name,
        public string $industry,
        public string $nationality,
        public AddressData $address,
        public string $contact_no,
        //for GNC
        public ?string $employer_status,
        public ?string $type,
        public ?string $status,
        public ?string $year_established,
        public ?string $total_number_of_employees,
        public ?string $email,

    ) {}
}

class ContactEmploymentIdData extends Data
{
    public function __construct(
        public ?string $tin,
        public ?string $pagibig,
        public ?string $sss,
        public ?string $gsis,
    ) {}
}

class UploadData extends Data
{
    public function __construct(
        public string $name,
        public string $url
    ) {}
}

class SellerData{
    public function __construct(
        public ?string $name,
        public ?string $id,
        public ?string $superior,
        public ?string $team_head,
        public ?string $chief_seller_officer,
        public ?string $deputy_chief_seller_officer,
        public ?string $type,
        public ?string $reference_no, //seller id
        public ?string $unit //seller id
    ) {}
}



class PaymentSchemeData{
    public function __construct(
        public ?string $scheme,
        public ?string $method,
        public ?string $collectible_price,
        public ?string $commissionable_amount,
        public ?string $evat_percentage,
        public ?string $evat_amount,
        public ?string $net_total_contact_price,
        public ?string $total_contact_price,
        /** @var PaymentData[] */
        public PaymentData $payments,
        /** @var FeesData[] */
        public DataCollection $fees,
        public ?string $payment_remarks,
        public ?string $transaction_remarks,
        public ?string $discount_rate,
        public ?string $conditional_discount,
        public ?string $transaction_sub_status,


    ) {}
}

class PaymentData{
    public function __construct(
        public ?string $type, //processing_fee, home_utility_connection_fee, equity, balance
        public ?string $amount_paid,
        public ?string $date,
        public ?string $reference_number,
    ) {}
}

class FeesData{
    public function __construct(
        public ?string $name, //processing fee, home_utility_connection_fee, mrif, rental,
        public ?string $amount,
    ) {}
}

