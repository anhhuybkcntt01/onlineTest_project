@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create New Examination</div>


                    <div class="card-body">
                        {{-- @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif --}}
                        <form method="POST" action="{{ route('teacher.examination.store',['room_id'=>$room->id]) }}"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Examination
                                    Title</label>

                                <div class="col-md-6">
                                    <input id="title" type="text"
                                           class="form-control @error('title') is-invalid @enderror" name="title"
                                           value="{{ old('title') }}" required autocomplete="title" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="duration" class="col-md-4 col-form-label text-md-right">Duration</label>

                                <div class="col-md-4">
                                    <input id="duration" type="number"
                                           class="form-control @error('duration') is-invalid @enderror" name="duration"
                                           value="{{ old('duration') }}" required autocomplete="duration" autofocus>

                                    @error('duration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <label class="col-md-4 col-form-label text-md-left">minutes</label>

                            </div>
                            <div class="form-group row">
                                <label for="begin-time" class="col-md-4 col-form-label text-md-right">Begin Time</label>

                                <div class="col-md-6">

                                    <div class="col-md-8">

                                        <b> Date </b>

                                        <input id="begin_date" type="date"
                                               class="form-control @error('begin_date') is-invalid @enderror"
                                               name="begin_date" value="{{ old('begin_date') }}" required
                                               autocomplete="begin_date" autofocus>
                                    </div>
                                    <div class="col-md-7">

                                        <b> Hour</b>
                                        <input id="begin_hour" type="time"
                                               class="form-control @error('begin_hour') is-invalid @enderror"
                                               name="begin_hour" value="{{ old('begin_hour') }}" required
                                               autocomplete="begin_hour" autofocus>


                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="finish_time" class="col-md-4 col-form-label text-md-right">Finish
                                    Time</label>

                                <div class="col-md-6">

                                    <div class="col-md-8">

                                        <b> Date </b>

                                        <input id="finish_date" type="date"
                                               class="form-control @error('finish_date') is-invalid @enderror"
                                               name="finish_date" value="{{ old('finish_date') }}" required
                                               autocomplete="finish_date" autofocus>
                                    </div>
                                    <div class="col-md-7">

                                        <b> Hour</b>
                                        <input id="finish_hour" type="time"
                                               class="form-control @error('finish_hour') is-invalid @enderror"
                                               name="finish_hour" value="{{ old('finish_hour') }}" required
                                               autocomplete="finish_hour" autofocus>


                                    </div>
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" style="margin-left: 80px">
                                        Create Examination
                                    </button>
                                </div>
                            </div>


                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>


    </script>
@endsection
