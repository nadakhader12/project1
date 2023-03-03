@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'Edit new | ' . env('APP_NAME'))

@section('content')

    <h1>Edit new</h1>
    @include('admin.errors')
    <form action="{{ route('admin.news.update', $new->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')


        <div class="mb-3">
            <label>title</label>
            <input type="text" name="title" placeholder="title" class="form-control" value="{{ $category->title }}">
        </div>

        <div class="mb-3">
            <label>content</label>
            <input type="text" name="content" placeholder="content" class="form-control" value="{{ $category->content }}">
        </div>
        <div class="mb-3">
            <label>date</label>
            <input type="date" name="date" placeholder="date" class="form-control" value="{{ $category->type }}">
        </div>
        <div class="mb-3">
            <label>image</label>
            <input type="file" name="image"  class="form-control">
            <img width="80" src="{{ asset('uploads/news/'.$new->image) }}" alt="">
        </div>
        <button class="btn btn-success px-5">Update</button>
    </form>

@stop
