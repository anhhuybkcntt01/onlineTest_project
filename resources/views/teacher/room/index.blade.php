@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
    <div class="col-md-8">
        <form action="{{ route('teacher.room.create') }}">
            @csrf
            <button class='btn btn-success'>Thêm lớp mới</button>
        </form>
        <div class="card">

            <div class="card">
                <div class="card-header">
                    Bạn đang có {{ $rooms->total() }} lớp học.
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th> Name</th>
                            <th> Type</th>
                            <th> Password</th>
                            <th > Avatar</th>
                            <th colspan="3"> Management</th>
                        </tr>
                        @foreach($rooms as $room)
                        <tr>
                            <td> {{ $room->name }}</td>
                            <td> {{ $room->type }}</td>
                            <td> {{ $room->password }}</td>
                            <td ><img src="{{ $room->avatar }}" height="100" /></td>
                            {{-- <a href="">Edit  </a>  <a href="">  Delete</a></ --}}

                            <th >
                                  <a class="btn btn-primary" href="{{ route('teacher.room.edit',['id'=>$room->id])}}">Edit  </a>
                            </th>
                            <th >
                                <form action="{{ route('teacher.room.destroy',['id'=>$room->id]) }}" method="POST">
                                   @csrf
                                   @method('delete')
                                <button type="submit" class="btn btn-danger">
                                    Delete
                                </button>
                                </form>
                            </th>
                            <th >
                                <a class="btn btn-info" href="{{ route('teacher.room.show',['id'=>$room->id])}}">Show  </a>
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
