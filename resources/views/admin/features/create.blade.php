(35 sloc)  1.3 KB

@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'features | ' . env('APP_NAME'))

@section('content')

    <h1>Add new features</h1>
    @include('admin.errors')
    <form action="{{ route('admin.features.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>title</label>
            <input type="text" name="title" placeholder="title" class="form-control">
        </div>
        <div class="mb-3">
            <label>type</label>
            <select name="type" class="form-control">

                <option value="feature">features</option>
                <option value="service">services</option>

            </select>
        </div>

        <div class="mb-3">
            <label>Icon</label>
            <input type="file" name="icon"  class="form-control">
        </div>
        <div class="mb-3">
            <label>content</label>
            <input type="text" name="content" placeholder="content" class="form-control">
        </div>
        <button class="btn btn-success px-5">Add</button>
    </form>

@stop
