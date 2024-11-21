@extends('layouts.admin.app')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                {{ isset($socialLinks) ? 'Edit Social Links' : 'Create Social Links' }}
            </div>
            <div class="card-body">
                <!-- Form for create or edit -->
                {!! Form::open([
                    'url' => isset($socialLinks) ? url('social-links/update/' . $socialLinks->id) : 'social-links/store',
                    'method' => isset($socialLinks) ? 'PUT' : 'POST',
                ]) !!}

                <div class="row">

                    <!-- Facebook URL Field -->
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('icon', 'Icon:') !!}
                            {!! Form::text('icon', isset($socialLinks) ? $socialLinks->icon : null, [
                                'placeholder' => 'Enter Icon class (e.g., fa fa-home etc.)',
                                'required' => 'required',
                                'class' => 'form-control',
                            ]) !!}
                        </div>
                    </div>

                    <!-- Twitter URL Field -->
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('link', __('URL:')) !!}
                            {!! Form::url('link', isset($socialLinks) ? $socialLinks->link : null, [
                                'placeholder' => __('Enter URL'),
                                'required' => 'required',
                                'class' => 'form-control',
                            ]) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-12 d-flex justify-content-end">
                    {!! Form::submit(isset($socialLinks) ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection
