<?php

use Homeful\Contacts\Actions\PersistContactAction;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
