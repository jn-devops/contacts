<?php

namespace Homeful\Contacts\Data;

use Carbon\Carbon;
use Homeful\Contacts\Models\Contact;
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

        $order = $model->order;

        $order['baf_date'] = isset($order['baf_date']) && $order['baf_date'] !== null
            ? date('Y-m-d', strtotime($order['baf_date']))
            : '';
        $order['date_created'] = isset($order['date_created']) && $order['date_created'] !== null
            ? date('Y-m-d', strtotime($order['date_created']))
            : '';

        $order['payment_scheme'] = new PaymentSchemeData(
            scheme: isset($order['payment_scheme']['scheme']) && $order['payment_scheme']['scheme'] !== null ? $order['payment_scheme']['scheme'] : null,
            method: isset($order['payment_scheme']['method']) && $order['payment_scheme']['method'] !== null ? $order['payment_scheme']['method'] : null,
            collectible_price: isset($order['payment_scheme']['collectible_price']) && $order['payment_scheme']['collectible_price'] !== null ? $order['payment_scheme']['collectible_price'] : null,
            commissionable_amount: isset($order['payment_scheme']['commissionable_amount']) && $order['payment_scheme']['commissionable_amount'] !== null ? $order['payment_scheme']['commissionable_amount'] : null,
            evat_percentage: isset($order['payment_scheme']['evat_percentage']) && $order['payment_scheme']['evat_percentage'] !== null ? $order['payment_scheme']['evat_percentage'] : null,
            evat_amount: isset($order['payment_scheme']['evat_amount']) && $order['payment_scheme']['evat_amount'] !== null ? $order['payment_scheme']['evat_amount'] : null,
            net_total_contract_price: isset($order['payment_scheme']['net_total_contract_price']) && $order['payment_scheme']['net_total_contract_price'] !== null ? $order['payment_scheme']['net_total_contract_price'] : null,
            total_contract_price: isset($order['payment_scheme']['total_contract_price']) && $order['payment_scheme']['total_contract_price'] !== null ? $order['payment_scheme']['total_contract_price'] : null,
            payments: isset($order['payment_scheme']['payments']) && $order['payment_scheme']['payments'] !== null
                ? new DataCollection(PaymentData::class, $order['payment_scheme']['payments']) : null,
            fees: isset($order['payment_scheme']['fees']) && $order['payment_scheme']['fees'] !== null
                ? new DataCollection(FeesData::class, $order['payment_scheme']['fees']) : null,
            payment_remarks: isset($order['payment_scheme']['payment_remarks']) && $order['payment_scheme']['payment_remarks'] !== null ? $order['payment_scheme']['payment_remarks'] : null,
            transaction_remarks: isset($order['payment_scheme']['transaction_remarks']) && $order['payment_scheme']['transaction_remarks'] !== null ? $order['payment_scheme']['transaction_remarks'] : null,
            discount_rate: isset($order['payment_scheme']['discount_rate']) && $order['payment_scheme']['discount_rate'] !== null ? $order['payment_scheme']['discount_rate'] : null,
            conditional_discount: isset($order['payment_scheme']['conditional_discount']) && $order['payment_scheme']['conditional_discount'] !== null ? $order['payment_scheme']['conditional_discount'] : null,
            transaction_sub_status: isset($order['payment_scheme']['transaction_sub_status']) && $order['payment_scheme']['transaction_sub_status'] !== null ? $order['payment_scheme']['transaction_sub_status'] : null,
        );
        $sellerData = isset($order['seller']) && is_array($order['seller'])
             ? $order['seller']
            : [];
        // (isset($model->order['seller'])) ? $order['seller'] = SellerData::from($order['seller']) :null;
        // dd(new DataCollection(ContactEmploymentData::class, $model->employment));
        // Create DataCollection for employment data
        // dd($model->employment);
        $employmentDataCollection = isset($model->employment) && is_array($model->employment)
            ? new DataCollection(ContactEmploymentData::class, array_map(function ($employment) {
                $addressData = isset($employment['employer']['address']) && is_array($employment['employer']['address'])
                    ? AddressData::from($employment['employer']['address'])
                    : null;
                    return new ContactEmploymentData(
                    employment_status: $employment['employment_status'] ?? '',
                    monthly_gross_income: $employment['monthly_gross_income'] ?? '0',
                        current_position: $employment['current_position'] ?? '',
                        rank: $employment['rank'] ?? '',
                    employment_type: $employment['employment_type'] ?? '',
                    character_reference: new EmploymentCharacterReeference(
                        name: $employment['character_reference']['name'] ?? '',
                        mobile: $employment['character_reference']['mobile'] ?? ''
                    ),
                    employer: new ContactEmploymentEmployerData(
                        name: $employment['employer']['name'] ?? '',
                        industry: $employment['employer']['industry'] ?? '',
                        nationality: $employment['employer']['nationality'] ?? '',
                        address: $addressData,
                        contact_no: $employment['employer']['contact_no'] ?? '',
                        employer_status: $employment['employer']['employer_status'] ?? null,
                        type: $employment['employer']['type'] ?? null,
                        status: $employment['employer']['status'] ?? null,
                        year_established: $employment['employer']['year_established'] ?? null,
                        total_number_of_employees: $employment['employer']['total_number_of_employees'] ?? null,
                        email: $employment['employer']['email'] ?? null,
                        fax: $employment['employer']['fax'] ?? null,
                    ),
                    id: isset($employment['id']) ? new ContactEmploymentIdData(
                        tin: $employment['id']['tin'] ?? '',
                        pagibig: $employment['id']['pagibig'] ?? '',
                        sss: $employment['id']['sss'] ?? '',
                        gsis: $employment['id']['gsis'] ?? ''
                    ) : null,
                    years_in_service: $employment['years_in_service'] ?? null,
                    salary_range: $employment['salary_range'] ?? null,
                    industry: $employment['industry'] ?? null,
                    department_name: $employment['department_name'] ?? null,
                    type: $employment['type'] ?? null
                );
            }, $model->employment))
            : new DataCollection(ContactEmploymentData::class, []);

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
                mobile: $model->mobile,
                other_mobile: $model->other_mobile,
                help_number: $model->help_number,
                landline: $model->landline,
                mothers_maiden_name: $model->mothers_maiden_name,
                age: Carbon::parse($model->date_of_birth)->age,
                relationship_to_buyer: $model->relationship_to_buyer,
                passport: $model->passport,
                date_issued: $model->date_issued,
                place_issued: $model->place_issued,
            ),
            spouse: $model->spouse ? PersonData::from([
                'first_name' => $model->spouse['first_name'] ?? '',
                'middle_name' => $model->spouse['middle_name'] ?? '',
                'last_name' => $model->spouse['last_name'] ?? '',
                'name_suffix' => $model->spouse['name_suffix'] ?? '',
                'mothers_maiden_name' => $model->spouse['mothers_maiden_name'] ?? '',
                'civil_status' => $model->spouse['civil_status'] ?? '',
                'sex' => $model->spouse['sex'] ?? '',
                'nationality' => $model->spouse['nationality'] ?? '',
                'date_of_birth' => $model->spouse['date_of_birth'] ?? '',
                'email' => $model->spouse['email'] ?? '',
                'mobile' => $model->spouse['mobile'] ?? '',
                'other_mobile' => $model->spouse['other_mobile'] ?? '',
                'help_number' => $model->spouse['help_number'] ?? '',
                'client_id' => $model->spouse['client_id'] ?? '',
                'landline' => $model->spouse['landline'] ?? '',
                'age' => $model->spouse['age'] ?? '',
            ]): null,
            addresses: new DataCollection(AddressData::class, $model->addresses),
            employment: $employmentDataCollection,
            //            employment: new DataCollection(ContactEmploymentData::class, $model->employment),
            co_borrowers: new DataCollection(PersonData::class, collect($model->co_borrowers)->map(fn($coBorrower) => PersonData::from([
                'first_name' => $coBorrower['first_name'] ?? '',
                'middle_name' => $coBorrower['middle_name'] ?? '',
                'last_name' => $coBorrower['last_name'] ?? '',
                'name_suffix' => $coBorrower['name_suffix'] ?? '',
                'mothers_maiden_name' => $coBorrower['mothers_maiden_name'] ?? '',
                'civil_status' => $coBorrower['civil_status'] ?? '',
                'sex' => $coBorrower['sex'] ?? '',
                'nationality' => $coBorrower['nationality'] ?? '',
                'date_of_birth' => $coBorrower['date_of_birth'] ?? '',
                'email' => $coBorrower['email'] ?? '',
                'mobile' => $coBorrower['mobile'] ?? '',
                'other_mobile' => $coBorrower['other_mobile'] ?? '',
                'help_number' => $coBorrower['help_number'] ?? '',
                'client_id' => $coBorrower['client_id'] ?? '',
                'landline' => $coBorrower['landline'] ?? '',
                'age' => $coBorrower['age'] ?? '',
                'relationship_to_buyer' => $coBorrower['relationship_to_buyer'] ?? '',
            ]))->toArray()),
            order: $model->order ? ContactOrderData::from($order) : null,
            uploads: new DataCollection(UploadData::class, $model->uploads),
        );
    }

    public function toArray(): array
    {
        $array = [
            'reference_code' => $this->reference_code,
            'profile' => $this->profile->toArray(),
            'spouse' => $this->spouse->toArray(),
            'addresses' => $this->addresses->toArray(),
            'employment' => $this->employment->toArray(),
            'co_borrowers' => $this->co_borrowers->toArray(),
            'order' => [
                'sku' => $this->order->sku,
                'promo_code' => $this->order->promo_code,
                'seller_commission_code' => $this->order->seller_commission_code,
                'property_code' => $this->order->property_code,
                // for GNC
                'company_name' => $this->order->company_name,
                'project_name' => $this->order->project_name,
                'project_code' => $this->order->project_code,
                'property_name' => $this->order->property_name,
                'property_type' => $this->order->property_type,
                'phase' => $this->order->phase,
                'block' => $this->order->block,
                'lot' => $this->order->lot,
                'lot_area' => $this->order->lot_area,
                'floor_area' => $this->order->floor_area,
                'loan_term' => $this->order->loan_term,
                'loan_interest_rate' => $this->order->loan_interest_rate,
                'tct_no' => $this->order->tct_no,
                'project_location' => $this->order->project_location,
                'project_address' => $this->order->project_address,
                'mrif_fee' => $this->order->mrif_fee,
                'reservation_rate' => $this->order->reservation_rate,

                // for GNC
                'os_status' => $this->order->os_status,
                'class_field' => $this->order->class_field,
                'segment_field' => $this->order->segment_field,
                'rebooked_id_form' => $this->order->rebooked_id_form,
                'buyer_action_form_number' => $this->order->buyer_action_form_number, // buyer_action_form
                'buyer_action_form_date' => $this->order->buyer_action_form_date,

                'cancellation_type' => $this->order->cancellation_type,
                'cancellation_reason' => $this->order->cancellation_reason,
                'cancellation_remarks' => $this->order->cancellation_remarks,

                'unit_type' => $this->order->unit_type,
                'unit_type_interior' => $this->order->unit_type_interior,
                'house_color' => $this->order->house_color,
                'construction_status' => $this->order->construction_status,
                'transaction_reference' => $this->order->transaction_reference,
                'reservation_date' => $this->order->reservation_date,
                'circular_number' => $this->order->circular_number,

                // out of place fields
                'date_created' => $this->order->date_created,
                'ra_date' => $this->order->ra_date,
                'date_approved' => $this->order->date_approved,
                'date_expiration' => $this->order->date_expiration,
                'os_month' => $this->order->os_month,
                'due_date' => $this->order->due_date,
                'total_payments_made' => $this->order->total_payments_made,
                'transaction_status' => $this->order->transaction_status,
                'staging_status' => $this->order->staging_status,
                'period_id' => $this->order->period_id, // PeriodID (RE, DP, BP, MF, Fully Paid)
                'date_closed' => $this->order->date_closed,
                'closed_reason' => $this->order->closed_reason,
                'date_cancellation' => $this->order->date_cancellation,
                'baf_number' => $this->order->baf_number,
                'baf_date' => $this->order->baf_date,
                'client_id_buyer' => $this->order->client_id_buyer,
                'buyer_age' => $this->order->buyer_age,
                'client_id_spouse' => $this->order->client_id_spouse,
                'payment_scheme' => $this->order->payment_scheme == null ? null : $this->order->payment_scheme->toArray(),
                'seller' => $this->order->seller == null ? null : $this->order->seller->toArray(),
            ],
            'uploads' => $this->uploads->toArray(),
        ];

        return $array;
    }
}

