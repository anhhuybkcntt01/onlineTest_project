@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Room</div>


                <div class="card-body">
                    <form method="POST" action="{{ route('teacher.room.update',['id'=>$room->id]) }}">
                        @csrf

                        @method('put')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Room Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $room->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right">Room Type</label>

                            <div class="col-md-6">
                                <select class="form-control" name="type">
                                    @if($room->type == 'free')
                                    <option selected="free" value="free">Free</option>
                                    <option value="limit">Limit</option>
                                    @endif
                                    @if($room->type == 'limit')
                                    <option value="free">Free</option>
                                    <option selected="limit" value="limit">Limit</option>
                                    @endif

                                </select>
                                @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right">Room Password</label>

                            <div class="col-md-6">
                                <input id="password" type="integer" class="form-control @error('name') is-invalid @enderror" name="password" value="{{ $room->password }}" required autocomplete="password" autofocus>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <br>
                                <img src="{{ $room->avatar }}" height="100">
                            <br>
                            <label for="" class="col-md-4 col-form-label text-md-right">Room Avatar</label>

                            <div class="col-md-6">
                                <input id="avatar" type="file" class="form-control @error('name') is-invalid @enderror" name="avatar" value="{{ $room->avatar }}" required autocomplete="avatar" autofocus>

                                @error('avatar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>




                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Edit Room
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
