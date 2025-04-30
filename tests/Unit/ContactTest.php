<?php

use Homeful\Contacts\Data\ContactData;
use Homeful\Contacts\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\{Arr, Carbon, Str};
use Propaganistas\LaravelPhone\PhoneNumber;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

uses(RefreshDatabase::class, WithFaker::class);

beforeEach(function () {
    $this->faker = $this->makeFaker('en_PH');
    $migration = include 'vendor/spatie/laravel-medialibrary/database/migrations/create_media_table.php.stub';
    $migration->up();
});

dataset('contact', function () {
    return [
        [
            fn () => Contact::factory()->create([
                'idImage' => 'https://jn-img.enclaves.ph/Test/idImage.jpg',
                'selfieImage' => 'https://jn-img.enclaves.ph/Test/selfieImage.jpg',
                'payslipImage' => 'https://jn-img.enclaves.ph/Test/payslipImage.jpg',
                'signatureImage' => 'https://jn-img.enclaves.ph/Test/payslipImage.jpg',
                'voluntarySurrenderFormDocument' => 'https://unec.edu.az/application/uploads/2014/12/pdf-sample.pdf',
                'usufructAgreementDocument' => 'https://jn-img.enclaves.ph/Microservices%20Logo/Level%200%20-Book%20Flight_Property.pdf',
                'contractToSellDocument' => 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf',
                'deedOfRestrictionsDocument' => 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf',
                'disclosureDocument' => 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf',
                'borrowerConformityDocument' => 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf',
                'statementOfAccountDocument' => 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf',
                'invoiceDocument' => 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf',
                'receiptDocument' => 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf',
                'deedOfSaleDocument' => 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf',
                'governmentId1Image' => 'https://jn-img.enclaves.ph/Test/payslipImage.jpg',
            ]),
        ],
    ];
});

test('contact has schema attributes', function (Contact $contact) {
    expect($contact->id)->toBeUuid();
    expect($contact->reference_code)->toBeString();
    expect($contact->first_name)->toBeString();
    expect($contact->middle_name)->toBeString();
    expect($contact->last_name)->toBeString();
    expect($contact->civil_status)->toBeString();
    expect($contact->sex)->toBeString();
    expect($contact->nationality)->toBeString();
    expect($contact->date_of_birth)->toBeInstanceOf(Carbon::class);
    expect($contact->email)->toBeString();
    expect($contact->getMobile())->toBeInstanceOf(PhoneNumber::class);
    expect($contact->addresses)->toBeArray();
    expect($contact->employment)->toBeArray();
    expect($contact->co_borrowers)->toBeArray();
    expect($contact->order)->toBeArray();
    expect($contact->idImage)->toBeInstanceOf(Media::class);
    expect($contact->selfieImage)->toBeInstanceOf(Media::class);
    expect($contact->payslipImage)->toBeInstanceOf(Media::class);
    expect($contact->voluntarySurrenderFormDocument)->toBeInstanceOf(Media::class);
    expect($contact->usufructAgreementDocument)->toBeInstanceOf(Media::class);
    expect($contact->contractToSellDocument)->toBeInstanceOf(Media::class);
    expect($contact->deedOfRestrictionsDocument)->toBeInstanceOf(Media::class);
    expect($contact->disclosureDocument)->toBeInstanceOf(Media::class);
    expect($contact->borrowerConformityDocument)->toBeInstanceOf(Media::class);
    expect($contact->statementOfAccountDocument)->toBeInstanceOf(Media::class);
    expect($contact->invoiceDocument)->toBeInstanceOf(Media::class);
    expect($contact->receiptDocument)->toBeInstanceOf(Media::class);
    expect($contact->deedOfSaleDocument)->toBeInstanceOf(Media::class);
    expect($contact->governmentId1Image)->toBeInstanceOf(Media::class);
})->with('contact');

