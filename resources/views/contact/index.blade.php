@php
$title = 'Contacts';
@endphp

@extends('layouts.app', ['title' => $title, 'class' => 'contact-index'])

@section('content')
    <div class="contact-container">
        <div class="card">
            <div class="card-header d-flex flex-row">
                <div class="d-flex justify-content-end flex-fill">
                    <p class="card-title">{{ $title }}</p>
                </div>
                <div class="d-flex justify-content-end flex-fill">
                    <a href="{{ route('create') }}" class="btn btn-primary">Add Contact</a>
                </div>
            </div>
            <div class="card-body">
                @if (count($contacts))
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">ID</th>
                                <th scope="col" class="text-center">Name</th>
                                <th scope="col" class="text-center">Email</th>
                                <th scope="col" class="text-center">Contact</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $c)
                                <tr scope="row">
                                    <td class="text-center">{{ $c->id }}</td>
                                    <td class="text-center">{{ $c->name }}</td>
                                    <td class="text-center">{{ $c->email }}</td>
                                    <td class="text-center">{{ $c->contact }}</td>
                                    <td class="d-flex flex-row justify-content-center">
                                        <a href="{{ route('edit', $c->id) }}" class="btn btn-primary m-1"
                                            title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                        <a href="{{ route('info', $c->id) }}" class="btn btn-primary m-1"
                                            title="Show Contact Info"><i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                        <form action="{{ url('/contact') }}" method="post">
                                            @csrf()
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $c->id }}">
                                            <button type="submit" class="btn btn-danger m-1" title="Remove Contact"><i
                                                    class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {!! $contacts->links() !!}
                    </div>
                @else
                    <p>No Contacts Found</p>
                @endif
            </div>
        </div>
    </div>
@endsection
