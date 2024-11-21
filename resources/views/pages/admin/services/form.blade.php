@extends('layouts.admin.app')

@section('content')
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-header">
                    {{ isset($service) ? 'Edit Service' : 'Create New Service' }}
                </div>
                <div class="card-body">
                    <!-- Form for create or edit service -->
                    {!! Form::open([
                        'route' => isset($service) ? ['services.update', $service->id] : 'services.store', 
                        'method' => isset($service) ? 'PUT' : 'POST', 
                        'enctype' => 'multipart/form-data'
                    ]) !!}

                    <div class="row">
                        <!-- Title Field -->
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('title', 'Title:') !!}
                                {!! Form::text('title', isset($service) ? $service->title : null, [
                                    'placeholder' => 'Enter Service Title',
                                    'class' => 'form-control',
                                    'required' => 'required',
                                ]) !!}
                            </div>
                        </div>

                        <!-- Description Field -->
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('description', 'Description:') !!}
                                {!! Form::textarea('description', isset($service) ? $service->description : null, [
                                    'placeholder' => 'Enter Service Description',
                                    'class' => 'form-control',
                                    'required' => 'required',
                                    'rows' => 4,
                                ]) !!}
                            </div>
                        </div>

                        <!-- First Button Name -->
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('first_btn_name', 'First Button Name:') !!}
                                {!! Form::text('first_btn_name', isset($service) ? $service->first_btn_name : null, [
                                    'placeholder' => 'Enter First Button Name',
                                    'class' => 'form-control',
                                    'required' => 'required',
                                ]) !!}
                            </div>
                        </div>

                        <!-- First Button Link -->
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('first_btn_link', 'First Button Link:') !!}
                                {!! Form::text('first_btn_link', isset($service) ? $service->first_btn_link : null, [
                                    'placeholder' => 'Enter First Button Link',
                                    'class' => 'form-control',
                                    'required' => 'required',
                                ]) !!}
                            </div>
                        </div>

                        <!-- Second Button Name -->
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('second_btn_name', 'Second Button Name:') !!}
                                {!! Form::text('second_btn_name', isset($service) ? $service->second_btn_name : null, [
                                    'placeholder' => 'Enter Second Button Name',
                                    'class' => 'form-control',
                                    'required' => 'required',
                                ]) !!}
                            </div>
                        </div>

                        <!-- Second Button Link -->
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('second_btn_link', 'Second Button Link:') !!}
                                {!! Form::text('second_btn_link', isset($service) ? $service->second_btn_link : null, [
                                    'placeholder' => 'Enter Second Button Link',
                                    'class' => 'form-control',
                                    'required' => 'required',
                                ]) !!}
                            </div>
                        </div>

                        <!-- Right Image Field -->
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('right_image', 'Right Image:') !!}
                                {!! Form::file('right_image', ['class' => 'form-control-file'] ) !!}
                                @isset($service) 
                                <small class="form-text text-muted">Leave blank if you don't want to update the image.</small>
                                    <img src="{{ asset('storage/' . $service->right_image_url) }}" alt="Current Image" width="100">
                                @endisset
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-12 d-flex justify-content-end">
                        {!! Form::submit(isset($service) ? 'Update' : 'Create', ['class' => 'btn btn-primary mt-3']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
