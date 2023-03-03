@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'Trashed news | ' . env('APP_NAME'))

@section('content')

    <h1>All Trashed feature</h1>
    @if (session('msg'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('msg') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>title</th>
                <th>content</th>
                <th>image</th>
                <th>date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($news as $new)
                    <td>
                        {{ $new->$title }}
                    </td>
                    <td>{{ $new->content }}</td>
                    <td>{{ $new->date }}</td>
                    <td>{{ $new->image }}</td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.features.restore', $feature->id) }}"><i class="fas fa-undo"></i></a>
                        <form class="d-inline" action="{{ route('admin.features.forcedelete', $feature->id) }}" method="POST">
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
