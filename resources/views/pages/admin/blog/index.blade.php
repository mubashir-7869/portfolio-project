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
                    <p class="mb-0">All Blogs</p>

                    <a href="{{ route('blogs.create') }}" class="btn btn-sm btn-primary ms-auto" title="Create New Blog">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
                <div class="card-body">
                    <!-- Table for Blogs -->
                    <table class="table table-bordered table-striped" id="blogs-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Published Date</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Description</th>
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
        var table = $('#blogs-table').DataTable({
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
                'url': '{{ route('blogs.search') }}', // Adjust the route for your blogs' server-side processing
            },
            columns: [
                {
                    data: 'title', 
                    name: 'title'
                },
                {
                    data: 'author',
                    name: 'author'
                },
                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'image',
                    name: 'image',
                },
                {
                    data: 'description',
                    name: 'description',
                    orderable: false,
                    searchable: false,
                    render: function(data) {
                        return data.length > 50 ? data.substr(0, 50) + '...' : data;
                    }
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
    </script>
@endpush
