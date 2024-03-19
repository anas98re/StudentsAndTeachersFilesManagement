@extends('layout')

@section('content')
    <div class="container" style="padding-top: 3%">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div style="width: 95%; height:7em;padding-top: 20px"   class="jumbotron jumbotron-fluid">
                        <div class="container">
                        <h3 class="display-5" >TEACHERS</b></h3>
                        <p class="lead"> These are the teachers all properly organized</p>
                        </div>
                    </div>
                </div>

                <br>
                <br>
            </div>
            <div style="display: none;">
                {{ $teachers = DB::table('teachers')->get() }}
            </div>

        </div>

        <div>
            <a style="width: 10em" class="nav-link" data-bs-toggle="modal" data-bs-target="#addServiceModel">
                <button style="width: 8em" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add
                    New</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
        <div class="modal fade" id="addServiceModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Teacher</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="EmployeeForm">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Name</label>
                                <input type="text" name="name" class="form-control">
                                <span class="text-danger" id="nameError"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Email address</label>
                                <input type="email" name="email" class="form-control" id="exampleFormControlInput1"
                                    placeholder="name@example.com">
                                <span class="text-danger" id="emailError"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">password</label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="At least 8 characters">
                                <span class="text-danger" id="passwordError"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">address </label>
                                <input type="text" name="address" class="form-control" id="exampleFormControlInput1">
                                <span class="text-danger" id="emailError"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">dateOfBrithe</label>
                                <input type="date" name="dateOfBrithe" class="form-control">
                                <span class="text-danger" id="passwordError"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">specialist</label>
                                <input type="text" name="specialist" class="form-control">
                                <span class="text-danger" id="phoneError"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">phoneNumber</label>
                                <input type="text" name="phoneNumber" class="form-control">
                                <span class="text-danger" id="Job_titleError"></span>
                            </div>

                            <button type="submit" class="btn btn-primary">ADD</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                            @if (count($errors) > 0)
                                <ul>
                                    @foreach ($errors->all() as $item)
                                        <li>
                                            {{ $item }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </form>
                    </div>

                </div>
            </div>




        </div>

        <div class="row">


            @if ($teachers->count() > 0)
                <div class="col">

                    <input class="form-control" id="myInput" type="text" placeholder="Search..">
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">address</th>
                                <th scope="col">dateOfBrithe</th>
                                <th scope="col">specialist</th>
                                <th scope="col">phoneNumber</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($teachers as $item)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->dateOfBrithe }}</td>
                                    <td>{{ $item->specialist }}</td>
                                    <td>{{ $item->phoneNumber }}</td>

                                    <td>
                                        <div class="row">
                                            <a style="color: rgb(14, 167, 32)" href="javascript:void(0)"
                                                id="show-Service" data-url="{{ route('teacherShow', $item->id) }}"
                                                class="fas fa-2x fa-eye"></a>&nbsp;&nbsp;&nbsp;
                                            {{-- <a type="button" id="edit_todo" data-id="{{ $item->id }}"><i
                                                    class="fas fa-2x fa-edit"></i></a>&emsp;&emsp; --}}
                                            <a class="btn btn-outline-primary" href="{{ route('TeacherEdit', ['id' => $item->id]) }}">Edit </a>&emsp;&emsp;


                                            <br>
                                            <div class="row">&nbsp;
                                                <button type="button" class="btn btn-danger deleteService"
                                                    value="{{ $item->id }}"
                                                    data-target="#deleteModel">Delete</button>
                                                &nbsp;&nbsp;&nbsp;

                                            </div>
                                        </div>



                                        <div class="modal fade" id="deleteModel" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">



                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ url('deleteTeacher') }}" method="POST">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModel">Delete A file!
                                                            </h5>
                                                            <button class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name='teacher_delete_id'
                                                                id="lead_id">
                                                            <h5><b>Are you sure you want to delete this file ?</b></h5>

                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>

                                                            <button type="submit" class="btn btn-danger">Yes
                                                                Delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                </div>
            @else
                <div class="col">
                    <div class="alert alert-danger" role="alert">
                        No Teachers
                    </div>
                </div>
            @endif


        </div>
        <!-- Modal show-->
        <div class="modal fade" id="ServiceShowModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Show Service</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- <p><strong>ID:</strong> <span id="Service-id"></span></p> --}}
                        <p><strong><b style="color: #229ED9">name:</b></strong> <span id="Service-name"></span>
                        </p>
                        <p><strong><b style="color: #229ED9">address:</b></strong> <span id="Service-address"></span>
                        </p>
                        <p><strong><b style="color: #229ED9">dateOfBrithe:</b></strong> <span
                                id="Service-dateOfBrithe"></span></p>
                        <p><strong><b style="color: #229ED9">specialist:</b></strong> <span
                                id="Service-specialist"></span></p>
                        <p><strong><b style="color: #229ED9">phoneNumber:</b></strong> <span
                                id="Service-phoneNumber"></span>
                        </p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
            {{-- {!! $files->links() !!} --}}
        </div>
        <div class="modal" id="modal_todo">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="form_todo">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modal_title"></h4>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <input type="hidden" name="id" id="r_id" disabled>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Name</label>
                                <input type="text" name="name" id="name_todo" class="form-control">
                                <span class="text-danger" id="nameErrorUpdate"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">dateOfBrithe</label>
                                <input type="text" name="dateOfBrithe" id="dateOfBrithe_todo" class="form-control">
                                <span class="text-danger" id="phoneErrorUpdate"></span>
                            </div>
                            <div class="form-group">
                                {{-- <label for="exampleFormControlInput1">user</label> --}}
                                {{-- <input type="hidden" name="user_id" id="user_id_todo"  class="form-control" > --}}

                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">specialist</label>
                                <input type="text" name="specialist" id="specialist_todo" class="form-control">
                                <span class="text-danger" id="addressErrorUpdate"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Email address</label>
                                <input type="email" name="email" class="form-control" id="email_todo">
                                <span class="text-danger" id="emailErrorUpdate"></span>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="user_id_todo" id="user_id_todo" disabled>
                                <input type="hidden" name="password" id="password_todo" disabled>
                                <input type="hidden" name="role" id="role_todo" disabled>

                                {{-- <label for="exampleFormControlInput1">password</label>
                                <input type="password" name="password" class="form-control" id="password_todo">
                                <span class="text-danger" id="passwordErrorUpdate"></span> --}}
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">phoneNumber</label>
                                <input type="text" name="phoneNumber" class="form-control" id="phoneNumber_todo">
                                <span class="text-danger" id="Job_titleErrorUpdate"></span>
                            </div>

                            {{-- </div> --}}
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button onclick="EditeMPLOYEE()" class="btn btn-info">Save</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                    </form>

                </div>
            </div>
        </div>


        <script>
            $(document).ready(function() {
                $.ajaxSetup({
                    // headers: {
                    //     'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                    // }
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                });
            });

            $("#add_todo").on('click', function() {
                $("#form_todo").trigger('reset');
                $("#modal_title").html('Add todo');
                $("#modal_todo").modal('show');
                $("#id").val("");
            });
            $("body").on('click', '#edit_todo', function() {
                var id = $(this).data('id');
                $.get('employees/' + id + '/edit', function(res) {
                    $("#modal_title").html('Edit Employee');
                    $("#r_id").val(res.id);
                    $("#name_todo").val(res.name);
                    $("#address_todo").val(res.address);
                    $("#dateOfBrithe_todo").val(res.dateOfBrithe);
                    $("#specialist_todo").val(res.specialist);
                    $("#email_todo").val(res.user.email);
                    $("#password_todo").val(res.user.password);
                    $("#phoneNumber_todo").val(res.phoneNumber);
                    $("#role_todo").val(res.user.role);
                    $("#user_id_todo").val(res.user_id);
                    $("#modal_todo").modal('show');
                });
            });

            function EditeMPLOYEE() {
                $("form").on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: "SaveTeacher",
                        data: $("#form_todo").serialize(),
                        type: 'POST',
                        success: function(res) {
                            if (res) {

                                location.reload();

                                if ($("#id").val()) {
                                    $("#row_todo_" + res.id).replaceWith(row);
                                } else {
                                    $("#list_todo").prepend(row);
                                }

                                $("#form_todo").trigger('reset');
                                $("#modal_todo").modal('hide');

                            }

                        },
                        error: function(res) {
                            $('#nameErrorUpdate').text(res.responseJSON.errors.name);
                            $('#emailErrorUpdate').text(res.responseJSON.errors.email);
                            $('#phoneErrorUpdate').text(res.responseJSON.errors.phone);
                            $('#passwordErrorUpdate').text(res.responseJSON.errors.password);
                            $('#addressErrorUpdate').text(res.responseJSON.errors.address);
                            $('#Job_titleErrorUpdate').text(res.responseJSON.errors.Job_title);
                            // console.log(error);
                            // alert('The data is incorrect, Either there are required entries that you did not enter, or the name or email or phone already exists, or you used letters in the place of numbers, or numbers in the place of letters');
                        }
                    });
                });
            }


            $(document).ready(function() {
                $(document).on('click', '.deleteService', function(e) {
                    e.preventDefault();
                    var lead_id = $(this).val();
                    $('#lead_id').val(lead_id);
                    $('#deleteModel').modal('show')
                });
            });


            $(document).ready(function() {
                $(document).on('click', '.deleteService', function(e) {
                    e.preventDefault();
                    var lead_id = $(this).val();
                    $('#lead_id').val(lead_id);
                    $('#deleteModel').modal('show')
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#EmployeeForm').on('submit', function(e) {
                    e.preventDefault();

                    $.ajax({
                        type: "POST",
                        url: "CreteTeacher",
                        data: $('#EmployeeForm').serialize(),
                        success: function(res) {

                            if (res) {
                                console.log(res);
                                location.reload();
                                $("#EmployeeForm")[0].reset();
                                $("#addServiceModel").modal('hide');
                            }
                        },
                        error: function(res) {
                            $('#nameError').text(res.responseJSON.errors.name);
                            $('#numberOfRoomsError').text(res.responseJSON.errors.numberOfRooms);
                            $('#addressError').text(res.responseJSON.errors.address);
                            $('#RegionError').text(res.responseJSON.errors.Region);
                            $('#priceError').text(res.responseJSON.errors.price);
                            $('#phoneNumberError').text(res.responseJSON.errors.phoneNumber);
                            $('#rentOrSellError').text(res.responseJSON.errors.rentOrSell);
                            $('#generalTypeError').text(res.responseJSON.errors.generalType);
                            $('#srecialTypeError').text(res.responseJSON.errors.srecialType);
                            $('#employeesError').text(res.responseJSON.errors.employees);
                        }
                    });
                });

            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {

                $('body').on('click', '#show-Service', function() {
                    var userURL = $(this).data('url');
                    var a = document.getElementById('a');
                    var i = 1;
                    $.get(userURL, function(data) {
                        $('#ServiceShowModal').modal('show');
                        $('#Service-name').text(data.name);
                        $('#Service-address').text(data.address);
                        $('#Service-dateOfBrithe').text(data.dateOfBrithe);
                        $('#Service-specialist').text(data.specialist);
                        $('#Service-phoneNumber').text(data.phoneNumber);
                        console.log(data);
                    })

                });

            });
        </script>
        {{-- {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    @endsection
