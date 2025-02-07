<?php

namespace Homeful\Contacts\Models;

use Homeful\Common\Traits\HasPackageFactory as HasFactory;
use Homeful\Contacts\Database\Factories\ContactFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Homeful\Contacts\Traits\{HasDocs, HasUploads};
use Illuminate\Database\Eloquent\Casts\Attribute;
use Homeful\Common\Interfaces\BorrowerInterface;
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
 *
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
 *
 * @property Media $letterOfConsentEmployerDocument
 * @property Media $threeMonthsCertifiedPayslipsDocument
 * @property Media $employmentContractDocument
 * @property Media $ofwEmploymentCertificateDocument
 * @property Media $passportWithVisaDocument
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
 *
 * @property array $current_status
 * @property array $current_status_code
 * @property string $status_reason
 *
 * @method int getKey()
 * @method array getDocumentCollections()
 */
class Contact extends Model implements BorrowerInterface, HasMedia
{
    use InteractsWithMedia {
        HasDocs::registerMediaCollections insteadof InteractsWithMedia;
        HasDocs::registerMediaConversions insteadof InteractsWithMedia;
    }
    use HasStatuses;
    use HasFactory;
    use Notifiable;
    use HasUploads;
    use HasDocs;

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
        'governmentId1Image',
        'governmentId2Image',
        'certificateOfEmploymentDocument',
        'oneMonthLatestPayslipDocument',
        'esavDocument',
        'birthCertificateDocument',
        'photoImage',
        'proofOfBillingAddressDocument',
        'letterOfConsentEmployerDocument',
        'threeMonthsCertifiedPayslipsDocument',
        'employmentContractDocument',
        'ofwEmploymentCertificateDocument',
        'passportWithVisaDocument',
        'workingPermitDocument',
        'notarizedSpaDocument',
        'authorizedRepInfoSheetDocument',
        'validIdAifImage',
        'workingPermitCardDocument',
        'itrBir1701Document',
        'auditedFinancialStatementDocument',
        'officialReceiptTaxPaymentDocument',
        'businessMayorsPermitDocument',
        'dtiBusinessRegistrationDocument',
        'sketchOfBusinessLocationDocument',
        'letterOfConsentCreditBackgroundInvestigationDocument',
        'marriageCertificateDocument',
        'governmentIdOfSpouseImage',
        'courtDecisionAnnulmentDocument',
        'marriageContractDocument',
        'courtDecisionSeparationDocument',
        'deathCertificateDocument',
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

    public function getNameAttribute(): string
    {
        return $this->name ?? implode(' ', array_filter([$this->first_name, $this->middle_name, $this->last_name, $this->name_suffix]));
    }

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
