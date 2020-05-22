<?php

namespace App\Http\Controllers\Student;


use Auth;
use App\Room;
use App\RoomUser;
use App\Examination;
use Carbon\Carbon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return view('student.room.show',compact('room','examinations'));
    }
}
