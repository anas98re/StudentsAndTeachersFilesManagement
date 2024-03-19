@extends('layout')

@section('content')
    <div class="container" style="padding-top: 3%">
        <div class="container">
            <div class="row">
                <div style="width: 95%; height:7em;padding-top: 20px"   class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h3 class="display-5" >ADS For <b style="color: #9f0707">{{$subject->name}}</b></h3>
                        <p class="lead"> These are the ADS all for this subject properly organized</p>
                    </div>
                </div>
                <div class="col">
                    {{-- <a class="btn btn-outline-dark" href="{{ route('CreteFile') }}" role="button">Add teacher</a> --}}
                </div>
                <br>
                <br>
            </div>
            {{-- <div style="display: none;">
                {{ $ads = DB::table('ads')->get() }}
            </div> --}}

        </div>

        <div>
            <div class="row">
                @if (Auth::user()->role == 3)
            <a style="width: 10em" class="nav-link" data-bs-toggle="modal" data-bs-target="#addServiceModel">
                <button style="width: 20em" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add
                    New ads For This subject</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@endif
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    @if (Auth::user()->role == 4 || Auth::user()->role == 1 )
                    <div style="padding-top:0.5em"><a class="btn btn-primary" style="height: 2.4em;"  href="{{ route('getAllSubjects') }}" role="button">back</a></div>
                    @endif
                    @if ( Auth::user()->role == 3)
                    <div style="padding-top:0.5em"><a class="btn btn-primary" style="height: 2.4em;"  href="{{ route('getAllMySubjects') }}" role="button">back</a></div>
                    @endif            </div>
            {{-- {{-- <div> <a class="btn btn-primary" onclick="history.go(-1)">Back</a></div> --}}

        </div>
        <div class="modal fade" id="addServiceModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New AD</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="EmployeeForm">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="exampleFormControlInput1">name</label>
                                <input type="text" name="name" class="form-control">
                                <span class="text-danger" id="nameError"></span>
                            </div>
                            {{-- <div class="form-group">
                                <label for="exampleFormControlInput1">photo</label>
                                <input type="file" name="photo" class="form-control">
                              </div> --}}
                                <label for="exampleFormControlInput1">text</label><br>
                                <textarea name="text" cols="40" rows="5"></textarea>
                                <br>
                            {{-- <div class="form-group"> --}}
                                <label for="exampleFormControlInput1">descreption </label><br>
                                <textarea name="descreption" cols="40" rows="5"></textarea>
                                {{-- <input type="url" name="descreption" class="form-control" id="exampleFormControlInput1"> --}}
                                <span class="text-danger" id="emailError"></span>
                            {{-- </div> --}}

                            <input type="hidden" name="subject_id" value="{{ $subject->id }}" class="form-control">

                            <div class="form-group">
                            <button type="submit" class="btn btn-primary">ADD</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
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


            @if ($ads->count() > 0)
                <div class="col">

                    <input class="form-control" id="myInput" type="text" placeholder="Search..">
                    <br>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">descreption</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody id="myTable">
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($ads as $item)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->descreption }}</td>

                                    <td>
                                        <div class="row">
                                            <a style="color: rgb(14, 167, 32)" href="javascript:void(0)" id="show-Service"
                                                data-url="{{ route('ADShow', $item->id) }}"
                                                class="fas fa-2x fa-eye"></a>&nbsp;&nbsp;&nbsp;
                                                @if (Auth::user()->role == 3)
                                            <a class="btn btn-secondary" href="{{ route('ADEdit', ['id' => $item->id]) }}">Edit </a>&emsp;&emsp;


                                            <br>
                                            <div class="row">
                                                <button type="button" class="btn btn-danger deleteService"
                                                    value="{{ $item->id }}"
                                                    data-target="#deleteModel">Delete</button>


                                            </div>
                                            @endif
                                        </div>



                                        <div class="modal fade" id="deleteModel" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">



                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{ url('deleteAD') }}" method="POST">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModel">Delete A homeWork!
                                                            </h5>
                                                            {{-- <button class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button> --}}
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name='AD_delete_id'
                                                                id="lead_id">
                                                            <h5><b>Are you sure you want to delete this homeWork ?</b></h5>

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
                        No ADS For This Subject
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
                                <input type="text" name="speailiazation" class="form-control" id="speailiazation_todo">
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
                    <h5 class="modal-title" id="exampleModalLabel">Show AD</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <p><strong>ID:</strong> <span id="Service-id"></span></p> --}}
                    <p><strong><b style="color: #229ED9">name:</b></strong> <span id="Service-title"></span>
                    </p>
                    <p><strong><b style="color: #229ED9">Description:</b></strong> <span
                            id="Service-keyword"></span>
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
            $('#EmployeeForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "CreteAD",
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
                $('#Service-title').text(data.name);
                $('#Service-keyword').text(data.descreption);

                console.log(data);
            })

        });

    });
</script>
    {{-- {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

@endsection
