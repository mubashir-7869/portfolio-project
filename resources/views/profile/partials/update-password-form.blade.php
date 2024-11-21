<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                {{ __('Update Password') }}
            </div>
            <div class="card-body">
                <!-- Password Update Form -->
                {!! Form::open([
                    'url' => route('password.update'),
                    'method' => 'PUT',
                ]) !!}

                <div class="row">
                    <!-- Current Password Field -->
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('current_password', __('Current Password:')) !!}
                            {!! Form::password('current_password', [
                                'placeholder' => __('Enter your current password'),
                                'class' => 'form-control',
                                'autocomplete' => 'current-password',
                                'required' => 'required'
                            ]) !!}
                            @error('current_password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- New Password Field -->
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('password', __('New Password:')) !!}
                            {!! Form::password('password', [
                                'placeholder' => __('Enter your new password'),
                                'class' => 'form-control',
                                'autocomplete' => 'new-password',
                                'required' => 'required'
                            ]) !!}
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('password_confirmation', __('Confirm Password:')) !!}
                            {!! Form::password('password_confirmation', [
                                'placeholder' => __('Confirm your new password'),
                                'class' => 'form-control',
                                'autocomplete' => 'new-password',
                                'required' => 'required'
                            ]) !!}
                            @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>

                <!-- Save Button -->
                <div class="col-md-12 d-flex justify-content-end">
                    {!! Form::submit(__('Save'), ['class' => 'btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}

                <!-- Success Message (Optional) -->
                @if (session('status') === 'password-updated')
                    <p class="mt-3 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('Password updated successfully.') }}
                    </p>
                @endif

            </div>
        </div>
    </div>
</div>

