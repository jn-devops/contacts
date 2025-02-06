<?php

namespace Homeful\Contacts\Models;

use Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Homeful\Common\Traits\HasPackageFactory as HasFactory;
use Propaganistas\LaravelPhone\Casts\RawPhoneNumberCast;
use Homeful\Contacts\Database\Factories\ContactFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Homeful\Common\Interfaces\BorrowerInterface;
use Spatie\MediaLibrary\MediaCollections\File;
use Propaganistas\LaravelPhone\PhoneNumber;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Homeful\Contacts\Data\ContactData;
use Spatie\ModelStatus\HasStatuses;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Spatie\Image\Enums\Fit;
use Whitecube\Price\Price;
use Brick\Money\Money;


/**
 * Class Contact
 *
 * @property string $id
 * @property string $reference_code
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $name_suffix
 * @property string $civil_status
 * @property string $sex
 * @property string $nationality
 * @property Carbon $date_of_birth
 * @property string $email
 * @property PhoneNumber $mobile
 * @property PhoneNumber $other_mobile
 * @property PhoneNumber $help_number
 * @property string $landline
 * @property string $mothers_maiden_name
 * @property array $spouse
 * @property array $addresses
 * @property array $employment
 * @property array $co_borrowers
 * @property array $aif
 * @property array $uploads
 * @property array $order
 * @property array $media
 * @property Media $idImage
 * @property Media $selfieImage
 * @property Media $payslipImage
 * @property Media $signatureImage
 * @property Media $voluntarySurrenderFormDocument
 * @property Media $usufructAgreementDocument
 * @property Media $contractToSellDocument
 * @property Media $deedOfRestrictionsDocument
 * @property Media $disclosureDocument
 * @property Media $borrowerConformityDocument
 * @property Media $statementOfAccountDocument
 * @property Media $invoiceDocument
 * @property Media $receiptDocument
 * @property Media $deedOfSaleDocument
 * @property Media $governmentId1Image
 * @property Media $governmentId2Image
 * @property Media $certificateOfEmploymentDocument
 * @property Media $oneMonthLatestPayslipDocument
 * @property Media $esavDocument
 * @property Media $birthCertificateDocument
 * @property Media $photoImage
 * @property Media $proofOfBillingAddressDocument
 * @property Media $letterOfConsentEmployerDocument
 * @property Media $threeMonthsCertifiedPayslipsDocument
 * @property Media $employmentContractDocument
 * @property Media $ofwEmploymentCertificateDocument
 * @property Media $passportWithVisaImage
 * @property Media $workingPermitDocument
 * @property Media $notarizedSpaDocument
 * @property Media $authorizedRepInfoSheetDocument
 * @property Media $validIdAifImage
 * @property Media $workingPermitCardDocument
 * @property Media $itrBir1701Document
 * @property Media $auditedFinancialStatementDocument
 * @property Media $officialReceiptTaxPaymentDocument
 * @property Media $businessMayorsPermitDocument
 * @property Media $dtiBusinessRegistrationDocument
 * @property Media $sketchOfBusinessLocationDocument
 * @property Media $letterOfConsentCreditBackgroundInvestigationDocument
 * @property Media $marriageCertificateDocument
 * @property Media $governmentIdOfSpouseImage
 * @property Media $courtDecisionAnnulmentDocument
 * @property Media $marriageContractDocument
 * @property Media $courtDecisionSeparationDocument
 * @property Media $deathCertificateDocument
 * @property array $current_status
 * @property array $current_status_code
 * @property string $status_reason
 *
 * @method int getKey()
 */
