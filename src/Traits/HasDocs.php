<?php

namespace Homeful\Contacts\Traits;

use Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\MediaCollections\File;
use Homeful\Contacts\Models\Contact;
use Homeful\Common\Enums\UploadFile;
use Illuminate\Support\Str;
use Spatie\Image\Enums\Fit;

trait HasDocs
{
    protected array $documentCollections = [
        'idImage' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'selfieImage' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'payslipImage' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'signatureImage' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'voluntarySurrenderFormDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'usufructAgreementDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'contractToSellDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'deedOfRestrictionsDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'disclosureDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'borrowerConformityDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'statementOfAccountDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'invoiceDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'receiptDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'deedOfSaleDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'governmentId1Image' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'governmentId2Image' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'certificateOfEmploymentDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'oneMonthLatestPayslipDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'esavDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'birthCertificateDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'photoImage' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'proofOfBillingAddressDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'letterOfConsentEmployerDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'threeMonthsCertifiedPayslipsDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'employmentContractDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'ofwEmploymentCertificateDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'passportWithVisaDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'workingPermitDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'notarizedSpaDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'authorizedRepInfoSheetDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'validIdAifImage' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'workingPermitCardDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'itrBir1701Document' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'auditedFinancialStatementDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'officialReceiptTaxPaymentDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'businessMayorsPermitDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'dtiBusinessRegistrationDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'sketchOfBusinessLocationDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'letterOfConsentCreditBackgroundInvestigationDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'marriageCertificateDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'governmentIdOfSpouseImage' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'courtDecisionAnnulmentDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'marriageContractDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'courtDecisionSeparationDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
        'deathCertificateDocument' => ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'],
    ];

    /**
     * Retrieve the attribute value from the model.
     *
     * This method checks if the provided attribute key is registered within
     * the media collections. If so, it retrieves the first media item associated
     * with the corresponding media collection. Otherwise, it defaults to
     * retrieving the attribute from the parent model.
     *
     * @param string $key The attribute name to retrieve.
     *
     * @return mixed|null The first media item from the corresponding media collection
     *                    or the parent model's attribute value if not found in media collections.
     */
    public function getAttribute($key): mixed
    {
        return array_key_exists($key, $this->documentCollections)
            ? $this->getMedia(UploadFile::deriveCollectionNameFromAttribute($key))->last()
            : parent::getAttribute($key);
    }

    /**
     * Set the attribute value on the model.
     *
     * If the provided attribute key is associated with a media collection,
     * this method uploads the media from the provided URL to the appropriate
     * media collection. If the attribute key is not related to media,
     * the method defaults to the standard model behavior for setting attributes.
     *
     * @param string $key The attribute name to set.
     * @param mixed $value The value to set, which could be a URL for media uploads.
     *
     * @throws FileCannotBeAdded
     */
    public function setAttribute($key, $value)
    {
        return array_key_exists($key, $this->documentCollections)
            ? ($value ? $this->addMediaFromUrl($value)
                ->usingName($key)
                ->toMediaCollection(UploadFile::deriveCollectionNameFromAttribute($key)
                )
                : $this)
            : parent::setAttribute($key, $value);
    }

    /**
     * Helper function to get all media field names registered in the media collection.
     * This function converts media collection names (snake_case or kebab-case)
     * to their corresponding camelCase attribute names.
     *
     * Examples of conversions:
     *
     * - id-images => idImage
     * - selfie-images => selfieImage
     * - payslip-images => payslipImage
     * - voluntary_surrender_form-documents => voluntarySurrenderFormDocument
     * - usufruct_agreement-documents => usufructAgreementDocument
     * - contract_to_sell-documents => contractToSellDocument
     * - deed_of_restrictions-documents => deedOfRestrictionsDocument
     * - borrower_conformity-documents => borrowerConformityDocument
     * - statement_of_account-documents => statementOfAccountDocument
     * - invoice-documents => invoiceDocument
     * - receipt-documents => receiptDocument
     * - deed_of_sale-documents => deedOfSaleDocument
     * - government_id1-images => governmentId1Image
     * - government_id2-images => governmentId2Image
     * - certificate_of_employment-documents => certificateOfEmploymentDocument
     * - one_month_latest_payslip-documents => oneMonthLatestPayslipDocument
     * - esav-documents => esavDocument
     * - birth_certificate-documents => birthCertificateDocument
     * - photo-images => photoImage
     * - proof_of_billing_address-documents => proofOfBillingAddressDocument
     * - letter_of_consent_employer-documents => letterOfConsentEmployerDocument
     * - three_months_certified_payslips-documents => threeMonthsCertifiedPayslipsDocument
     * - employment_contract-documents => employmentContractDocument
     * - ofw_employment_certificate-documents => ofwEmploymentCertificateDocument
     * - passport_with_visa-documents => passportWithVisaDocument
     * - working_permit-documents => workingPermitDocument
     * - notarized_spa-documents => notarizedSpaDocument
     * - authorized_rep_info_sheet-documents => authorizedRepInfoSheetDocument
     * - valid_id_aif-images => validIdAifImage
     * - working_permit_card-documents => workingPermitCardDocument
     * - itr_bir1701-documents => itrBir1701Document
     * - audited_financial_statement-documents => auditedFinancialStatementDocument
     * - official_receipt_tax_payment-documents => officialReceiptTaxPaymentDocument
     * - business_mayors_permit-documents => businessMayorsPermitDocument
     * - dti_business_registration-documents => dtiBusinessRegistrationDocument
     * - sketch_of_business_location-documents => sketchOfBusinessLocationDocument
     * - letter_of_consent_credit_background_investigation-documents => letterOfConsentCreditBackgroundInvestigationDocument
     * - marriage_certificate-documents => marriageCertificateDocument
     * - government_id_of_spouse-images => governmentIdOfSpouseImage
     * - court_decision_annulment-documents => courtDecisionAnnulmentDocument
     * - marriage_contract-documents => marriageContractDocument
     * - court_decision_separation-documents => courtDecisionSeparationDocument
     * - death_certificate-documents => deathCertificateDocument
     *
     * @return array An array of attribute names derived from the registered media collection names.
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

    /**
     * Retrieve the media uploads and their corresponding details.
     *
     * This function maps each media item to an associative array containing:
     * - The singular camel-case version of the collection name (e.g., 'id-images' -> 'idImage').
     * - The URL of the original media file.
     *
     * @return array An array of uploaded media details, keyed by their index.
     */
    public function getUploadsAttribute(): array
    {
        return collect($this->media)->mapWithKeys(function ($mediaItem, $index) {
            return [
                $index => [
                    'name' => Str::camel(Str::singular($mediaItem['collection_name'])),
                    'url' => $mediaItem['original_url'],
                ],
            ];
        })->toArray();
    }

    protected function getDocumentCollections(): array
    {
        return $this->documentCollections;
    }

    public function registerMediaCollections(): void
    {
        foreach ($this->getDocumentCollections() as $collection => $mimeTypes) {
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
}
