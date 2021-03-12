@extends('backend.layouts.app')

@section('title', __('Deleted Contacts'))

@section('breadcrumb-links')
    @include('backend.contact.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Deleted Contacts')
        </x-slot>

        <x-slot name="body">
            <livewire:contact-table status="deleted" />
        </x-slot>
    </x-backend.card>
@endsection