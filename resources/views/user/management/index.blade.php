@extends('layouts.app')

@section('navbar')
@include('layouts.navbar.navbar')
@endsection

@section('sidebar')
@include('layouts.navbar.sidebar')
@endsection

@section('body')
@include('layouts.add.main-body')
@endsection

@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                
                <div class="card skeleton-template">
                    <div class="card-header border-0">
                        <h3 class="card-title align-items-start flex-column">
                            <div class="skeleton h-10px w-70px"></div>
                        </h3>
                        <div class="card-toolbar">
                            <div class="skeleton h-10px w-70px"></div>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header border-0 data-template" style="display: none">
                        <div class="d-flex align-items-center gap-2">
                            <div class="d-flex align-items-center">
                                <span class="fs-7 fw-bolder text-dark pe-4 text-nowrap d-none d-md-block">Role</span>
                                <select class="form-select form-select-sm w-150px w-xxl-200px" data-control="select2" name="filterRole" id="filter_role_id">
                                    <option value="*" selected>Semua Data</option>
                                    @foreach ($getRole as $gr)
                                    <option value="{{$gr->id}}">{{$gr->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <div class="d-flex align-items-center">
                                <div class="d-flex">
                                    @role('administrator')
                                    <a href="#kt_modal_tambah_user" class="btn btn-sm btn-primary btn_tambah_user" data-bs-toggle="modal">
                                        <i class="fa-solid fa-users me-1"></i>User Baru
                                    </a>
                                    @endrole
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-xl-12">
                                <table class="table align-middle table-striped fs-6" id="kt_table_user">
                                    <thead>
                                        <tr class="text-white fw-bolder fs-7 gs-0 bg-danger text-uppercase">
                                            <th class="text-center w-50px">#</th>
                                            <th class="w-400px">User</th>
                                            <th>Site Region</th>
                                            <th class="w-250px text-center">Role</th>
                                            <th class="text-center w-150px">#</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-dark fw-semibold fs-7">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>	
                </div>
            </div>
        </div>
    </div>
</div>

@role('administrator')
@include('user.management.add.modal-tambah-user')
@include('user.management.add.modal-edit-user')
@include('user.management.add.modal-hapus-user')
@endrole

@push('js')
<script class="text/javascript">
    $(document).ready(function(){
        
        $('#bc_active').append(`
        <li class="breadcrumb-item">
            <span class="bullet bg-muted w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">{{$homepage}}</li>
        `)
        
        var getFilter = function(){
            return {
                'filterRole': $('#filter_role_id').val(),
            }
        }
        
        $('#filter_role_id').change(function(){
            tableUser.draw()  
        });
        
        window.tableUser  = $('#kt_table_user')
        .DataTable({
            processing: true,
            serverSide: true,
            retrieve: true,
            responsive: true,
            aaSorting : [],
            ajax: {
                url : "{{route('user.management.index')}}",
                data: function(data){
                    data.filters = getFilter()
                }
            },
            language: {
                "lengthMenu": "Show _MENU_",
                "emptyTable" : "Tidak ada data terbaru 💻",
                "zeroRecords": "Data tidak ditemukan 😞",
            },
            dom:
            "<'row'" +
            "<'col-4 col-xl-6 d-flex align-items-center justify-content-start'l>" +
            "<'col-8 col-xl-6 d-flex align-items-center justify-content-lg-end justify-content-start 'f>" +
            ">" +
            
            "<'table-responsive'tr>" +
            
            "<'row'" +
            "<'col-sm-12 col-xl-5 d-flex align-items-center justify-content-center justify-content-xl-start'i>" +
            "<'col-sm-12 col-xl-7 d-flex align-items-center justify-content-center justify-content-xl-end'p>" +
            ">",
            columns: [
            { data: 'DT_RowIndex'},
            { data: 'user'},
            { data: 'regionItem'},
            { data: 'role'},
            { data: 'action'},
            ],
            columnDefs: [
            {
                targets: 0,
                orderable : false,
                searchable : false,
                className: 'text-center',
            },
            {
                targets: 3,
                orderable : false,
                searchable : false,
                className: 'text-center',
            },
            {
                targets: -1,
                orderable : false,
                searchable : false,
                className: 'text-center',
            },
            ],
        });
        
        $('body').on('click', '.btn_tambah_user', function () {
            $('#role_id').val("").trigger("change")
            $('#kt_modal_tambah_user_form').trigger("reset")
        });
        
        $("#kt_modal_tambah_user_form").validate({
            messages: {
                name: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Nama user wajib diisi</span>",
                },
                email: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Email user wajib diisi</span>",
                    email: "<span class='fw-semibold fs-8 text-danger'>Email user belum sesusai format</span>",
                },
                role_id: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Role user wajib dipilih</span>",
                },
                site_region_id: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Daerah user wajib dipilih</span>",
                },
                new_password: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Password wajib diisi</span>",
                    minlength: "<span class='fw-semibold fs-8 text-danger'>Password minimal memiliki 8 karakter</span>",
                    confirmed: "<span class='fw-semibold fs-8 text-danger'>Password tidak sama</span>",
                },
                new_password_confirmation: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Konfirmasi password wajib diisi</span>",
                    minlength: "<span class='fw-semibold fs-8 text-danger'>Konfirmasi password minimal memiliki 8 karakter</span>",
                },
            },
            submitHandler: function(form) {
                $.ajax({
                    data: $('#kt_modal_tambah_user_form').serialize(),
                    url: '{{route("user.management.store")}}',
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#kt_modal_tambah_user_cancel').click();
                        var oTable = $('#kt_table_user').dataTable();
                        oTable.fnDraw(false);
                        toastr.success('User baru berhasil ditambahkan','Selamat !');
                    },
                    error: function (xhr, status, errorThrown) {
                        if (JSON.parse(xhr.responseText).errors.name) {
                            toastr.error('Nama user wajib diisi', 'Opps!');
                        }else if (JSON.parse(xhr.responseText).errors.email) {
                            toastr.error('Email user wajib diisi/telah terdaftar', 'Opps!');
                        }else if (JSON.parse(xhr.responseText).errors.role_id) {
                            toastr.error('Role user wajib dipilih', 'Opps!');
                        }else if (JSON.parse(xhr.responseText).errors.new_password) {
                            toastr.error('Password tidak sama', 'Opps!');
                        }else if (JSON.parse(xhr.responseText).errors.new_password_confirmation) {
                            toastr.error('Password tidak sama', 'Opps!');
                        }else {
                            toastr.error(errorThrown ,'Opps!');
                        }
                    }
                });
            }
        });
        
        $('#kt_table_user').on('click', '.btn_edit_user', function () {
            var id = $(this).data('id')
            var form_edit = $('#kt_modal_edit_user_form')
            form_edit.trigger("reset");
            
            $.get(`{{url('')}}/user/edit/${id}`, function (data) {
                form_edit.find("input[name='user_id']").val(data.id)
                form_edit.find("input[name='name']").val(data.name)
            })
            
        });	
        
        $("#kt_modal_edit_user_form").validate({
            messages: {
                name: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Nama user wajib diisi</span>",
                },
                new_password: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Password wajib diisi</span>",
                    minlength: "<span class='fw-semibold fs-8 text-danger'>Password minimal memiliki 8 karakter</span>",
                    confirmed: "<span class='fw-semibold fs-8 text-danger'>Password tidak sama</span>",
                },
                new_password_confirmation: {
                    required: "<span class='fw-semibold fs-8 text-danger'>Konfirmasi password wajib diisi</span>",
                    minlength: "<span class='fw-semibold fs-8 text-danger'>Konfirmasi password minimal memiliki 8 karakter</span>",
                },
            },
            submitHandler: function(form) {
                $.ajax({
                    data: $('#kt_modal_edit_user_form').serialize(),
                    url: '{{route("user.management.update")}}',
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#kt_modal_edit_user_cancel').click();
                        var oTable = $('#kt_table_user').dataTable();
                        oTable.fnDraw(false);
                        toastr.success('Data user berhasil diperbaharui','Selamat !');
                    },
                    error: function (xhr, status, errorThrown) {
                        if (JSON.parse(xhr.responseText).errors.name) {
                            toastr.error('Nama user wajib diisi', 'Opps!');
                        }else if (JSON.parse(xhr.responseText).errors.new_password) {
                            toastr.error('Password tidak sama', 'Opps!');
                        }else if (JSON.parse(xhr.responseText).errors.new_password_confirmation) {
                            toastr.error('Password tidak sama', 'Opps!');
                        }else {
                            toastr.error(errorThrown ,'Opps!');
                        }
                    }
                });
            }
        });
        
        $('#kt_table_user').on('click', '.btn_hapus_user', function () {
            var id = $(this).data('id')
            $.get(`{{url('')}}/user/edit/${id}`, function (data) {
                var form_delete = $('#kt_modal_delete_form')
                form_delete.find("input[name='id']").val(data.id)
            })			
        });
        
        $("#kt_modal_delete_form").validate({
            submitHandler: function(form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    data: $('#kt_modal_delete_form').serialize(),
                    url: '{{route("user.management.destroy")}}',
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#kt_modal_delete_cancel').click();
                        var oTable = $('#kt_table_user').dataTable();
                        oTable.fnDraw(false);
                        toastr.success('User berhasil dihapus','Selamat!');
                    },
                    error: function (xhr, status, errorThrown) {
                        toastr.error(errorThrown ,'Error!');
                    }
                });
            }
        })
        
    });
</script> 
@endpush

@endsection