test('contact can attach media', function () {
    $idImageUrl = 'https://jn-img.enclaves.ph/Test/idImage.jpg';
    $selfieImageUrl = 'https://jn-img.enclaves.ph/Test/selfieImage.jpg';
    $payslipImageUrl = 'https://jn-img.enclaves.ph/Test/payslipImage.jpg';
    $signatureImageUrl = 'https://jn-img.enclaves.ph/Test/payslipImage.jpg';
    $voluntarySurrenderFormDocument = 'https://unec.edu.az/application/uploads/2014/12/pdf-sample.pdf';
    $usufructAgreementDocument = 'https://jn-img.enclaves.ph/Microservices%20Logo/Level%200%20-Book%20Flight_Property.pdf';
    $contractToSellDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $deedOfRestrictionsDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $disclosureDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $borrowerConformityDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $statementOfAccountDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $invoiceDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $receiptDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $deedOfSaleDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $governmentId1Image = 'https://jn-img.enclaves.ph/Test/idImage.jpg';
    $governmentId2Image = 'https://jn-img.enclaves.ph/Test/idImage.jpg';
    $certificateOfEmploymentDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $oneMonthLatestPayslipDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $esavDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $birthCertificateDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $photoImage = 'https://jn-img.enclaves.ph/Test/selfieImage.jpg';
    $proofOfBillingAddressDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';

    $letterOfConsentEmployerDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $threeMonthsCertifiedPayslipsDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $employmentContractDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $ofwEmploymentCertificateDocument= 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $passportWithVisaDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $workingPermitDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $notarizedSpaDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $authorizedRepInfoSheetDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $validIdAifImage = 'https://jn-img.enclaves.ph/Test/selfieImage.jpg';
    $workingPermitCardDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $itrBir1701Document = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $auditedFinancialStatementDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $officialReceiptTaxPaymentDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $businessMayorsPermitDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $dtiBusinessRegistrationDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $sketchOfBusinessLocationDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $letterOfConsentCreditBackgroundInvestigationDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $marriageCertificateDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $governmentIdOfSpouseImage = 'https://jn-img.enclaves.ph/Test/selfieImage.jpg';
    $courtDecisionAnnulmentDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $marriageContractDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $courtDecisionSeparationDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $deathCertificateDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';
    $cashDepositProofOfPaymentDocument = 'https://s29.q4cdn.com/175625835/files/doc_downloads/test.pdf';

    $contact = Contact::factory()->create([
        'idImage' => null,
        'selfieImage' => null,
        'payslipImage' => null,
        'signatureImage' => null,
        'voluntarySurrenderFormDocument' => null,
        'usufructAgreementDocument' => null,
        'contractToSellDocument' => null,
        'deedOfRestrictionsDocument' => null,
        'disclosureDocument' => null,
        'borrowerConformityDocument' => null,
        'statementOfAccountDocument' => null,
        'invoiceDocument' => null,
        'receiptDocument' => null,
        'deedOfSaleDocument' => null,
        'governmentId1Image' => null,
        'governmentId2Image' => null,
        'certificateOfEmploymentDocument' => null,
        'oneMonthLatestPayslipDocument' => null,
        'esavDocument' => null,
        'birthCertificateDocument' => null,
        'photoImage' => null,
        'proofOfBillingAddressDocument' => null,
        'letterOfConsentEmployerDocument' => null,

        'threeMonthsCertifiedPayslipsDocument' => null,
        'employmentContractDocument' => null,
        'ofwEmploymentCertificateDocument' => null,
        'passportWithVisaDocument' => null,
        'workingPermitDocument' => null,
        'notarizedSpaDocument' => null,
        'authorizedRepInfoSheetDocument' => null,
        'validIdAifImage' => null,
        'workingPermitCardDocument' => null,
        'itrBir1701Document' => null,
        'auditedFinancialStatementDocument' => null,
        'officialReceiptTaxPaymentDocument' => null,
        'businessMayorsPermitDocument' => null,
        'dtiBusinessRegistrationDocument' => null,
        'sketchOfBusinessLocationDocument' => null,
        'letterOfConsentCreditBackgroundInvestigationDocument' => null,
        'marriageCertificateDocument' => null,
        'governmentIdOfSpouseImage' => null,
        'courtDecisionAnnulmentDocument' => null,
        'marriageContractDocument' => null,
        'courtDecisionSeparationDocument' => null,
        'deathCertificateDocument' => null,
        'cashDepositProofOfPaymentDocument' => null,
    ]);
    $contact->idImage = $idImageUrl;
    $contact->selfieImage = $selfieImageUrl;
    $contact->payslipImage = $payslipImageUrl;
    $contact->signatureImage = $signatureImageUrl;
    $contact->voluntarySurrenderFormDocument = $voluntarySurrenderFormDocument;
    $contact->usufructAgreementDocument = $usufructAgreementDocument;
    $contact->contractToSellDocument = $contractToSellDocument;
    $contact->deedOfRestrictionsDocument = $deedOfRestrictionsDocument;
    $contact->disclosureDocument = $disclosureDocument;
    $contact->borrowerConformityDocument = $borrowerConformityDocument;
    $contact->statementOfAccountDocument = $statementOfAccountDocument;
    $contact->invoiceDocument = $invoiceDocument;
    $contact->receiptDocument = $receiptDocument;
    $contact->deedOfSaleDocument = $deedOfSaleDocument;
    $contact->governmentId1Image = $governmentId1Image;
    $contact->governmentId2Image = $governmentId2Image;
    $contact->certificateOfEmploymentDocument = $certificateOfEmploymentDocument;
    $contact->oneMonthLatestPayslipDocument = $oneMonthLatestPayslipDocument;
    $contact->esavDocument = $esavDocument;
    $contact->birthCertificateDocument = $birthCertificateDocument;
    $contact->photoImage = $photoImage;
    $contact->proofOfBillingAddressDocument = $proofOfBillingAddressDocument;

    $contact->letterOfConsentEmployerDocument = $letterOfConsentEmployerDocument;
    $contact->threeMonthsCertifiedPayslipsDocument = $threeMonthsCertifiedPayslipsDocument;
    $contact->employmentContractDocument = $employmentContractDocument;
    $contact->ofwEmploymentCertificateDocument= $ofwEmploymentCertificateDocument;
    $contact->passportWithVisaDocument = $passportWithVisaDocument;
    $contact->workingPermitDocument = $workingPermitDocument;
    $contact->notarizedSpaDocument = $notarizedSpaDocument;
    $contact->authorizedRepInfoSheetDocument = $authorizedRepInfoSheetDocument;
    $contact->validIdAifImage = $validIdAifImage;
    $contact->workingPermitCardDocument = $workingPermitCardDocument;
    $contact->itrBir1701Document = $itrBir1701Document;
    $contact->auditedFinancialStatementDocument = $auditedFinancialStatementDocument;
    $contact->officialReceiptTaxPaymentDocument = $officialReceiptTaxPaymentDocument;
    $contact->businessMayorsPermitDocument = $businessMayorsPermitDocument;
    $contact->dtiBusinessRegistrationDocument = $dtiBusinessRegistrationDocument;
    $contact->sketchOfBusinessLocationDocument = $sketchOfBusinessLocationDocument;
    $contact->letterOfConsentCreditBackgroundInvestigationDocument = $letterOfConsentCreditBackgroundInvestigationDocument;
    $contact->marriageCertificateDocument = $marriageCertificateDocument;
    $contact->governmentIdOfSpouseImage = $governmentIdOfSpouseImage;
    $contact->courtDecisionAnnulmentDocument = $courtDecisionAnnulmentDocument;
    $contact->marriageContractDocument = $marriageContractDocument;
    $contact->courtDecisionSeparationDocument = $courtDecisionSeparationDocument;
    $contact->deathCertificateDocument = $deathCertificateDocument;
    $contact->cashDepositProofOfPaymentDocument = $cashDepositProofOfPaymentDocument;

    $contact->save();
    expect($contact->idImage)->toBeInstanceOf(Media::class);
    expect($contact->selfieImage)->toBeInstanceOf(Media::class);
    expect($contact->payslipImage)->toBeInstanceOf(Media::class);
    expect($contact->signatureImage)->toBeInstanceOf(Media::class);
    expect($contact->voluntarySurrenderFormDocument)->toBeInstanceOf(Media::class);
    expect($contact->usufructAgreementDocument)->toBeInstanceOf(Media::class);
    expect($contact->contractToSellDocument)->toBeInstanceOf(Media::class);
    expect($contact->deedOfRestrictionsDocument)->toBeInstanceOf(Media::class);
    expect($contact->disclosureDocument)->toBeInstanceOf(Media::class);
    expect($contact->borrowerConformityDocument)->toBeInstanceOf(Media::class);
    expect($contact->statementOfAccountDocument)->toBeInstanceOf(Media::class);
    expect($contact->invoiceDocument)->toBeInstanceOf(Media::class);
    expect($contact->receiptDocument)->toBeInstanceOf(Media::class);
    expect($contact->deedOfSaleDocument)->toBeInstanceOf(Media::class);
    expect($contact->governmentId1Image)->toBeInstanceOf(Media::class);
    expect($contact->governmentId2Image)->toBeInstanceOf(Media::class);
    expect($contact->certificateOfEmploymentDocument)->toBeInstanceOf(Media::class);
    expect($contact->oneMonthLatestPayslipDocument)->toBeInstanceOf(Media::class);
    expect($contact->esavDocument)->toBeInstanceOf(Media::class);
    expect($contact->birthCertificateDocument)->toBeInstanceOf(Media::class);
    expect($contact->photoImage)->toBeInstanceOf(Media::class);
    expect($contact->proofOfBillingAddressDocument)->toBeInstanceOf(Media::class);

    expect($contact->letterOfConsentEmployerDocument)->toBeInstanceOf(Media::class);
    expect($contact->threeMonthsCertifiedPayslipsDocument)->toBeInstanceOf(Media::class);
    expect($contact->employmentContractDocument)->toBeInstanceOf(Media::class);
    expect($contact->ofwEmploymentCertificateDocument)->toBeInstanceOf(Media::class);
    expect($contact->passportWithVisaDocument)->toBeInstanceOf(Media::class);
    expect($contact->workingPermitDocument)->toBeInstanceOf(Media::class);
    expect($contact->notarizedSpaDocument)->toBeInstanceOf(Media::class);
    expect($contact->authorizedRepInfoSheetDocument)->toBeInstanceOf(Media::class);
    expect($contact->validIdAifImage)->toBeInstanceOf(Media::class);
    expect($contact->workingPermitCardDocument)->toBeInstanceOf(Media::class);
    expect($contact->itrBir1701Document)->toBeInstanceOf(Media::class);
    expect($contact->auditedFinancialStatementDocument)->toBeInstanceOf(Media::class);
    expect($contact->officialReceiptTaxPaymentDocument)->toBeInstanceOf(Media::class);
    expect($contact->businessMayorsPermitDocument)->toBeInstanceOf(Media::class);
    expect($contact->dtiBusinessRegistrationDocument )->toBeInstanceOf(Media::class);
    expect($contact->sketchOfBusinessLocationDocument)->toBeInstanceOf(Media::class);
    expect($contact->letterOfConsentCreditBackgroundInvestigationDocument)->toBeInstanceOf(Media::class);
    expect($contact->marriageCertificateDocument)->toBeInstanceOf(Media::class);
    expect($contact->governmentIdOfSpouseImage)->toBeInstanceOf(Media::class);
    expect($contact->courtDecisionAnnulmentDocument)->toBeInstanceOf(Media::class);
    expect($contact->marriageContractDocument)->toBeInstanceOf(Media::class);
    expect($contact->courtDecisionSeparationDocument)->toBeInstanceOf(Media::class);
    expect($contact->deathCertificateDocument)->toBeInstanceOf(Media::class);
    expect($contact->cashDepositProofOfPaymentDocument)->toBeInstanceOf(Media::class);

    expect($contact->idImage->name)->toBe('idImage');
    expect($contact->selfieImage->name)->toBe('selfieImage');
    expect($contact->payslipImage->name)->toBe('payslipImage');
    expect($contact->signatureImage->name)->toBe('signatureImage');
    expect($contact->voluntarySurrenderFormDocument->name)->toBe('voluntarySurrenderFormDocument');
    expect($contact->usufructAgreementDocument->name)->toBe('usufructAgreementDocument');
    expect($contact->contractToSellDocument->name)->toBe('contractToSellDocument');
    expect($contact->deedOfRestrictionsDocument->name)->toBe('deedOfRestrictionsDocument');
    expect($contact->disclosureDocument->name)->toBe('disclosureDocument');
    expect($contact->borrowerConformityDocument->name)->toBe('borrowerConformityDocument');
    expect($contact->statementOfAccountDocument->name)->toBe('statementOfAccountDocument');
    expect($contact->invoiceDocument->name)->toBe('invoiceDocument');
    expect($contact->receiptDocument->name)->toBe('receiptDocument');
    expect($contact->deedOfSaleDocument->name)->toBe('deedOfSaleDocument');
    expect($contact->governmentId1Image->name)->toBe('governmentId1Image');
    expect($contact->certificateOfEmploymentDocument->name)->toBe('certificateOfEmploymentDocument');
    expect($contact->oneMonthLatestPayslipDocument->name)->toBe('oneMonthLatestPayslipDocument');
    expect($contact->esavDocument->name)->toBe('esavDocument');
    expect($contact->birthCertificateDocument->name)->toBe('birthCertificateDocument');
    expect($contact->photoImage->name)->toBe('photoImage');
    expect($contact->proofOfBillingAddressDocument->name)->toBe('proofOfBillingAddressDocument');

    expect($contact->letterOfConsentEmployerDocument->name)->toBe('letterOfConsentEmployerDocument');
    expect($contact->threeMonthsCertifiedPayslipsDocument->name)->toBe('threeMonthsCertifiedPayslipsDocument');
    expect($contact->employmentContractDocument->name)->toBe('employmentContractDocument');
    expect($contact->ofwEmploymentCertificateDocument->name)->toBe('ofwEmploymentCertificateDocument');
    expect($contact->passportWithVisaDocument->name)->toBe('passportWithVisaDocument');
    expect($contact->workingPermitDocument->name)->toBe('workingPermitDocument');
    expect($contact->notarizedSpaDocument->name)->toBe('notarizedSpaDocument');
    expect($contact->authorizedRepInfoSheetDocument->name)->toBe('authorizedRepInfoSheetDocument');
    expect($contact->validIdAifImage->name)->toBe('validIdAifImage');
    expect($contact->workingPermitCardDocument->name)->toBe('workingPermitCardDocument');
    expect($contact->itrBir1701Document->name)->toBe('itrBir1701Document');
    expect($contact->auditedFinancialStatementDocument->name)->toBe('auditedFinancialStatementDocument');
    expect($contact->officialReceiptTaxPaymentDocument->name)->toBe('officialReceiptTaxPaymentDocument');
    expect($contact->businessMayorsPermitDocument->name)->toBe('businessMayorsPermitDocument');
    expect($contact->dtiBusinessRegistrationDocument->name)->toBe('dtiBusinessRegistrationDocument');
    expect($contact->sketchOfBusinessLocationDocument->name)->toBe('sketchOfBusinessLocationDocument');
    expect($contact->letterOfConsentCreditBackgroundInvestigationDocument->name)->toBe('letterOfConsentCreditBackgroundInvestigationDocument');
    expect($contact->marriageCertificateDocument->name)->toBe('marriageCertificateDocument');
    expect($contact->governmentIdOfSpouseImage->name)->toBe('governmentIdOfSpouseImage');
    expect($contact->courtDecisionAnnulmentDocument->name)->toBe('courtDecisionAnnulmentDocument');
    expect($contact->marriageContractDocument->name)->toBe('marriageContractDocument');
    expect($contact->courtDecisionSeparationDocument->name)->toBe('courtDecisionSeparationDocument');
    expect($contact->deathCertificateDocument->name)->toBe('deathCertificateDocument');
    expect($contact->cashDepositProofOfPaymentDocument->name)->toBe('cashDepositProofOfPaymentDocument');

    expect($contact->selfieImage->file_name)->toBe('selfieImage.jpg');
    expect($contact->payslipImage->file_name)->toBe('payslipImage.jpg');
    expect($contact->signatureImage->file_name)->toBe('payslipImage.jpg');
    expect($contact->voluntarySurrenderFormDocument->file_name)->toBe('pdf-sample.pdf');
    expect($contact->usufructAgreementDocument->file_name)->toBe('Level-0--Book-Flight_Property.pdf');
    expect($contact->contractToSellDocument->file_name)->toBe('test.pdf');
    expect($contact->deedOfRestrictionsDocument->file_name)->toBe('test.pdf');
    expect($contact->disclosureDocument->file_name)->toBe('test.pdf');
    expect($contact->borrowerConformityDocument->file_name)->toBe('test.pdf');
    expect($contact->statementOfAccountDocument->file_name)->toBe('test.pdf');
    expect($contact->invoiceDocument->file_name)->toBe('test.pdf');
    expect($contact->receiptDocument->file_name)->toBe('test.pdf');
    expect($contact->deedOfSaleDocument->file_name)->toBe('test.pdf');
    expect($contact->governmentId1Image->file_name)->toBe('idImage.jpg');
    expect($contact->governmentId2Image->file_name)->toBe('idImage.jpg');
    expect($contact->certificateOfEmploymentDocument->file_name)->toBe('test.pdf');
    expect($contact->oneMonthLatestPayslipDocument->file_name)->toBe('test.pdf');
    expect($contact->esavDocument->file_name)->toBe('test.pdf');
    expect($contact->birthCertificateDocument->file_name)->toBe('test.pdf');
    expect($contact->photoImage->file_name)->toBe('selfieImage.jpg');
    expect($contact->proofOfBillingAddressDocument->file_name)->toBe('test.pdf');

    expect($contact->letterOfConsentEmployerDocument->file_name)->toBe('test.pdf');
    expect($contact->threeMonthsCertifiedPayslipsDocument->file_name)->toBe('test.pdf');
    expect($contact->employmentContractDocument->file_name)->toBe('test.pdf');
    expect($contact->ofwEmploymentCertificateDocument->file_name)->toBe('test.pdf');
    expect($contact->passportWithVisaDocument->file_name)->toBe('test.pdf');
    expect($contact->workingPermitDocument->file_name)->toBe('test.pdf');
    expect($contact->notarizedSpaDocument->file_name)->toBe('test.pdf');
    expect($contact->authorizedRepInfoSheetDocument->file_name)->toBe('test.pdf');
    expect($contact->validIdAifImage->file_name)->toBe('selfieImage.jpg');
    expect($contact->workingPermitCardDocument->file_name)->toBe('test.pdf');
    expect($contact->itrBir1701Document->file_name)->toBe('test.pdf');
    expect($contact->auditedFinancialStatementDocument->file_name)->toBe('test.pdf');
    expect($contact->officialReceiptTaxPaymentDocument->file_name)->toBe('test.pdf');
    expect($contact->businessMayorsPermitDocument->file_name)->toBe('test.pdf');
    expect($contact->dtiBusinessRegistrationDocument->file_name)->toBe('test.pdf');
    expect($contact->sketchOfBusinessLocationDocument->file_name)->toBe('test.pdf');
    expect($contact->letterOfConsentCreditBackgroundInvestigationDocument->file_name)->toBe('test.pdf');
    expect($contact->marriageCertificateDocument->file_name)->toBe('test.pdf');
    expect($contact->governmentIdOfSpouseImage->file_name)->toBe('selfieImage.jpg');
    expect($contact->courtDecisionAnnulmentDocument->file_name)->toBe('test.pdf');
    expect($contact->marriageContractDocument->file_name)->toBe('test.pdf');
    expect($contact->courtDecisionSeparationDocument->file_name)->toBe('test.pdf');
    expect($contact->deathCertificateDocument->file_name)->toBe('test.pdf');
    expect($contact->cashDepositProofOfPaymentDocument->file_name)->toBe('test.pdf');

    $host = (config('app.url'));
    config()->set('app.url', '');
    tap(config('app.url'), function ($host) use ($contact) {
        expect($contact->idImage->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->idImage->getPathRelativeToRoot()]));
        expect($contact->selfieImage->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->selfieImage->getPathRelativeToRoot()]));
        expect($contact->payslipImage->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->payslipImage->getPathRelativeToRoot()]));
        expect($contact->signatureImage->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->signatureImage->getPathRelativeToRoot()]));
        expect($contact->voluntarySurrenderFormDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->voluntarySurrenderFormDocument->getPathRelativeToRoot()]));
        expect($contact->usufructAgreementDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->usufructAgreementDocument->getPathRelativeToRoot()]));
        expect($contact->contractToSellDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->contractToSellDocument->getPathRelativeToRoot()]));
        expect($contact->deedOfRestrictionsDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->deedOfRestrictionsDocument->getPathRelativeToRoot()]));
        expect($contact->disclosureDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->disclosureDocument->getPathRelativeToRoot()]));
        expect($contact->borrowerConformityDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->borrowerConformityDocument->getPathRelativeToRoot()]));
        expect($contact->statementOfAccountDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->statementOfAccountDocument->getPathRelativeToRoot()]));
        expect($contact->invoiceDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->invoiceDocument->getPathRelativeToRoot()]));
        expect($contact->receiptDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->receiptDocument->getPathRelativeToRoot()]));
        expect($contact->deedOfSaleDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->deedOfSaleDocument->getPathRelativeToRoot()]));
        expect($contact->governmentId1Image->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->governmentId1Image->getPathRelativeToRoot()]));
        expect($contact->governmentId2Image->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->governmentId2Image->getPathRelativeToRoot()]));
        expect($contact->certificateOfEmploymentDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->certificateOfEmploymentDocument->getPathRelativeToRoot()]));
        expect($contact->oneMonthLatestPayslipDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->oneMonthLatestPayslipDocument->getPathRelativeToRoot()]));
        expect($contact->esavDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->esavDocument->getPathRelativeToRoot()]));
        expect($contact->birthCertificateDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->birthCertificateDocument->getPathRelativeToRoot()]));
        expect($contact->photoImage->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->photoImage->getPathRelativeToRoot()]));
        expect($contact->proofOfBillingAddressDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->proofOfBillingAddressDocument->getPathRelativeToRoot()]));

        expect($contact->letterOfConsentEmployerDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->letterOfConsentEmployerDocument->getPathRelativeToRoot()]));
        expect($contact->threeMonthsCertifiedPayslipsDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->threeMonthsCertifiedPayslipsDocument->getPathRelativeToRoot()]));
        expect($contact->employmentContractDocument)->getUrl()->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->employmentContractDocument->getPathRelativeToRoot()]));
        expect($contact->ofwEmploymentCertificateDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->ofwEmploymentCertificateDocument->getPathRelativeToRoot()]));
        expect($contact->passportWithVisaDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->passportWithVisaDocument->getPathRelativeToRoot()]));
        expect($contact->workingPermitDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->workingPermitDocument->getPathRelativeToRoot()]));
        expect($contact->notarizedSpaDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->notarizedSpaDocument->getPathRelativeToRoot()]));
        expect($contact->authorizedRepInfoSheetDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->authorizedRepInfoSheetDocument->getPathRelativeToRoot()]));
        expect($contact->validIdAifImage->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->validIdAifImage->getPathRelativeToRoot()]));
        expect($contact->workingPermitCardDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->workingPermitCardDocument->getPathRelativeToRoot()]));
        expect($contact->itrBir1701Document->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->itrBir1701Document->getPathRelativeToRoot()]));
        expect($contact->auditedFinancialStatementDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->auditedFinancialStatementDocument->getPathRelativeToRoot()]));
        expect($contact->officialReceiptTaxPaymentDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->officialReceiptTaxPaymentDocument->getPathRelativeToRoot()]));
        expect($contact->businessMayorsPermitDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->businessMayorsPermitDocument->getPathRelativeToRoot()]));
        expect($contact->dtiBusinessRegistrationDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->dtiBusinessRegistrationDocument->getPathRelativeToRoot()]));
        expect($contact->sketchOfBusinessLocationDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->sketchOfBusinessLocationDocument->getPathRelativeToRoot()]));
        expect($contact->letterOfConsentCreditBackgroundInvestigationDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->letterOfConsentCreditBackgroundInvestigationDocument->getPathRelativeToRoot()]));
        expect($contact->marriageCertificateDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->marriageCertificateDocument->getPathRelativeToRoot()]));
        expect($contact->governmentIdOfSpouseImage->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->governmentIdOfSpouseImage->getPathRelativeToRoot()]));
        expect($contact->courtDecisionAnnulmentDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->courtDecisionAnnulmentDocument->getPathRelativeToRoot()]));
        expect($contact->marriageContractDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->marriageContractDocument->getPathRelativeToRoot()]));
        expect($contact->courtDecisionSeparationDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->courtDecisionSeparationDocument->getPathRelativeToRoot()]));
        expect($contact->deathCertificateDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->deathCertificateDocument->getPathRelativeToRoot()]));
        expect($contact->cashDepositProofOfPaymentDocument->getUrl())->toBe(__(':host/storage/:path', ['host' => $host, 'path' => $contact->cashDepositProofOfPaymentDocument->getPathRelativeToRoot()]));
    });
    config()->set('app.url', $host);
    $contact->idImage->delete();
    $contact->selfieImage->delete();
    $contact->payslipImage->delete();
    $contact->signatureImage->delete();
    $contact->voluntarySurrenderFormDocument->delete();
    $contact->usufructAgreementDocument->delete();
    $contact->contractToSellDocument->delete();
    $contact->deedOfRestrictionsDocument->delete();
    $contact->disclosureDocument->delete();
    $contact->borrowerConformityDocument->delete();
    $contact->statementOfAccountDocument->delete();
    $contact->invoiceDocument->delete();
    $contact->receiptDocument->delete();
    $contact->deedOfSaleDocument->delete();
    $contact->governmentId1Image->delete();
    $contact->governmentId2Image->delete();
    $contact->certificateOfEmploymentDocument->delete();
    $contact->oneMonthLatestPayslipDocument->delete();
    $contact->esavDocument->delete();
    $contact->birthCertificateDocument->delete();
    $contact->photoImage->delete();
    $contact->proofOfBillingAddressDocument->delete();

    $contact->letterOfConsentEmployerDocument->delete();
    $contact->threeMonthsCertifiedPayslipsDocument->delete();
    $contact->employmentContractDocument->delete();
    $contact->ofwEmploymentCertificateDocument->delete();
    $contact->passportWithVisaDocument->delete();
    $contact->workingPermitDocument->delete();
    $contact->notarizedSpaDocument->delete();
    $contact->authorizedRepInfoSheetDocument->delete();
    $contact->validIdAifImage->delete();
    $contact->workingPermitCardDocument->delete();
    $contact->itrBir1701Document->delete();
    $contact->auditedFinancialStatementDocument->delete();
    $contact->officialReceiptTaxPaymentDocument->delete();
    $contact->businessMayorsPermitDocument->delete();
    $contact->dtiBusinessRegistrationDocument->delete();
    $contact->sketchOfBusinessLocationDocument->delete();
    $contact->letterOfConsentCreditBackgroundInvestigationDocument->delete();
    $contact->marriageCertificateDocument->delete();
    $contact->governmentIdOfSpouseImage->delete();
    $contact->courtDecisionAnnulmentDocument->delete();
    $contact->marriageContractDocument->delete();
    $contact->courtDecisionSeparationDocument->delete();
    $contact->deathCertificateDocument->delete();
    $contact->cashDepositProofOfPaymentDocument->delete();

    $contact->clearMediaCollection('id-images');
    $contact->clearMediaCollection('selfie-images');
    $contact->clearMediaCollection('payslip-images');
    $contact->clearMediaCollection('voluntary_surrender_form-documents');
    $contact->clearMediaCollection('usufruct_agreement-documents');
    $contact->clearMediaCollection('contract_to_sell-documents');
    $contact->clearMediaCollection('deed_of_restrictions-documents');
    $contact->clearMediaCollection('disclosure-documents');
    $contact->clearMediaCollection('borrower_conformity-documents');
    $contact->clearMediaCollection('statement_of_account-documents');
    $contact->clearMediaCollection('invoice-documents');
    $contact->clearMediaCollection('receipt-documents');
    $contact->clearMediaCollection('deed_of_sale-documents');
    $contact->clearMediaCollection('government_id1-images');
    $contact->clearMediaCollection('government_id2-images');
    $contact->clearMediaCollection('certificate_of_employment-documents');
    $contact->clearMediaCollection('one_month_latest_payment_slip-documents');
    $contact->clearMediaCollection('esav-documents');
    $contact->clearMediaCollection('birth_certificate-documents');
    $contact->clearMediaCollection('photo-images');
    $contact->clearMediaCollection('proof_of_billing_address-document');

    $contact->clearMediaCollection('letter_of_consent_employer-documents');
    $contact->clearMediaCollection('three_months_certified_payslips-documents');
    $contact->clearMediaCollection('employment_contract-documents');
    $contact->clearMediaCollection('ofw_employment_certificate-documents');
    $contact->clearMediaCollection('passport_with_visa-documents');
    $contact->clearMediaCollection('working_permit-documents');
    $contact->clearMediaCollection('notarized_spa-documents');
    $contact->clearMediaCollection('authorized_rep_info_sheet-documents');
    $contact->clearMediaCollection('valid_id_aif-images');
    $contact->clearMediaCollection('working_permit_card-documents');
    $contact->clearMediaCollection('itr_bir1701-documents');
    $contact->clearMediaCollection('audited_financial_statement-documents');
    $contact->clearMediaCollection('official_receipt_tax_payment-documents');
    $contact->clearMediaCollection('business_mayors_permit-documents');
    $contact->clearMediaCollection('dti_business_registration-documents');
    $contact->clearMediaCollection('sketch_of_business_location-documents');
    $contact->clearMediaCollection('letter_of_consent_credit_background_investigation-documents');
    $contact->clearMediaCollection('marriage_certificate-documents');
    $contact->clearMediaCollection('government_id_of_spouse-images');
    $contact->clearMediaCollection('court_decision_annulment-documents');
    $contact->clearMediaCollection('marriage_contract-documents');
    $contact->clearMediaCollection('court_decision_separation-documents');
    $contact->clearMediaCollection('death_certificate-documents');
    $contact->clearMediaCollection('cash_deposit_proof_of_payment-documents');
});


