@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'Edit project | ' . env('APP_NAME'))

@section('content')

    <h1>Edit project</h1>
    @include('admin.errors')
    <form action="{{ route('admin.projects.update', $pro->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="mb-3">
            <label>name</label>
            <input type="text" name="name" placeholder="name" class="form-control" value="{{ $pro->name }}">
        </div>

        <div class="mb-3">
            <label>image</label>
            <input type="file" name="image"  class="form-control">
            <img width="40" src="{{ asset('uploads/projects/'.$pro->image) }}" alt="">
        </div>
        <div class="mb-3">
            <label>client</label>
            <input type="text" name="client" placeholder="client" class="form-control" value="{{ $pro->client }}">
        </div>
        <div class="mb-3">
            <label>category</label>
            <input type="text" name="category" placeholder="category" class="form-control" value="{{ $pro->category }}">
        </div>
        <div class="mb-3">
            <label>feature</label>
            {{ config('app.transname') }}
            <select name="feature_id" class="form-control">

                <option value="">Select</option>
                @foreach ($projects as $item)
                    <option {{ $pro->feature_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>content</label>
            <input type="text" name="content" placeholder="content" class="form-control" value="{{ $pro->content }}">
        </div>
        <button class="btn btn-success px-5">update</button>
    </form>

@stop
