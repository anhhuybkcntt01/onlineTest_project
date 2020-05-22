<?php

namespace App\Http\Controllers\Teacher;

use Auth;
use App\Room;
use App\Examination;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExaminationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $room = Room::find($id);
        $examinations = $room->createdExams()->paginate(5);
        foreach ($examinations as $examination) {
         $current = Carbon::now();
         if($current < $examination->begin_time) $examination->status = 'Open soon';
         if($examination->begin_time <= $current && $current <= $examination->finish_time) $examination->status = 'Opening';
         if($current > $examination->finish_time) $examination->status = 'Closing';
         //$examination->status = $examination->finish_time->diffForHumans($current);

         $examination->save();
        }
        return view('teacher.room.show',compact('room','examinations'));
    }

    public function create($room_id)
    {
        $room = Room::find($room_id);
        return view('teacher.examination.create',compact('room'));
    }

    public function store(Request $request,$room_id)
    {
        $examination = new Examination();
        $examination->title = $request->title;
        $examination->duration = $request->duration;
        $examination->room_id = $room_id;
        $begin_date = $request->begin_date;
        $begin_hour = $request->begin_hour;

        $finish_date = $request->finish_date;
        $finish_hour = $request->finish_hour;


        $begin_time = $begin_date.' '.$begin_hour; //dấu cách ở giữa
        $examination->begin_time = Carbon::createFromFormat('Y-m-d H:i', $begin_time);

        $finish_time = $finish_date.' '.$finish_hour; //dấu cách ở giữa
        $examination->finish_time = Carbon::createFromFormat('Y-m-d H:i', $finish_time);

         $current = Carbon::now();
         if($current < $examination->begin_time) $examination->status = 'Open soon';
         if($examination->begin_time <= $current && $current <= $examination->finish_time) $examination->status = 'Opening';
         if($current > $examination->finish_time) $examination->status = 'Closing';
         //$examination->status = $examination->finish_time->diffForHumans($current);

         $examination->save();
        return redirect(route('teacher.question.create',['room_id'=>$room_id,'examination_id'
                        =>$examination->id]))->with('success','Create Examination Successfully! Now, create new question for your examination');

    }
    public function show($room_id, $id)
    {
        $room = Room::find($room_id);
        $examination = Examination::find($id);
        $questions = $examination->createdQuestions;
        return view('teacher.examination.show',compact('room','examination','questions'));
    }

    public function edit($room_id, $id)
    {

    }
    public function destroy($room_id, $id)
    {

    }
}
