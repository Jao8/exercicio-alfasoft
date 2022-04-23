@php
$title = 'Contact Info';
@endphp

@extends('layouts.app', ['title' => $title, 'class' => 'contact-info'])

@section('content')
    <div class="contact-container">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <p class="card-title">{{ $title }}</p>
                <div class="actions d-flex flex-row">
                    <a href="/contact/{{ $contact->id }}/edit" class="btn btn-primary">Edit</a>
                    <form action="{{ url('/contact') }}" method="post">
                        @csrf()
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{ $contact->id }}">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
            <div class="card-body">

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Name: {{ $contact->name }}</li>
                    <li class="list-group-item">Contact: {{ $contact->contact }}</li>
                    <li class="list-group-item">Email: {{ $contact->email }}</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
