<?php

namespace App\Domains\Contact\Http\Controllers\Backend\Contact;

use App\Http\Controllers\Controller;
use App\Domains\Contact\Models\Contact;
use App\Domains\Contact\Services\ContactService;
use App\Domains\Contact\Http\Requests\Backend\Contact\DeleteContactRequest;
use App\Domains\Contact\Http\Requests\Backend\Contact\EditContactRequest;
use App\Domains\Contact\Http\Requests\Backend\Contact\StoreContactRequest;
use App\Domains\Contact\Http\Requests\Backend\Contact\UpdateContactRequest;

/**
 * Class ContactController.
 */
class ContactController extends Controller
{
    /**
     * @var ContactService
     */
    protected $contactService;

    /**
     * ContactController constructor.
     *
     * @param ContactService $contactService
     */
    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.contact.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.contact.create');
    }

    /**
     * @param StoreContactRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(StoreContactRequest $request)
    {
        $contact = $this->contactService->store($request->validated());

        return redirect()->route('admin.contact.show', $contact)->withFlashSuccess(__('The  Contacts was successfully created.'));
    }

    /**
     * @param Contact $contact
     *
     * @return mixed
     */
    public function show(Contact $contact)
    {
        return view('backend.contact.show')
            ->withContact($contact);
    }

    /**
     * @param EditContactRequest $request
     * @param Contact $contact
     *
     * @return mixed
     */
    public function edit(EditContactRequest $request, Contact $contact)
    {
        return view('backend.contact.edit')
            ->withContact($contact);
    }

    /**
     * @param UpdateContactRequest $request
     * @param Contact $contact
     *
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $this->contactService->update($contact, $request->validated());

        return redirect()->route('admin.contact.show', $contact)->withFlashSuccess(__('The  Contacts was successfully updated.'));
    }

    /**
     * @param DeleteContactRequest $request
     * @param Contact $contact
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy(DeleteContactRequest $request, Contact $contact)
    {
        $this->contactService->delete($contact);

        return redirect()->route('admin.$contact.deleted')->withFlashSuccess(__('The  Contacts was successfully deleted.'));
    }
}