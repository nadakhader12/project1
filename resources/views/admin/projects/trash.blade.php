@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'Trashed projects | ' . env('APP_NAME'))

@section('content')

    <h1>All Trashed projects</h1>
    @if (session('msg'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('msg') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>name</th>
                <th>image</th>
                <th>client</th>
                <th>category</th>
                <th>feature_id</th>
                <th>content</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($projects as $pro)
                    <td>{{ $pro->name }}</td>

                    <td><img width="80" src="{{ asset('uploads/projects/'.$pro->image) }}" alt=""></td>
                    <td>{{ $pro->client }}</td>
                    <td>{{ $pro->category }}</td>
                    <td>{{ $pro->feature_id }}</td>
                    <td>{{ $pro->content}}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.projects.edit', $pro->id) }}"><i class="fas fa-edit"></i></a>
                        <form class="d-inline" action="{{ route('admin.projects.destroy', $pro->id) }}" method="POST">
                            @csrf
                            @method('delete')
                        <button class="btn btn-danger" onclick="return confirm('Are you sure')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@stop