it('correctly maps media uploads to their names and URLs', function () {
    // Mocked media data similar to Spatie's output
    $mockMedia = [
        [
            'collection_name' => 'id-images',
            'original_url' => 'https://example.com/uploads/id_image1.png',
        ],
        [
            'collection_name' => 'selfie-images',
            'original_url' => 'https://example.com/uploads/selfie_image1.png',
        ],
        [
            'collection_name' => 'payslip-images',
            'original_url' => 'https://example.com/uploads/payslip_image1.pdf',
        ],
    ];

    // Mock a model with the media property and getUploadsAttribute method
    $model = new class {
        public array $media = [];

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
    };

    // Assign mocked media to the model
    $model->media = $mockMedia;

    // Expected result
    $expected = [
        0 => [
            'name' => 'idImage',
            'url' => 'https://example.com/uploads/id_image1.png',
        ],
        1 => [
            'name' => 'selfieImage',
            'url' => 'https://example.com/uploads/selfie_image1.png',
        ],
        2 => [
            'name' => 'payslipImage',
            'url' => 'https://example.com/uploads/payslip_image1.pdf',
        ],
    ];

    // Assert that the method returns the expected mapping
    expect($model->getUploadsAttribute())->toBe($expected);
});

test('contact has data', function (Contact $contact) {
    $data = ContactData::fromModel($contact);

    expect($data->reference_code)->toBe($contact->reference_code);
    expect($data->profile->first_name)->toBe($contact->first_name);
    expect($data->profile->middle_name)->toBe($contact->middle_name);
    expect($data->profile->last_name)->toBe($contact->last_name);
    expect($data->profile->civil_status)->toBe($contact->civil_status);
    expect($data->profile->sex)->toBe($contact->sex);
    expect($data->profile->nationality)->toBe($contact->nationality);
    expect($data->profile->date_of_birth)->toBe($contact->date_of_birth->format('Y-m-d'));
    expect($data->profile->email)->toBe($contact->email);

    expect($contact->getMobile()->equals(new \Propaganistas\LaravelPhone\PhoneNumber($data->profile->mobile, 'PH')))->toBeTrue();

    if ($contact->spouse) {

        expect($data->spouse->first_name)->toBe($contact->spouse['first_name']);
        expect($data->spouse->middle_name)->toBe($contact->spouse['middle_name']);
        expect($data->spouse->last_name)->toBe($contact->spouse['last_name']);
        expect($data->spouse->civil_status)->toBe($contact->spouse['civil_status']);
        expect($data->spouse->sex)->toBe($contact->spouse['sex']);
        expect($data->spouse->nationality)->toBe($contact->spouse['nationality']);
        expect($data->spouse->date_of_birth)->toBe($contact->spouse['date_of_birth']);
        expect($data->spouse->email)->toBe($contact->spouse['email']);
        expect($data->spouse->mobile)->toBe($contact->spouse['mobile']);
    }
    foreach ($data->addresses->toArray() as $index => $address) {
        expect(array_filter($address))->toBe(array_filter($contact->addresses[$index]));
    }

    // fromModel ensures the presence of key-value pairs by setting default values to null or []
    // When directly accessing array fields without existing key-value pairs, the resulting array will lack these keys
    // This discrepancy causes a mismatch in array structure and key count
    foreach ($data->employment->toArray() as $index => $employment) {
        //expect(array_filter($employment))->toBe($contact->employment[$index]);
    }

    foreach ($data->co_borrowers->toArray() as $index => $co_borrower) {
        expect(array_filter($co_borrower))->toBe(array_filter($contact->co_borrowers[$index]));
    }
    expect($data->order->toArray())->toBe($contact->toData()['order']);

    foreach (array_filter($data->uploads->toArray()) as $upload) {
        $name = $upload['name'];
        $url = $upload['url'];
        expect($contact->$name->getUrl())->toBe($url);
    }
    expect($data->uploads->toArray())->toBe($contact->uploads);
})->with('contact')->skip();

