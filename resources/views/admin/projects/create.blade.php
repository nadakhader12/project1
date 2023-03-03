@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'Add New Feature | ' . env('APP_NAME'))

@section('content')

    <h1>Add new project</h1>
    @include('admin.errors')
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>name</label>
            <input type="text" name="name" placeholder="name" class="form-control">
        </div>
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image"  class="form-control">
            <div class="mb-3">
                <label>client</label>
                <input type="text" name="client" placeholder="client" class="form-control">
            </div>
            <div class="mb-3">
                <label>category</label>
                <input type="text" name="category" placeholder="category" class="form-control">
            </div>
            <div class="mb-3">
                <label>feature_id</label>
                <input type="number" name="feature_id" placeholder="feature_id" class="form-control">
            </div>
            <div class="mb-3">
                <label>content</label>
                <input type="text" name="content" placeholder="content" class="form-control">
            </div>

        <button class="btn btn-success px-5">Add</button>
    </form>

@stop
