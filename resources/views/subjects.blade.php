@extends('layout')

@section('content')
    <div class="container" style="padding-top: 3%">
        <div class="container">
            <div class="row">
                <div style="width: 95%; height:7em;padding-top: 20px" class="jumbotron jumbotron-fluid">
                    <div class="container">
                        @if (Auth::user()->role == 3)
                            <h1 class="display-4">Teacher subjects <b style="color: #9f0707">{{ $teacher->name }}</b></h1>
                            <p class="lead"> These are the subjects all for this Teacher properly organized properly
                                organized</p>
                        @endif
                        @if (Auth::user()->role == 4)
                            <h1 class="display-4">ALL SUBJECTS </h1>
                            <p class="lead"> These are the subjects all properly organized</p>
                        @endif
                        @if (Auth::user()->role == 1)
                        <h1 class="display-4">ALL SUBJECTS </h1>
                        <p class="lead"> These are the subjects all properly organized</p>
                    @endif
                    </div>
                </div>
                <div class="col">
                    {{-- <a class="btn btn-outline-dark" href="{{ route('CreteFile') }}" role="button">Add teacher</a> --}}
                </div>
                <br>
                <br>
            </div>
            {{-- <div style="display: none;">
                {{ $subjects = DB::table('subjects')->get() }}
            </div> --}}

        </div>

        <div>
            @if (Auth::user()->role == 3)
                <a style="width: 10em" class="nav-link" data-bs-toggle="modal" data-bs-target="#addSubjectModel">
                    <button style="width: 8em" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add
                        New</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
        @endif

        <div class="modal fade" id="addSubjectModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Subject</h5>
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
                                <label for="exampleFormControlInput1">Link For Last Marks</label>
                                <input type="text" name="LinkForTheLastMarks" class="form-control"
                                    placeholder="https://example.com to show The Last Marks of this Subject"
                                     size="30">
                                <span class="text-danger" id="nameError"></span>
                            </div>
                            <label for="exampleFormControlInput1">year</label>
                            <select class="form-control" name="year" id="exampleFormControlSelect1">
                                <option value="first">first</option>
                                <option value="second">second</option>
                                <option value="third">third</option>
                                <option value="forth">forth</option>
                                <option value="fifth">fifth</option>
                            </select>
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


            @if ($subjects->count() > 0)
                <div class="col">

                    <input class="form-control" id="myInput" type="text" placeholder="Search..">
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">name</th>
                                    <th scope="col">year</th>
                                    <th scope="col">LINK For Last Marks</th>
                                    {{-- <th scope="col">Teacher Name</th> --}}
                                    <th scope="col">ADS</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">name</th>
                                    <th scope="col">year</th>
                                    <th scope="col">LINK For Last Marks</th>
                                    {{-- <th scope="col">Teacher Name</th> --}}
                                    <th scope="col">ADS</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </tfoot>
                            <tbody id="myTable">
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($subjects as $item)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->year }}</td>
                                        <td><a href="{{ $item->LinkForTheLastMarks }}">{{ $item->LinkForTheLastMarks }}</a>
                                        </td>
                                        <td>
                                            &nbsp;&nbsp;
                                                <a  href="{{ route('ADSShow', ['id' => $item->id]) }}"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                                                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                                                  </svg></a>&nbsp;&nbsp;&nbsp;
                                        </td>
                                        <td>
                                            <div class="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                {{-- <a style="color: rgb(14, 167, 32)" href="javascript:void(0)" id="show-Service"
                                                data-url="{{ route('ProjectShow', $item->id) }}"
                                                class="fas fa-2x fa-eye"></a> --}}
                                                <a class="btn btn-outline-success"
                                                    href="{{ route('subjectShow', ['id' => $item->id]) }}">Show Lectures
                                                </a>&nbsp;&nbsp;&nbsp;

                                                {{-- <a class="btn btn-outline-info"
                                                    href="{{ route('ADSShow', ['id' => $item->id]) }}">Show ADS
                                                </a>&nbsp;&nbsp;&nbsp; --}}
                                                <a class="btn btn-outline-danger"
                                                    href="{{ route('courseShow', ['id' => $item->id]) }}">Show Courses
                                                </a>
                                                &nbsp;&nbsp;&nbsp;
                                                @if (Auth::user()->role == 3 || Auth::user()->role == 1)
                                                    <a class="btn btn-outline-secondary"
                                                        href="{{ route('marksShow', ['id' => $item->id]) }}">MARKS
                                                    </a>
                                                @endif
                                                &nbsp;&nbsp;&nbsp;
                                                @if (Auth::user()->role == 3)
                                                    <a class="btn btn-outline-primary"
                                                        href="{{ route('subjectEdit', ['id' => $item->id]) }}">Edit
                                                    </a>&emsp;&emsp;


                                                    <br>
                                                    <div class="row">&nbsp;
                                                        <button type="button" class="btn btn-danger deleteService"
                                                            value="{{ $item->id }}"
                                                            data-target="#deleteModel">Delete</button>
                                                        &nbsp;&nbsp;&nbsp;

                                                    </div>
                                                @endif
                                            </div>



                                            <div class="modal fade" id="deleteModel" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">



                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form action="{{ url('deleteSubject') }}" method="POST">
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
                                                                <input type="hidden" name='subject_delete_id'
                                                                    id="lead_id">
                                                                <h5><b>Are you sure you want to delete this Subject ?</b>
                                                                </h5>

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
                    url: "CreteSubject",
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
