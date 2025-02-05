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
 * @property Media $governmentId1
 * @property Media $governmentId2
 * @property Media $certificateOfEmployment
 * @property Media $oneMonthLatestPayslip
 * @property Media $esav
 * @property Media $birthCertificate
 * @property Media photoImage
 * @property Media $proofOfBillingAddress
 * @property Media $letterOfConsentEmployer
 * @property Media $threeMonthsCertifiedPayslips
 * @property Media $employmentContract
 * @property Media $ofwEmploymentCertificate
 * @property Media $passportWithVisa
 * @property Media $workingPermit
 * @property Media $notarizedSpa
 * @property Media $authorizedRepInfoSheet
 * @property Media $validIdAif
 * @property Media $workingPermitCard
 * @property Media $itrBir1701
 * @property Media $auditedFinancialStatement
 * @property Media $officialReceiptTaxPayment
 * @property Media $businessMayorsPermit
 * @property Media $dtiBusinessRegistration
 * @property Media $sketchOfBusinessLocation
 * @property Media $letterOfConsentCreditBackgroundInvestigation
 * @property Media $marriageCertificate
 * @property Media $governmentIdOfSpouse
 * @property Media $courtDecisionAnnulment
 * @property Media $marriageContract
 * @property Media $courtDecisionSeparation
 * @property Media $deathCertificate
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

    // Government ID 1
    public function getGovernmentId1(): ?Media
    {
        return $this->getFirstMedia('government-id-1');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setGovernmentId1Attribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('governmentId1')
                ->toMediaCollection('government-id-1');
        }

        return $this;
    }

// Government ID 2
    public function getGovernmentId2(): ?Media
    {
        return $this->getFirstMedia('government-id-2');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setGovernmentId2Attribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('governmentId2')
                ->toMediaCollection('government-id-2');
        }

        return $this;
    }

// Certificate of Employment
    public function getCertificateOfEmployment(): ?Media
    {
        return $this->getFirstMedia('certificate-of-employment');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setCertificateOfEmploymentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('certificateOfEmployment')
                ->toMediaCollection('certificate-of-employment');
        }

        return $this;
    }

// One Month Latest Payslip
    public function getOneMonthLatestPayslip(): ?Media
    {
        return $this->getFirstMedia('one-month-latest-payslip');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setOneMonthLatestPayslipAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('oneMonthLatestPayslip')
                ->toMediaCollection('one-month-latest-payslip');
        }

        return $this;
    }

// ESAV
    public function getEsav(): ?Media
    {
        return $this->getFirstMedia('esav');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setEsavAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('esav')
                ->toMediaCollection('esav');
        }

        return $this;
    }

// Birth Certificate
    public function getBirthCertificate(): ?Media
    {
        return $this->getFirstMedia('birth-certificate');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setBirthCertificateAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('birthCertificate')
                ->toMediaCollection('birth-certificate');
        }

        return $this;
    }

// Photo 4x1 White Background
    public function getPhotoImageAttribute(): ?Media
    {
        return $this->getFirstMedia('photo-images');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setPhotoImageAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('photoImage')
                ->toMediaCollection('photo-images');
        }

        return $this;
    }

// Proof of Billing Address
    public function getProofOfBillingAddress(): ?Media
    {
        return $this->getFirstMedia('proof-of-billing-address');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setProofOfBillingAddressAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('proofOfBillingAddress')
                ->toMediaCollection('proof-of-billing-address');
        }

        return $this;
    }

// Letter of Consent Employer
    public function getLetterOfConsentEmployer(): ?Media
    {
        return $this->getFirstMedia('letter-of-consent-employer');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setLetterOfConsentEmployerAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('letterOfConsentEmployer')
                ->toMediaCollection('letter-of-consent-employer');
        }

        return $this;
    }

// Three Months Certified Payslips
    public function getThreeMonthsCertifiedPayslips(): ?Media
    {
        return $this->getFirstMedia('three-months-certified-payslips');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setThreeMonthsCertifiedPayslipsAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('threeMonthsCertifiedPayslips')
                ->toMediaCollection('three-months-certified-payslips');
        }

        return $this;
    }

// Employment Contract
    public function getEmploymentContract(): ?Media
    {
        return $this->getFirstMedia('employment-contract');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setEmploymentContractAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('employmentContract')
                ->toMediaCollection('employment-contract');
        }

        return $this;
    }

// OFW Employment Certificate
    public function getOfwEmploymentCertificate(): ?Media
    {
        return $this->getFirstMedia('ofw-employment-certificate');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setOfwEmploymentCertificateAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('ofwEmploymentCertificate')
                ->toMediaCollection('ofw-employment-certificate');
        }

        return $this;
    }

// Passport With Visa
    public function getPassportWithVisa(): ?Media
    {
        return $this->getFirstMedia('passport-with-visa');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setPassportWithVisaAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('passportWithVisa')
                ->toMediaCollection('passport-with-visa');
        }

        return $this;
    }

// Working Permit
    public function getWorkingPermit(): ?Media
    {
        return $this->getFirstMedia('working-permit');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setWorkingPermitAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('workingPermit')
                ->toMediaCollection('working-permit');
        }

        return $this;
    }

    // Notarized SPA
    public function getNotarizedSpa(): ?Media
    {
        return $this->getFirstMedia('notarized-spa');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setNotarizedSpaAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('notarizedSpa')
                ->toMediaCollection('notarized-spa');
        }

        return $this;
    }

// Authorized Rep Information Sheet
    public function getAuthorizedRepInfoSheet(): ?Media
    {
        return $this->getFirstMedia('authorized-rep-info-sheet');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setAuthorizedRepInfoSheetAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('authorizedRepInfoSheet')
                ->toMediaCollection('authorized-rep-info-sheet');
        }

        return $this;
    }

