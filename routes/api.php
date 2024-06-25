<?php


use Homeful\Contacts\Actions\{AttachContactMediaAction, PersistContactAction};
use Homeful\Contacts\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

Route::post('persist-contact', function (Request $request): \Illuminate\Http\JsonResponse {
    $contact = PersistContactAction::run($request->all());

    return response()->json([
        'code' => $contact->reference_code,
        'status' => $contact->exists,
    ]);
})
    ->prefix('api')
    ->middleware('api')
    ->name('persist-contact');

Route::post('attach-contact-media/{reference_code}', function (Request $request, string $reference_code): \Illuminate\Http\JsonResponse {
    $contact = app(Contact::class)->where('reference_code', $reference_code)->firstOrFail();
    $rules =  Arr::mapWithKeys(app(Contact::class)->getMediaFieldNames(), function (string $mediaFieldName) {
        return [
            $mediaFieldName => ['nullable', 'url']
        ];
    });
    $validated = Validator::make($request->all(), $rules)->validate();
    $contact = app(AttachContactMediaAction::class)->run($contact, $validated);

    return response()->json([
        'contact' => $contact->toData()
    ]);
})
    ->prefix('api')
    ->middleware('api')
    ->name('attach-contact-media');
