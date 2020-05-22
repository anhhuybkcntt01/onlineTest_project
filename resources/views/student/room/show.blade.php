
@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
    <div class="col-md-8">

        <form action="{{ route('student.room.index') }}">
            @csrf
            <button class='btn btn-warning'>Back to your Rooms</button>
        </form>
      {{--   @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif --}}
        <div class="card">

            <div class="card">
                <div class="card-header">
                    Lớp đang có {{ $examinations->total() }} bài thi.
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th> Title</th>
                            <th> Room</th>
                            <th> Duration</th>
                            <th > Total Question</th>
                            <th > Total Point</th>
                            <th > Begin Time</th>
                            <th > Finish Time</th>
                            <th > Status</th>
                            <th colspan="3"> Management</th>
                        </tr>
                        @foreach($examinations as $exam)
                        <tr>
                            <td> {{ $exam->title }}</td>
                            <td> {{ $exam->room_owner->name }}</td>
                            <td> {{ $exam->duration }}</td>
                            <td> {{ $exam->total_question }}</td>
                            <td> {{ $exam->point }}</td>
                            <td> {{ $exam->begin_time }}</td>
                            <td> {{ $exam->finish_time }}</td>
                            <td> {{ $exam->status }}</td>



                        <th >
                                  <a class="btn btn-primary" href="{{ route('teacher.examination.edit',['room_id'=>$room->id,'id'=>$exam->id])}}">Edit  </a>
                            </th>

                            <th >
                                <form action="{{ route('teacher.examination.destroy',['room_id'=>$room->id,'id'=>$exam->id]) }}" method="POST">
                                   @csrf
                                   @method('delete')
                                <button type="submit" class="btn btn-danger">
                                    Delete
                                </button>
                                </form>
                            </th>

                            <th >
                                <a class="btn btn-info" href="{{ route('teacher.examination.show',['room_id'=>$room->id, 'id'=>$exam->id])}}">Show  </a>
                            </th>
                        </tr>

                        @endforeach

                    </table>
                </div>
            </div>
        </div>
        <span> {{ $examinations->render() }}</span>
    </div>
</div>
@endsection
