@extends('layout')

@section('content')
    <div class="container" style="padding-top: 3%">
        <div class="container">
            <div class="row">
                <div style="width: 95%; height:7em;padding-top: 20px"   class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-5">Edit Course</h1>
                        <p class="lead"> This Course info to edit </p>
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
                    <form action="{{ route('updateCourse', ['id' => $course->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">name</label>
                            <input type="text" name="name" value="{{ $course->name }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">LINK</label>
                            <input type="text" name="Link" value="{{ $course->Link }}" class="form-control" placeholder="https://example.com"
                             size="30">
                        </div>
                        <input type="hidden" name="subject_id" value="{{ $course->subject_id }}" class="form-control">

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">update</button>
                            <a class="btn btn-primary" href="{{ route('courseShow', ['id' => $course->subject_id]) }}" role="button">back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
