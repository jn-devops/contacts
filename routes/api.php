<?php

use Homeful\Contacts\Actions\PersistContactAction;
use Illuminate\Support\Facades\Route;

Route::post('persist-contact', PersistContactAction::class)->middleware('api')
    ->name('persist-contact');
