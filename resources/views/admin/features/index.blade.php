@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'features | ' . env('APP_NAME'))

@section('content')

    <h1>All features</h1>
    @if (session('msg'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('msg') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>title</th>
                <th>type</th>
                <th>icon</th>
                <th>content</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($features as $feat)
                    <td>{{ $feat->title }}</td>
                    <td>
                        {{ $feat->type }}
                    </td>

                    <td><img width="40" src="{{ asset('uploads/features/'.$feat->icon) }}" alt=""></td>
                    <td>{{ $feat->content}}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.features.edit', $feat->id) }}"><i class="fas fa-edit"></i></a>
                        <form class="d-inline" action="{{ route('admin.features.destroy', $feat->id) }}" method="POST">
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
