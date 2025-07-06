<?php

namespace Homeful\Contacts\Data;

use Exception;
use Homeful\Contacts\Models\Contact;
use NumberToWords\NumberToWords;
use Throwable;

class FlatData extends \Spatie\LaravelData\Data
{
    public function __construct(
        public string $brn,
        public string $buyer_first_name,
        public ?string $buyer_middle_name,
        public string $buyer_last_name,
        public string $s_name,
        public string $buyer_name,
        public string $buyer_name_with_middle_initial,
        public string $buyer_civil_status,
        public string $buyer_civil_status_lower_case,
        public ?string $buyer_civil_status_to,
        public ?string $buyer_civil_status_to_lower_case,
        public ?string $buyer_spouse_name,
        public ?string $buyer_spouse_name_with_middle_initial,
        public string $buyer_nationality,
        public ?string $buyer_tin,
        public string $buyer_gender,
        public ?string $buyer_principal_email,
        public ?string $buyer_primary_contact_number,
        public ?string $buyer_other_contact_number,
        public ?string $buyer_province,
        public ?string $buyer_birthday,
        public ?string $buyer_residence_type,
        public ?string $buyer_ownership_type,
        public ?string $buyer_unit_lot, // can't be declare as a buyer_unit/lot
        public ?string $buyer_block,
        public ?string $buyer_street,
        public ?string $buyer_barangay,
        public ?string $buyer_city,
        public ?string $buyer_place_of_residency_1_city_of_residency,
        public ?string $buyer_place_of_residency_2_province_of_residency,
        public ?string $buyer_sss_gsis_number,
        public ?string $buyer_pagibig_number,

        public ?string $spouse_name,
        public ?string $spouse_civil_status,
        public ?string $spouse_civil_status_lower_case,
        public ?string $spouse_nationality,
        public ?string $spouse_gender,
        public ?string $spouse_principal_email,
        public ?string $spouse_mobile,
        public ?string $client_id_spouse,
        public ?string $spouse_fb_account_name,

        public ?string $buyer_address,
        public ?string $buyer_zip_code,
        public ?string $buyer_address1,

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
        public ?string $interest,
        public ?string $interest_in_words,
        public ?string $loan_term,
        public ?string $loan_term_in_years,
        public ?string $loan_term_in_years_in_words,
        public ?string $loan_interest_rate,
        public ?string $tct_no,
        public ?string $sku,
        public ?string $promo_code,
        public ?string $seller_commission_code,
        public ?string $property_code,
        public ?string $property_type,
        public ?string $os_status,
        public ?string $class_field,
        public ?string $segment_field,
        public ?string $rebooked_id_form,
        public ?string $cancellation_type,
        public ?string $cancellation_reason,
        public ?string $cancellation_remarks,
        public ?string $unit_type,
        public ?string $unit_type_interior,
        public ?string $house_color,
        public ?string $construction_status,
        public ?string $transaction_reference,
        public ?string $help_number,
        public ?string $date_created,
        public ?string $ra_date,
        public ?string $date_approved,
        public ?string $date_expiration,
        public ?string $os_month,
        public ?string $due_date,
        public ?string $total_payments_made,
        public ?string $transaction_status,
        public ?string $staging_status,
        public ?string $period_id,
        public ?string $date_closed,
        public ?string $closed_reason,
        public ?string $date_cancellation,
        public ?string $discount_rate,
        public ?string $conditional_discount,
        public ?string $evat_percentage,
        public ?string $total_contract_price,
        public ?string $evat_amount,
        public ?string $net_total_contract_price,
        public ?string $ntcp_in_words,
        public string $payment_scheme,
        public ?string $payment_method_name,
        public ?string $collectible_price,
        public ?string $reservation_date,
        public ?string $commissionable_amount,
        public ?string $transaction_sub_status,
        public ?string $pf_amount_paid,
        public ?string $pf_payment_reference_number,
        public ?string $pf_payment_date,
        public ?string $hucf_amount_paid,
        public ?string $hucf_payment_reference_number,
        public ?string $hucf_payment_date,
        public ?string $balance_payment_amount_paid,
        public ?string $balance_payment_reference_number,
        public ?string $balance_payment_date,
        public ?string $equity_payment_amount_paid,
        public ?string $equity_payment_reference_number,
        public ?string $equity_payment_date,
        public ?string $payment_remarks,
        public ?string $transaction_remarks,
        public ?string $mothers_maiden_name,
        public ?string $baf_number,
        public ?string $baf_date,
        public ?string $client_id,
        public ?string $buyer_age,
        public ?string $buyer_subdivision,
        public ?string $rental_fee,
        public ?string $years_of_residency,
        public ?string $present_buyer_unit_lot,
        public ?string $present_buyer_street,
        public ?string $present_buyer_subdivision,
        public ?string $present_buyer_barangay,
        public ?string $present_buyer_city,
        public ?string $present_buyer_province,
        public ?string $present_buyer_ownership_type,
        public ?string $present_rental_fee,
        public ?string $present_years_of_residency,
        public ?string $buyer_residence_landline,
        public ?string $buyer_fb_account_name,
        public ?string $buyer_company_email_address,
        public ?string $buyer_spouse_last_name,
        public ?string $buyer_spouse_middle_name,
        public ?string $spouse_extension_name,
        public ?string $spouse_mothers_maiden_name,
        public ?string $spouse_birthday,
        public ?string $buyer_spouse_first_name,
        public ?string $spouse_primary_contact_number,
        public ?string $spouse_residence_landline,
        public ?string $building,
        public ?string $floor,
        public ?string $unit,
        public ?string $aif_name,
        public ?string $aif_address,
        public ?string $co_borrower_name,
        public ?string $co_borrower_name_with_middle_initial,
        public ?string $co_borrower_address,
        public ?string $buyer_years_in_service,
        public ?string $buyer_employer_type,
        public ?string $buyer_employer_status,
        public ?string $buyer_employer_year_established,
        public ?string $buyer_employer_total_number_of_employees,
        public ?string $buyer_employer_name,
        public ?string $buyer_employer_contact_number,
        public ?string $buyer_employer_address,
        public ?string $buyer_employer_city,
        public ?string $buyer_employer_province,
        public ?string $buyer_employer_address1,
        public ?string $buyer_place_of_work_1_city_of_employer,
        public ?string $buyer_place_of_work_2_city_of_employer,
        public ?string $buyer_position,
        public ?string $buyer_salary_gross_income,
        public ?string $buyer_salary_range,
        public ?string $industry,
        public ?string $selling_unit,
        public ?string $seller_id,
        public ?string $seller_name,
        public ?string $seller_superior,
        public ?string $sales_team_head,
        public ?string $chief_seles_officer,
        public ?string $seller_type,
        public ?string $cancellation_reason2,
        public ?string $hucf_move_in_fee,
        public ?string $reservation_rate_processing_fee,
        public ?string $cash_outlay_1_amount,
        public ?string $cash_outlay_1_percentage_rate,
        public ?string $cash_outlay_1_interest_rate,
        public ?string $cash_outlay_1_terms,
        public ?string $cash_outlay_1_monthly_payment,
        public ?string $cash_outlay_2_amount,
        public ?string $cash_outlay_2_percentage_rate,
        public ?string $cash_outlay_2_interest_rate,
        public ?string $cash_outlay_2_terms,
        public ?string $cash_outlay_2_monthly_payment,
        public ?string $cash_outlay_1_effective_date,
        public ?string $cash_outlay_2_effective_date,
        public ?string $cash_outlay_3_amount,
        public ?string $cash_outlay_3_percentage_rate,
        public ?string $cash_outlay_3_interest_rate,
        public ?string $cash_outlay_3_terms,
        public ?string $cash_outlay_3_monthly_payment,
        public ?string $cash_outlay_3_effective_date,
        public ?string $equity_1_amount,
        public ?string $equity_1_amount_in_words,
        public ?string $equity_1_percentage_rate,
        public ?string $equity_1_interest_rate,
        public ?string $equity_1_terms,
        public ?string $equity_1_monthly_payment,
        public ?string $equity_1_effective_date,
        public ?string $equity_2_amount,
        public ?string $equity_2_percentage_rate,
        public ?string $equity_2_interest_rate,
        public ?string $equity_2_terms,
        public ?string $equity_2_monthly_payment,
        public ?string $equity_2_effective_date,
        public ?string $bp_1_amount,
        public ?string $bp_1_amount_in_words,
        public ?string $bp_1_percentage_rate,
        public ?string $bp_1_interest_rate,
        public ?string $bp_1_terms,
        public ?string $bp_1_monthly_payment,
        public ?string $bp_1_effective_date,
        public ?string $bp_2_amount,
        public ?string $bp_2_percentage_rate,
        public ?string $bp_2_interest_rate,
        public ?string $bp_2_terms,
        public ?string $bp_2_monthly_payment,
        public ?string $bp_2_effective_date,
        public ?string $circular_no_312_379,
        public ?string $ltvr_slug,
        public ?string $spouse_age,
        public ?string $spouse_tin,
        public ?string $spouse_tin_with_label,
        public ?string $spouse_pagibig_number,
        public ?string $spouse_employer_name,
        public ?string $spouse_employer_type,
        public ?string $spouse_employer_status,
        public ?string $spouse_employer_address,
        public ?string $spouse_employer_contact_number,
        public ?string $spouse_company_email_address,
        public ?string $spouse_position,
        public ?string $spouse_years_in_service,
        public ?string $spouse_salary_gross_income,
        public ?string $zip_code,
        public ?string $length_of_stay,
        public ?string $logo,
        public ?string $loan_period_months,
        public ?string $co_borrower_civil_status,
        public ?string $co_borrower_civil_status_to,
        public ?string $co_borrower_civil_status_lower_case,
        public ?string $co_borrower_nationality,
        public ?string $co_borrower_spouse,
        public ?string $co_borrower_spouse_with_middle_initial,
        public ?string $co_borrower_spouse_tin,
        public ?string $co_borrower_tin,
        public ?string $aif_last_name,
        public ?string $aif_first_name,
        public ?string $aif_middle_name,
        public ?string $aif_extension_name,
        public ?string $aif_mobile,
        public ?string $aif_email,
        public ?string $aif_other_mobile,
        public ?string $aif_landline,
        public ?string $aif_unit_lot,
        public ?string $aif_street,
        public ?string $aif_subdivision,
        public ?string $aif_barangay,
        public ?string $aif_city,
        public ?string $aif_province,
        public ?string $aif_zip_code,
        public ?string $aif_length_of_stay,
        public ?string $aif_ownership_type,
        public ?string $aif_birthday,
        public ?string $aif_age,
        public ?string $aif_gender,
        public ?string $aif_civil_status,
        public ?string $aif_civil_status_lower_case,
        public ?string $aif_nationality,
        public ?string $aif_residence_landline,
        public ?string $aif_primary_contact_number,
        public ?string $aif_relationship_to_buyer,
        public ?string $aif_account_name,
        public ?string $aif_username_or_email,
        public ?string $aif_tin,
        public ?string $aif_sss,
        public ?string $aif_pagibig,
        public ?string $aif_passport,
        public ?string $aif_date_issued,
        public ?string $aif_place_issued,
        public ?string $aif_employer_name,
        public ?string $aif_employer_address,
        public ?string $aif_employer_type,
        public ?string $aif_employment_status,
        public ?string $aif_position,
        public ?string $aif_industry,
        public ?string $aif_salary_gross_income,
        public ?string $aif_company_phone_number,
        public ?string $aif_fax,
        public ?string $aif_company_email,
        public ?string $term_1,
        public ?string $term_2,
        public ?string $term_3,
        public ?string $amort_mrisri1,
        public ?string $amort_mrisri2,
        public ?string $amort_mrisri3,
        public ?string $amort_nonlife1,
        public ?string $amort_nonlife2,
        public ?string $amort_nonlife3,
        public ?string $amort_princ_int1,
        public ?string $amort_princ_int2,
        public ?string $amort_princ_int3,
        public ?string $monthly_amort1,
        public ?string $monthly_amort1_in_words,
        public ?string $monthly_amort2,
        public ?string $monthly_amort3,
        public ?string $cct,
        public ?string $witness,
        public ?string $witness1,
        public ?string $witness2,
        public ?string $page,
        public ?string $buyer_extension_name,
        public ?string $spouse_industry,
        public ?string $exec_signatories,
        public ?string $exec_position,
        public ?string $exec_tin_no,
        public ?string $board_resolution_date,
        public ?string $repricing_period,
        public ?string $loan_terms_in_word,
        public ?string $loan_terms_in_years_in_word,
        public ?string $repricing_period_in_words,
        public ?string $registry_of_deeds_address,
        public ?string $scheme,
        public ?string $company_tin,
        public ?string $company_address,
        public ?string $loan_value_after_downpayment,
        public ?string $loan_value_after_downpayment_in_words,
        public ?string $company_acronym,
        public ?string $total_selling_price,
        public ?string $client_id_co_borrower,
        public ?string $client_id_aif,
        public ?string $retention_fee,
        public ?string $service_fee,
        public ?string $dslt_total,
        public ?string $dst,
        public ?string $total_deductions_from_loan_proceeds,
        public ?string $net_loan_proceeds,
        public ?string $vsr_no,
        public ?string $technical_description,
        public ?string $both_of,
        //TIMOTHY S. GOBIO TIN
        public ?string $timothy_s_gobio_tin,
        //
        public ?string $non_life_insurance,
        public ?string $mrisri_docstamp_total,
        public ?string $comencement_period,
        public ?string $repricing_period_affordable,
        public ?string $loan_period_in_years,
        public ?string $aif_attorney,
        public ?string $loan_base,
        public ?string $loan_base_in_words,
        public ?string $pagibig_filing_site,

    ) {}

