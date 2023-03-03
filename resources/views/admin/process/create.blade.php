@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'Add New process | ' . env('APP_NAME'))

@section('content')

    <h1>Add new process</h1>
    @include('admin.errors')
    <form action="{{ route('admin.process.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>title</label>
            <input type="text" name="title" placeholder="title" class="form-control">
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image"  class="form-control">
        </div>

        <div class="mb-3">
            <label>content</label>
            <input type="text" name="content" placeholder="content" class="form-control">
        </div>

        <button class="btn btn-success px-5">Add</button>
    </form>

@stop
