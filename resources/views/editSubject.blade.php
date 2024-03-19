@extends('layout')

@section('content')
    <div class="container" style="padding-top: 3%">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div style="width: 95%; height:7em;padding-top: 20px"   class="jumbotron jumbotron-fluid">
                        <div class="container">
                        <h1 class="display-5">Edit Subject</h1>
                        <p class="lead"> This subject info to edit </p>
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
                    <form action="{{ route('updateSubject', ['id' => $subject->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">name</label>
                            <input type="text" name="name" value="{{ $subject->name }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Link For Last Marks</label>
                            <input type="text" name="LinkForTheLastMarks" value="{{ $subject->LinkForTheLastMarks }}" class="form-control" placeholder="https://example.com to show The Last Marks of this Subject"
                             size="30">
                            <span class="text-danger" id="nameError"></span>
                        </div>
                        <label for="exampleFormControlInput1">year</label>
                        <select class="form-control" name="year" value="{{ $subject->year }}" id="exampleFormControlSelect1">
                            <option value="first">first</option>
                            <option value="second">second</option>
                            <option value="third">third</option>
                            <option value="forth">forth</option>
                            <option value="fifth">fifth</option>
                        </select>

                        <br>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">update</button>
                            <a class="btn btn-primary" href="{{ route('getAllMySubjects') }}" role="button">back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
