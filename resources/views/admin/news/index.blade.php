@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'news | ' . env('APP_NAME'))

@section('content')

    <h1>All new</h1>
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
                <th>date</th>
                <th>image</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($news as $new)
                    <td>
                        {{ $new->$title }}
                    </td>
                    <td>
                        {{ $new->$content}}
                    </td>
                    <td>
                        {{ $new->$date }}
                    </td>
                    <td><img width="80" src="{{ asset('uploads/new/'.$new->icon) }}" alt=""></td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.news.edit', $new->id) }}"><i class="fas fa-edit"></i></a>
                        <form class="d-inline" action="{{ route('admin.news.destroy', $new->id) }}" method="POST">
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
