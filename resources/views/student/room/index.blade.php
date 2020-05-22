@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <form action="{{ route('student.room.homepage') }}">
                    @csrf
                    <button class='btn btn-warning'>Another Rooms</button>
                </form>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card">

                    <div class="card">
                        <div class="card-header">
                            Bạn đang tham gia {{ $rooms->total() }} lớp học.
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
                                    <tr>
                                        <td> {{ $room->name }}</td>
                                        <td> {{ $room->owner->name }}</td>
                                        <td> {{ $room->type }}</td>

                                        <td>
                                            <div><img src="{{ URL::to('storage/'.$room->avatar) }}" height="100%"
                                                      width="100%"/></div>
                                        </td>
                                        {{-- <a href="">Edit  </a>  <a href="">  Delete</a></ --}}

                                        <th>
                                            <a class="btn btn-primary"
                                               href="{{ route('student.examination.index',['room_id'=>$room->id])}}">Join </a>
                                        </th>
                                        <th>
                                            <form action="{{ route('student.room.destroy',['id'=>$room->id]) }}"
                                                  method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">
                                                    Out
                                                </button>
                                            </form>
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
