@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'Edit feature | ' . env('APP_NAME'))

@section('content')

    <h1>Edit feature</h1>
    @include('admin.errors')
    <form action="{{ route('admin.features.update', $feat->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="mb-3">
            <label>title</label>
            <input type="text" name="title" placeholder="title" class="form-control" value="{{ $feat->title }}">
        </div>

        <div class="mb-3">
            <label>type</label>
            <select name="type" class="form-control" >

                <option value="feature">features</option>
                <option value="service">services</option>

            </select>
        </div>
        <div class="mb-3">
            <label>Icon</label>
            <input type="file" name="icon"  class="form-control">
            <img width="40" src="{{ asset('uploads/features/'.$feat->icon) }}" alt="">
        </div>

        <div class="mb-3">
            <label>content</label>
            <input type="text" name="content" placeholder="content" class="form-control" value="{{ $feat->content }}">
        </div>
        <button class="btn btn-success px-5">Update</button>
    </form>

@stop