test('contact implements BorrowerInterface', function (Contact $contact) {
    expect($contact->getBirthdate())->toBeInstanceOf(Carbon::class);
    expect($contact->getBirthdate()->eq($contact->date_of_birth))->toBeTrue();
    expect($contact->getMobile()->equals($contact->mobile))->toBeTrue();
    expect($contact->getWages()->compareTo(Arr::get(collect($contact->employment)->firstWhere('type', 'buyer'), 'monthly_gross_income')))->toBe(0);
    $region = Arr::get($contact->addresses, '0.administrative_area');
    expect($contact->getRegional())->toBe(! ($region == 'NCR' || $region == 'Metro Manila'));
})->with('contact');

test('contact can login', function () {
    $contact = Contact::factory()->create();
//    $flatData = \Homeful\Contacts\Data\FlatData::fromModel($contact);
//    dd($flatData->exec_signatories, $flatData->exec_position,$flatData->exec_tin_no);
//    dd($flatData->spouse_tin_with_label);
    expect(auth()->user())->toBeNull();
    $this->actingAs($contact);
    expect(auth()->user()->is($contact))->toBeTrue();

});

test('conjure contact from metadata', function () {
    $array = [
        'first_name' => 'Lester',
        'last_name' => 'Hurtado',
        'mobile' => '09171234567',
        'email' => 'lester@hurtado.ph',
        'date_of_birth' => '1970-04-21',
    ];
    $metadata = \Homeful\Contacts\Classes\ContactMetaData::from($array);
    expect($metadata)->toBeInstanceOf(\Homeful\Contacts\Classes\ContactMetaData::class);
});
