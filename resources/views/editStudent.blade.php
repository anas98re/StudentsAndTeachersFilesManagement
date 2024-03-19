@extends('layout')

@section('content')
    <div class="container" style="padding-top: 3%">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div style="width: 95%; height:7em;padding-top: 20px"   class="jumbotron jumbotron-fluid">
                        <div class="container">
                        <h1 class="display-5">Edit Student</h1>
                        <p class="lead"> This Student info to edit </p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                @if (count($errors) > 0)
                    <ul>
                        @foreach ($errors->all() as $item)
                            <li>
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>
                @endif

                <div class="col">
                    <form action="{{ route('updateStudent', ['id' => $student->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Name</label>
                            <input type="text" name="name" value="{{ $student->name }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Email address</label>
                            <input type="text" type="email" name="email" value="{{ $student->user->email }}" class="form-control" id="email_todo">
                            <span class="text-danger" id="emailErrorUpdate"></span>
                        </div>
                        <div class="form-group">
                        <input type="hidden" name="user_id" value="{{ $student->user_id }}" >
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">password</label>

                            <input type="text" name="password" value="{{ $student->user->password }}" class="form-control" >
                            <input type="hidden" name="role" id="role_todo" disabled>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">gpa</label>
                            <input type="text" name="gpa" value="{{ $student->gpa }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">speailiazation</label>
                            <input type="text" name="speailiazation" value="{{ $student->speailiazation }}"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">phoneNumber</label>
                            <input type="text" name="phoneNumber" value="{{ $student->phoneNumber }}"
                                class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">update</button>
                            <a class="btn btn-primary" href="{{ route('getAllStudents') }}" role="button">back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