class ContactOrderData extends Data
{
    public function __construct(
        public string $sku,
        public ?string $promo_code,
        public string $seller_commission_code,
        public string $property_code,
        //for GNC
        public ?string $company_name,
        public ?string $project_name,
        public ?string $project_code,
        public ?string $property_name,
        public ?string $property_type,
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

        public ?string $os_status,
        public ?string $class_field,
        public ?string $segment_field,
        public ?string $rebooked_id_form,
        public ?string $buyer_action_form_number, //buyer_action_form
        public ?string $buyer_action_form_date,

        public ?string $cancellation_type,
        public ?string $cancellation_reason,
        public ?string $cancellation_remarks,
        public ?string $cancellation_reason2,
        public ?string $total_selling_price,

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
        public ?string $baf_number,
        public ?string $baf_date,
        public ?string $client_id_buyer,
        public ?string $buyer_age,
        public ?string $client_id_spouse,
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
        public ?string $monthly_amort2,
        public ?string $monthly_amort3,
        public ?string $equity_1_amount,
        public ?string $equity_1_percentage_rate,
        public ?string $equity_1_interest_rate,
        public ?string $equity_1_terms,
        public ?string $equity_1_monthly_payment,
        public ?string $equity_1_effective_date,
        public ?string $equity_2_amount,
        public ?string $equity_2_percentage_rate,
        public ?string $equity_2_interest_rate,
        public ?string $equity_2_terms,
        public ?string $cash_outlay_1_terms,
        public ?string $cash_outlay_1_monthly_payment,
        public ?string $cash_outlay_1_effective_date,
        public ?string $cash_outlay_2_amount,
        public ?string $cash_outlay_2_percentage_rate,
        public ?string $cash_outlay_2_interest_rate,
        public ?string $cash_outlay_2_terms,
        public ?string $cash_outlay_2_monthly_payment,
        public ?string $cash_outlay_2_effective_date,
        public ?string $cash_outlay_3_amount,
        public ?string $cash_outlay_3_percentage_rate,
        public ?string $cash_outlay_3_interest_rate,
        public ?string $cash_outlay_3_terms,
        public ?string $cash_outlay_3_monthly_payment,
        public ?string $cash_outlay_3_effective_date,
        public ?string $building,
        public ?string $floor,
        public ?string $unit,
        public ?string $cct,
        public ?string $witness1,
        public ?string $witness2,
        public ?string $buyer_extension_name,
        public ?string $company_acronym,
        public ?string $repricing_period_in_words,
        public ?string $repricing_period,
        public ?string $company_address,
        public ?string $exec_position,
        public ?string $board_resolution_date,
        public ?string $registry_of_deeds_address,
        public ?string $exec_tin,
        public ?string $loan_period_in_words,
        public ?string $spouse_address,
        public ?string $total_miscellaneous_fee_in_words,
        public ?string $tmf,
        public ?string $cash_outlay_1_amount,
        public ?string $cash_outlay_1_percentage_rate,
        public ?string $cash_outlay_1_interest_rate,
        public ?string $equity_2_monthly_payment,
        public ?string $equity_2_effective_date,
        public ?string $bp_1_amount,
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
        public ?string $hucf_move_in_fee,
        public ?string $circular_no_312_379,
        public ?string $ltvr_slug,
        public ?string $repricing_period_slug,
        public ?string $tcp_in_words,
        public ?string $interest_in_words,
        public ?string $interest,
        public ?string $logo,
        public ?string $loan_period_months,
        public ?string $page,
        public ?string $lot_area_in_words,
        public ?string $exec_signatories,
        public ?string $exec_tin_no,
        public ?string $loan_terms_in_word,
        public ?string $company_tin,
        public ?string $yes_for_faq_solaris_project,
        public ?string $n_for_faq_solaris_project,
        public ?string $loan_value_after_downpayment,
        public ?string $client_id_aif,
        public ?string $client_id_co_borrower,
        public ?string $loan_term_in_years,
        public ?string $loan_term_in_years_in_words,
        public ?string $retention_fee,
        public ?string $service_fee,
        public ?string $disclosure_statement_on_loan_transaction_total,
        public ?string $documentary_stamp,
        public ?string $total_deductions_from_loan_proceeds,
        public ?string $net_loan_proceeds,
        public ?string $verified_survey_return_no,
        public ?string $technical_description,

        public ?string $non_life_insurance,
        public ?string $mrisri_docstamp_total,
        public ?string $comencement_period,
        public ?string $repricing_period_affordable,
        public ?string $aif_attorney_first_name,
        public ?string $aif_attorney_last_name,
        public ?string $aif_attorney_middle_name,
        public ?string $aif_attorney_name_suffix,
        public ?string $loan_base,
        public ?string $government_id_1_type,
        public ?string $brn,
        public ?string $homeful_id,

        public ?PaymentSchemeData $payment_scheme,
        public ?SellerData $seller,
        Public ?PersonData $aif,

    ) {}