    public static function fromModel(Contact $model): self
    {
        try {
            $numberToWords = new NumberToWords;
            $data = ContactData::fromModel($model);
            $co_borrower_spouse_name = '';
            $co_borrower_spouse_tin = '';
            $co_borrower_spouse_name_with_middle_initial='';
            if (isset($model->co_borrowers[0]['spouse'])) {
                $spouse = $model->co_borrowers[0]['spouse'];
                $co_borrower_spouse_name =implode(' ', array_filter([
                    $spouse['first_name'] ?? '',
                    mb_substr($spouse['middle_name'] ?? '', 0, 1) ? mb_substr($spouse['middle_name'], 0, 1) . '.' : '',
                    $spouse['last_name'] ?? '',
                    $spouse['name_suffix'] ?? ''
                ]));
                $co_borrower_spouse_name_with_middle_initial =implode(' ', array_filter([
                    $spouse['first_name'] ?? '',
                    mb_substr($spouse['middle_name'] ?? '', 0, 1) ? mb_substr($spouse['middle_name'], 0, 1) . '.' : '',
                    $spouse['last_name'] ?? '',
                    $spouse['name_suffix'] ?? ''
                ]));
                $co_borrower_spouse_tin = $spouse['tin'] ?? '';
            }
    
            $spouse_tin = $data->employment?->toCollection()->firstWhere('type', 'spouse')->id?->tin??'';

            $flatdata= new FlatData(
            brn: $data->reference_code ?? '',
            buyer_first_name: strtoupper($data->profile->first_name ?? ''),
            buyer_middle_name: strtoupper($data->profile->middle_name ?? ''),
            buyer_last_name: strtoupper($data->profile->last_name ?? ''),
            s_name: strtoupper(collect([
                ($data->profile->last_name ?? '') . ',',
                $data->profile->first_name,
                $data->profile->name_suffix,
                mb_substr($data->profile->middle_name ?? '', 0, 1) ? mb_substr($data->profile->middle_name, 0, 1) . '.' : '',
            ])->filter()->implode(' ')),
            buyer_name: strtoupper(collect([
                $data->profile->first_name,
                mb_substr($data->profile->middle_name ?? '', 0, 1) ? mb_substr($data->profile->middle_name, 0, 1) . '.' : '',
                $data->profile->last_name,
                $data->profile->name_suffix
            ])->filter()->implode(' ')),
            buyer_name_with_middle_initial: strtoupper(collect([
                $data->profile->first_name,
                mb_substr($data->profile->middle_name ?? '', 0, 1) ? mb_substr($data->profile->middle_name, 0, 1) . '.' : '',
                $data->profile->last_name,
                $data->profile->name_suffix
            ])->filter()->implode(' ')),
            buyer_birthday: $data->profile->date_of_birth ?? '',
            buyer_civil_status: $data->profile->civil_status ?? '',
            buyer_civil_status_lower_case:strtolower($data->profile->civil_status ?? ''),
            buyer_civil_status_to: ($data->profile->civil_status) ? (strtoupper($data->profile->civil_status) == 'MARRIED') ? $data->profile->civil_status.' to ' : $data->profile->civil_status : '',
            buyer_civil_status_to_lower_case: ($data->profile->civil_status) ? (strtoupper($data->profile->civil_status) == 'MARRIED') ?strtolower($data->profile->civil_status.' to ')  :strtolower($data->profile->civil_status ) : '',
            both_of: ($data->profile->civil_status) ? (strtoupper($data->profile->civil_status) == 'MARRIED') ? 'both' : 'of' : 'of',
            buyer_spouse_name: (($data->profile->civil_status ?? '') == 'Single') ? 'N/A' : strtoupper(collect([
                $data->spouse->first_name,
                mb_substr($data->spouse->middle_name ?? '', 0, 1) ? mb_substr($data->spouse->middle_name, 0, 1) . '.' : '',
                $data->spouse->last_name,
                $data->spouse->name_suffix
            ])->filter()->implode(' ')),
            buyer_spouse_name_with_middle_initial: (($data->profile->civil_status ?? '') == 'Single') ? 'N/A' : strtoupper(collect([
                $data->spouse->first_name,
                mb_substr($data->spouse->middle_name ?? '', 0, 1) ? mb_substr($data->spouse->middle_name, 0, 1) . '.' : '',
                $data->spouse->last_name,
                $data->spouse->name_suffix
            ])->filter()->implode(' ')),
            buyer_nationality: $data->profile->nationality ?? '',
            buyer_tin: $data->employment?->toCollection()->firstWhere('type', 'buyer')->id->tin ?? '',
            buyer_sss_gsis_number: $data->employment?->toCollection()->firstWhere('type', 'buyer')->id->sss ?? '',
            buyer_pagibig_number: $data->employment?->toCollection()->firstWhere('type', 'buyer')->id->pagibig ?? '',
            buyer_gender: $data->profile->sex ?? '',
            buyer_principal_email: $data->profile->email ?? '',
            buyer_primary_contact_number: $data->profile->mobile ?? '',
            buyer_other_contact_number: $data->profile->other_mobile ?? '',
            help_number: $data->profile->help_number ?? '',
            mothers_maiden_name: strtoupper( $data->profile->mothers_maiden_name ?? ''),
            buyer_residence_landline: $data->profile->landline ?? '',
            buyer_fb_account_name: $data->profile->first_name.' '.$data->profile->middle_name.' '.$data->profile->last_name ?? '',
            buyer_company_email_address: $data->profile->email ?? '',
            buyer_spouse_first_name: strtoupper($data->spouse->first_name ?? ''),
            buyer_spouse_middle_name: strtoupper($data->spouse->middle_name ?? ''),
            buyer_spouse_last_name: $data->spouse->last_name ?? '',
            spouse_name: strtoupper($data->spouse->first_name.' '.$data->spouse->middle_name.' '.$data->spouse->last_name ?? ''),
            spouse_civil_status: $data->spouse->civil_status ?? '',
            spouse_civil_status_lower_case:strtolower($data->spouse->civil_status ?? ''),
            spouse_nationality: $data->spouse->nationality ?? '',
            spouse_gender: $data->spouse->sex ?? '',
            spouse_birthday: $data->spouse->date_of_birth ?? '',
            spouse_principal_email: $data->spouse->email ?? '',
            spouse_mobile: $data->spouse->mobile ?? '',
            client_id_spouse: $data->order->client_id_spouse ?? '', // temporary location of client_id
            spouse_extension_name: strtoupper($data->spouse->name_suffix ?? ''),
            spouse_mothers_maiden_name: strtoupper($data->spouse->mothers_maiden_name ?? ''),
            spouse_primary_contact_number: $data->spouse->mobile ?? '',
            spouse_residence_landline: $data->spouse->landline ?? '',
            spouse_fb_account_name: $data->spouse->first_name.' '.$data->spouse->middle_name.' '.$data->spouse->last_name ?? '',
            spouse_age: $data->spouse->age ?? '',
            spouse_tin_with_label: $spouse_tin ? 'TIN: ' . $spouse_tin:'',
            spouse_tin: $data->employment?->toCollection()->firstWhere('type', 'spouse')->id->tin ??'',
            spouse_pagibig_number: $data->employment?->toCollection()->firstWhere('type', 'spouse')->id->pagibig ?? '',
            spouse_employer_name: strtoupper($data->employment?->toCollection()->firstWhere('type', 'spouse')->employer->name ?? ''),
            spouse_employer_type: $data->employment?->toCollection()->firstWhere('type', 'spouse')->employer->type ?? '',
            spouse_employer_status: $data->employment?->toCollection()->firstWhere('type', 'spouse')->employer->status ?? '',
            spouse_employer_address: $data->employment?->toCollection()->firstWhere('type', 'spouse')->employer->address->full_address ?? '',
            spouse_employer_contact_number: $data->employment?->toCollection()->firstWhere('type', 'spouse')->employer->contact_no ?? '',
            spouse_company_email_address: $data->employment?->toCollection()->firstWhere('type', 'spouse')->employer->email ?? '',
            spouse_position: $data->employment?->toCollection()->firstWhere('type', 'spouse')->current_position ?? '',
            spouse_years_in_service: $data->employment?->toCollection()->firstWhere('type', 'spouse')->years_in_service ?? '',
            spouse_salary_gross_income:$data->employment?->toCollection()->firstWhere('type', 'spouse')->monthly_gross_income ?? 0,
            zip_code: $data->addresses?->toCollection()->firstWhere('type', 'spouse')->postal_code ?? '',
            length_of_stay: $data->employment?->toCollection()->firstWhere('type', 'spouse')->years_in_service ?? '',
            spouse_industry: $data->employment?->toCollection()->firstWhere('type', 'spouse')->industry ?? '',
            buyer_address: $data->addresses?->toCollection()->firstWhere('type', 'primary')->full_address ?? '',
            buyer_address1: $data->addresses?->toCollection()->firstWhere('type', 'primary')->address1 ?? '',
            buyer_zip_code: $data->addresses?->toCollection()->firstWhere('type', 'primary')->postal_code ?? '',
            buyer_province: $data->addresses?->toCollection()->firstWhere('type', 'primary')->administrative_area ?? '',
            buyer_residence_type: $data->addresses?->toCollection()->firstWhere('type', 'primary')->type ?? '',
            buyer_ownership_type: $data->addresses?->toCollection()->firstWhere('type', 'primary')->ownership ?? '',
            buyer_unit_lot: $data->addresses?->toCollection()->firstWhere('type', 'primary')->unit ?? '',
            buyer_block: $data->addresses?->toCollection()->firstWhere('type', 'primary')->block ?? '',
            buyer_street: $data->addresses?->toCollection()->firstWhere('type', 'primary')->street ?? '',
            buyer_barangay: $data->addresses?->toCollection()->firstWhere('type', 'primary')->sublocality ?? '',
            buyer_city: $data->addresses?->toCollection()->firstWhere('type', 'primary')->locality ?? '',
            buyer_place_of_residency_1_city_of_residency: $data->addresses?->toCollection()->firstWhere('type', 'primary')->address1 ?? '',
            buyer_place_of_residency_2_province_of_residency: $data->addresses?->toCollection()->firstWhere('type', 'primary')->address2 ?? '',
            buyer_subdivision: $data->addresses?->toCollection()->firstWhere('type', 'primary')->street ?? '',
            years_of_residency: $data->addresses?->toCollection()->firstWhere('type', 'primary')->length_of_stay ?? '',
            present_buyer_unit_lot: $data->addresses?->toCollection()->firstWhere('type', 'primary')->unit ?? '',
            present_buyer_street: $data->addresses?->toCollection()->firstWhere('type', 'primary')->street ?? '',
            present_buyer_subdivision: $data->addresses?->toCollection()->firstWhere('type', 'primary')->street ?? '',
            present_buyer_barangay: $data->addresses?->toCollection()->firstWhere('type', 'primary')->sublocality ?? '',
            present_buyer_city: $data->addresses?->toCollection()->firstWhere('type', 'primary')->locality ?? '',
            present_buyer_province: $data->addresses?->toCollection()->firstWhere('type', 'primary')->administrative_area ?? '',
            present_buyer_ownership_type: $data->addresses?->toCollection()->firstWhere('type', 'primary')->ownership ?? '',
            present_years_of_residency: $data->addresses?->toCollection()->firstWhere('type', 'primary')->length_of_stay ?? '',
            building: $data->addresses?->toCollection()->firstWhere('type', 'primary')->building ?? '',
            floor: $data->addresses?->toCollection()->firstWhere('type', 'primary')->floor ?? '',
            unit: $data->addresses?->toCollection()->firstWhere('type', 'primary')->unit ?? '',
            aif_address: $data->addresses?->toCollection()->firstWhere('type', 'co_borrower')->full_address ?? '',
            company_name: $data->order->company_name ?? '',
            project_name: $data->order->project_name ?? '',
            project_code: $data->order->project_code ?? '',
            project_location: $data->order->project_location ?? '',
            project_address: $data->order->project_address ?? '',
            property_name: $data->order->property_name ?? '',
            phase: $data->order->phase ?? '',
            block: $data->order->block ?? '',
            lot: $data->order->lot ?? '',
            mrif_fee: number_format($data->order->mrif_fee ?? 0, 2),
            reservation_rate: $data->order->reservation_rate ?? '',
            lot_area: $data->order->lot_area ?? '',
            lot_area_in_words: str_replace('-', ' ', strtoupper(self::convertNumberToWordsWithDynamicNotation($data->order->lot_area ?? '0', ' SQUARE METERS', ' DECIMETERS', 'SQUARE METERS AND'))),
            floor_area: $data->order->floor_area ?? '',
            floor_area_in_words: strtoupper(self::convertNumberToWords( $data->order->floor_area ?? '')),
            tcp: $data->order->tcp ?? '0',
            tcp_in_words: strtoupper(self::convertNumberToWords($data->order->payment_scheme->total_contract_price ?? '0')),
            loan_term: $data->order->loan_term ?? '',
            loan_term_in_years: (string)((int)($data->order->loan_term ?? 0) / 12),
            loan_term_in_years_in_words: strtoupper(self::convertNumberToWords((int)($data->order->loan_term ?? 0) / 12)),
            loan_interest_rate:is_numeric($data->order->loan_interest_rate) ? number_format($data->order->loan_interest_rate ?? 0, 3): '',
            tct_no: $data->order->tct_no ?? '',
            sku: $data->order->sku ?? '',
            promo_code: $data->order->promo_code ?? '',
            seller_commission_code: $data->order->seller_commission_code ?? '',
            property_code: $data->order->property_code ?? '',
            property_type: $data->order->property_type ?? '',
            baf_number: $data->order->baf_number ?? '',
            baf_date: $data->order->baf_date ?? '',
            client_id: $data->order->client_id_buyer ?? '',
            buyer_age: $data->order->buyer_age ?? '',
            os_status: $data->order->os_status ?? '',
            class_field: $data->order->class_field ?? '',
            segment_field: $data->order->segment_field ?? '',
            rebooked_id_form: $data->order->rebooked_id_form ?? '', // for checking
            cancellation_type: $data->order->cancellation_type ?? '',
            cancellation_reason: $data->order->cancellation_reason ?? '',
            cancellation_remarks: $data->order->cancellation_remarks ?? '',
            unit_type: $data->order->unit_type ?? '',
            unit_type_interior: $data->order->unit_type_interior ?? '',
            house_color: $data->order->house_color ?? '',
            construction_status: $data->order->construction_status ?? '',
            transaction_reference: $data->order->transaction_reference ?? '',
            date_created: $data->order->date_created ?? '',
            ra_date: $data->order->ra_date ?? '',
            date_approved: $data->order->date_approved ?? '',
            date_expiration: $data->order->date_expiration ?? '',
            os_month: $data->order->os_month ?? '',
            due_date: $data->order->due_date ?? '',
            total_payments_made: $data->order->total_payments_made ?? '',
            transaction_status: $data->order->transaction_status ?? '',
            staging_status: $data->order->staging_status ?? '',
            period_id: $data->order->period_id ?? '',
            date_closed: $data->order->date_closed ?? '',
            closed_reason: $data->order->closed_reason ?? '',
            date_cancellation: $data->order->date_cancellation ?? '',
            reservation_date: $data->order->reservation_date ?? '',
            payment_scheme: $data->order->payment_scheme->scheme ?? '',
            discount_rate: $data->order->payment_scheme->discount_rate ?? '',
            conditional_discount: number_format($data->order->payment_scheme->conditional_discount ?? 0, 2),
            evat_percentage: number_format($data->order->payment_scheme->evat_percentage ?? 0, 2),
            total_contract_price: number_format(($data->order?->payment_scheme?->total_contract_price ?? '') === '' ?? 0, 2),
            evat_amount: number_format($data->order->payment_scheme->evat_amount ?? 0, 2),
            net_total_contract_price: number_format($data->order->payment_scheme->net_total_contract_price ?? 0, 2),
            ntcp_in_words: strtoupper(self::convertNumberToWords($data->order->payment_scheme->net_total_contract_price ?? '0')),
            payment_method_name: $data->order->payment_scheme->method ?? '',
            collectible_price: number_format($data->order->payment_scheme->collectible_price ?? 0, 2),
            commissionable_amount: number_format($data->order->payment_scheme->commissionable_amount ?? 0),
            transaction_sub_status: $data->order->payment_scheme->transaction_sub_status ?? '',
            payment_remarks: $data->order->payment_scheme->payment_remarks ?? '',
            transaction_remarks: $data->order->payment_scheme->transaction_remarks ?? '',
            pf_amount_paid: number_format($data->order->payment_scheme->payments?->toCollection()->firstWhere('type', 'processing_fee')->amount_paid ?? 0),
            pf_payment_reference_number: $data->order->payment_scheme->payments?->toCollection()->firstWhere('type', 'processing_fee')->reference_number ?? '',
            pf_payment_date: $data->order->payment_scheme->payments?->toCollection()->firstWhere('type', 'processing_fee')->date ?? '',
            hucf_amount_paid: number_format($data->order->payment_scheme->payments?->toCollection()->firstWhere('type', 'home_utility_connection_fee')->amount_paid ?? 0),
            hucf_payment_reference_number: $data->order->payment_scheme->payments?->toCollection()->firstWhere('type', 'home_utility_connection_fee')->reference_number ?? '',
            hucf_payment_date: $data->order->payment_scheme->payments?->toCollection()->firstWhere('type', 'home_utility_connection_fee')->date ?? '',
            balance_payment_amount_paid: number_format($data->order->payment_scheme->payments?->toCollection()->firstWhere('type', 'balance')->amount_paid ?? 0),
            balance_payment_reference_number: $data->order->payment_scheme->payments?->toCollection()->firstWhere('type', 'balance')->reference_number ?? '',
            balance_payment_date: $data->order->payment_scheme->payments?->toCollection()->firstWhere('type', 'balance')->date ?? '',
            equity_payment_amount_paid: number_format($data->order->payment_scheme->payments?->toCollection()->firstWhere('type', 'equity')->amount_paid ?? 0),
            equity_payment_reference_number: $data->order->payment_scheme->payments?->toCollection()->firstWhere('type', 'equity')->reference_number ?? '',
            equity_payment_date: $data->order->payment_scheme->payments?->toCollection()->firstWhere('type', 'equity')->date ?? '',
            rental_fee: number_format($data->order->payment_scheme->fees?->toCollection()->firstWhere('name', 'rental')->amount ?? 0),
            present_rental_fee: number_format($data->order->payment_scheme->fees?->toCollection()->firstWhere('name', 'present_rental_fee')->amount ?? 0),
            co_borrower_name: ((!$data->co_borrowers[0]->first_name) && (!$data->co_borrowers[0]->last_name)) ? 'N/A' : strtoupper((collect([
                $data->co_borrowers[0]->first_name ?? '',
                mb_substr($data->co_borrowers[0]->middle_name ?? '', 0, 1) ? mb_substr($data->co_borrowers[0]->middle_name, 0, 1) . '.' : '',
                $data->co_borrowers[0]->last_name ?? '',
                $data->co_borrowers[0]->name_suffix ?? '',
            ])->filter()->implode(' '))),
            co_borrower_name_with_middle_initial: ((!$data->co_borrowers[0]->first_name) && (!$data->co_borrowers[0]->last_name)) ? 'N/A' : strtoupper((collect([
                $data->co_borrowers[0]->first_name ?? '',
                mb_substr($data->co_borrowers[0]->middle_name ?? '', 0, 1) ? mb_substr($data->co_borrowers[0]->middle_name, 0, 1) . '.' : '',
                $data->co_borrowers[0]->last_name ?? '',
                $data->co_borrowers[0]->name_suffix ?? '',
            ])->filter()->implode(' '))),
            co_borrower_address: $data->addresses?->toCollection()->firstWhere('type', 'co_borrower')->full_address ?? 'N/A',
            co_borrower_civil_status: $data->co_borrowers[0]->civil_status ?? '',
            co_borrower_civil_status_lower_case: strtolower($data->co_borrowers[0]->civil_status ?? '') ,
            co_borrower_civil_status_to: ($data->co_borrowers[0]->civil_status) ? ((strtoupper($data->co_borrowers[0]->civil_status) == 'MARRIED') ? $data->co_borrowers[0]->civil_status.' to ' : $data->co_borrowers[0]->civil_status) : '',
            co_borrower_nationality: $data->co_borrowers[0]->nationality ?? '',
            co_borrower_spouse: (($data->co_borrowers[0]->civil_status ?? '') == 'Single' || ($data->co_borrowers[0]->civil_status ?? '') == '') ? 'N/A' : $co_borrower_spouse_name,
            co_borrower_spouse_with_middle_initial: $co_borrower_spouse_name_with_middle_initial,
            co_borrower_spouse_tin: $co_borrower_spouse_tin,
            co_borrower_tin: $data->employment?->toCollection()->firstWhere('type', 'co_borrower')->id->tin ?? 'N/A',
            aif_name: $data->order->aif ? strtoupper("{$data->order->aif->first_name} {$data->order->aif->middle_name} {$data->order->aif->last_name} {$data->order->aif->name_suffix}") : '',
            aif_last_name: $data->order->aif ? strtoupper($data->order->aif->last_name ?? '') : '',
            aif_first_name: $data->order->aif ? strtoupper($data->order->aif->first_name ?? '') : '',
            aif_middle_name: $data->order->aif ? strtoupper($data->order->aif->middle_name ?? '') : '',
            aif_extension_name: $data->order->aif ? $data->order->aif->name_suffix ?? '' : '',
            aif_mobile: $data->order->aif ? $data->order->aif->mobile ?? '' : '',
            aif_other_mobile: $data->order->aif ? $data->order->aif->other_mobile ?? '' : '',
            aif_landline: $data->order->aif ? $data->order->aif->landline ?? '' : '',
            aif_email: $data->order->aif ? $data->order->aif->email ?? '' : '',
            aif_unit_lot: $data->addresses?->toCollection()->firstWhere('type', 'co_borrower')->unit ?? '',
            aif_street: $data->addresses?->toCollection()->firstWhere('type', 'co_borrower')->street ?? '',
            aif_subdivision: $data->addresses?->toCollection()->firstWhere('type', 'co_borrower')->street ?? '',
            aif_barangay: $data->addresses?->toCollection()->firstWhere('type', 'co_borrower')->sublocality ?? '',
            aif_city: $data->addresses?->toCollection()->firstWhere('type', 'co_borrower')->locality ?? '',
            aif_province: $data->addresses?->toCollection()->firstWhere('type', 'co_borrower')->administrative_area ?? '',
            aif_zip_code: $data->addresses?->toCollection()->firstWhere('type', 'co_borrower')->postal_code ?? '',
            aif_length_of_stay: $data->addresses?->toCollection()->firstWhere('type', 'co_borrower')->length_of_stay ?? '',
            aif_ownership_type: $data->addresses?->toCollection()->firstWhere('type', 'co_borrower')->ownership ?? '',
            aif_birthday: $data->order->aif->date_of_birth ?? '',
            aif_age: $data->co_borrowers[0]->age ?? '',
            aif_gender: $data->order->aif->sex ?? '',
            aif_civil_status: $data->order->aif->civil_status ?? '',
            aif_civil_status_lower_case:strtolower($data->order->aif->civil_status ?? '') ,
            aif_nationality: $data->order->aif->nationality ?? '',
            aif_residence_landline: $data->co_borrowers[0]->landline ?? '',
            aif_primary_contact_number: $data->co_borrowers[0]->mobile ?? '',
            aif_relationship_to_buyer: $data->co_borrowers[0]->relationship_to_buyer ?? '',
            aif_account_name: strtoupper(($data->co_borrowers[0]->first_name ?? '').($data->co_borrowers[0]->middle_name ?? '').($data->co_borrowers[0]->last_name ?? '')),
            aif_username_or_email: $data->co_borrowers[0]->email ?? '',
            aif_sss: $data->employment?->toCollection()->firstWhere('type', 'co_borrower')->id->sss ?? '',
            aif_pagibig: $data->employment?->toCollection()->firstWhere('type', 'co_borrower')->id->pagibig ?? '',
            aif_tin: $data->order->aif ? $data->order->aif->tin ?? '' : '',
            aif_passport: $data->co_borrowers[0]->passport ?? '',
            aif_date_issued: $data->co_borrowers[0]->date_issued ?? '',
            aif_place_issued: $data->co_borrowers[0]->place_issued ?? '',
            aif_employer_name: strtoupper($data->employment?->toCollection()->firstWhere('type', 'co_borrower')->employer->name ?? ''),
            aif_employer_address: $data->employment?->toCollection()->firstWhere('type', 'co_borrower')->employer->address->full_address ?? '',
            aif_employer_type: $data->employment?->toCollection()->firstWhere('type', 'co_borrower')->employer->type ?? '',
            aif_employment_status: $data->employment?->toCollection()->firstWhere('type', 'co_borrower')->employment_status ?? '',
            aif_position: $data->employment?->toCollection()->firstWhere('type', 'co_borrower')->current_position ?? '',
            aif_industry: $data->employment?->toCollection()->firstWhere('type', 'co_borrower')->industry ?? '',
            aif_salary_gross_income: $data->employment?->toCollection()->firstWhere('type', 'co_borrower')->monthly_gross_income ?? '',
            aif_company_phone_number: $data->employment?->toCollection()->firstWhere('type', 'co_borrower')->employer->contact_no ?? '',
            aif_fax: $data->employment?->toCollection()->firstWhere('type', 'co_borrower')->employer->fax ?? '',
            aif_company_email: $data->employment?->toCollection()->firstWhere('type', 'co_borrower')->employer->email ?? '',
            buyer_years_in_service: $data->employment?->toCollection()->firstWhere('type', 'buyer')->years_in_service ?? '',
            buyer_employer_type: $data->employment?->toCollection()->firstWhere('type', 'buyer')->employment_type ?? '',
            buyer_employer_status: $data->employment?->toCollection()->firstWhere('type', 'buyer')->employer->status ?? '',
            buyer_employer_year_established: $data->employment?->toCollection()->firstWhere('type', 'buyer')->employer->year_established ?? '',
            buyer_employer_total_number_of_employees: $data->employment?->toCollection()->firstWhere('type', 'buyer')->employer->total_number_of_employees ?? '',
            buyer_employer_name: strtoupper($data->employment?->toCollection()->firstWhere('type', 'buyer')->employer->name ?? ''),
            buyer_employer_contact_number: $data->employment?->toCollection()->firstWhere('type', 'buyer')->employer->contact_no ?? '',
            buyer_employer_address: $data->employment?->toCollection()->firstWhere('type', 'buyer')->employer->address->full_address ?? '',
            buyer_employer_city: $data->employment?->toCollection()->firstWhere('type', 'buyer')->employer->address->locality ?? '',
            buyer_employer_province: $data->employment?->toCollection()->firstWhere('type', 'buyer')->employer->address->administrative_area ?? '',
            buyer_employer_address1: $data->employment?->toCollection()->firstWhere('type', 'buyer')->employer->address->address1 ?? '',
            buyer_place_of_work_1_city_of_employer: $data->employment?->toCollection()->firstWhere('type', 'buyer')->employer->address->address1 ?? '',
            buyer_place_of_work_2_city_of_employer: $data->employment?->toCollection()->firstWhere('type', 'buyer')->employer->address->address2 ?? '',
            buyer_position: $data->employment?->toCollection()->firstWhere('type', 'buyer')->current_position ?? '',
            buyer_salary_gross_income: number_format($data->employment?->toCollection()->firstWhere('type', 'buyer')->monthly_gross_income ?? 0, 2),
            buyer_salary_range: $data->employment?->toCollection()->firstWhere('type', 'buyer')->salary_range ?? '',
            industry: $data->employment?->toCollection()->firstWhere('type', 'buyer')->employer->industry ?? '',
            selling_unit: $data->order->seller->unit ?? '',
            seller_id: $data->order->seller->id ?? '',
            seller_name: strtoupper($data->order->seller->name ?? ''),
            seller_superior: $data->order->seller->superior ?? '',
            sales_team_head: $data->order->seller->team_head ?? '',
            chief_seles_officer: $data->order->seller->chief_seller_officer ?? '',
            seller_type: $data->order->seller->type ?? '',
            cancellation_reason2: $data->order->cancellation_reason2 ?? '',
            hucf_move_in_fee: number_format($data->order->hucf_move_in_fee ?? 0, 2),
            reservation_rate_processing_fee: number_format($data->order->reservation_rate ?? 0, 2),
            cash_outlay_1_amount: number_format($data->order->cash_outlay_1_amount ?? 0, 2),
            cash_outlay_1_percentage_rate: $data->order->cash_outlay_1_percentage_rate ?? 0,
            cash_outlay_1_interest_rate: $data->order->cash_outlay_1_interest_rate ?? 0,
            cash_outlay_1_terms: $data->order->cash_outlay_1_terms ?? 0,
            cash_outlay_1_monthly_payment: $data->order->cash_outlay_1_monthly_payment ?? 0,
            cash_outlay_1_effective_date: $data->order->cash_outlay_1_effective_date ?? '',
            cash_outlay_2_amount: number_format($data->order->cash_outlay_2_amount ?? 0),
            cash_outlay_2_percentage_rate: $data->order->cash_outlay_2_percentage_rate ?? 0,
            cash_outlay_2_interest_rate: $data->order->cash_outlay_2_interest_rate ?? 0,
            cash_outlay_2_terms: $data->order->cash_outlay_2_terms ?? 0,
            cash_outlay_2_monthly_payment: number_format($data->order->cash_outlay_2_monthly_payment ?? 0),
            cash_outlay_2_effective_date: $data->order->cash_outlay_2_effective_date ?? '',
            cash_outlay_3_amount: $data->order->cash_outlay_3_amount ?? '',
            cash_outlay_3_percentage_rate: $data->order->cash_outlay_3_percentage_rate ?? '',
            cash_outlay_3_interest_rate: $data->order->cash_outlay_3_interest_rate ?? '',
            cash_outlay_3_terms: $data->order->cash_outlay_3_terms ?? '',
            cash_outlay_3_monthly_payment: number_format($data->order->cash_outlay_3_monthly_payment ?? 0, 2),
            cash_outlay_3_effective_date: $data->order->cash_outlay_3_effective_date ?? '',
            equity_1_amount: number_format($data->order->equity_1_amount ?? 0, 2),
            equity_1_amount_in_words: strtoupper(self::convertNumberToWords($data->order->equity_1_amount ?? '0')),
            equity_1_percentage_rate: $data->order->equity_1_percentage_rate ?? '',
            equity_1_interest_rate: is_numeric($data->order->equity_1_interest_rate) ? number_format($data->order->equity_1_interest_rate ?? 0, 3) : '',
            equity_1_terms: $data->order->equity_1_terms ?? '',
            equity_1_monthly_payment: number_format($data->order->equity_1_monthly_payment ?? 0),
            equity_1_effective_date: $data->order->equity_1_effective_date ?? '',
            equity_2_amount: number_format($data->order->equity_2_amount ?? 0),
            equity_2_percentage_rate: $data->order->equity_2_percentage_rate ?? '',
            equity_2_interest_rate: $data->order->equity_2_interest_rate ?? '',
            equity_2_terms: $data->order->equity_2_terms ?? '',
            equity_2_monthly_payment: number_format($data->order->equity_2_monthly_payment ?? 0),
            equity_2_effective_date: $data->order->equity_2_effective_date ?? '',
            bp_1_amount: number_format($data->order->bp_1_amount ?? 0),
            bp_1_amount_in_words: strtoupper(self::convertNumberToWords( $data->order->bp_1_amount ?? '')),
            bp_1_percentage_rate: $data->order->bp_1_percentage_rate ?? '',
            bp_1_interest_rate: is_numeric($data->order->bp_1_interest_rate) ? number_format($data->order->bp_1_interest_rate ?? 0, 3) : '',
            bp_1_terms: $data->order->bp_1_terms ?? '',
            bp_1_monthly_payment: number_format($data->order->bp_1_monthly_payment ?? 0),
            bp_1_effective_date: $data->order->bp_1_effective_date ?? '',
            bp_2_amount: $data->order->bp_2_amount ?? '',
            bp_2_terms: $data->order->bp_2_terms ?? '',
            bp_2_percentage_rate: $data->order->bp_2_percentage_rate ?? '',
            bp_2_interest_rate: $data->order->bp_2_interest_rate ?? '',
            bp_2_monthly_payment: number_format($data->order->bp_2_monthly_payment ?? 0),
            bp_2_effective_date: $data->order->bp_2_effective_date ?? '',
            circular_no_312_379: $data->order->circular_no_312_379 ?? '',
            ltvr_slug: $data->order->ltvr_slug ?? '',
            interest: is_numeric($data->order->interest) ? number_format($data->order->interest ?? 0, 3) : '',
            interest_in_words: $data->order->interest ? strtoupper(\NumberFormatter::create('en', \NumberFormatter::SPELLOUT)->format((int)$data->order->interest)) . ' AND ' . str_pad((int)(($data->order->interest - (int)$data->order->interest) * 1000), 3, '0', STR_PAD_LEFT) . '/1000' : '',
            logo: $data->order->logo ?? '',
            loan_period_months: $data->order->loan_period_months ?? '',
            term_1: $data->order->term_1 ?? '',
            term_2: $data->order->term_2 ?? '',
            term_3: $data->order->term_3 ?? '',
            amort_mrisri1: is_numeric($data->order->amort_mrisri1) ? number_format($data->order->amort_mrisri1 ?? 0, 2) : $data->order->amort_mrisri1,
            amort_mrisri2: is_numeric($data->order->amort_mrisri2) ? number_format($data->order->amort_mrisri2 ?? 0, 2) : $data->order->amort_mrisri2,
            amort_mrisri3: is_numeric($data->order->amort_mrisri3) ? number_format($data->order->amort_mrisri3 ?? 0, 2) : $data->order->amort_mrisri3,
            amort_nonlife1: is_numeric($data->order->amort_nonlife1) ? number_format($data->order->amort_nonlife1 ?? 0, 2) : $data->order->amort_nonlife1,
            amort_nonlife2: is_numeric($data->order->amort_nonlife2) ? number_format($data->order->amort_nonlife2 ?? 0, 2) : $data->order->amort_nonlife2,
            amort_nonlife3: is_numeric($data->order->amort_nonlife3) ? number_format($data->order->amort_nonlife3 ?? 0, 2) : $data->order->amort_nonlife3,
            amort_princ_int1: is_numeric($data->order->amort_princ_int1) ? number_format($data->order->amort_princ_int1 ?? 0, 2) : $data->order->amort_princ_int1,
            amort_princ_int2: is_numeric($data->order->amort_princ_int2) ? number_format($data->order->amort_princ_int2 ?? 0, 2) : $data->order->amort_princ_int2,
            amort_princ_int3: is_numeric($data->order->amort_princ_int3) ? number_format($data->order->amort_princ_int3 ?? 0, 2) : $data->order->amort_princ_int3,
            monthly_amort1: is_numeric($data->order->monthly_amort1) ? number_format($data->order->monthly_amort1 ?? 0, 2) : $data->order->monthly_amort1,
            monthly_amort2: is_numeric($data->order->monthly_amort2) ? number_format($data->order->monthly_amort2 ?? 0, 2) : $data->order->monthly_amort2,
            monthly_amort3: is_numeric($data->order->monthly_amort3) ? number_format($data->order->monthly_amort3 ?? 0, 2) : $data->order->monthly_amort3,
            monthly_amort1_in_words: is_numeric($data->order->monthly_amort1) ? strtoupper(self::convertNumberToWords(number_format($data->order->monthly_amort1 ?? 0, 2, '.', ''))) : '',
            cct: $data->order->cct ?? '',
            witness: 'WITNESS',
            witness1: $data->order->witness1 ??  'WITNESS',
            witness2: $data->order->witness2?? 'WITNESS',
            page: $data->order->page ?? '',
            buyer_extension_name: $data->order->buyer_extension_name ?? '',
            exec_signatories: strtoupper($data->order->seller->chief_seller_officer ?? ''),
            exec_position: 'Chief Sales Officer',
            exec_tin_no: $data->order->exec_tin_no ?? '',
            board_resolution_date: $data->order->board_resolution_date ?? '',
            repricing_period: $data->order->repricing_period ?? 0,
            loan_terms_in_word: strtoupper(self::convertNumberToWords($data->order->loan_term ?? '')),
            loan_terms_in_years_in_word: strtoupper(self::convertNumberToWords((int)($data->order->loan_term ?? 0) / 12)),
            repricing_period_in_words: strtoupper(self::convertNumberToWords($data->order->repricing_period ?? '')),
            registry_of_deeds_address: $data->order->registry_of_deeds_address ?? '',
            scheme: $data->order->payment_scheme->scheme ?? '',
            company_tin: $data->order->company_tin ?? '',
            company_address: $data->order->company_address ?? '',
            loan_value_after_downpayment: $data->order->loan_value_after_downpayment ?? '0',
            loan_value_after_downpayment_in_words: strtoupper(self::convertNumberToWords($data->order->loan_value_after_downpayment ?? 0, true, ' PESOS')),
            company_acronym: $data->order->company_acronym ?? '',
            total_selling_price: number_format($data->order->total_selling_price ?? 0, 2),
            client_id_co_borrower: $data->order->client_id_co_borrower ?? '',
            client_id_aif: $data->order->client_id_aif ?? '',
            retention_fee: number_format($data->order->payment_scheme->fees?->toCollection()->firstWhere('name', 'retention_fee')->amount ?? 0, 2),
            service_fee: number_format($data->order->payment_scheme->fees?->toCollection()->firstWhere('name', 'service_fee')->amount ?? 0, 2),
            dslt_total: number_format($data->order->disclosure_statement_on_loan_transaction_total ?? 0, 2),
            dst: number_format($data->order->documentary_stamp ?? 0, 2),
            total_deductions_from_loan_proceeds: number_format($data->order->total_deductions_from_loan_proceeds ?? 0, 2),
            net_loan_proceeds: number_format($data->order->net_loan_proceeds ?? 0, 2),
            vsr_no: $data->order->verified_survey_return_no ?? '',
            technical_description: $data->order->technical_description ?? '',
            timothy_s_gobio_tin: '315-765-457-000',
            comencement_period: $data->order->comencement_period ?? '',
            non_life_insurance: number_format($data->order->non_life_insurance ?? 0, 2),
            mrisri_docstamp_total: number_format($data->order->mrisri_docstamp_total ?? 0, 2),
            repricing_period_affordable: $data->order->repricing_period_affordable ?? '',
            loan_period_in_years: intdiv($data->order->loan_period_months ?? 0, 12),
            aif_attorney: strtoupper(collect([
                $data->order->aif_attorney_first_name,
                mb_substr($data->order->aif_attorney_middle_name ?? '', 0, 1) ? mb_substr($data->order->aif_attorney_middle_name, 0, 1) . '.' : '',
                $data->order->aif_attorney_last_name,
                $data->order->aif_attorney_name_suffix,
            ])->filter()->implode(' ')),
            loan_base: is_numeric($data->order->loan_base)? number_format($data->order->loan_base , 2):0,
            loan_base_in_words: strtoupper(self::convertNumberToWords(is_numeric($data->order->loan_base)?$data->order->loan_base:0, true, ' PESOS')),
            pagibig_filing_site: (strpos(strtoupper($data->order->project_location ?? ''), 'PAMPANGA') !== false) ? 'SAN FERNANDO HOUSING BUSINESS CENTER, Suburbia Commercial Center,Maimpis City of San Fernando, Pampanga Tel:(02)8422-3000 local 6297' : '11F JELP Business Solution Center, #409 Shaw Boulevard, Mandaluyong City, Trunk line: (02) 422-3000',
            );

            return $flatdata;

        } catch (\Throwable $e) {
            $message = 'Please double check the fields. Check on '.$e->getLine();
            if($e instanceof \TypeError){
                throw new Exception(self::determineFieldName($e->getLine()));
            }else{
                throw new Exception($message);
            }
            
        }

        return new FlatData(
            brn: '',
            buyer_first_name: '',
            buyer_middle_name: '',
            buyer_last_name: '',
            s_name: '',
            buyer_name: '',
            buyer_name_with_middle_initial: '',
            buyer_civil_status: '',
            buyer_civil_status_lower_case: '',
            buyer_civil_status_to: '',
            buyer_civil_status_to_lower_case: '',
            buyer_spouse_name: '',
            buyer_spouse_name_with_middle_initial: '',
            buyer_nationality: '',
            buyer_tin: '',
            buyer_gender: '',
            buyer_principal_email: '',
            buyer_primary_contact_number: '',
            buyer_other_contact_number: '',
            buyer_province: '',
            buyer_birthday: '',
            buyer_residence_type: '',
            buyer_ownership_type: '',
            buyer_unit_lot: '',
            buyer_block: '',
            buyer_street: '',
            buyer_barangay: '',
            buyer_city: '',
            buyer_place_of_residency_1_city_of_residency: '',
            buyer_place_of_residency_2_province_of_residency: '',
            buyer_sss_gsis_number: '',
            buyer_pagibig_number: '',
            spouse_name: '',
            spouse_civil_status: '',
            spouse_civil_status_lower_case: '',
            spouse_nationality: '',
            spouse_gender: '',
            spouse_principal_email: '',
            spouse_mobile: '',
            client_id_spouse: '',
            spouse_fb_account_name: '',
            buyer_address: '',
            buyer_zip_code: '',
            buyer_address1: '',
            company_name: '',
            project_name: '',
            project_code: '',
            project_location: '',
            project_address: '',
            property_name: '',
            phase: '',
            block: '',
            lot: '',
            mrif_fee: '',
            reservation_rate: '',
            lot_area: '',
            lot_area_in_words: '',
            floor_area: '',
            floor_area_in_words: '',
            tcp: '',
            tcp_in_words: '',
            interest: '',
            interest_in_words: '',
            loan_term: '',
            loan_term_in_years: '',
            loan_term_in_years_in_words: '',
            loan_interest_rate: '',
            tct_no: '',
            sku: '',
            promo_code: '',
            seller_commission_code: '',
            property_code: '',
            property_type: '',
            os_status: '',
            class_field: '',
            segment_field: '',
            rebooked_id_form: '',
            cancellation_type: '',
            cancellation_reason: '',
            cancellation_remarks: '',
            unit_type: '',
            unit_type_interior: '',
            house_color: '',
            construction_status: '',
            transaction_reference: '',
            help_number: '',
            date_created: '',
            ra_date: '',
            date_approved: '',
            date_expiration: '',
            os_month: '',
            due_date: '',
            total_payments_made: '',
            transaction_status: '',
            staging_status: '',
            period_id: '',
            date_closed: '',
            closed_reason: '',
            date_cancellation: '',
            discount_rate: '',
            conditional_discount: '',
            evat_percentage: '',
            total_contract_price: '',
            evat_amount: '',
            net_total_contract_price: '',
            ntcp_in_words: '',
            payment_scheme: '',
            payment_method_name: '',
            collectible_price: '',
            reservation_date: '',
            commissionable_amount: '',
            transaction_sub_status: '',
            pf_amount_paid: '',
            pf_payment_reference_number: '',
            pf_payment_date: '',
            hucf_amount_paid: '',
            hucf_payment_reference_number: '',
            hucf_payment_date: '',
            balance_payment_amount_paid: '',
            balance_payment_reference_number: '',
            balance_payment_date: '',
            equity_payment_amount_paid: '',
            equity_payment_reference_number: '',
            equity_payment_date: '',
            payment_remarks: '',
            transaction_remarks: '',
            mothers_maiden_name: '',
            baf_number: '',
            baf_date: '',
            client_id: '',
            buyer_age: '',
            buyer_subdivision: '',
            rental_fee: '',
            years_of_residency: '',
            present_buyer_unit_lot: '',
            present_buyer_street: '',
            present_buyer_subdivision: '',
            present_buyer_barangay: '',
            present_buyer_city: '',
            present_buyer_province: '',
            present_buyer_ownership_type: '',
            present_rental_fee: '',
            present_years_of_residency: '',
            buyer_residence_landline: '',
            buyer_fb_account_name: '',
            buyer_company_email_address: '',
            buyer_spouse_last_name: '',
            buyer_spouse_middle_name: '',
            spouse_extension_name: '',
            spouse_mothers_maiden_name: '',
            spouse_birthday: '',
            buyer_spouse_first_name: '',
            spouse_primary_contact_number: '',
            spouse_residence_landline: '',
            building: '',
            floor: '',
            unit: '',
            aif_name: '',
            aif_address: '',
            co_borrower_name: '',
            co_borrower_name_with_middle_initial: '',
            co_borrower_address: '',
            buyer_years_in_service: '',
            buyer_employer_type: '',
            buyer_employer_status: '',
            buyer_employer_year_established: '',
            buyer_employer_total_number_of_employees: '',
            buyer_employer_name: '',
            buyer_employer_contact_number: '',
            buyer_employer_address: '',
            buyer_employer_city: '',
            buyer_employer_province: '',
            buyer_employer_address1: '',
            buyer_place_of_work_1_city_of_employer: '',
            buyer_place_of_work_2_city_of_employer: '',
            buyer_position: '',
            buyer_salary_gross_income: '',
            buyer_salary_range: '',
            industry: '',
            selling_unit: '',
            seller_id: '',
            seller_name: '',
            seller_superior: '',
            sales_team_head: '',
            chief_seles_officer: '',
            seller_type: '',
            cancellation_reason2: '',
            hucf_move_in_fee: '',
            reservation_rate_processing_fee: '',
            cash_outlay_1_amount: '',
            cash_outlay_1_percentage_rate: '',
            cash_outlay_1_interest_rate: '',
            cash_outlay_1_terms: '',
            cash_outlay_1_monthly_payment: '',
            cash_outlay_2_amount: '',
            cash_outlay_2_percentage_rate: '',
            cash_outlay_2_interest_rate: '',
            cash_outlay_2_terms: '',
            cash_outlay_2_monthly_payment: '',
            cash_outlay_1_effective_date: '',
            cash_outlay_2_effective_date: '',
            cash_outlay_3_amount: '',
            cash_outlay_3_percentage_rate: '',
            cash_outlay_3_interest_rate: '',
            cash_outlay_3_terms: '',
            cash_outlay_3_monthly_payment: '',
            cash_outlay_3_effective_date: '',
            equity_1_amount: '',
            equity_1_amount_in_words: '',
            equity_1_percentage_rate: '',
            equity_1_interest_rate: '',
            equity_1_terms: '',
            equity_1_monthly_payment: '',
            equity_1_effective_date: '',
            equity_2_amount: '',
            equity_2_percentage_rate: '',
            equity_2_interest_rate: '',
            equity_2_terms: '',
            equity_2_monthly_payment: '',
            equity_2_effective_date: '',
            bp_1_amount: '',
            bp_1_amount_in_words: '',
            bp_1_percentage_rate: '',
            bp_1_interest_rate: '',
            bp_1_terms: '',
            bp_1_monthly_payment: '',
            bp_1_effective_date: '',
            bp_2_amount: '',
            bp_2_percentage_rate: '',
            bp_2_interest_rate: '',
            bp_2_terms: '',
            bp_2_monthly_payment: '',
            bp_2_effective_date: '',
            circular_no_312_379: '',
            ltvr_slug: '',
            spouse_age: '',
            spouse_tin: '',
            spouse_tin_with_label: '',
            spouse_pagibig_number: '',
            spouse_employer_name: '',
            spouse_employer_type: '',
            spouse_employer_status: '',
            spouse_employer_address: '',
            spouse_employer_contact_number: '',
            spouse_company_email_address: '',
            spouse_position: '',
            spouse_years_in_service: '',
            spouse_salary_gross_income: '',
            zip_code: '',
            length_of_stay: '',
            logo: '',
            loan_period_months: '',
            co_borrower_civil_status: '',
            co_borrower_civil_status_to: '',
            co_borrower_civil_status_lower_case: '',
            co_borrower_nationality: '',
            co_borrower_spouse: '',
            co_borrower_spouse_with_middle_initial: '',
            co_borrower_spouse_tin: '',
            co_borrower_tin: '',
            aif_last_name: '',
            aif_first_name: '',
            aif_middle_name: '',
            aif_extension_name: '',
            aif_mobile: '',
            aif_email: '',
            aif_other_mobile: '',
            aif_landline: '',
            aif_unit_lot: '',
            aif_street: '',
            aif_subdivision: '',
            aif_barangay: '',
            aif_city: '',
            aif_province: '',
            aif_zip_code: '',
            aif_length_of_stay: '',
            aif_ownership_type: '',
            aif_birthday: '',
            aif_age: '',
            aif_gender: '',
            aif_civil_status: '',
            aif_civil_status_lower_case: '',
            aif_nationality: '',
            aif_residence_landline: '',
            aif_primary_contact_number: '',
            aif_relationship_to_buyer: '',
            aif_account_name: '',
            aif_username_or_email: '',
            aif_tin: '',
            aif_sss: '',
            aif_pagibig: '',
            aif_passport: '',
            aif_date_issued: '',
            aif_place_issued: '',
            aif_employer_name: '',
            aif_employer_address: '',
            aif_employer_type: '',
            aif_employment_status: '',
            aif_position: '',
            aif_industry: '',
            aif_salary_gross_income: '',
            aif_company_phone_number: '',
            aif_fax: '',
            aif_company_email: '',
            term_1: '',
            term_2: '',
            term_3: '',
            amort_mrisri1: '',
            amort_mrisri2: '',
            amort_mrisri3: '',
            amort_nonlife1: '',
            amort_nonlife2: '',
            amort_nonlife3: '',
            amort_princ_int1: '',
            amort_princ_int2: '',
            amort_princ_int3: '',
            monthly_amort1: '',
            monthly_amort1_in_words: '',
            monthly_amort2: '',
            monthly_amort3: '',
            cct: '',
            witness: '',
            witness1: '',
            witness2: '',
            page: '',
            buyer_extension_name: '',
            spouse_industry: '',
            exec_signatories: '',
            exec_position: '',
            exec_tin_no: '',
            board_resolution_date: '',
            repricing_period: '',
            loan_terms_in_word: '',
            loan_terms_in_years_in_word: '',
            repricing_period_in_words: '',
            registry_of_deeds_address: '',
            scheme: '',
            company_tin: '',
            company_address: '',
            loan_value_after_downpayment: '',
            loan_value_after_downpayment_in_words: '',
            company_acronym: '',
            total_selling_price: '',
            client_id_co_borrower: '',
            client_id_aif: '',
            retention_fee: '',
            service_fee: '',
            dslt_total: '',
            dst: '',
            total_deductions_from_loan_proceeds: '',
            net_loan_proceeds: '',
            vsr_no: '',
            technical_description: '',
            both_of: '',
            timothy_s_gobio_tin: '',
            non_life_insurance: '',
            mrisri_docstamp_total: '',
            comencement_period: '',
            repricing_period_affordable: '',
            loan_period_in_years: '',
            aif_attorney: '',
            loan_base: '',
            loan_base_in_words: '',
            pagibig_filing_site: '',
        );
     
    }

