<?php

namespace Homeful\Contacts\Data;

use Homeful\Contacts\Models\Contact;
use NumberToWords\NumberToWords;

class FlatData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public string $reference_code,
        public string $buyer_first_name,
        public ?string $buyer_middle_name,
        public string $buyer_last_name,
        public string $buyer_name,
        public string $buyer_civil_status,
        public ?string $buyer_spouse_name,
        public string $buyer_nationality,
        public ?string $tin_no,
        public string $buyer_sex,
        public string $buyer_date_of_birth,
        public ?string $buyer_email,
        public ?string $buyer_mobile,

        public ?string $spouse_first_name,
        public ?string $spouse_middle_name,
        public ?string $spouse_last_name,
        public ?string $spouse_name,
        public ?string $spouse_civil_status,
        public ?string $spouse_nationality,
        public ?string $spouse_sex,
        public ?string $spouse_date_of_birth,
        public ?string $spouse_email,
        public ?string $spouse_mobile,

        public ?string $buyer_address,

        public ?string $company_name,
        public ?string $project_name,
        public ?string $project_code,
        public ?string $project_location,
        public ?string $project_address,
        public ?string $property_name,
        public ?string $phase,
        public ?string $block,
        public ?string $lot,

        public ?string $mrif_fee,
        public ?string $reservation_rate,

        public ?string $lot_area,
        public ?string $lot_area_in_words,
        public ?string $floor_area,
        public ?string $floor_area_in_words,

        public ?string $tcp,
        public ?string $tcp_in_words,
        public ?string $loan_term,
        public ?string $loan_interest_rate,
        public ?string $tct_no,
        public ?string $sku,
        public ?string $seller_commission_code,
        public ?string $property_code,
    ) {}

    public static function fromModel(Contact $model): self
    {
        $numberToWords = new NumberToWords;
        $data = ContactData::fromModel($model);

        //        dd($data);
        return new self(
            reference_code: $data->reference_code,
            buyer_first_name: $data->profile->first_name,
            buyer_middle_name: $data->profile->middle_name,
            buyer_last_name: $data->profile->last_name,
            buyer_name: $data->profile->first_name.' '.$data->profile->middle_name.' '.$data->profile->last_name,
            buyer_civil_status: $data->profile->civil_status,
            buyer_spouse_name: $data->spouse->first_name.' '.$data->spouse->middle_name.' '.$data->spouse->last_name,
            buyer_nationality: $data->profile->nationality,
            tin_no: ($data->employment->count() === 0) ? '' : $data->employment->id->tin,
            buyer_sex: $data->profile->sex,
            buyer_date_of_birth: $data->profile->date_of_birth,
            buyer_email: $data->profile->email,
            buyer_mobile: $data->profile->mobile,

            spouse_first_name: $data->spouse->first_name,
            spouse_middle_name: $data->spouse->middle_name,
            spouse_last_name: $data->spouse->last_name,
            spouse_name: $data->spouse->first_name.' '.$data->spouse->middle_name.' '.$data->spouse->last_name,
            spouse_civil_status: $data->spouse->civil_status,
            spouse_nationality: $data->spouse->nationality,
            spouse_sex: $data->spouse->sex,
            spouse_date_of_birth: $data->spouse->date_of_birth,
            spouse_email: $data->spouse->email,
            spouse_mobile: $data->spouse->mobile,

            buyer_address: $data->addresses[0]->full_address,

            company_name: $data->order->company_name,
            project_name: $data->order->project_name,
            project_code: $data->order->project_code,
            project_location: $data->order->project_location,
            project_address: $data->order->project_address,
            property_name: $data->order->property_name,
            phase: $data->order->phase,
            block: $data->order->block,
            lot: $data->order->lot,

            mrif_fee: $data->order->mrif_fee,
            reservation_rate: $data->order->reservation_rate,

            lot_area: $data->order->lot_area,
            lot_area_in_words: $data->order->lot_area == null ? '' : $numberToWords->getNumberTransformer('en')->toWords($data->order->lot_area),
            floor_area: $data->order->floor_area,
            floor_area_in_words: $data->order->floor_area == null ? '' : $numberToWords->getNumberTransformer('en')->toWords($data->order->floor_area),

            tcp: $data->order->tcp ?? '',
            tcp_in_words: isset($data->order->tcp) ? $numberToWords->getNumberTransformer('en')->toWords($data->order->tcp) : '',
            loan_term: $data->order->loan_term,
            loan_interest_rate: $data->order->loan_interest_rate,
            tct_no: $data->order->tct_no,

            sku: $data->order->sku,
            seller_commission_code: $data->order->seller_commission_code,
            property_code: $data->order->property_code,

        );
    }
}