    public function toArray(): array
    {
        return [
            'sku' => $this->sku,
            'promo_code' => $this->promo_code,
            'seller_commission_code' => $this->seller_commission_code,
            'property_code' => $this->property_code,
            'property_type' => $this->property_type,
            'company_name' => $this->company_name,
            'registry_of_deeds_address' => $this->registry_of_deeds_address,
            'project_name' => $this->project_name,
            'project_code' => $this->project_code,
            'property_name' => $this->property_name,
            'phase' => $this->phase,
            'block' => $this->block,
            'lot' => $this->lot,
            'lot_area' => $this->lot_area,
            'floor_area' => $this->floor_area,
            'loan_term' => $this->loan_term,
            'loan_interest_rate' => $this->loan_interest_rate,
            'tct_no' => $this->tct_no,
            'project_location' => $this->project_location,
            'project_address' => $this->project_address,
            'mrif_fee' => $this->mrif_fee,
            'reservation_rate' => $this->reservation_rate,
            'os_status' => $this->os_status,
            'class_field' => $this->class_field,
            'segment_field' => $this->segment_field,
            'rebooked_id_form' => $this->rebooked_id_form,
            'buyer_action_form_number' => $this->buyer_action_form_number,
            'buyer_action_form_date' => $this->buyer_action_form_date,
            'cancellation_type' => $this->cancellation_type,
            'cancellation_reason' => $this->cancellation_reason,
            'cancellation_remarks' => $this->cancellation_remarks,
            'unit_type' => $this->unit_type,
            'unit_type_interior' => $this->unit_type_interior,
            'house_color' => $this->house_color,
            'construction_status' => $this->construction_status,
            'transaction_reference' => $this->transaction_reference,
            'reservation_date' => $this->reservation_date,
            'circular_number' => $this->circular_number,
            'date_created' => $this->date_created,
            'ra_date' => $this->ra_date,
            'date_approved' => $this->date_approved,
            'date_expiration' => $this->date_expiration,
            'os_month' => $this->os_month,
            'due_date' => $this->due_date,
            'total_payments_made' => $this->total_payments_made,
            'transaction_status' => $this->transaction_status,
            'staging_status' => $this->staging_status,
            'period_id' => $this->period_id,
            'date_closed' => $this->date_closed,
            'closed_reason' => $this->closed_reason,
            'date_cancellation' => $this->date_cancellation,
            'baf_number' => $this->baf_number,
            'baf_date' => $this->baf_date,
            'client_id_buyer' => $this->client_id_buyer,
            'buyer_age' => $this->buyer_age,
            'client_id_spouse' => $this->client_id_spouse,
            'retention_fee' => $this->retention_fee,
            'service_fee' => $this->service_fee,
            'exec_tin' => $this->exec_tin,
            'exec_tin_no' => $this->exec_tin_no,
            'disclosure_statement_on_loan_transaction_total' => is_numeric($this->disclosure_statement_on_loan_transaction_total) ? $this->disclosure_statement_on_loan_transaction_total : 0,
            'documentary_stamp' => is_numeric($this->documentary_stamp) ? $this->documentary_stamp : 0,
            'total_deductions_from_loan_proceeds' => is_numeric($this->total_deductions_from_loan_proceeds) ? $this->total_deductions_from_loan_proceeds : 0,
            'net_loan_proceeds' => is_numeric($this->net_loan_proceeds) ? $this->net_loan_proceeds : 0,
            'verified_survey_return_no' => $this->verified_survey_return_no,
            'technical_description' => $this->technical_description,
            'payment_scheme' => $this->payment_scheme ? $this->payment_scheme->toArray() : null,
            'seller' => $this->seller ? $this->seller->toArray() : null,

            //for lazarus
            'equity_1_amount' =>$this->equity_1_amount,
            'equity_1_percentage_rate' =>$this->equity_1_percentage_rate,
            'equity_1_interest_rate' =>$this->equity_1_interest_rate,
            'equity_1_terms' =>$this->equity_1_terms,
            'equity_1_monthly_payment' =>$this->equity_1_monthly_payment,
            'equity_1_effective_date'=>$this->equity_1_effective_date,

            'bp_1_amount' =>$this->bp_1_amount,
            'bp_1_percentage_rate' =>$this->bp_1_percentage_rate,
            'bp_1_interest_rate' =>$this->bp_1_interest_rate,
            'bp_1_terms' =>$this->bp_1_terms,
            'bp_1_monthly_payment' =>$this->bp_1_monthly_payment,
            'bp_1_effective_date'=>$this->bp_1_effective_date,

            'repricing_period'=>$this->repricing_period,
            'witness1'=>$this->witness1,
            'witness2'=>$this->witness2,
            'aif' => $this->aif ? $this->aif->toArray() : null,

            'interest'=>$this->interest,
            'comencement_period'=>$this->comencement_period,
            'repricing_period_affordable'=>$this->repricing_period_affordable,
            'mrisri_docstamp_total'=>$this->mrisri_docstamp_total,
            'non_life_insurance'=>$this->non_life_insurance,
            'loan_period_months'=>$this->loan_period_months,
            'term_1'=>$this->term_1,
            'term_2'=>$this->term_2,
            'term_3'=>$this->term_3,
            'amort_mrisri1'=>$this->amort_mrisri1,
            'amort_mrisri2'=>$this->amort_mrisri2,
            'amort_mrisri3'=>$this->amort_mrisri3,
            'amort_nonlife1'=>$this->amort_nonlife1,
            'amort_nonlife2'=>$this->amort_nonlife2,
            'amort_nonlife3'=>$this->amort_nonlife3,
            'amort_princ_int1'=>$this->amort_princ_int1,
            'amort_princ_int2'=>$this->amort_princ_int2,
            'amort_princ_int3'=>$this->amort_princ_int3,
            'monthly_amort1'=>$this->monthly_amort1,
            'monthly_amort2'=>$this->monthly_amort2,
            'monthly_amort3'=>$this->monthly_amort3,
            'loan_value_after_downpayment'=>$this->loan_value_after_downpayment,
            'aif_attorney_last_name'=>$this->aif_attorney_last_name,
            'aif_attorney_first_name'=>$this->aif_attorney_first_name,
            'aif_attorney_middle_name'=>$this->aif_attorney_middle_name,
            'aif_attorney_name_suffix'=>$this->aif_attorney_name_suffix,
            'loan_base'=>$this->loan_base,
            'government_id_1_type'=>$this->government_id_1_type,
            'brn'=>$this->brn,
            'homeful_id'=>$this->homeful_id,
        ];
    }
}