class Contact extends Authenticatable implements BorrowerInterface, HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use Notifiable;
    use HasStatuses;

    protected $fillable = [
        'reference_code',
        'first_name',
        'middle_name',
        'last_name',
        'name_suffix',
        'civil_status',
        'sex',
        'nationality',
        'date_of_birth',
        'email',
        'mobile',
        'other_mobile',
        'help_number',
        'landline',
        'mothers_maiden_name',
        'spouse',
        'aif',
        'addresses',
        'employment',
        'co_borrowers',
        'order',
        'idImage',
        'selfieImage',
        'payslipImage',
        'signatureImage',
        'voluntarySurrenderFormDocument',
        'usufructAgreementDocument',
        'contractToSellDocument',
        'deedOfRestrictionsDocument',
        'disclosureDocument',
        'borrowerConformityDocument',
        'statementOfAccountDocument',
        'invoiceDocument',
        'receiptDocument',
        'deedOfSaleDocument',
        'governmentId1',
        'governmentId2',
        'certificateOfEmployment',
        'oneMonthLatestPayslip',
        'esav',
        'birthCertificate',
        'photoImage',
        'proofOfBillingAddress',
        'letterOfConsentEmployer',
        'threeMonthsCertifiedPayslips',
        'employmentContract',
        'ofwEmploymentCertificate',
        'passportWithVisa',
        'workingPermit',
        'notarizedSpa',
        'authorizedRepInfoSheet',
        'validIdAif',
        'workingPermitCard',
        'itrBir1701',
        'auditedFinancialStatement',
        'officialReceiptTaxPayment',
        'businessMayorsPermit',
        'dtiBusinessRegistration',
        'sketchOfBusinessLocation',
        'letterOfConsentCreditBackgroundInvestigation',
        'marriageCertificate',
        'governmentIdOfSpouse',
        'courtDecisionAnnulment',
        'marriageContract',
        'courtDecisionSeparation',
        'deathCertificate',
        'current_status',
        'current_status_code',
        'status_reason',
    ];

    protected $casts = [
        // 'mobile' => RawPhoneNumberCast::class.':PH',
        // 'other_mobile' => RawPhoneNumberCast::class.':PH',
        // 'help_number' => RawPhoneNumberCast::class.':PH',
        'spouse' => 'array',
        'aif' => 'array',
        'addresses' => 'array',
        'employment' => 'array',
        'co_borrowers' => 'array',
        'order' => 'array',
    ];

    protected array $dates = [
        'date_of_birth',
    ];

    protected $keyType = 'string';

    public $incrementing = false;

    public static function booted(): void
    {
        static::creating(function (Contact $contact) {
            $contact->id = Str::uuid()->toString();
        });
    }

    public function getConnectionName()
    {
        $connection = config('contacts.models.contact.connection');

        return !empty($connection)
            ? $connection
            : parent::getConnectionName();
    }

    public function getTable()
    {
        $table = config('contacts.models.contact.table');

        return !empty($table)
            ? $table
            : parent::getTable();
    }

    protected static function newFactory()
    {
        $factoryClass = config('contacts.models.contact.factory_class');

        if (!empty($factoryClass) && class_exists($factoryClass)) {
            return $factoryClass::new();
        }

        return ContactFactory::new();
    }

    public function routeNotificationForEngageSpark(): string
    {
        return $this->mobile;
    }

    public function getContactId(): string
    {
        return (string) $this->id;
    }

    public function toData(): array
    {
        return ContactData::fromModel($this)->toArray();
    }

