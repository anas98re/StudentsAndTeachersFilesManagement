@extends('layout')

@section('content')
    <div class="container" style="padding-top: 3%">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div style="width: 95%; height:7em;padding-top: 20px"   class="jumbotron jumbotron-fluid">
                        <div class="container">
                        <h1 class="display-5">EMPLOYEES</h1>
                        <p class="lead"> These are the EMPLOYEES all properly organized</p>
                        </div>
                    </div>
                </div>
                {{-- <div class="col">
                    <a style="width: 10em" class="nav-link" action="{{ route('CreteTeacher') }}"> <button
                            style="width: 10em" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add
                            Teacher</button></a>&emsp;&emsp;
                </div> --}}

                <br>
                <br>
            </div>
            <div style="display: none;">
                {{ $employees = DB::table('employees')->get() }}
            </div>

        </div>

        <div>
            <a style="width: 10em" class="nav-link" data-bs-toggle="modal" data-bs-target="#addSubjectModel">
                <button style="width: 8em" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add
                    New</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>

        <div class="modal fade" id="addSubjectModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="SubjectForm">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="exampleFormControlInput1">name</label>
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

                            <br>

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


            @if ($employees->count() > 0)
                <div class="col">

                    <input class="form-control" id="myInput" type="text" placeholder="Search..">
                    <br>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">Action</th>


                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($employees as $item)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $item->name }}</td>


                                    <td>
                                        <div class="row">
                                            {{-- <a style="color: rgb(14, 167, 32)" href="javascript:void(0)" id="show-Service"
                                                data-url="{{ route('ProjectShow', $item->id) }}"
                                                class="fas fa-2x fa-eye"></a> --}}
                                                {{-- <a class="btn btn-outline-success"
                                                href="{{ route('subjectShow', ['id' => $item->id]) }}">Show Lectures
                                            </a> --}}
                                                &nbsp;&nbsp;&nbsp;
                                            {{-- <a class="btn btn-outline-primary"
                                                href="{{ route('subjectEdit', ['id' => $item->id]) }}">Edit --}}
                                            </a>&emsp;&emsp;
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
                                                    <form action="{{ url('deleteEmployee') }}" method="POST">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModel">Delete A file!
                                                            </h5>
                                                            {{-- <button class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button> --}}
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name='employee_delete_id' id="lead_id">
                                                            <h5><b>Are you sure you want to delete this Subject ?</b></h5>

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
            @else
                <div class="col">
                    <div class="alert alert-danger" role="alert">
                        No Subjects
                    </div>
                </div>
            @endif


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
                            <input type="hidden" name="id" id="id_todo" disabled>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">title</label>
                                <input type="text" name="title" id="title_todo" class="form-control">
                                <span class="text-danger" id="nameErrorUpdate"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">keyword</label>
                                <input type="text" name="keyword" id="keyword_todo" class="form-control">
                                <span class="text-danger" id="phoneErrorUpdate"></span>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlInput1">descrition</label>
                                <input type="text" name="descrition" id="descrition_todo" class="form-control">
                                <span class="text-danger" id="addressErrorUpdate"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">tool</label>
                                <input type="text" name="tool" class="form-control" id="tool_todo">
                                <span class="text-danger" id="emailErrorUpdate"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">supervisored</label>
                                <input type="password" name="supervisored" class="form-control" id="supervisored_todo">
                                <span class="text-danger" id="passwordErrorUpdate"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">type</label>
                                <input type="text" name="type" class="form-control" id="type_todo">
                                <span class="text-danger" id="Job_titleErrorUpdate"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">speailiazation</label>
                                <input type="text" name="speailiazation" class="form-control"
                                    id="speailiazation_todo">
                                <span class="text-danger" id="Job_titleErrorUpdate"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">studentName</label>
                                <input type="text" name="studentName" class="form-control" id="studentName_todo">
                                <span class="text-danger" id="Job_titleErrorUpdate"></span>
                            </div>


                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button onclick="EditePROJECT()" class="btn btn-info">Save</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>

                </div>


            </div>
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
                        <p><strong><b style="color: #229ED9">title:</b></strong> <span id="Service-title"></span>
                        </p>
                        <p><strong><b style="color: #229ED9">keyword:</b></strong> <span id="Service-keyword"></span>
                        </p>
                        <p><strong><b style="color: #229ED9">descrition:</b></strong> <span
                                id="Service-descrition"></span></p>
                        <p><strong><b style="color: #229ED9">tool:</b></strong> <span id="Service-tool"></span>
                        </p>
                        <p><strong><b style="color: #229ED9">supervisored:</b></strong> <span
                                id="Service-supervisored"></span>
                        </p>
                        <p><strong><b style="color: #229ED9">type:</b></strong> <span id="Service-type"></span>
                        </p>
                        <p><strong><b style="color: #229ED9">speailiazation:</b></strong> <span
                                id="Service-speailiazation"></span>
                        </p>
                        <p><strong><b style="color: #229ED9">studentName:</b></strong> <span
                                id="Service-studentName"></span>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- {!! $files->links() !!} --}}
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
            $('#SubjectForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "storeEmployee",
                    data: $('#SubjectForm').serialize(),
                    success: function(res) {

                        if (res) {
                            console.log(res);
                            location.reload();
                            $("#SubjectForm")[0].reset();
                            $("#addSubjectModel").modal('hide');
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
            $.get('projects/' + id + '/editBybob', function(res) {
                $("#modal_title").html('Edit Employee');
                $("#id_todo").val(res.id);
                $("#title_todo").val(res.title);
                $("#keyword_todo").val(res.keyword);
                $("#descrition_todo").val(res.descrition);
                $("#tool_todo").val(res.tool);
                $("#supervisored_todo").val(res.supervisored);
                $("#type_todo").val(res.type);
                $("#speailiazation_todo").val(res.speailiazation);
                $("#studentName_todo").val(res.studentName);
                $("#modal_todo").modal('show');
                console.log(res);
            });
        });

        function EditePROJECT() {
            $("form").on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "updateProject",
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
                    $('#Service-title').text(data.title);
                    $('#Service-keyword').text(data.keyword);
                    $('#Service-descrition').text(data.descrition);
                    $('#Service-tool').text(data.tool);
                    $('#Service-supervisored').text(data.supervisored);
                    $('#Service-type').text(data.type);
                    $('#Service-speailiazation').text(data.speailiazation);
                    $('#Service-studentName').text(data.studentName);
                    console.log(data);
                })

            });

        });
    </script>
    {{-- {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

@endsection