class ContactEmploymentData extends Data
{
    public function __construct(
        public string $employment_status,
        public string $monthly_gross_income,
        public string $current_position,
        public ?string $rank,
        public string $employment_type,
        public ContactEmploymentEmployerData $employer,
        public ?ContactEmploymentIdData $id,
        public ?string $years_in_service,
        public ?string $salary_range,
        public ?string $industry,
        public ?string $department_name,
        public ?string $type, //spouse, co-borrower, buyer
        public ?EmploymentCharacterReeference $character_reference,
    ) {}

    public function toArray(): array
    {
        return [
            'employment_status' => $this->employment_status,
            'monthly_gross_income' => $this->monthly_gross_income,
            'current_position' => $this->current_position,
            'rank' => $this->rank,
            'employment_type' => $this->employment_type,
            'employer' => $this->employer ? $this->employer->toArray() : null,
            'id' => $this->id ? $this->id->toArray() : null,
            'years_in_service' => $this->years_in_service,
            'salary_range' => $this->salary_range,
            'industry' => $this->industry,
            'department_name' => $this->department_name,
            'type' => $this->type,
            'character_reference' => $this->character_reference ? $this->character_reference->toArray() : null,
        ];
    }
}

class EmploymentCharacterReeference extends Data
{
    public function __construct(
        public ?string $name,
        public ?string $mobile,
    ) {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'mobile' => $this->mobile,
        ];
    }
}