// Valid ID AIF
    public function getValidIdAif(): ?Media
    {
        return $this->getFirstMedia('valid-id-aif');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setValidIdAifAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('validIdAif')
                ->toMediaCollection('valid-id-aif');
        }

        return $this;
    }

// Working Permit Card
    public function getWorkingPermitCard(): ?Media
    {
        return $this->getFirstMedia('working-permit-card');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setWorkingPermitCardAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('workingPermitCard')
                ->toMediaCollection('working-permit-card');
        }

        return $this;
    }

// Income Tax Return BIR 1701
    public function getItrBir1701(): ?Media
    {
        return $this->getFirstMedia('itr-bir1701');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setItrBir1701Attribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('itrBir1701')
                ->toMediaCollection('itr-bir1701');
        }

        return $this;
    }

// Audited Financial Statement
    public function getAuditedFinancialStatement(): ?Media
    {
        return $this->getFirstMedia('audited-financial-statement');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setAuditedFinancialStatementAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('auditedFinancialStatement')
                ->toMediaCollection('audited-financial-statement');
        }

        return $this;
    }

// Official Receipt Tax Payment
    public function getOfficialReceiptTaxPayment(): ?Media
    {
        return $this->getFirstMedia('official-receipt-tax-payment');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setOfficialReceiptTaxPaymentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('officialReceiptTaxPayment')
                ->toMediaCollection('official-receipt-tax-payment');
        }

        return $this;
    }

// Business Mayor's Permit
    public function getBusinessMayorsPermit(): ?Media
    {
        return $this->getFirstMedia('business-mayors-permit');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setBusinessMayorsPermitAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('businessMayorsPermit')
                ->toMediaCollection('business-mayors-permit');
        }

        return $this;
    }

// DTI Business Registration
    public function getDtiBusinessRegistration(): ?Media
    {
        return $this->getFirstMedia('dti-business-registration');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setDtiBusinessRegistrationAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('dtiBusinessRegistration')
                ->toMediaCollection('dti-business-registration');
        }

        return $this;
    }

// Sketch of Business Location
    public function getSketchOfBusinessLocation(): ?Media
    {
        return $this->getFirstMedia('sketch-of-business-location');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setSketchOfBusinessLocationAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('sketchOfBusinessLocation')
                ->toMediaCollection('sketch-of-business-location');
        }

        return $this;
    }

// Letter of Consent Credit Background Investigation
    public function getLetterOfConsentCreditBackgroundInvestigation(): ?Media
    {
        return $this->getFirstMedia('letter-of-consent-credit-background-investigation');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setLetterOfConsentCreditBackgroundInvestigationAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('letterOfConsentCreditBackgroundInvestigation')
                ->toMediaCollection('letter-of-consent-credit-background-investigation');
        }

        return $this;
    }

// Marriage Certificate
    public function getMarriageCertificate(): ?Media
    {
        return $this->getFirstMedia('marriage-certificate');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setMarriageCertificateAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('marriageCertificate')
                ->toMediaCollection('marriage-certificate');
        }

        return $this;
    }

// Government ID of Spouse
    public function getGovernmentIdOfSpouse(): ?Media
    {
        return $this->getFirstMedia('government-id-of-spouse');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setGovernmentIdOfSpouseAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('governmentIdOfSpouse')
                ->toMediaCollection('government-id-of-spouse');
        }

        return $this;
    }

// Court Decision Annulment
    public function getCourtDecisionAnnulment(): ?Media
    {
        return $this->getFirstMedia('court-decision-annulment');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setCourtDecisionAnnulmentAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('courtDecisionAnnulment')
                ->toMediaCollection('court-decision-annulment');
        }

        return $this;
    }

// Marriage Contract
    public function getMarriageContract(): ?Media
    {
        return $this->getFirstMedia('marriage-contract');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setMarriageContractAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('marriageContract')
                ->toMediaCollection('marriage-contract');
        }

        return $this;
    }

// Court Decision Separation
    public function getCourtDecisionSeparation(): ?Media
    {
        return $this->getFirstMedia('court-decision-separation');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setCourtDecisionSeparationAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('courtDecisionSeparation')
                ->toMediaCollection('court-decision-separation');
        }

        return $this;
    }

// Death Certificate
    public function getDeathCertificate(): ?Media
    {
        return $this->getFirstMedia('death-certificate');
    }

    /**
     * @return $this
     *
     * @throws FileCannotBeAdded
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function setDeathCertificateAttribute(?string $url): static
    {
        if ($url) {
            $this->addMediaFromUrl($url)
                ->usingName('deathCertificate')
                ->toMediaCollection('death-certificate');
        }

        return $this;
    }

    public function registerMediaCollections(): void
    {
        $collections = [
            'id-images' => ['image/jpeg', 'image/png', 'image/webp'],
            'selfie-images' => ['image/jpeg', 'image/png', 'image/webp'],
            'payslip-images' => ['image/jpeg', 'image/png', 'image/webp'],
            'voluntary_surrender_form-documents' => 'application/pdf',
            'usufruct_agreement-documents' => 'application/pdf',
            'contract_to_sell-documents' => 'application/pdf',
            'deed_of_restrictions-documents' => 'application/pdf',
            'disclosure-documents' => 'application/pdf',
            'borrower_conformity-documents' => 'application/pdf',
            'statement_of_account-documents' => 'application/pdf',
            'invoice-documents' => 'application/pdf',
            'receipt-documents' => 'application/pdf',
            'deed_of_sale-documents' => 'application/pdf',
            'photo-images' => ['image/jpeg', 'image/png', 'image/webp'],
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
