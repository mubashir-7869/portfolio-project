@extends('layouts.admin.app')

@section('content')
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-header">
                    {{ isset($blog) ? 'Edit Blog' : 'Create New Blog' }}
                </div>
                <div class="card-body">
                    <!-- Form for create or edit blog -->
                    {!! Form::open([
                        'route' => isset($blog) ? ['blogs.update', $blog->id] : 'blogs.store', 
                        'method' => isset($blog) ? 'PUT' : 'POST', 
                        'enctype' => 'multipart/form-data'
                    ]) !!}

                    <div class="row">
                        <!-- Title Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('title', 'Title:') !!}
                                {!! Form::text('title', isset($blog) ? $blog->title : null, [
                                    'placeholder' => 'Enter Blog Title',
                                    'class' => 'form-control',
                                    'required' => 'required',
                                ]) !!}
                            </div>
                        </div>

                        <!-- Author Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('author', 'Author:') !!}
                                {!! Form::text('author', isset($blog) ? $blog->author : null, [
                                    'placeholder' => 'Enter Author Name',
                                    'class' => 'form-control',
                                    'required' => 'required',
                                ]) !!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('description', 'Description:') !!}
                                {!! Form::textarea('description', isset($blog) ? $blog->description : null, [
                                    'placeholder' => 'Enter Blog Description',
                                    'class' => 'form-control',
                                    'required' => 'required',
                                    'rows' => 4,
                                ]) !!}
                            </div>
                        </div>
                        <!-- Date Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('date', 'Published Date:') !!}
                                {!! Form::date('date', isset($blog) ? $blog->date : null, [
                                    'class' => 'form-control',
                                    'required' => 'required',
                                ]) !!}
                            </div>
                        </div>

                        <!-- Category Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('category', 'Category:') !!}
                                {!! Form::text('category', isset($blog) ? $blog->category : null, [
                                    'placeholder' => 'Enter Blog Category',
                                    'class' => 'form-control',
                                    'required' => 'required',
                                ]) !!}
                            </div>
                        </div>

                        <!-- Image Field -->
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('image', 'Image:') !!}
                                {!! Form::file('image', ['class' => 'form-control-file']) !!}
                                @isset($blog) 
                                    <small class="form-text text-muted">Leave blank if you don't want to update the image.</small>
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="Current Image" width="100">
                                @endisset
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-12 d-flex justify-content-end">
                        {!! Form::submit(isset($blog) ? 'Update Blog' : 'Create Blog', ['class' => 'btn btn-primary mt-3']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
