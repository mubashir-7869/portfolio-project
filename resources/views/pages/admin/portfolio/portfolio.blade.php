<table class="table table-bordered table-striped" id="portfolio-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Image</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
    </thead>
</table>

@push('scripts')

<script>
$(document).on('change', '.categoryDropdown', function() {
        var rowId = $(this).data('id');
        var selectedStatus = $(this).val();
        $.ajax({
            url: '{{ url('/portfolio/update-category') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                rowId: rowId,
                categoryId: selectedStatus
            },
            success: function(result) {
                toastr.success('Category updated successfully');
            },
            error: function(jqXHR, exception) {
                toastr.error('Failed to update data');
            }
        });
    });

    </script>
    @endpush