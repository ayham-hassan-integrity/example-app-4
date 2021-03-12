<?php

namespace App\Domains\Contact\Services;

use App\Domains\Contact\Models\Contact;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class ContactService.
 */
class ContactService extends BaseService
{
    /**
     * ContactService constructor.
     *
     * @param Contact $contact
     */
    public function __construct(Contact $contact)
    {
        $this->model = $contact;
    }

    /**
     * @param array $data
     *
     * @return Contact
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Contact
    {
        DB::beginTransaction();

        try {
            $contact = $this->model::create([
                'name' => $data['name'],
                'description' => $data['description'],
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem creating this contact. Please try again.'));
        }

        DB::commit();

        return $contact;
    }

    /**
     * @param Contact $contact
     * @param array $data
     *
     * @return Contact
     * @throws \Throwable
     */
    public function update(Contact $contact, array $data = []): Contact
    {
        DB::beginTransaction();

        try {
            $contact->update([
                'name' => $data['name'],
                'description' => $data['description'],
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem updating this contact. Please try again.'));
        }

        DB::commit();

        return $contact;
    }

    /**
     * @param Contact $contact
     *
     * @return Contact
     * @throws GeneralException
     */
    public function delete(Contact $contact): Contact
    {
        if ($this->deleteById($contact->id)) {
            return $contact;
        }

        throw new GeneralException('There was a problem deleting this contact. Please try again.');
    }

    /**
     * @param Contact $contact
     *
     * @return Contact
     * @throws GeneralException
     */
    public function restore(Contact $contact): Contact
    {
        if ($contact->restore()) {
            return $contact;
        }

        throw new GeneralException(__('There was a problem restoring this  Contacts. Please try again.'));
    }

    /**
     * @param Contact $contact
     *
     * @return bool
     * @throws GeneralException
     */
    public function destroy(Contact $contact): bool
    {
        if ($contact->forceDelete()) {
            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this  Contacts. Please try again.'));
    }
}