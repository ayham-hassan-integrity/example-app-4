<?php

namespace App\Domains\Contact\Observers;

use App\Domains\Contact\Models\Contact;

/**
 * Class ContactObserver.
 */
class ContactObserver
{
    /**
     * @param  Contact  $contact
     */
    public function created(Contact $contact): void
    {

    }

    /**
     * @param  Contact  $contact
     */
    public function updated(Contact $contact): void
    {

    }

}
