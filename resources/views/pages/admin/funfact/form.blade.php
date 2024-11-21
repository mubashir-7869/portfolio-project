@extends('layouts.admin.app')

@section('content')
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-header">
                    {{ isset($funfact) ? 'Edit Fun Fact' : 'Create New Fun Fact' }}
                </div>
                <div class="card-body">
                    <!-- Form for create or edit fun fact -->
                    {!! Form::open([
                        'route' => isset($funfact) ? ['funfacts.update', $funfact->id] : 'funfacts.store',
                        'method' => isset($funfact) ? 'PUT' : 'POST',
                        'enctype' => 'multipart/form-data'
                    ]) !!}

                    <div class="row">
                        <!-- Label Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('label', 'Label:') !!}
                                {!! Form::text('label', isset($funfact) ? $funfact->label : null, [
                                    'placeholder' => 'Enter Fun Fact Label',
                                    'class' => 'form-control',
                                    'required' => 'required',
                                ]) !!}
                            </div>
                        </div>

                        <!-- Count Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('count', 'Count:') !!}
                                {!! Form::number('count', isset($funfact) ? $funfact->count : null, [
                                    'placeholder' => 'Enter Count Value',
                                    'class' => 'form-control',
                                    'required' => 'required',
                                    'min' => 0,  // Ensure count is a non-negative number
                                ]) !!}
                            </div>
                        </div>

                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-12 d-flex justify-content-end">
                        {!! Form::submit(isset($funfact) ? 'Update' : 'Create', ['class' => 'btn btn-primary mt-3']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
