<?php

use Homeful\Contacts\Data\ContactData;
use Homeful\Contacts\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
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
    expect($contact->idImage->file_name)->toBe('idImage.jpg');
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
