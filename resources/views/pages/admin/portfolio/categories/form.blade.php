{{ Form::open(['url' => $action, 'method' => $method]) }}
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('title', __('Category Title'), ['class' => 'col-form-label']) }}
                {{ Form::text('title', $category->title ?? null, ['class' => 'form-control', 'placeholder' => __('Enter Category Title')]) }}
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{ isset($category) ? __('Update') : __('Create') }}" class="btn  btn-primary">
</div>
{{ Form::close() }}