    public static function convertNumberToWords($number, $isFraction = true, $postfix = '') {
        if($number != '' && $number != 0){
            if($isFraction){
                if (fmod($number, 1) == 0) {
                    // If the number is an integer
                    return strtoupper(\NumberFormatter::create('en', \NumberFormatter::SPELLOUT)
                                        ->format((int)$number)) . $postfix;
                } else {
                    // If the number has a fractional part
                    return strtoupper(\NumberFormatter::create('en', \NumberFormatter::SPELLOUT)
                                        ->format((int)$number))
                                . ' AND '
                                . str_pad((int)round(($number - (int)$number) * 100), 2, '0', STR_PAD_LEFT)
                                . '/100'
                                . $postfix;
                }
            }else{
                $formatter = new \NumberFormatter('en', \NumberFormatter::SPELLOUT);

                if (strpos($number, '.') !== false) {
                    $parts = explode('.', $number);
                    $wholePart = $formatter->format($parts[0]);

                    // Check if the fractional part is not zero
                    if ((int)$parts[1] !== 0) {
                        $fractionalPart = $formatter->format($parts[1]);
                        return $wholePart . ' AND ' . $fractionalPart;
                    }

                    // If the fractional part is zero, return only the whole part
                    return $wholePart . $postfix;
                }

                // For whole numbers, convert directly
                return $formatter->format($number) . $postfix;
            }
        }else{
            return '';
        }
    }

