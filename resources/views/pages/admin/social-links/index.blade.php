@extends('layouts.admin.app')

@push('header')
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p class="mb-0">All Social Links</p>

                    <a href="{{ url('social-links/create') }}" class="btn btn-sm btn-primary ms-auto" title="Add Social Link">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="social-links-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Icon</th>
                                <th>URL</th>
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
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>

    <script>
        var table = $('#social-links-table').DataTable({
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
                'url': '{{ route('social-links.search') }}',  // Adjust the route as needed
            },
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'icon',
                    name: 'icon'
                },
                {
                    data: 'link',
                    name: 'link'
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
           
        });
    </script>
@endpush
