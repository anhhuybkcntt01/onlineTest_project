@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('student.room.index') }}">
                    @csrf
                    <button class='btn btn-warning'> Back Your Rooms</button>
                </form>
                @if(session('alert'))
                    <div class="alert alert-success">
                        {{ session('alert') }}
                    </div>
                @endif


                {{--  <form action="{{ route('student.room.homepage') }}">
                     @csrf
                     <button class='btn btn-warning'>Join in a new room </button>
                 </form> --}}
                <div class="card">

                    <div class="card">
                        <div class="card-header">
                            Hiện tại, trong hệ thống có {{ $rooms->total() }} lớp học mà bạn chưa tham gia.
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th> Name</th>
                                    <th> Teacher</th>
                                    <th> Type</th>

                                    <th> Avatar</th>
                                    <th colspan="3"> Management</th>
                                </tr>
                                @foreach($rooms as $room)
                                    <form action="{{ route('student.room.checkpassword',['id'=>$room->id]) }}"
                                          method="POST">
                                        @method('put')
                                        @csrf
                                        <div class="modal " id="modal-{{ $room->id }}" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true"
                                        >
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Password
                                                            Alert</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    @if($room->type  == "limit")
                                                        <div class="modal-body">

                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">
                                                                    This room needs password to Come in.
                                                                    If you don't know its password, please contact to
                                                                    its teacher by:
                                                                    <br>
                                                                    Email: {{ $room->owner->email }}
                                                                    <br>
                                                                    Phone: {{ $room->owner->phone }}
                                                                    <br>
                                                                    If you know its password, please check password:

                                                                </label>

                                                                <input type="text" class="form-control"
                                                                       id="recipient-name" name="password">
                                                            </div>

                                                        </div>


                                                    @elseif($room->type == "free")
                                                        <div class="modal-body">

                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">
                                                                    This room is free.
                                                                    You can join it now !

                                                                </label>

                                                            </div>

                                                        </div>
                                                    @endif

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">
                                                            Join
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <tr>
                                        <td> {{ $room->name }}</td>
                                        <td> {{ $room->owner->name }}</td>
                                        <td> {{ $room->type }}</td>
                                        {{-- <td> {{ $room->password }}</td> --}}
                                        <td>
                                            <div><img src="{{ URL::to('storage/'.$room->avatar) }}" height="100%"
                                                      width="100%"/></div>
                                        </td>
                                        {{-- <a href="">Edit  </a>  <a href="">  Delete</a></ --}}

                                        <th>

                                            <button class="btn btn-primary"
                                                    data-toggle="modal" data-target="#modal-{{ $room->id }}"
                                            >Come in
                                            </button>

                                        </th>


                                    </tr>

                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>
                <span> {{ $rooms->render() }}</span>
            </div>
        </div>
@endsection
