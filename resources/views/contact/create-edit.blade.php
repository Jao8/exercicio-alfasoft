@php
$isEdit = str_contains(Request::url(), 'edit');
$title = $isEdit ? 'Edit Contact' : 'New Contact';
@endphp

@extends('layouts.app', ['title' => $title, 'class' => 'contact-form'])

@section('content')

    <div class="contact-container">
        <div class="card">
            <div class="card-header">
                <p class="card-title d-flex justify-content-center">{{ $title }}</p>
            </div>
            <form action="{{ url('contact') }}" method="post">
                <div class="card-body">

                    @method($isEdit ? "PUT":"POST")
                    @csrf()

                    <input type="hidden" name="id" value="{{ isset($contact->id) ? $contact->id : ''}}">

                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Insert a name"
                            value="{{ isset($contact->name) ? $contact->name : '' }}">
                        <label for="name">Name</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="contact" class="form-control" name="contact" id="contact"
                            placeholder="Insert a contact" value="{{ isset($contact->contact) ? $contact->contact : '' }}">
                        <label for="contact">Contact</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Insert a email"
                            value="{{ isset($contact->email) ? $contact->email : '' }}">
                        <label for="email">Email address</label>
                    </div>

                </div>
                <div class="card-footer d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-primary btn-lg btn-submit">{{ $isEdit ? 'Update' : 'Create' }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
