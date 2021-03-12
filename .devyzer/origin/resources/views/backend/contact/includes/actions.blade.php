@if (
    $contact->trashed()
)
    <x-utils.form-button
        :action="route('admin.contact.restore', $contact)"
        method="patch"
        button-class="btn btn-info btn-sm"
        icon="fas fa-sync-alt"
        name="confirm-item"
    >
        @lang('Restore')
    </x-utils.form-button>

    <x-utils.delete-button
        :href="route('admin.contact.permanently-delete', $contact)"
        :text="__('Permanently Delete')"/>
@else
    <x-utils.view-button :href="route('admin.contact.show', $contact)"/>
    <x-utils.edit-button :href="route('admin.contact.edit', $contact)"/>
    <x-utils.delete-button :href="route('admin.contact.destroy', $contact)"/>
@endif