class ContactEmploymentEmployerData extends Data
{
    public function __construct(
        public string $name,
        public string $industry,
        public string $nationality,
        public ?AddressData $address,
        public string $contact_no,
        //for GNC
        public ?string $employer_status,
        public ?string $type,
        public ?string $status,
        public ?string $year_established,
        public ?string $total_number_of_employees,
        public ?string $email,
        public ?string $fax,
    ) {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'industry' => $this->industry,
            'nationality' => $this->nationality,
            'address' => $this->address ? $this->address->toArray() : [],
            'contact_no' => $this->contact_no,
            'employer_status' => $this->employer_status,
            'type' => $this->type,
            'status' => $this->status,
            'year_established' => $this->year_established,
            'total_number_of_employees' => $this->total_number_of_employees,
            'email' => $this->email,
        ];
    }
}

class ContactEmploymentIdData extends Data
{
    public function __construct(
        public ?string $tin,
        public ?string $pagibig,
        public ?string $sss,
        public ?string $gsis,
    ) {}
    public function toArray(): array
    {
        return [
            'tin' => $this->tin,
            'pagibig' => $this->pagibig,
            'sss' => $this->sss,
            'gsis' => $this->gsis,
        ];
    }

}

class UploadData extends Data
{
    public function __construct(
        public string $name,
        public string $url
    ) {}
}

