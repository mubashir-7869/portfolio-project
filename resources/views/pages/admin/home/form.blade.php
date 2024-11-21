@extends('layouts.admin.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ isset($slider) ? 'Edit Home Page Slider' : 'Create Home Page Slider' }}
                </div>
                <div class="card-body">
                    <!-- Form for create or edit -->
                    {!! Form::open([
                        'url' => isset($slider) ? url('slider/update/' . $slider->id) : 'slider/store',
                        'method' => isset($slider) ? 'PUT' : 'POST',
                        'enctype' => 'multipart/form-data'
                    ]) !!}

                    <div class="row">
                        <!-- Subtitle Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('slideSubtitle', __('Subtitle :')) !!}
                                {!! Form::text('slideSubtitle', isset($slider) ? $slider->slide_subtitle : null, [
                                    'placeholder' => __('Enter Subtitle'),
                                    'required' => 'required',
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                        </div>

                        <!-- Title Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('slideTitle', __('Title:')) !!}
                                {!! Form::text('slideTitle', isset($slider) ? $slider->slide_title : null, [
                                    'placeholder' => __('Enter Title'),
                                    'required' => 'required',
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                        </div>

                        <!-- Description Field -->
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('slideDescription', __('Description (p):')) !!}
                                {!! Form::textarea('slideDescription', isset($slider) ? $slider->slide_description : null, [
                                    'placeholder' => __('Enter Description'),
                                    'required' => 'required',
                                    'class' => 'form-control',
                                    'rows' => 4,
                                ]) !!}
                            </div>
                        </div>

                        <!-- Button Name Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('buttonName', __('Button Name:')) !!}
                                {!! Form::text('buttonName', isset($slider) ? $slider->button_name : null, [
                                    'placeholder' => __('Enter Button Name'),
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                        </div>

                        <!-- Button Link Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('buttonLink', __('Button Link:')) !!}
                                {!! Form::text('buttonLink', isset($slider) ? $slider->button_link : null, [
                                    'placeholder' => __('Enter Button Link'),
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                        </div>

                        <!-- Image Upload Field -->
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('image', __('Background Image:')) !!}
                                {!! Form::file('image', [
                                    'class' => 'form-control',
                                    isset($slider) ? '' : 'required' => 'required', 
                                ]) !!}
                                @if(isset($slider) && $slider->image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $slider->slide_image) }}" width="150px" height="auto" alt="Slider Image">
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-12 d-flex justify-content-end">
                        {!! Form::submit(isset($slider) ? 'Update':'Create', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
