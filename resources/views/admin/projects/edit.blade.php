@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'Edit project | ' . env('APP_NAME'))

@section('content')

    <h1>Edit project</h1>
    @include('admin.errors')
    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')


        <div class="mb-3">
            <label>name</label>
            <input type="text" name="name" placeholder="name" class="form-control" value="{{ $category->title }}">
        </div>

        <div class="mb-3">
            <label>image</label>
            <input type="file" name="image"  class="form-control">
            <img width="80" src="{{ asset('uploads/projects/'.$project->image) }}" alt="">
        </div>
        <div class="mb-3">
            <label>client</label>
            <input type="text" name="client" placeholder="client" class="form-control" value="{{ $category->type }}">
        </div>
        <div class="mb-3">
            <label>category</label>
            <input type="text" name="category" placeholder="category" class="form-control" value="{{ $category->type }}">
        </div>
        <div class="mb-3">
            <label>feature_id</label>
            <input type="text" name="feature_id" placeholder="feature_id" class="form-control" value="{{ $category->type }}">
        </div>
        <div class="mb-3">
            <label>content</label>
            <input type="text" name="content" placeholder="content" class="form-control" value="{{ $category->content }}">
        </div>

        <button class="btn btn-success px-5">Update</button>
    </form>

@stop
