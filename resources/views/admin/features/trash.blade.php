@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'Trashed features | ' . env('APP_NAME'))

@section('content')

    <h1>All Trashed features</h1>
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
                    <td>{{ $feat->id }}</td>
                    <td>
                        {{ $feat->$title}}
                    </td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.features.restore', $feat->id) }}"><i class="fas fa-undo"></i></a>
                        <form class="d-inline" action="{{ route('admin.features.forcedelete', $feat->id) }}" method="POST">
                            @csrf
                            @method('delete')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure')"><i class="fas fa-times"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@stop
