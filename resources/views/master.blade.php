<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}} - Grapiku Docs</title>
    <link rel="icon" href="{{ URL::asset('img/favicon-docs.png') }}">
    <link href="{{ URL::asset('css/mdb.min.css'); }}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
    <!-- jQuery -->


    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link href="{{ asset('vendor/file-manager/css/file-manager.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .navbar {
            border-bottom: 3px solid #9f1d35;
            border-radius: 0 0 10px 10px;
            font-family: 'Raleway';
        }

        .tox.tox-tinymce {
            border-radius: 0.25rem;
        }

        table td:nth-last-child(1),
        table th:nth-last-child(1) {

            width: 250px !important;
        }

        .nav-link:hover {
            color: #9f1d35;
        }

        .dataTables_filter input:focus {
            outline: none !important;
            border: 1px solid #9f1d35;
        }

        h4,
        h5 {
            font-family: 'Montserrat';
            font-weight: 700;
        }

        p,
        #user_info,
        #user_paginate {
            font-family: 'Raleway';
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col mb-3">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <!-- Container wrapper -->
                    <div class="container-fluid">
                        <!-- Toggle button -->
                        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-bars"></i>
                        </button>

                        <!-- Collapsible wrapper -->
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Navbar brand -->
                            <a class="navbar-brand mt-2 mt-lg-0" href="/">
                                <img src="{{URL::asset('img/grapiku-docs.png')}}" height="30" alt="Grapiku Docs Logo" loading="lazy" />
                            </a>
                            <!-- Left links -->
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" href="/home/user">Data User</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/home/docsman">Documentations</a>
                                </li>
                            </ul>
                            <!-- Left links -->
                        </div>
                        <!-- Collapsible wrapper -->

                        <!-- Right elements -->
                        <div class="d-flex align-items-center">
                            <a class="nav-link" href="/actionlogout"><i class="fa fa-sign-out"></i> Logout</a>
                        </div>
                        <!-- Right elements -->
                    </div>
                    <!-- Container wrapper -->
                </nav>
            </div>
        </div>

        <!-- Navbar -->
        @yield('konten')
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Are you sure to remove data <b id="nameVal"></b></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                    <a id="modalDelete" href="javascript:;" class="btn btn-primary">Delete Data</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalDeleteFile" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">Are you sure to remove data <b id="nameVal"></b></div>
                <div class="modal-footer">
                    <form action="{{route('delFile')}}" method="post">
                        @csrf
                        <input type="hidden" name="path" id="path">
                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Delete Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Enter New Password for <b id="nameVal"></b></p>

                    <form action="{{route('editUser')}}" method="post">
                        @csrf
                        <div class="form-outline mb-4">
                            <input type="hidden" name="id" id="idVal">
                            <input type="password" id="password" name="password" placeholder="Masukkan Password" class="input form-control" required />
                            <label class="form-label" for="password">Password</label>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditParent" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Change Site Name</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Enter New Site Name for <b id="nameVal"></b></p>

                    <form action="{{route('editParent')}}" method="post">
                        @csrf
                        <div class="form-outline mb-4">
                            <input type="hidden" name="id" id="idVal">
                            <input type="text" id="company" name="company" placeholder="Masukkan Password" class="input form-control" required />
                            <label class="form-label" for="company">Site Name</label>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>


</body>
<script src="{{URL::asset('js/mdb.min.js');}}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>

<script>
    $('#user').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": true,
    });
    $('#modalDelete').on('show.bs.modal', function(event) {
        var div = $(event.relatedTarget);
        var title = div.data('title');
        var id = div.data('id');
        var type = div.data('type');
        var modal = $(this);
        modal.find('#nameVal').text(title);
        if (type == 'user') {
            modal.find('#modalDelete').attr("href", "/home/user/delete/" + id);
        }
        if (type == 'parent') {
            modal.find('#modalDelete').attr("href", "/home/parent/delete/" + id);
        }
    })
    $('#modalEdit').on('show.bs.modal', function(event) {
        var div = $(event.relatedTarget);
        var title = div.data('title');
        var id = div.data('id');
        var modal = $(this);
        modal.find('#nameVal').text(title);
        modal.find('#idVal').val(id);
    })
    $('#modalDeleteFile').on('show.bs.modal', function(event) {
        var div = $(event.relatedTarget);
        var title = div.data('title');
        var id = div.data('id');
        var modal = $(this);
        modal.find('#nameVal').text(title);
        modal.find('#path').val(title);
    })
    $('#modalEditParent').on('show.bs.modal', function(event) {
        var div = $(event.relatedTarget);
        var title = div.data('title');
        var id = div.data('id');
        var modal = $(this);
        modal.find('#nameVal').text(title);
        modal.find('#idVal').val(id);
    })
</script>

</html>