    public static function convertNumberToWordsWithDynamicNotation($number, $postfix_default = '', $postfix = '', $infix = ' AND ') {
        if($number != '' && $number != 0){
            $formatter = new \NumberFormatter('en', \NumberFormatter::SPELLOUT);

            if (strpos($number, '.') !== false) {
                $parts = explode('.', $number);
                $wholePart = $formatter->format($parts[0]);

                // Check if the fractional part is not zero
                if ((int)$parts[1] !== 0) {
                    $fractionalPart = $formatter->format($parts[1]);
                    return $wholePart . ' '. $infix .' ' . $fractionalPart . $postfix;
                }

                // If the fractional part is zero, return only the whole part
                return $wholePart . $postfix_default;
            }

            // For whole numbers, convert directly
            return $formatter->format($number) . $postfix_default;
        }else{
            return '';
        }
    }

    public static function determineFieldName($line_number){
        switch($line_number){
            case(416):
            return "Please check your field brn to view/download the document.";
            break;
            case(417):
            return "Please check your field buyer_first_name to view/download the document.";
            break;
            case(418):
            return "Please check your field buyer_middle_name to view/download the document.";
            break;
            case(419):
            return "Please check your field buyer_last_name to view/download the document.";
            break;
            case(420):
            return "Please check your field s_name to view/download the document.";
            break;
            case(426):
            return "Please check your field buyer_name to view/download the document.";
            break;
            case(432):
            return "Please check your field buyer_name_with_middle_initial to view/download the document.";
            break;
            case(438):
            return "Please check your field buyer_birthday to view/download the document.";
            break;
            case(439):
            return "Please check your field buyer_civil_status to view/download the document.";
            break;
            case(440):
            return "Please check your field buyer_civil_status_lower_case to view/download the document.";
            break;
            case(441):
            return "Please check your field buyer_civil_status_to to view/download the document.";
            break;
            case(442):
            return "Please check your field buyer_civil_status_to_lower_case to view/download the document.";
            break;
            case(443):
            return "Please check your field both_of to view/download the document.";
            break;
            case(444):
            return "Please check your field buyer_spouse_name to view/download the document.";
            break;
            case(450):
            return "Please check your field buyer_spouse_name_with_middle_initial to view/download the document.";
            break;
            case(456):
            return "Please check your field buyer_nationality to view/download the document.";
            break;
            case(457):
            return "Please check your field buyer_tin to view/download the document.";
            break;
            case(458):
            return "Please check your field buyer_sss_gsis_number to view/download the document.";
            break;
            case(459):
            return "Please check your field buyer_pagibig_number to view/download the document.";
            break;
            case(460):
            return "Please check your field buyer_gender to view/download the document.";
            break;
            case(461):
            return "Please check your field buyer_principal_email to view/download the document.";
            break;
            case(462):
            return "Please check your field buyer_primary_contact_number to view/download the document.";
            break;
            case(463):
            return "Please check your field buyer_other_contact_number to view/download the document.";
            break;
            case(464):
            return "Please check your field help_number to view/download the document.";
            break;
            case(465):
            return "Please check your field mothers_maiden_name to view/download the document.";
            break;
            case(466):
            return "Please check your field buyer_residence_landline to view/download the document.";
            break;
            case(467):
            return "Please check your field buyer_fb_account_name to view/download the document.";
            break;
            case(468):
            return "Please check your field buyer_company_email_address to view/download the document.";
            break;
            case(469):
            return "Please check your field buyer_spouse_first_name to view/download the document.";
            break;
            case(470):
            return "Please check your field buyer_spouse_middle_name to view/download the document.";
            break;
            case(471):
            return "Please check your field buyer_spouse_last_name to view/download the document.";
            break;
            case(472):
            return "Please check your field spouse_name to view/download the document.";
            break;
            case(473):
            return "Please check your field spouse_civil_status to view/download the document.";
            break;
            case(474):
            return "Please check your field spouse_civil_status_lower_case to view/download the document.";
            break;
            case(475):
            return "Please check your field spouse_nationality to view/download the document.";
            break;
            case(476):
            return "Please check your field spouse_gender to view/download the document.";
            break;
            case(477):
            return "Please check your field spouse_birthday to view/download the document.";
            break;
            case(478):
            return "Please check your field spouse_principal_email to view/download the document.";
            break;
            case(479):
            return "Please check your field spouse_mobile to view/download the document.";
            break;
            case(480):
            return "Please check your field client_id_spouse to view/download the document.";
            break;
            case(481):
            return "Please check your field spouse_extension_name to view/download the document.";
            break;
            case(482):
            return "Please check your field spouse_mothers_maiden_name to view/download the document.";
            break;
            case(483):
            return "Please check your field spouse_primary_contact_number to view/download the document.";
            break;
            case(484):
            return "Please check your field spouse_residence_landline to view/download the document.";
            break;
            case(485):
            return "Please check your field spouse_fb_account_name to view/download the document.";
            break;
            case(486):
            return "Please check your field spouse_age to view/download the document.";
            break;
            case(487):
            return "Please check your field spouse_tin_with_label to view/download the document.";
            break;
            case(488):
            return "Please check your field spouse_tin to view/download the document.";
            break;
            case(489):
            return "Please check your field spouse_pagibig_number to view/download the document.";
            break;
            case(490):
            return "Please check your field spouse_employer_name to view/download the document.";
            break;
            case(491):
            return "Please check your field spouse_employer_type to view/download the document.";
            break;
            case(492):
            return "Please check your field spouse_employer_status to view/download the document.";
            break;
            case(493):
            return "Please check your field spouse_employer_address to view/download the document.";
            break;
            case(494):
            return "Please check your field spouse_employer_contact_number to view/download the document.";
            break;
            case(495):
            return "Please check your field spouse_company_email_address to view/download the document.";
            break;
            case(496):
            return "Please check your field spouse_position to view/download the document.";
            break;
            case(497):
            return "Please check your field spouse_years_in_service to view/download the document.";
            break;
            case(498):
            return "Please check your field spouse_salary_gross_income to view/download the document.";
            break;
            case(499):
            return "Please check your field zip_code to view/download the document.";
            break;
            case(500):
            return "Please check your field length_of_stay to view/download the document.";
            break;
            case(501):
            return "Please check your field spouse_industry to view/download the document.";
            break;
            case(502):
            return "Please check your field buyer_address to view/download the document.";
            break;
            case(503):
            return "Please check your field buyer_address1 to view/download the document.";
            break;
            case(504):
            return "Please check your field buyer_zip_code to view/download the document.";
            break;
            case(505):
            return "Please check your field buyer_province to view/download the document.";
            break;
            case(506):
            return "Please check your field buyer_residence_type to view/download the document.";
            break;
            case(507):
            return "Please check your field buyer_ownership_type to view/download the document.";
            break;
            case(508):
            return "Please check your field buyer_unit_lot to view/download the document.";
            break;
            case(509):
            return "Please check your field buyer_block to view/download the document.";
            break;
            case(510):
            return "Please check your field buyer_street to view/download the document.";
            break;
            case(511):
            return "Please check your field buyer_barangay to view/download the document.";
            break;
            case(512):
            return "Please check your field buyer_city to view/download the document.";
            break;
            case(513):
            return "Please check your field buyer_place_of_residency_1_city_of_residency to view/download the document.";
            break;
            case(514):
            return "Please check your field buyer_place_of_residency_2_province_of_residency to view/download the document.";
            break;
            case(515):
            return "Please check your field buyer_subdivision to view/download the document.";
            break;
            case(516):
            return "Please check your field years_of_residency to view/download the document.";
            break;
            case(517):
            return "Please check your field present_buyer_unit_lot to view/download the document.";
            break;
            case(518):
            return "Please check your field present_buyer_street to view/download the document.";
            break;
            case(519):
            return "Please check your field present_buyer_subdivision to view/download the document.";
            break;
            case(520):
            return "Please check your field present_buyer_barangay to view/download the document.";
            break;
            case(521):
            return "Please check your field present_buyer_city to view/download the document.";
            break;
            case(522):
            return "Please check your field present_buyer_province to view/download the document.";
            break;
            case(523):
            return "Please check your field present_buyer_ownership_type to view/download the document.";
            break;
            case(524):
            return "Please check your field present_years_of_residency to view/download the document.";
            break;
            case(525):
            return "Please check your field building to view/download the document.";
            break;
            case(526):
            return "Please check your field floor to view/download the document.";
            break;
            case(527):
            return "Please check your field unit to view/download the document.";
            break;
            case(528):
            return "Please check your field aif_address to view/download the document.";
            break;
            case(529):
            return "Please check your field company_name to view/download the document.";
            break;
            case(530):
            return "Please check your field project_name to view/download the document.";
            break;
            case(531):
            return "Please check your field project_code to view/download the document.";
            break;
            case(532):
            return "Please check your field project_location to view/download the document.";
            break;
            case(533):
            return "Please check your field project_address to view/download the document.";
            break;
            case(534):
            return "Please check your field property_name to view/download the document.";
            break;
            case(535):
            return "Please check your field phase to view/download the document.";
            break;
            case(536):
            return "Please check your field block to view/download the document.";
            break;
            case(537):
            return "Please check your field lot to view/download the document.";
            break;
            case(538):
            return "Please check your field mrif_fee to view/download the document.";
            break;
            case(539):
            return "Please check your field reservation_rate to view/download the document.";
            break;
            case(540):
            return "Please check your field lot_area to view/download the document.";
            break;
            case(541):
            return "Please check your field lot_area_in_words to view/download the document.";
            break;
            case(542):
            return "Please check your field floor_area to view/download the document.";
            break;
            case(543):
            return "Please check your field floor_area_in_words to view/download the document.";
            break;
            case(544):
            return "Please check your field tcp to view/download the document.";
            break;
            case(545):
            return "Please check your field tcp_in_words to view/download the document.";
            break;
            case(546):
            return "Please check your field loan_term to view/download the document.";
            break;
            case(547):
            return "Please check your field loan_term_in_years  to view/download the document.";
            break;
            case(548):
            return "Please check your field loan_term_in_years_in_words  to view/download the document.";
            break;
            case(549):
            return "Please check your field loan_interest_rate to view/download the document.";
            break;
            case(550):
            return "Please check your field tct_no to view/download the document.";
            break;
            case(551):
            return "Please check your field sku to view/download the document.";
            break;
            case(552):
            return "Please check your field promo_code to view/download the document.";
            break;
            case(553):
            return "Please check your field seller_commission_code to view/download the document.";
            break;
            case(554):
            return "Please check your field property_code to view/download the document.";
            break;
            case(555):
            return "Please check your field property_type to view/download the document.";
            break;
            case(556):
            return "Please check your field baf_number to view/download the document.";
            break;
            case(557):
            return "Please check your field baf_date to view/download the document.";
            break;
            case(558):
            return "Please check your field client_id to view/download the document.";
            break;
            case(559):
            return "Please check your field buyer_age to view/download the document.";
            break;
            case(560):
            return "Please check your field os_status to view/download the document.";
            break;
            case(561):
            return "Please check your field class_field to view/download the document.";
            break;
            case(562):
            return "Please check your field segment_field to view/download the document.";
            break;
            case(563):
            return "Please check your field rebooked_id_form to view/download the document.";
            break;
            case(564):
            return "Please check your field cancellation_type to view/download the document.";
            break;
            case(565):
            return "Please check your field cancellation_reason to view/download the document.";
            break;
            case(566):
            return "Please check your field cancellation_remarks to view/download the document.";
            break;
            case(567):
            return "Please check your field unit_type to view/download the document.";
            break;
            case(568):
            return "Please check your field unit_type_interior to view/download the document.";
            break;
            case(569):
            return "Please check your field house_color to view/download the document.";
            break;
            case(570):
            return "Please check your field construction_status to view/download the document.";
            break;
            case(571):
            return "Please check your field transaction_reference to view/download the document.";
            break;
            case(572):
            return "Please check your field date_created to view/download the document.";
            break;
            case(573):
            return "Please check your field ra_date to view/download the document.";
            break;
            case(574):
            return "Please check your field date_approved to view/download the document.";
            break;
            case(575):
            return "Please check your field date_expiration to view/download the document.";
            break;
            case(576):
            return "Please check your field os_month to view/download the document.";
            break;
            case(577):
            return "Please check your field due_date to view/download the document.";
            break;
            case(578):
            return "Please check your field total_payments_made to view/download the document.";
            break;
            case(579):
            return "Please check your field transaction_status to view/download the document.";
            break;
            case(580):
            return "Please check your field staging_status to view/download the document.";
            break;
            case(581):
            return "Please check your field period_id to view/download the document.";
            break;
            case(582):
            return "Please check your field date_closed to view/download the document.";
            break;
            case(583):
            return "Please check your field closed_reason to view/download the document.";
            break;
            case(584):
            return "Please check your field date_cancellation to view/download the document.";
            break;
            case(585):
            return "Please check your field reservation_date to view/download the document.";
            break;
            case(586):
            return "Please check your field payment_scheme to view/download the document.";
            break;
            case(587):
            return "Please check your field discount_rate to view/download the document.";
            break;
            case(588):
            return "Please check your field conditional_discount to view/download the document.";
            break;
            case(589):
            return "Please check your field evat_percentage to view/download the document.";
            break;
            case(590):
            return "Please check your field total_contract_price to view/download the document.";
            break;
            case(591):
            return "Please check your field evat_amount to view/download the document.";
            break;
            case(592):
            return "Please check your field net_total_contract_price to view/download the document.";
            break;
            case(593):
            return "Please check your field ntcp_in_words to view/download the document.";
            break;
            case(594):
            return "Please check your field payment_method_name to view/download the document.";
            break;
            case(595):
            return "Please check your field collectible_price to view/download the document.";
            break;
            case(596):
            return "Please check your field commissionable_amount to view/download the document.";
            break;
            case(597):
            return "Please check your field transaction_sub_status to view/download the document.";
            break;
            case(598):
            return "Please check your field payment_remarks to view/download the document.";
            break;
            case(599):
            return "Please check your field transaction_remarks to view/download the document.";
            break;
            case(600):
            return "Please check your field pf_amount_paid to view/download the document.";
            break;
            case(601):
            return "Please check your field pf_payment_reference_number to view/download the document.";
            break;
            case(602):
            return "Please check your field pf_payment_date to view/download the document.";
            break;
            case(603):
            return "Please check your field hucf_amount_paid to view/download the document.";
            break;
            case(604):
            return "Please check your field hucf_payment_reference_number to view/download the document.";
            break;
            case(605):
            return "Please check your field hucf_payment_date to view/download the document.";
            break;
            case(606):
            return "Please check your field balance_payment_amount_paid to view/download the document.";
            break;
            case(607):
            return "Please check your field balance_payment_reference_number to view/download the document.";
            break;
            case(608):
            return "Please check your field balance_payment_date to view/download the document.";
            break;
            case(609):
            return "Please check your field equity_payment_amount_paid to view/download the document.";
            break;
            case(610):
            return "Please check your field equity_payment_reference_number to view/download the document.";
            break;
            case(611):
            return "Please check your field equity_payment_date to view/download the document.";
            break;
            case(612):
            return "Please check your field rental_fee to view/download the document.";
            break;
            case(613):
            return "Please check your field present_rental_fee to view/download the document.";
            break;
            case(614):
            return "Please check your field co_borrower_name to view/download the document.";
            break;
            case(620):
            return "Please check your field co_borrower_name_with_middle_initial to view/download the document.";
            break;
            case(626):
            return "Please check your field co_borrower_address to view/download the document.";
            break;
            case(627):
            return "Please check your field co_borrower_civil_status to view/download the document.";
            break;
            case(628):
            return "Please check your field co_borrower_civil_status_lower_case to view/download the document.";
            break;
            case(629):
            return "Please check your field co_borrower_civil_status_to to view/download the document.";
            break;
            case(630):
            return "Please check your field co_borrower_nationality to view/download the document.";
            break;
            case(631):
            return "Please check your field co_borrower_spouse to view/download the document.";
            break;
            case(632):
            return "Please check your field co_borrower_spouse_with_middle_initial to view/download the document.";
            break;
            case(633):
            return "Please check your field co_borrower_spouse_tin to view/download the document.";
            break;
            case(634):
            return "Please check your field co_borrower_tin to view/download the document.";
            break;
            case(635):
            return "Please check your field aif_name to view/download the document.";
            break;
            case(636):
            return "Please check your field aif_last_name to view/download the document.";
            break;
            case(637):
            return "Please check your field aif_first_name to view/download the document.";
            break;
            case(638):
            return "Please check your field aif_middle_name to view/download the document.";
            break;
            case(639):
            return "Please check your field aif_extension_name to view/download the document.";
            break;
            case(640):
            return "Please check your field aif_mobile to view/download the document.";
            break;
            case(641):
            return "Please check your field aif_other_mobile to view/download the document.";
            break;
            case(642):
            return "Please check your field aif_landline to view/download the document.";
            break;
            case(643):
            return "Please check your field aif_email to view/download the document.";
            break;
            case(644):
            return "Please check your field aif_unit_lot to view/download the document.";
            break;
            case(645):
            return "Please check your field aif_street to view/download the document.";
            break;
            case(646):
            return "Please check your field aif_subdivision to view/download the document.";
            break;
            case(647):
            return "Please check your field aif_barangay to view/download the document.";
            break;
            case(648):
            return "Please check your field aif_city to view/download the document.";
            break;
            case(649):
            return "Please check your field aif_province to view/download the document.";
            break;
            case(650):
            return "Please check your field aif_zip_code to view/download the document.";
            break;
            case(651):
            return "Please check your field aif_length_of_stay to view/download the document.";
            break;
            case(652):
            return "Please check your field aif_ownership_type to view/download the document.";
            break;
            case(653):
            return "Please check your field aif_birthday to view/download the document.";
            break;
            case(654):
            return "Please check your field aif_age to view/download the document.";
            break;
            case(655):
            return "Please check your field aif_gender to view/download the document.";
            break;
            case(656):
            return "Please check your field aif_civil_status to view/download the document.";
            break;
            case(657):
            return "Please check your field aif_civil_status_lower_case to view/download the document.";
            break;
            case(658):
            return "Please check your field aif_nationality to view/download the document.";
            break;
            case(659):
            return "Please check your field aif_residence_landline to view/download the document.";
            break;
            case(660):
            return "Please check your field aif_primary_contact_number to view/download the document.";
            break;
            case(661):
            return "Please check your field aif_relationship_to_buyer to view/download the document.";
            break;
            case(662):
            return "Please check your field aif_account_name to view/download the document.";
            break;
            case(663):
            return "Please check your field aif_username_or_email to view/download the document.";
            break;
            case(664):
            return "Please check your field aif_sss to view/download the document.";
            break;
            case(665):
            return "Please check your field aif_pagibig to view/download the document.";
            break;
            case(666):
            return "Please check your field aif_tin to view/download the document.";
            break;
            case(667):
            return "Please check your field aif_passport to view/download the document.";
            break;
            case(668):
            return "Please check your field aif_date_issued to view/download the document.";
            break;
            case(669):
            return "Please check your field aif_place_issued to view/download the document.";
            break;
            case(670):
            return "Please check your field aif_employer_name to view/download the document.";
            break;
            case(671):
            return "Please check your field aif_employer_address to view/download the document.";
            break;
            case(672):
            return "Please check your field aif_employer_type to view/download the document.";
            break;
            case(673):
            return "Please check your field aif_employment_status to view/download the document.";
            break;
            case(674):
            return "Please check your field aif_position to view/download the document.";
            break;
            case(675):
            return "Please check your field aif_industry to view/download the document.";
            break;
            case(676):
            return "Please check your field aif_salary_gross_income to view/download the document.";
            break;
            case(677):
            return "Please check your field aif_company_phone_number to view/download the document.";
            break;
            case(678):
            return "Please check your field aif_fax to view/download the document.";
            break;
            case(679):
            return "Please check your field aif_company_email to view/download the document.";
            break;
            case(680):
            return "Please check your field buyer_years_in_service to view/download the document.";
            break;
            case(681):
            return "Please check your field buyer_employer_type to view/download the document.";
            break;
            case(682):
            return "Please check your field buyer_employer_status to view/download the document.";
            break;
            case(683):
            return "Please check your field buyer_employer_year_established to view/download the document.";
            break;
            case(684):
            return "Please check your field buyer_employer_total_number_of_employees to view/download the document.";
            break;
            case(685):
            return "Please check your field buyer_employer_name to view/download the document.";
            break;
            case(686):
            return "Please check your field buyer_employer_contact_number to view/download the document.";
            break;
            case(687):
            return "Please check your field buyer_employer_address to view/download the document.";
            break;
            case(688):
            return "Please check your field buyer_employer_city to view/download the document.";
            break;
            case(689):
            return "Please check your field buyer_employer_province to view/download the document.";
            break;
            case(690):
            return "Please check your field buyer_employer_address1 to view/download the document.";
            break;
            case(691):
            return "Please check your field buyer_place_of_work_1_city_of_employer to view/download the document.";
            break;
            case(692):
            return "Please check your field buyer_place_of_work_2_city_of_employer to view/download the document.";
            break;
            case(693):
            return "Please check your field buyer_position to view/download the document.";
            break;
            case(694):
            return "Please check your field buyer_salary_gross_income to view/download the document.";
            break;
            case(695):
            return "Please check your field buyer_salary_range to view/download the document.";
            break;
            case(696):
            return "Please check your field industry to view/download the document.";
            break;
            case(697):
            return "Please check your field selling_unit to view/download the document.";
            break;
            case(698):
            return "Please check your field seller_id to view/download the document.";
            break;
            case(699):
            return "Please check your field seller_name to view/download the document.";
            break;
            case(700):
            return "Please check your field seller_superior to view/download the document.";
            break;
            case(701):
            return "Please check your field sales_team_head to view/download the document.";
            break;
            case(702):
            return "Please check your field chief_seles_officer to view/download the document.";
            break;
            case(703):
            return "Please check your field seller_type to view/download the document.";
            break;
            case(704):
            return "Please check your field cancellation_reason2 to view/download the document.";
            break;
            case(705):
            return "Please check your field hucf_move_in_fee to view/download the document.";
            break;
            case(706):
            return "Please check your field reservation_rate_processing_fee to view/download the document.";
            break;
            case(707):
            return "Please check your field cash_outlay_1_amount to view/download the document.";
            break;
            case(708):
            return "Please check your field cash_outlay_1_percentage_rate to view/download the document.";
            break;
            case(709):
            return "Please check your field cash_outlay_1_interest_rate to view/download the document.";
            break;
            case(710):
            return "Please check your field cash_outlay_1_terms to view/download the document.";
            break;
            case(711):
            return "Please check your field cash_outlay_1_monthly_payment to view/download the document.";
            break;
            case(712):
            return "Please check your field cash_outlay_1_effective_date to view/download the document.";
            break;
            case(713):
            return "Please check your field cash_outlay_2_amount to view/download the document.";
            break;
            case(714):
            return "Please check your field cash_outlay_2_percentage_rate to view/download the document.";
            break;
            case(715):
            return "Please check your field cash_outlay_2_interest_rate to view/download the document.";
            break;
            case(716):
            return "Please check your field cash_outlay_2_terms to view/download the document.";
            break;
            case(717):
            return "Please check your field cash_outlay_2_monthly_payment to view/download the document.";
            break;
            case(718):
            return "Please check your field cash_outlay_2_effective_date to view/download the document.";
            break;
            case(719):
            return "Please check your field cash_outlay_3_amount to view/download the document.";
            break;
            case(720):
            return "Please check your field cash_outlay_3_percentage_rate to view/download the document.";
            break;
            case(721):
            return "Please check your field cash_outlay_3_interest_rate to view/download the document.";
            break;
            case(722):
            return "Please check your field cash_outlay_3_terms to view/download the document.";
            break;
            case(723):
            return "Please check your field cash_outlay_3_monthly_payment to view/download the document.";
            break;
            case(724):
            return "Please check your field cash_outlay_3_effective_date to view/download the document.";
            break;
            case(725):
            return "Please check your field equity_1_amount to view/download the document.";
            break;
            case(726):
            return "Please check your field equity_1_amount_in_words to view/download the document.";
            break;
            case(727):
            return "Please check your field equity_1_percentage_rate to view/download the document.";
            break;
            case(728):
            return "Please check your field equity_1_interest_rate to view/download the document.";
            break;
            case(729):
            return "Please check your field equity_1_terms to view/download the document.";
            break;
            case(730):
            return "Please check your field equity_1_monthly_payment to view/download the document.";
            break;
            case(731):
            return "Please check your field equity_1_effective_date to view/download the document.";
            break;
            case(732):
            return "Please check your field equity_2_amount to view/download the document.";
            break;
            case(733):
            return "Please check your field equity_2_percentage_rate to view/download the document.";
            break;
            case(734):
            return "Please check your field equity_2_interest_rate to view/download the document.";
            break;
            case(735):
            return "Please check your field equity_2_terms to view/download the document.";
            break;
            case(736):
            return "Please check your field equity_2_monthly_payment to view/download the document.";
            break;
            case(737):
            return "Please check your field equity_2_effective_date to view/download the document.";
            break;
            case(738):
            return "Please check your field bp_1_amount to view/download the document.";
            break;
            case(739):
            return "Please check your field bp_1_amount_in_words to view/download the document.";
            break;
            case(740):
            return "Please check your field bp_1_percentage_rate to view/download the document.";
            break;
            case(741):
            return "Please check your field bp_1_interest_rate to view/download the document.";
            break;
            case(742):
            return "Please check your field bp_1_terms to view/download the document.";
            break;
            case(743):
            return "Please check your field bp_1_monthly_payment to view/download the document.";
            break;
            case(744):
            return "Please check your field bp_1_effective_date to view/download the document.";
            break;
            case(745):
            return "Please check your field bp_2_amount to view/download the document.";
            break;
            case(746):
            return "Please check your field bp_2_terms to view/download the document.";
            break;
            case(747):
            return "Please check your field bp_2_percentage_rate to view/download the document.";
            break;
            case(748):
            return "Please check your field bp_2_interest_rate to view/download the document.";
            break;
            case(749):
            return "Please check your field bp_2_monthly_payment to view/download the document.";
            break;
            case(750):
            return "Please check your field bp_2_effective_date to view/download the document.";
            break;
            case(751):
            return "Please check your field circular_no_312_379 to view/download the document.";
            break;
            case(752):
            return "Please check your field ltvr_slug to view/download the document.";
            break;
            case(753):
            return "Please check your field interest to view/download the document.";
            break;
            case(754):
            return "Please check your field interest_in_words to view/download the document.";
            break;
            case(755):
            return "Please check your field logo to view/download the document.";
            break;
            case(756):
            return "Please check your field loan_period_months to view/download the document.";
            break;
            case(757):
            return "Please check your field term_1 to view/download the document.";
            break;
            case(758):
            return "Please check your field term_2 to view/download the document.";
            break;
            case(759):
            return "Please check your field term_3 to view/download the document.";
            break;
            case(760):
            return "Please check your field amort_mrisri1 to view/download the document.";
            break;
            case(761):
            return "Please check your field amort_mrisri2 to view/download the document.";
            break;
            case(762):
            return "Please check your field amort_mrisri3 to view/download the document.";
            break;
            case(763):
            return "Please check your field amort_nonlife1 to view/download the document.";
            break;
            case(764):
            return "Please check your field amort_nonlife2 to view/download the document.";
            break;
            case(765):
            return "Please check your field amort_nonlife3 to view/download the document.";
            break;
            case(766):
            return "Please check your field amort_princ_int1 to view/download the document.";
            break;
            case(767):
            return "Please check your field amort_princ_int2 to view/download the document.";
            break;
            case(768):
            return "Please check your field amort_princ_int3 to view/download the document.";
            break;
            case(769):
            return "Please check your field monthly_amort1 to view/download the document.";
            break;
            case(770):
            return "Please check your field monthly_amort2 to view/download the document.";
            break;
            case(771):
            return "Please check your field monthly_amort3 to view/download the document.";
            break;
            case(772):
            return "Please check your field monthly_amort1_in_words to view/download the document.";
            break;
            case(773):
            return "Please check your field cct to view/download the document.";
            break;
            case(774):
            return "Please check your field witness to view/download the document.";
            break;
            case(775):
            return "Please check your field witness1 to view/download the document.";
            break;
            case(776):
            return "Please check your field witness2 to view/download the document.";
            break;
            case(777):
            return "Please check your field page to view/download the document.";
            break;
            case(778):
            return "Please check your field buyer_extension_name to view/download the document.";
            break;
            case(779):
            return "Please check your field exec_signatories to view/download the document.";
            break;
            case(780):
            return "Please check your field exec_position to view/download the document.";
            break;
            case(781):
            return "Please check your field exec_tin_no to view/download the document.";
            break;
            case(782):
            return "Please check your field board_resolution_date to view/download the document.";
            break;
            case(783):
            return "Please check your field repricing_period to view/download the document.";
            break;
            case(784):
            return "Please check your field loan_terms_in_word to view/download the document.";
            break;
            case(785):
            return "Please check your field loan_terms_in_years_in_word to view/download the document.";
            break;
            case(786):
            return "Please check your field repricing_period_in_words to view/download the document.";
            break;
            case(787):
            return "Please check your field registry_of_deeds_address to view/download the document.";
            break;
            case(788):
            return "Please check your field scheme to view/download the document.";
            break;
            case(789):
            return "Please check your field company_tin to view/download the document.";
            break;
            case(790):
            return "Please check your field company_address to view/download the document.";
            break;
            case(791):
            return "Please check your field loan_value_after_downpayment to view/download the document.";
            break;
            case(792):
            return "Please check your field loan_value_after_downpayment_in_words to view/download the document.";
            break;
            case(793):
            return "Please check your field company_acronym to view/download the document.";
            break;
            case(794):
            return "Please check your field total_selling_price to view/download the document.";
            break;
            case(795):
            return "Please check your field client_id_co_borrower to view/download the document.";
            break;
            case(796):
            return "Please check your field client_id_aif to view/download the document.";
            break;
            case(797):
            return "Please check your field retention_fee to view/download the document.";
            break;
            case(798):
            return "Please check your field service_fee to view/download the document.";
            break;
            case(799):
            return "Please check your field dslt_total to view/download the document.";
            break;
            case(800):
            return "Please check your field dst to view/download the document.";
            break;
            case(801):
            return "Please check your field total_deductions_from_loan_proceeds to view/download the document.";
            break;
            case(802):
            return "Please check your field net_loan_proceeds to view/download the document.";
            break;
            case(803):
            return "Please check your field vsr_no to view/download the document.";
            break;
            case(804):
            return "Please check your field technical_description to view/download the document.";
            break;
            case(805):
            return "Please check your field timothy_s_gobio_tin to view/download the document.";
            break;
            case(806):
            return "Please check your field comencement_period to view/download the document.";
            break;
            case(807):
            return "Please check your field non_life_insurance to view/download the document.";
            break;
            case(808):
            return "Please check your field mrisri_docstamp_total to view/download the document.";
            break;
            case(809):
            return "Please check your field repricing_period_affordable to view/download the document.";
            break;
            case(810):
            return "Please check your field loan_period_in_years to view/download the document.";
            break;
            case(811):
            return "Please check your field aif_attorney to view/download the document.";
            break;
            case(817):
            return "Please check your field loan_base to view/download the document.";
            break;
            case(818):
            return "Please check your field loan_base_in_words to view/download the document.";
            break;
            case(819):
            return "Please check your field pagibig_filing_site to view/download the document.";
            break;
            default:
            return "There are fields to be reviewed. Specifically on ". $line_number;    
        }
    }
}
