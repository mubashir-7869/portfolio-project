
@extends('layouts.admin.app')
@push('header')
    <link href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="mb-0">All Services</p>
                    @if($services->isEmpty())
                    <a href="{{ route('services.create') }}" class="btn btn-sm btn-primary ms-auto" title="Add Service">
                        <i class="fas fa-plus"></i>
                    </a>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="whatwedo-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>First Button Name</th>
                                <th>First Button Link</th>
                                <th>Second Button Name</th>
                                <th>Second Button Link</th>
                                <th>Right Image</th>
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
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>

    <script>
        var table = $('#whatwedo-table').DataTable({
            'paging': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true,
            'processing': true,
            'serverSide': true,
            'stateSave': true,
            'responsive': true,
            'colReorder': true,
            'ajax': {
                'url': '{{ route('services.search') }}', // Adjust route for services
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'description',
                    name: 'description',
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
                    data: 'first_btn_name',
                    name: 'first_btn_name'
                },
                {
                    data: 'first_btn_link',
                    name: 'first_btn_link'
                },
                {
                    data: 'second_btn_name',
                    name: 'second_btn_name'
                },
                {
                    data: 'second_btn_link',
                    name: 'second_btn_link'
                },
                {
                    data: 'right_image_url',
                    name: 'right_image_url',
                    
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
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
    </script>
@endpush
