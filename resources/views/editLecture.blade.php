@extends('layout')

@section('content')
    <div class="container" style="padding-top: 3%">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div style="width: 95%; height:7em;padding-top: 20px"   class="jumbotron jumbotron-fluid">
                        <div class="container">
                        <h1 class="display-5">Edit Lecture</h1>
                        <p class="lead"> This Lecture info to edit </p>
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
                    <form action="{{ route('updateLecture', ['id' => $lecture->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">name</label>
                            <input type="text" name="name" value="{{ $lecture->name }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">LinkForDownloade</label>
                            <input type="url" name="LinkForDownloade" value="{{ $lecture->LinkForDownloade }}" class="form-control">
                        </div>
                        <input type="hidden" name="subject_id" value="{{ $lecture->subject_id }}" class="form-control">

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">update</button>
                            <a class="btn btn-primary" href="{{ route('subjectShow', ['id' => $lecture->subject_id]) }}" role="button">back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
