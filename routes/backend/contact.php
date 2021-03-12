<?php

use App\Domains\Contact\Http\Controllers\Backend\Contact\DeletedContactController;
use App\Domains\Contact\Http\Controllers\Backend\Contact\ContactController;
use App\Domains\Contact\Models\Contact;
use Tabuna\Breadcrumbs\Trail;

Route::group([
    'prefix' => 'contact',
    'as' => 'contact.',
], function () {

    Route::get('/', [ContactController::class, 'index'])
        ->name('index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.dashboard')
                ->push(__(' Contacts'), route('admin.contact.index'));
        });


    Route::get('deleted', [DeletedContactController::class, 'index'])
        ->name('deleted')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.contact.index')
                ->push(__('Deleted  Contacts'), route('admin.contact.deleted'));
        });


    Route::get('create', [ContactController::class, 'create'])
        ->name('create')
        ->breadcrumbs(function (Trail $trail) {
            $trail->parent('admin.contact.index')
                ->push(__('Create Contact'), route('admin.contact.create'));
        });

    Route::post('/', [ContactController::class, 'store'])->name('store');

    Route::group(['prefix' => '{contact}'], function () {
        Route::get('/', [ContactController::class, 'show'])
            ->name('show')
            ->breadcrumbs(function (Trail $trail, Contact $contact) {
                $trail->parent('admin.contact.index')
                    ->push($contact->id, route('admin.contact.show', $contact));
            });

        Route::get('edit', [ContactController::class, 'edit'])
            ->name('edit')
            ->breadcrumbs(function (Trail $trail, Contact $contact) {
                $trail->parent('admin.contact.show', $contact)
                    ->push(__('Edit'), route('admin.contact.edit', $contact));
            });

        Route::patch('/', [ContactController::class, 'update'])->name('update');
        Route::delete('/', [ContactController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => '{deletedContact}'], function () {
        Route::patch('restore', [DeletedContactController::class, 'update'])->name('restore');
        Route::delete('permanently-delete', [DeletedContactController::class, 'destroy'])->name('permanently-delete');
    });
});