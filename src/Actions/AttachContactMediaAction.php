<?php

namespace Homeful\Contacts\Actions;

use Homeful\Contacts\Models\Contact;
use Illuminate\Support\Arr;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class AttachContactMediaAction
{
    use AsAction;

    public function handle(Contact $contact, array $attribs): Contact
    {
        $contact->update($attribs);
        $contact->save();

        return $contact;
    }

    public function rules(): array
    {
        return Arr::mapWithKeys(app(Contact::class)->getMediaFieldNames(), function (string $mediaFieldName) {
            return [
                $mediaFieldName => ['nullable', 'url'],
            ];
        });
    }

    public function asController(string $reference_code, ActionRequest $request): \Illuminate\Http\JsonResponse
    {
        $contact = Contact::where('reference_code', $reference_code)->firstOrFail();
        $contact = $this->handle($contact, $request->validated());

        return response()->json([
            'contact' => $contact->toData(),
        ]);
    }
}
