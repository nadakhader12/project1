@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'process | ' . env('APP_NAME'))

@section('content')

    <h1>All process</h1>
    @if (session('msg'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('msg') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>

                <th>title</th>
                <th>Image</th>
                <th>content</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($processes as $proces)
                    <td>{{ $proces->title }}</td>

                    <td><img width="40" src="{{ asset('uploads/process/'.$proces->image) }}" alt=""></td>
                    <td>{{ $proces->content }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.process.edit', $proces->id) }}"><i class="fas fa-edit"></i></a>
                        <form class="d-inline" action="{{ route('admin.process.destroy', $proces->id) }}" method="POST">
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
