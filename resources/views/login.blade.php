@php
$title = 'Login';
@endphp

@extends('layouts.app', ['title' => $title, 'class' => 'contact-form'])

@section('content')
    <div class="contact-container">
        <div class="card">
            <div class="card-header d-flex flex-row">
                <div class="d-flex justify-content-start flex-fill">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                </div>
                <div class="d-flex justify-content-start flex-fill">
                    <p class="card-title">{{ $title }}</p>
                </div>
            </div>
            <form action="{{ url('/login') }}" method="post">
                <div class="card-body">

                    @csrf()

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Insert a email">
                        <label for="email">Email address</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Insert a password">
                        <label for="password">Password</label>
                    </div>
                </div>
                <div class="card-footer d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-primary btn-lg btn-submit">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection
