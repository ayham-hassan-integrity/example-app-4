<?php

namespace App\Domains\Contact\Http\Controllers\Backend\Contact;

use App\Http\Controllers\Controller;
use App\Domains\Contact\Models\Contact;
use App\Domains\Contact\Services\ContactService;

/**
 * Class DeletedContactController.
 */
class DeletedContactController extends Controller
{
    /**
     * @var ContactService
     */
    protected $contactService;

    /**
     * DeletedContactController constructor.
     *
     * @param  ContactService  $contactService
     */
    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.contact.deleted');
    }

    /**
     * @param  Contact  $deletedContact
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(Contact $deletedContact)
    {
        $this->contactService->restore($deletedContact);

        return redirect()->route('admin.contact.index')->withFlashSuccess(__('The  Contacts was successfully restored.'));
    }

    /**
     * @param  Contact  $deletedContact
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy(Contact $deletedContact)
    {
        $this->contactService->destroy($deletedContact);

        return redirect()->route('admin.contact.deleted')->withFlashSuccess(__('The  Contacts was permanently deleted.'));
    }
}