//    public function resolveRouteBinding($value, $field = null)
//    {
//        return parent::resolveRouteBinding($value, 'uid'); // TODO: Change the autogenerated stub
//    }

    public function getNameAttribute(): string
    {
//        if (trim($this->middle_name)) {
//            return $this->name ?? "$this->first_name $this->middle_name $this->last_name";
//        }
//        else {
//            return $this->name ?? "$this->first_name $this->last_name";
//        }

        return $this->name ?? implode(' ', array_filter([$this->first_name, $this->middle_name, $this->last_name, $this->name_suffix]));
    }

    public function getIdImageAttribute(): ?Media
    {
        return $this->getFirstMedia('id-images');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setIdImageAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('idImage')
                ->toMediaCollection('id-images');
        }

        return $this;
    }

    public function getSelfieImageAttribute(): ?Media
    {
        return $this->getFirstMedia('selfie-images');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setSelfieImageAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('selfieImage')
                ->toMediaCollection('selfie-images');
        }

        return $this;
    }

    public function getPayslipImageAttribute(): ?Media
    {
        return $this->getFirstMedia('payslip-images');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setPayslipImageAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('payslipImage')
                ->toMediaCollection('payslip-images');
        }

        return $this;
    }

    public function getSignatureImageAttribute(): ?Media
    {
        return $this->getFirstMedia('signature-image');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setSignatureImageAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('signatureImage')
                ->toMediaCollection('signature-image');
        }

        return $this;
    }

    public function getVoluntarySurrenderFormDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('voluntary_surrender_form-documents');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setVoluntarySurrenderFormDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('voluntarySurrenderFormDocument')
                ->toMediaCollection('voluntary_surrender_form-documents');
        }

        return $this;
    }

    public function getUsufructAgreementDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('usufruct_agreement-documents');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setUsufructAgreementDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('usufructAgreementDocument')
                ->toMediaCollection('usufruct_agreement-documents');
        }

        return $this;
    }

    public function getContractToSellDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('contract_to_sell-documents');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setContractToSellDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('contractToSellDocument')
                ->toMediaCollection('contract_to_sell-documents');
        }

        return $this;
    }

    public function getDeedOfRestrictionsDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('deed_of_restrictions-documents');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setDeedOfRestrictionsDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('deedOfRestrictionsDocument')
                ->toMediaCollection('deed_of_restrictions-documents');
        }

        return $this;
    }

    public function getDisclosureDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('disclosure-documents');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setDisclosureDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('disclosureDocument')
                ->toMediaCollection('disclosure-documents');
        }

        return $this;
    }

    public function getBorrowerConformityDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('borrower_conformity-documents');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setBorrowerConformityDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('borrowerConformityDocument')
                ->toMediaCollection('borrower_conformity-documents');
        }

        return $this;
    }

    public function getStatementOfAccountDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('statement_of_account-documents');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setStatementOfAccountDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('statementOfAccountDocument')
                ->toMediaCollection('statement_of_account-documents');
        }

        return $this;
    }

    public function getInvoiceDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('invoice-documents');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setInvoiceDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('invoiceDocument')
                ->toMediaCollection('invoice-documents');
        }

        return $this;
    }

    public function getReceiptDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('receipt-documents');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setReceiptDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('receiptDocument')
                ->toMediaCollection('receipt-documents');
        }

        return $this;
    }

    public function getDeedOfSaleDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('deed_of_sale-documents');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setDeedOfSaleDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('deedOfSaleDocument')
                ->toMediaCollection('deed_of_sale-documents');
        }

        return $this;
    }

    public function getGovernmentId1ImageAttribute(): ?Media
    {
        return $this->getFirstMedia('government_id1-image');
    }

    public function setGovernmentId1ImageAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('governmentId1Image')
                ->toMediaCollection('government_id1-image');
        }

        return $this;
    }

    public function getGovernmentId2ImageAttribute(): ?Media
    {
        return $this->getFirstMedia('government_id2-image');
    }

    public function setGovernmentId2ImageAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('governmentId2Image')
                ->toMediaCollection('government_id2-image');
        }

        return $this;
    }

    public function getCertificateOfEmploymentDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('certificate_of_employment-document');
    }

    public function setCertificateOfEmploymentDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('certificateOfEmploymentDocument')
                ->toMediaCollection('certificate_of_employment-document');
        }

        return $this;
    }

    public function getOneMonthLatestPayslipDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('one_month_latest_payslip-document');
    }

    public function setOneMonthLatestPayslipDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('oneMonthLatestPayslipDocument')
                ->toMediaCollection('one_month_latest_payslip-document');
        }

        return $this;
    }

    public function getEsavDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('esav-document');
    }

    public function setEsavDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('esavDocument')
                ->toMediaCollection('esav-document');
        }

        return $this;
    }

    public function getBirthCertificateDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('birth_certificate-document');
    }

    public function setBirthCertificateDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('birthCertificateDocument')
                ->toMediaCollection('birth_certificate-document');
        }

        return $this;
    }

    public function getPhotoImageAttribute(): ?Media
    {
        return $this->getFirstMedia('photo-image');
    }

    public function setPhotoImageAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('photoImage')
                ->toMediaCollection('photo-image');
        }

        return $this;
    }

    public function getProofOfBillingAddressDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('proof_of_billing_address-document');
    }

    public function setProofOfBillingAddressDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('proofOfBillingAddressDocument')
                ->toMediaCollection('proof_of_billing_address-document');
        }

        return $this;
    }

    public function getLetterOfConsentEmployerDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('letter_of_consent_employer-document');
    }

    public function setLetterOfConsentEmployerDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('letterOfConsentEmployerDocument')
                ->toMediaCollection('letter_of_consent_employer-document');
        }

        return $this;
    }

    public function getThreeMonthsCertifiedPayslipsDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('three_months_certified_payslips-document');
    }

    public function setThreeMonthsCertifiedPayslipsDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('threeMonthsCertifiedPayslipsDocument')
                ->toMediaCollection('three_months_certified_payslips-document');
        }

        return $this;
    }

    public function getEmploymentContractDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('employment_contract-document');
    }

    public function setEmploymentContractDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('employmentContractDocument')
                ->toMediaCollection('employment_contract-document');
        }

        return $this;
    }

    public function getOfwEmploymentCertificateDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('ofw_employment_certificate-document');
    }

    public function setOfwEmploymentCertificateDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('ofwEmploymentCertificateDocument')
                ->toMediaCollection('ofw_employment_certificate-document');
        }

        return $this;
    }

    public function getPassportWithVisaImageAttribute(): ?Media
    {
        return $this->getFirstMedia('passport_with_visa-image');
    }

    public function setPassportWithVisaImageAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('passportWithVisaImage')
                ->toMediaCollection('passport_with_visa-image');
        }

        return $this;
    }

    public function getWorkingPermitDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('working_permit-document');
    }

    public function setWorkingPermitDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('workingPermitDocument')
                ->toMediaCollection('working_permit-document');
        }

        return $this;
    }

    public function getNotarizedSpaDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('notarized_spa-document');
    }

    public function setNotarizedSpaDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('notarizedSpaDocument')
                ->toMediaCollection('notarized_spa-document');
        }

        return $this;
    }

    public function getAuthorizedRepInfoSheetDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('authorized_rep_info_sheet-document');
    }

    public function setAuthorizedRepInfoSheetDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('authorizedRepInfoSheetDocument')
                ->toMediaCollection('authorized_rep_info_sheet-document');
        }

        return $this;
    }

    public function getValidIdAifImageAttribute(): ?Media
    {
        return $this->getFirstMedia('valid_id_aif-image');
    }

    public function setValidIdAifImageAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('validIdAifImage')
                ->toMediaCollection('valid_id_aif-image');
        }

        return $this;
    }

    public function getWorkingPermitCardDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('working_permit_card-document');
    }

    public function setWorkingPermitCardDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('workingPermitCardDocument')
                ->toMediaCollection('working_permit_card-document');
        }

        return $this;
    }

    public function getItrBir1701DocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('itr_bir1701-document');
    }

    public function setItrBir1701DocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('itrBir1701Document')
                ->toMediaCollection('itr_bir1701-document');
        }

        return $this;
    }

    public function getAuditedFinancialStatementDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('audited_financial_statement-document');
    }

    public function setAuditedFinancialStatementDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('auditedFinancialStatementDocument')
                ->toMediaCollection('audited_financial_statement-document');
        }

        return $this;
    }

    public function getOfficialReceiptTaxPaymentDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('official_receipt_tax_payment-document');
    }

    public function setOfficialReceiptTaxPaymentDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('officialReceiptTaxPaymentDocument')
                ->toMediaCollection('official_receipt_tax_payment-document');
        }

        return $this;
    }

    public function getBusinessMayorsPermitDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('business_mayors_permit-document');
    }

    public function setBusinessMayorsPermitDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('businessMayorsPermitDocument')
                ->toMediaCollection('business_mayors_permit-document');
        }

        return $this;
    }

    public function getDtiBusinessRegistrationDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('dti_business_registration-document');
    }

    public function setDtiBusinessRegistrationDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('dtiBusinessRegistrationDocument')
                ->toMediaCollection('dti_business_registration-document');
        }

        return $this;
    }

    public function getSketchOfBusinessLocationDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('sketch_of_business_location-document');
    }

    public function setSketchOfBusinessLocationDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('sketchOfBusinessLocationDocument')
                ->toMediaCollection('sketch_of_business_location-document');
        }

        return $this;
    }

    public function getLetterOfConsentCreditBackgroundInvestigationDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('letter_of_consent_credit_background_investigation-document');
    }

    public function setLetterOfConsentCreditBackgroundInvestigationDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('letterOfConsentCreditBackgroundInvestigationDocument')
                ->toMediaCollection('letter_of_consent_credit_background_investigation-document');
        }

        return $this;
    }

    public function getMarriageCertificateDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('marriage_certificate-document');
    }

    public function setMarriageCertificateDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('marriageCertificateDocument')
                ->toMediaCollection('marriage_certificate-document');
        }

        return $this;
    }

    public function getGovernmentIdOfSpouseImageAttribute(): ?Media
    {
        return $this->getFirstMedia('government_id_of_spouse-image');
    }

    public function setGovernmentIdOfSpouseImageAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('governmentIdOfSpouseImage')
                ->toMediaCollection('government_id_of_spouse-image');
        }

        return $this;
    }

    public function getCourtDecisionAnnulmentDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('court_decision_annulment-document');
    }

    public function setCourtDecisionAnnulmentDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('courtDecisionAnnulmentDocument')
                ->toMediaCollection('court_decision_annulment-document');
        }

        return $this;
    }

    public function getMarriageContractDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('marriage_contract-document');
    }

    public function setMarriageContractDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('marriageContractDocument')
                ->toMediaCollection('marriage_contract-document');
        }

        return $this;
    }

    public function getCourtDecisionSeparationDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('court_decision_separation-document');
    }

    public function setCourtDecisionSeparationDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('courtDecisionSeparationDocument')
                ->toMediaCollection('court_decision_separation-document');
        }

        return $this;
    }

    public function getDeathCertificateDocumentAttribute(): ?Media
    {
        return $this->getFirstMedia('death_certificate-document');
    }

    public function setDeathCertificateDocumentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('deathCertificateDocument')
                ->toMediaCollection('death_certificate-document');
        }

        return $this;
    }

    public function registerMediaCollections(): void
    {
        $collections = [
            'id-images' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'selfie-images' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'payslip-images' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'voluntary_surrender_form-documents' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'usufruct_agreement-documents' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'contract_to_sell-documents' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'deed_of_restrictions-documents' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'disclosure-documents' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'borrower_conformity-documents' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'statement_of_account-documents' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'invoice-documents' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'receipt-documents' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'deed_of_sale-documents' => ['application/pdf','image/jpeg', 'image/png', 'image/webp'],
            'government_id1-image' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'government_id2-image' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'certificate_of_employment-document' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'one_month_latest_payslip-document' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'esav-document' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'birth_certificate-document' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'photo-image' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'proof_of_billing_address-document' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'letter_of_consent_employer-document' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'three_months_certified_payslips-document' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'employment_contract-document' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'ofw_employment_certificate-document' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'passport_with_visa-image' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'working_permit-document' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'notarized_spa-document' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'authorized_rep_info_sheet-document' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'valid_id_aif-image' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'working_permit_card-document' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'itr_bir1701-document' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'audited_financial_statement-document' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'official_receipt_tax_payment-document' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'business_mayors_permit-document' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'dti_business_registration-document' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'sketch_of_business_location-document' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'letter_of_consent_credit_background_investigation-document' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'marriage_certificate-document' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'government_id_of_spouse-image' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'court_decision_annulment-document' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'marriage_contract-document' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'court_decision_separation-document' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
            'death_certificate-document' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],


        ];

        foreach ($collections as $collection => $mimeTypes) {
            $this->addMediaCollection($collection)
                ->singleFile()
                ->acceptsFile(function (File $file) use ($mimeTypes) {
                    return in_array(
                        needle: $file->mimeType,
                        haystack: (array) $mimeTypes
                    );
                });
        }
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    public function getUploadsAttribute(): array
    {
        return collect($this->media)
            ->mapWithKeys(function ($item, $key) {
                $collection_name = $item['collection_name'];
                $name = Str::camel(Str::singular($collection_name));
                $url = $item['original_url'];

                return [
                    $key => [
                        'name' => $name,
                        'url' => $url,
                    ],
                ];
            })
            ->toArray();
    }
    /**
     * Helper function to get all media field names registered in the media collection i.e.,
     *
     * id-images => idImage
     * selfie-images => selfieImage
     * payslip-images => payslipImage
     * voluntary_surrender_form-documents => voluntarySurrenderFormDocument
     * usufruct_agreement-documents => usufructAgreementDocument
     * contract_to_sell-documents =< contractToSellDocument
     * deed_of_restrictions-documents => deedOfRestrictionsDocument
     * borrower_conformity-documents => borrowerConformityDocument
     * statement_of_account-documents => statementOfAccountDocument
     * invoice-documents => invoiceDocument
     * receipt-documents => receiptDocument
     * deed_of_sale-documents => deedOfSaleDocument
     */
    public function getMediaFieldNames(): array
    {
        return $this->getRegisteredMediaCollections()
            ->pluck('name')
            ->map(function ($key) {
                return Str::singular(Str::camel($key));
            })
            ->toArray();
    }

    //    protected function casts(): array
    //    {
    //        return [
    //            'date_of_birth' => 'datetime:Y-m-d',
    //        ];
    //    }

    public function getBirthdate(): Carbon
    {
        return new Carbon($this->date_of_birth);
    }

    public function getWages(): Money|float
    {
        $buyerEmployment = collect($this->employment)->firstWhere('type', 'buyer');

        return $buyerEmployment
            ? Money::of(Arr::get($buyerEmployment, 'monthly_gross_income', 0), 'PHP')
            : Money::of(0, 'PHP');
    }

    public function getRegional(): bool
    {
        $region = Arr::get($this->addresses, '0.administrative_area', 'NCR');

        return ! ($region == 'NCR' || $region == 'Metro Manila');
    }

    public function getMobile(): PhoneNumber
    {
        return new PhoneNumber($this->mobile, 'PH');
    }

    public function setMobile($value): void
    {
        if ($value instanceof PhoneNumber) {
            $this->attributes['mobile'] = $value->formatE164();
        } elseif (is_string($value)) {
            $this->attributes['mobile'] = $value;
        } else {
            throw new \InvalidArgumentException('Mobile must be a string or an instance of PhoneNumber.');
        }
    }

    protected function DateOfBirth(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value) => new Carbon($value),
            set: fn (mixed $value) => $value instanceof Carbon ? $value->format('Y-m-d') : $value
        );
    }

    public function getSellerCommissionCode(): string
    {
        return $this->getAttribute('order')->get('seller_commission_code', 'N/A');
    }

    public function getGrossMonthlyIncome(): Price
    {
        return new Price($this->getWages());
    }
}
