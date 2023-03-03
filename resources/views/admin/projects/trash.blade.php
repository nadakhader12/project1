@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'Trashed projects | ' . env('APP_NAME'))

@section('content')

    <h1>All Trashed project</h1>
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
                @foreach ($projects as $project)
                <td>
                    {{ $project->$name }}
                </td>
                    <td><img width="80" src="{{ asset('uploads/project/'.$project->image) }}" alt=""></td>
                    <td>
                        {{ $project->$client }}
                    </td>
                    <td>
                        {{ $project->$category}}
                    </td>
                    <td>
                        {{ $project->$feature_id}}
                    </td>
                    <td>
                        {{ $project->$content}}
                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.projects.edit', $project->id) }}"><i class="fas fa-edit"></i></a>
                        <form class="d-inline" action="{{ route('admin.projects.destroy', $project->id) }}" method="POST">
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
