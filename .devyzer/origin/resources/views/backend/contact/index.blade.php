@extends('backend.layouts.app')

@section('title', __(' Contacts'))

@section('breadcrumb-links')
    @include('backend.contact.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang(' Contacts')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link
                icon="c-icon cil-plus"
                class="card-header-action"
                :href="route('admin.contact.create')"
                :text="__('Create Contact')"
            />
        </x-slot>

        <x-slot name="body">
            <livewire:contact-table/>
        </x-slot>
    </x-backend.card>
@endsection