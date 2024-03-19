@extends('layout')

@section('content')
    <div class="container" style="padding-top: 3%">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div style="width: 95%; height:7em;padding-top: 20px"   class="jumbotron jumbotron-fluid">
                        <div class="container">
                        <h1 class="display-5">Edit Project</h1>
                        <p class="lead"> This Project info to edit </p>
                        </div>
                    </div>
                </div>

            </div>
            <div style="display: none;">
                {{ $students = DB::table('students')->get() }}
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
                    <form action="{{ route('updateProject', ['id' => $project->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">title</label>
                            <input type="text" name="title" value="{{ $project->title }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1"> description</label>
                            <input type="text" name="keyword" value="{{ $project->keyword }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">project files</label>
                            <input type="url" name="descrition" value="{{ $project->descrition }}"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">tool</label>
                            <input type="text" name="tool" value="{{ $project->tool }}"
                                class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">supervisored</label>
                            <input type="text" name="supervisored" value="{{ $project->supervisored }}"
                                class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">type</label>
                            <input type="text" name="type" value="{{ $project->type }}"
                                class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">specialization</label>
                            <input type="text" name="speailiazation" value="{{ $project->speailiazation }}"
                                class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                        </div>
                        <div class="form-group">
                            {{-- <label for="exampleFormControlInput1">studentName</label> --}}
                            <input type="hidden" name="studentName" value="{{ $project->studentName }}"
                                class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                    {{-- <select class="form-control" name="studentName" value="{{ $project->studentName }}" id="campaign_id_todo">
                                        @foreach ($students as $students)
                                            <option value="{{ $students->id }}">{{ $students->name }}</option>
                                        @endforeach
                                    </select> --}}

                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">update</button>
                            <a class="btn btn-primary" href="{{ route('getAllMyProjects') }}" role="button">back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