class SellerData extends Data
{
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

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'id' => $this->id,
            'superior' => $this->superior,
            'team_head' => $this->team_head,
            'chief_seller_officer' => $this->chief_seller_officer,
            'deputy_chief_seller_officer' => $this->deputy_chief_seller_officer,
            'type' => $this->type,
            'reference_no' => $this->reference_no,
            'unit' => $this->unit,
        ];
    }
}

class PaymentSchemeData
{
    public function __construct(
        public ?string $scheme,
        public ?string $method,
        public ?string $collectible_price,
        public ?string $commissionable_amount,
        public ?string $evat_percentage,
        public ?string $evat_amount,
        public ?string $net_total_contract_price,
        public ?string $total_contract_price,
        /** @var PaymentData[] */
        public ?DataCollection $payments,
        /** @var FeesData[] */
        public ?DataCollection $fees,
        public ?string $payment_remarks,
        public ?string $transaction_remarks,
        public ?string $discount_rate,
        public ?string $conditional_discount,
        public ?string $transaction_sub_status,

    ) {}

    public function toArray(): array
    {
        return [
            'scheme' => $this->scheme,
            'method' => $this->method,
            'collectible_price' => $this->collectible_price,
            'commissionable_amount' => $this->commissionable_amount,
            'evat_percentage' => $this->evat_percentage,
            'evat_amount' => $this->evat_amount,
            'net_total_contract_price' => $this->net_total_contract_price,
            'total_contract_price' => $this->total_contract_price,
            'payments' => $this->payments ? $this->payments->toArray() : null,
            'fees' => $this->fees ? $this->fees->toArray() : null,
            'payment_remarks' => $this->payment_remarks,
            'transaction_remarks' => $this->transaction_remarks,
            'discount_rate' => $this->discount_rate,
            'conditional_discount' => $this->conditional_discount,
            'transaction_sub_status' => $this->transaction_sub_status,
        ];
    }
}

class PaymentData extends Data
{
    public function __construct(
        public ?string $type, //processing_fee, home_utility_connection_fee, equity, balance
        public ?string $amount_paid,
        public ?string $date,
        public ?string $reference_number,
    ) {}
}

class FeesData extends Data
{
    public function __construct(
        public ?string $name, //processing fee, home_utility_connection_fee, mrif, rental, retention_fee, service_fee
        public ?string $amount,
    ) {}
}
