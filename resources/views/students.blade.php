@extends('layout')

@section('content')
    <div class="container" style="padding-top: 3%">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div style="width: 95%; height:7em;padding-top: 20px"   class="jumbotron jumbotron-fluid">
                        <div class="container">
                        <h3 class="display-5" >STUDENTS</b></h3>
                        <p class="lead"> These are the students all properly organized</p>
                        </div>
                    </div>
                </div>


                <br>
                <br>
            </div>
            <div style="display: none;">
                {{ $students = DB::table('students')->get() }}
            </div>
            <div>
                <a style="width: 10em" class="nav-link" data-bs-toggle="modal" data-bs-target="#addLeadModel">
                    <button style="width: 8em" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add
                        New</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
            <div class="modal fade" id="addLeadModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New Student</h5>
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
                                    <label for="exampleFormControlInput1">gpa </label>
                                    <input type="text" name="gpa" class="form-control" id="exampleFormControlInput1">
                                    <span class="text-danger" id="emailError"></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">speailiazation</label>
                                    <input type="text" name="speailiazation" class="form-control">
                                    <span class="text-danger" id="passwordError"></span>
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

        </div>

        <div class="row">


            @if ($students->count() > 0)
                <div class="col">

                    <input class="form-control" id="myInput" type="text" placeholder="Search..">
                    <br>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">gpa</th>
                                <th scope="col">speailiazation</th>
                                <th scope="col">phoneNumber</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($students as $item)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->gpa }}</td>
                                    <td>{{ $item->speailiazation }}</td>
                                    <td>{{ $item->phoneNumber }}</td>

                                    <td>
                                        <div class="row">
                                            <a style="color: rgb(14, 167, 32)" href="javascript:void(0)" id="show-Service"
                                                data-url="{{ route('studentShow', $item->id) }}"
                                                class="fas fa-2x fa-eye"></a>&nbsp;&nbsp;&nbsp;
                                            <a class="btn btn-outline-primary"
                                                href="{{ route('StudentEdit', ['id' => $item->id]) }}">Edit </a>&emsp;&emsp;
                                            {{-- <a type="button" id="edit_todo" data-id="{{ $item->id }}"><i
                                            class="fas fa-2x fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp; --}}

                                            <br>
                                            <div class="row">&nbsp;
                                                <button type="button" class="btn btn-danger deleteService"
                                                    value="{{ $item->id }}" data-target="#deleteModel">Delete</button>
                                                &nbsp;&nbsp;&nbsp;

                                            </div>
                                        </div>



                                        <div class="modal fade" id="deleteModel" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">



                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ url('deleteStudent') }}" method="POST">
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
                                                            <input type="hidden" name='student_delete_id'
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


                                    <div class="modal" id="modal_todo">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form id="form_todo">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="modal_title"></h4>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" id="id">
                                                        <label for="recipient-name" class="col-form-label"
                                                            style="color: #229ED9"><b>Name:</b></label>
                                                        <input type="text" name="name" id="name_todo"
                                                            class="form-control">
                                                        <span class="text-danger" id="nameErrorUpdate"></span><br>
                                                        <label for="recipient-name" class="col-form-label"
                                                            style="color: #229ED9"><b>gpa:</b></label>
                                                        <input type="text" name="gpa" id="gpa_todo"
                                                            class="form-control">
                                                        <span class="text-danger"
                                                            id="Creation_dateErrorUpdate"></span><br>

                                                        <label for="recipient-name" style="color: #229ED9"
                                                            class="col-form-label"><b>speailiazation</b></label>
                                                        <input type="text" name="speailiazation"
                                                            id="speailiazation_todo" class="form-control"><br>

                                                        <label for="recipient-name" style="color: #229ED9"
                                                            class="col-form-label"><b>phoneNumber</b></label>
                                                        <input type="text" name="phoneNumber" id="phoneNumber_todo"
                                                            class="form-control"><br>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button onclick="EditStudent()" class="btn btn-info">Save</button>
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            @else
                <div class="col">
                    <div class="alert alert-danger" role="alert">
                        No Students
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
                        <p><strong><b style="color: #229ED9">gpa:</b></strong> <span id="Service-gpa"></span>
                        </p>
                        <p><strong><b style="color: #229ED9">phoneNumber:</b></strong> <span id="Service-phoneNumber"></span></p>
                        <p><strong><b style="color: #229ED9">speailiazation:</b></strong> <span
                                id="Service-speailiazation"></span>
                        </p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
            {{-- {!! $files->links() !!} --}}
        </div>


        <script>
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

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
                $('#addLeadModel').on('submit', function(e) {
                    e.preventDefault();

                    $.ajax({
                        type: "POST",
                        url: "CreteStudent",
                        data: $('#EmployeeForm').serialize(),
                        success: function(res) {

                            if (res) {
                                console.log(res);
                                location.reload();
                                $("#EmployeeForm")[0].reset();
                                $("#addLeadModel").modal('hide');
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

        <script>
            $("#add_todo").on('click', function() {
                $("#form_todo").trigger('reset');
                $("#modal_title").html('Add todo');
                $("#modal_todo").modal('show');
                $("#id").val("");
            });

            $("body").on('click', '#edit_todo', function() {
                var id = $(this).data('id');
                // var input = document.getElementById("input_id").value;
                var state = ($(this).is(':checked')) ? '1' : '0';
                var i = 1;
                $.get('Student/' + id + '/editByBob', function(res) {
                    $("#modal_title").html('Edit Student');
                    $("#id").val(res.id);
                    $("#name_todo").val(res.name);
                    $("#gpa_todo").val(res.gpa);
                    $("#speailiazation_todo").val(res.speailiazation);
                    $("#phoneNumber_todo").val(res.phoneNumber);
                    $("#modal_todo").modal('show');
                    console.log(res);
                });

            });


            function EditStudent() {
                $("form").on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: "updateStudent",
                        data: $("#form_todo").serialize(),
                        type: 'POST',
                        success: function(response) {
                            if (response) {
                                // console.log(response);
                                location.reload();
                                if ($("#id").val()) {
                                    $("#row_todo_" + response.id).replaceWith(row);
                                } else {
                                    $("#list_todo").prepend(row);
                                }
                                $("#form_todo").trigger('reset');
                                $("#modal_todo").modal('hide');
                            }
                        },
                        error: function(response) {
                            $('#nameErrorUpdate').text(response.responseJSON.errors.name);
                            $('#Creation_dateErrorUpdate').text(response.responseJSON.errors.Creation_date);
                        }
                    });
                });
            }
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
                        $('#Service-gpa').text(data.gpa);
                        $('#Service-speailiazation').text(data.speailiazation);
                        $('#Service-phoneNumber').text(data.phoneNumber);
                        console.log(data);
                    })

                });

            });
        </script>
    @endsection
