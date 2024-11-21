@extends('layouts.admin.app')

@push('header')
    <!-- Include DataTables styles -->
    <link href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="mb-0">Contact Messages</p>
                    <div class="ms-auto" style="width: 250px;">
                        {{ Form::date('status', null, ['id' => 'status_filter', 'class' => 'form-control select2',  'data-placeholder' => 'Please select date']) }}
                        </div>
                </div>
                <div class="card-body">
                    <!-- Table for Contact Messages -->
                    <table class="table table-bordered table-striped" id="messages-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Sent At</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Include DataTables scripts -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>

    <script>
        var table = $('#messages-table').DataTable({
            'paging': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true,
            'processing': true,
            'serverSide': true,
            'stateSave': true,
            'responsive': true,
            'ajax': {
                'url': '{{ route('contact.search') }}', 
                'data': function(d) {
                        d.date = $('#status_filter').val();
                    }
            },
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'message',
                    name: 'message',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        if (data !== null) {

                            return '<span data-toggle="tooltip" data-placement="top" title="' + data +
                                '">' +
                                (data.length > 50 ? data.substr(0, 50) + '...' : data) + '</span>';
                        } else {
                            return '';
                        }
                    }
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                },
                {
                    data: 'status',
                    name: 'status',
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false,
                }
            ],
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
           
            drawCallback: function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });
        $(document).on('change', '#status_filter', function() {
                table.draw();
            });
    </script>
@endpush
