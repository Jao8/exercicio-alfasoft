@php
$title = 'Contact Info';
@endphp

@extends('layouts.app', ['title' => $title, 'class' => 'contact-info'])

@section('content')
    <div class="contact-container">
        <div class="card">
            <div class="card-header">
                <p class="card-title d-flex justify-content-center">{{ $title }}</p>
            </div>
            <div class="card-body">

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Name: {{ $contact->name }}</li>
                    <li class="list-group-item">Contact: {{ $contact->contact }}</li>
                    <li class="list-group-item">email: {{ $contact->email }}</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
