@extends('layouts.admin.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ isset($portfolio) ? 'Edit Portfolio Item' : 'Create Portfolio Item' }}
                </div>
                <div class="card-body">
                    <!-- Form for create or edit -->
                    {!! Form::open([
                        'url' => isset($portfolio) ? url('portfolio/update/' . $portfolio->id) : route('portfolio.store'),
                        'method' => isset($portfolio) ? 'PUT' : 'POST',
                        'enctype' => 'multipart/form-data',
                    ]) !!}

                    <div class="row">
                        <!-- Title Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('title', __('Title:')) !!}
                                {!! Form::text('title', isset($portfolio) ? $portfolio->title : null, [
                                    'placeholder' => __('Enter Portfolio Title'),
                                    'required' => 'required',
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                        </div>

                        <!-- Image Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('image', __('Image:')) !!}
                                {!! Form::file('image', [
                                    'class' => 'form-control',
                                ]) !!}


                                <!-- Display current image if available -->
                                @if (isset($portfolio) && $portfolio->image)
                                    <small class="form-text text-muted">Leave blank if you don't want to update the
                                        image.</small>
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $portfolio->image) }}" alt="Current Image"
                                            width="100">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-12 d-flex justify-content-end">
                        {!! Form::submit(isset($portfolio) ? 'Update' : 'Create', ['class' => 'btn btn-primary mt-3']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
