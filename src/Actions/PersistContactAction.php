<?php

namespace Homeful\Contacts\Actions;

use Homeful\Contacts\Events\ContactPersisted;
use Homeful\Contacts\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class PersistContactAction
{
    use AsAction;

    protected function persist(array $validated): Contact
    {
        return tap(new Contact($validated), function ($contact) use ($validated){
            $contact = Contact::updateOrCreate(
                ['reference_code' => $validated['reference_code']], // Unique identifier, adjust as needed
                $validated
            );
            ContactPersisted::dispatch($contact);
        });
    }

    public function handle(array $attribs): Contact
    {
        $validated = Validator::validate($attribs, $this->rules());

        return $this->persist($validated);
    }

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'reference_code' => ['nullable', 'string'],

            'first_name' => ['required', 'string'],
            'middle_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'civil_status' => ['required', 'string'],
            'sex' => ['required', 'string'],
            'nationality' => ['required', 'string'],
            'date_of_birth' => ['required', 'date'],
            'email' => ['required', 'string'],
            'mobile' => ['required', 'string'],

            'addresses' => ['required', 'array'],
            'addresses.*.type' => ['required', 'string'],
            'addresses.*.ownership' => ['required', 'string'],
            'addresses.*.full_address' => ['nullable', 'string'],
            'addresses.*.address1' => ['nullable', 'string'], //improve this, required if full address
            'addresses.*.address2' => ['nullable', 'string'],
            'addresses.*.sublocality' => ['nullable', 'string'],
            'addresses.*.locality' => ['nullable', 'string'], //improve this, required if full address
            'addresses.*.administrative_area' => ['nullable', 'string'],
            'addresses.*.postal_code' => ['nullable', 'string'],
            'addresses.*.sorting_code' => ['nullable', 'string'],
            'addresses.*.country' => ['required', 'string'],

            'spouse' => ['nullable', 'array'],
            'spouse.first_name' => ['required_with:spouse', 'string'],
            'spouse.middle_name' => ['required_with:spouse', 'string'],
            'spouse.last_name' => ['required_with:spouse', 'string'],
            'spouse.civil_status' => ['required_with:spouse', 'string'],
            'spouse.sex' => ['required_with:spouse', 'string'],
            'spouse.nationality' => ['required_with:spouse', 'string'],
            'spouse.date_of_birth' => ['required_with:spouse', 'string'],
            'spouse.email' => ['required_with:spouse', 'string'],
            'spouse.mobile' => ['required_with:spouse', 'string'],

            'employment' => ['nullable', 'array'],
            'employment.employment_status' => ['required_with:employment', 'string'],
            'employment.monthly_gross_income' => ['required_with:employment', 'string'],
            'employment.current_position' => ['required_with:employment', 'string'],
            'employment.employment_type' => ['required_with:employment', 'string'],
            'employment.employer' => ['required_with:employment', 'array'],
            'employment.employer.name' => ['required_with:employment.employer', 'string'],
            'employment.employer.industry' => ['required_with:employment.employer', 'string'],
            'employment.employer.nationality' => ['required_with:employment.employer', 'string'],
            'employment.employer.address' => ['required_with:employment.employer', 'array'],
            'employment.employer.address.type' => ['required_with:employment.employer.address', 'string'],
            'employment.employer.address.ownership' => ['required_with:employment.employer.address', 'string'],
            'employment.employer.address.address1' => ['required_with:employment.employer.address', 'string'],
            'employment.employer.address.locality' => ['required_with:employment.employer.address', 'string'],
            'employment.employer.address.postal_code' => ['required_with:employment.employer.address', 'string'],
            'employment.employer.address.country' => ['required_with:employment.employer.address', 'string'],
            'employment.employer.contact_no' => ['required_with:employment.employer', 'string'],
            'employment.id' => ['required', 'array'],
            'employment.id.tin' => ['required_without_all:employment.id.pagibig,employment.id.sss,employment.id.gsis', 'string'],
            'employment.id.pagibig' => ['required_without_all:employment.id.tin,employment.id.sss,employment.id.gsis', 'string'],
            'employment.id.sss' => ['required_without_all:employment.id.tin,employment.id.pagibig,employment.id.gsis', 'string'],
            'employment.id.gsis' => ['required_without_all:employment.id.tin,employment.id.pagibig,employment.id.sss', 'string'],

            'co_borrowers' => ['nullable', 'array'],
            'co_borrowers.*.first_name' => ['required_with:co_borrowers', 'string'],
            'co_borrowers.*.middle_name' => ['required_with:co_borrowers', 'string'],
            'co_borrowers.*.last_name' => ['required_with:co_borrowers', 'string'],
            'co_borrowers.*.civil_status' => ['required_with:co_borrowers', 'string'],
            'co_borrowers.*.sex' => ['required_with:co_borrowers', 'string'],
            'co_borrowers.*.nationality' => ['required_with:co_borrowers', 'string'],
            'co_borrowers.*.date_of_birth' => ['required_with:co_borrowers', 'string'],
            'co_borrowers.*.email' => ['required_with:co_borrowers', 'string'],
            'co_borrowers.*.mobile' => ['required_with:co_borrowers', 'string'],

            'order' => ['nullable', 'array'],
            'order.sku' => ['nullable', 'string'],
            'order.seller_commission_code' => ['nullable', 'string'],
            'order.property_code' => ['nullable', 'string'],

            'order.company_name' => ['nullable', 'string'],
            'order.project_name' => ['nullable', 'string'],
            'order.project_code' => ['nullable', 'string'],
            'order.property_name' => ['nullable', 'string'],
            'order.phase' => ['nullable', 'string'],
            'order.block' => ['nullable', 'numeric'],
            'order.lot' => ['nullable', 'numeric'],
            'order.lot_area' => ['nullable', 'numeric'],
            'order.floor_area' => ['nullable', 'numeric'],
            'order.tcp' => ['nullable', 'numeric'],
            'order.loan_term' => ['nullable', 'numeric'],
            'order.loan_interest_rate' => ['nullable', 'numeric'],
            'order.tct_no' => ['nullable', 'string'],
            'order.project_location' => ['nullable', 'string'],
            'order.project_address' => ['nullable', 'string'],
            'order.mrif_fee' => ['nullable', 'numeric'],
            'order.reservation_rate' => ['nullable', 'numeric'],
        ];
    }

    public function asController(ActionRequest $request): \Illuminate\Http\JsonResponse
    {
        $contact = $this->persist($request->validated());

        return response()->json([
            'code' => $contact->reference_code,
            'status' => $contact->exists,
        ]);
    }
}
