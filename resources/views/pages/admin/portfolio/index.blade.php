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
                    <p class="mb-0">All Portfolio Items</p>
                    <a href="{{ route('portfolio.create') }}" id="create-portfolio" class="btn btn-sm btn-primary ms-auto"
                        title="Create Portfolio Item">
                        <i class="fas fa-plus"></i>
                    </a>
                    <a id="create-category" class="btn btn-sm btn-primary ms-auto d-none" title="Create  Category"
                        data-url="{{ route('category.create') }}" data-size="small" data-ajax-popup="true"
                        data-title="{{ __('Create New Category') }}" data-bs-toggle="tooltip">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="portfolioTabs">
                        <li class="nav-item">
                            <a class="nav-link active" id="portfolioBtn" data-bs-toggle="tab" href="#portfolio"
                                aria-selected="true">Portfolio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="categoryBtn" data-bs-toggle="tab" href="#category"
                                aria-selected="false">Category</a>
                        </li>
                    </ul>

                    <!-- Tab content -->
                    <div class="tab-content mt-3">
                        <div class="tab-pane fade show active" id="portfolio" role="tabpanel"
                            aria-labelledby="portfolio-tab">
                            @include('pages.admin.portfolio.portfolio')
                        </div>
                        <div class="tab-pane fade" id="category" role="tabpanel" aria-labelledby="category-tab">
                            <table class="table table-bordered table-striped" id="category-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
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
        function portfolioData() {
            if ($.fn.dataTable.isDataTable('#portfolio-table')) {
                $('#portfolio-table').DataTable().destroy();
            }

            var categories = @json($categories);
            var table = $('#portfolio-table').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: true,
                processing: true,
                serverSide: true,
                stateSave: true,
                responsive: true,
                colReorder: true,
                ajax: '{{ route('portfolio.search') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'category_id',
                        name: 'category_id',
                        orderable: false,
                        searchable: false,
                        width: '10%',
                        render: function(data, type, row, meta) {
                            var dropdownOptions = '<option value="">Please select category</option>';
                            categories.forEach(function(category) {
                                var selected = (parseInt(category.id) === parseInt(row
                                    .category_id)) ? 'selected' : ''; 
                                dropdownOptions +=
                                    `<option value="${category.id}" ${selected}>${category.title}</option>`;
                            });
                            return `<select class="custom-select form-control-sm categoryDropdown" data-id="${row.id}">${dropdownOptions}</select>`;
                        }
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
        }

        // Initialize DataTable for Categories
        function categoryData() {
            if ($.fn.dataTable.isDataTable('#category-table')) {
                $('#category-table').DataTable().destroy();
            }
            $('#category-table').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: true,
                processing: true,
                serverSide: true,
                stateSave: true,
                responsive: true,
                colReorder: true,
                ajax: '{{ route('category.search') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'title',
                        name: 'title'
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
        }

        // Tab switching logic
        $(document).on('click', '#portfolioBtn', function() {
            $('#categoryBtn').removeClass('btn-primary').addClass('btn-secondary');
            $(this).addClass('btn-primary');
            $('#portfolio').show();
            $('#category').hide();
            $('#create-portfolio').removeClass('d-none');
            $('#create-category').addClass('d-none');
            portfolioData();
        });

        $(document).on('click', '#categoryBtn', function() {
            $('#portfolioBtn').removeClass('btn-primary').addClass('btn-secondary');
            $(this).addClass('btn-primary');
            $('#portfolio').hide();
            $('#category').show();
            $('#create-portfolio').addClass('d-none');
            $('#create-category').removeClass('d-none');
            categoryData();
        });

        // Initial tab load
        $('#portfolio').show();
        $('#portfolioBtn').addClass('btn-primary');
        portfolioData();
    </script>
@endpush
