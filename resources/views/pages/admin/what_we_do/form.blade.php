@extends('layouts.admin.app')



@section('content')
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-header">
                    {{ isset($whatWeDo) ? 'Edit What We Do' : 'What We Do' }}
                </div>
                <div class="card-body">
                    <!-- Dynamic Form -->
                    {!! Form::open([
                        'url' => isset($whatWeDo) ? url('whatwedo/update/' . $whatWeDo->id) : 'whatwedo/store',
                        'method' => isset($whatWeDo) ? 'PUT' : 'POST',
                        'enctype' => 'multipart/form-data',
                    ]) !!}

                    <div class="row">
                        <!-- Icon Field -->
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('icon', 'Icon:') !!}
                                {!! Form::text('icon', isset($whatWeDo) ? $whatWeDo->icon : null, [
                                    'placeholder' => 'Enter Icon name (e.g., home, star, etc.)',
                                    'required' => 'required',
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                        </div>

                        <!-- Title Field -->
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('title', 'Title:') !!}
                                {!! Form::text('title', isset($whatWeDo) ? $whatWeDo->title : null, [
                                    'placeholder' => 'Enter Service Title',
                                    'required' => 'required',
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                        </div>

                        <!-- Description Field -->
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('description', 'Description:') !!}
                                {!! Form::textarea('description', isset($whatWeDo) ? $whatWeDo->description : null, [
                                    'placeholder' => 'Enter Service Description',
                                    'required' => 'required',
                                    'class' => 'form-control',
                                    'rows' => 4,
                                ]) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-12 d-flex justify-content-end">
                        {!! Form::submit(__('Submit'), ['class' => 'btn btn-primary mt-3']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
