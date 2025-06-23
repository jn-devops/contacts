<?php

namespace Homeful\Contacts\Data;

use Spatie\LaravelData\{Attributes\MapInputName, Data, Optional};

class OrderData extends Data
{
    public function __construct(
        public ?string $lot,
        public ?string $sku,
        public ?string $block,
        public ?string $tct_no,
        public ?string $term_1,
        public ?string $term_2,
        public ?string $term_3,
        public ?string $interest,
        public ?string $lot_area,
        public ?string $witness1,
        public ?string $witness2,
        public ?string $loan_base,
        public ?string $loan_term,
        public ?string $unit_type,
        public ?string $bp_1_terms,
        public ?string $floor_area,
        public ?string $promo_code,
        public ?string $bp_1_amount,
        public ?string $exec_tin_no,
        public ?string $company_name,
        public ?string $project_code,
        public ?string $project_name,
        public ?string $amort_mrisri1,
        public ?string $amort_mrisri2,
        public ?string $amort_mrisri3, //***
        public ?string $property_code,
        public ?string $property_name,
        public ?string $property_type,
        public ?string $amort_nonlife1,
        public ?string $amort_nonlife2,
        public ?string $amort_nonlife3, //***
        public ?string $equity_1_terms,
        public ?string $monthly_amort1,
        public ?string $monthly_amort2,
        public ?string $monthly_amort3,
        public ?string $equity_1_amount,
        public ?string $project_address,
        public ?string $amort_princ_int1,
        public ?string $amort_princ_int2, //***
        public ?string $amort_princ_int3, //***
        public ?string $project_location,
        public ?string $repricing_period,
        public ?string $reservation_date,
        public ?string $reservation_rate,
        public ?string $net_loan_proceeds,
        public ?string $bp_1_interest_rate,
        #[MapInputName('comencement_period')]
        public ?string $commencement_period,
        public ?string $loan_interest_rate,
        public ?string $loan_period_months,
        public ?string $unit_type_interior,
        public ?string $bp_1_effective_date,
        public ?string $bp_1_monthly_payment,
        public ?string $bp_1_percentage_rate,
        public ?string $mrisri_docstamp_total,
        public ?string $technical_description,
        public ?string $aif_attorney_last_name,
        public ?string $equity_1_interest_rate,
        public ?string $seller_commission_code,
        public ?string $aif_attorney_first_name,
        public ?string $aif_attorney_middle_name,
        public ?string $aif_attorney_name_suffix,
        public ?string $equity_1_monthly_payment,
        public ?string $equity_1_percentage_rate,
        public ?string $registry_of_deeds_address,
        public ?string $repricing_period_affordable,
        public ?string $disclosure_statement_on_loan_transaction_total,
        public ?string $government_id_1_type,
        public ?string $brn,
        public ?string $homeful_id,
        public ?string $referral_code,
        public ?string $source_of_sale,
        public ?string $preferred_project,
        public ?string $seller_voucher_code,
        public ?string $campaign_author,
        public HDMFData|Optional          $hdmf,
        public SellerData|Optional        $seller,
        public PaymentSchemeData|Optional $payment_scheme,
    ) {
    }
}

class HDMFData extends Data
{
    public function __construct(
        public ?string $file,
        public InputData|Optional $input
    ){}
}

class InputData extends Data
{
    public function __construct(
        #[MapInputName('TITLE')]
        public ?string $title,
        #[MapInputName('PROGRAM')]
        public ?string $program,
        #[MapInputName('LTS_DATE')]
        public ?string $lts_data,
        #[MapInputName('PAY_MODE')]
        public ?string $pay_mode,
        #[MapInputName('GUIDELINE')]
        public ?string $guideline,
        #[MapInputName('WORK_AREA')]
        public ?string $work_area,
        #[MapInputName('BIRTH_DATE')]
        public ?string $birth_date,
        #[MapInputName('EMPLOYMENT')]
        public ?string $employment,
        #[MapInputName('LTS_NUMBER')]
        public ?string $lts_number,
        #[MapInputName('COBORROWER_1')]
        public ?string $coborrower_1,
        #[MapInputName('COBORROWER_2')]
        public ?string $coborrower_2,
        #[MapInputName('DESIRED_LOAN')]
        public ?string $desired_loan,
        #[MapInputName('HOUSING_TYPE')]
        public ?string $housing_type,
        #[MapInputName('PROJECT_TYPE')]
        public ?string $project_type,
        #[MapInputName('PRICE_CEILING')]
        public ?string $price_ceiling,
        #[MapInputName('SELLING_PRICE')]
        public ?string $selling_price,
        #[MapInputName('APPLICATION_DATE')]
        public ?string $application_date,
        #[MapInputName('REPRICING_PERIOD')]
        public ?string $repricing_period,
        #[MapInputName('TOTAL_FLOOR_AREA')]
        public ?string $total_floor_area,
        #[MapInputName('LOAN_PERIOD_YEARS')]
        public ?int $load_period_years,
        #[MapInputName('PRINCIPAL_BORROWER')]
        public ?string $principal_borrower,
        #[MapInputName('TOTAL_FLOOR_NUMBER')]
        public ?string $total_floor_number,
        #[MapInputName('APPRAISED_VALUE_LOT')]
        public ?string $appraised_value_lot,
        #[MapInputName('TYPE_OF_DEVELOPMENT')]
        public ?string $type_of_development,
        #[MapInputName('APPRAISED_VALUE_HOUSE')]
        public ?string $appraised_value_house,
        #[MapInputName('GROSS_INCOME_PRINCIPAL')]
        public ?string $gross_income_principal,
        #[MapInputName('BIRTH_DATE_COBORROWER_1')]
        public ?string $birth_date_coborrower_1,
        #[MapInputName('BIRTH_DATE_COBORROWER_2')]
        public ?string $birth_date_coborrower_2,
        #[MapInputName('GROSS_INCOME_COBORROWER_1')]
        public ?string $gross_income_coborrower_1,
        #[MapInputName('GROSS_INCOME_COBORROWER_2')]
        public ?string $gross_income_coborrower_2,
    ){}
}

class SellerData extends Data
{
    public function __construct(
        public ?string $id,
        public ?string $name,
        public ?string $unit,
        public ?string $superior,
        public ?string $team_head,
        public ?string $chief_seller_officer,
        public ?string $deputy_chief_seller_officer,
    ){
    }
}

class PaymentSchemeData extends Data
{
    public function __construct(
        public ?array $fees,
        public ?string $method,
        public ?string $scheme,
        public ?string $discount_rate,
        public ?string $conditional_discount,
        public ?string $total_contract_price,
        public ?string $net_total_contract_price,
    ){}
}
