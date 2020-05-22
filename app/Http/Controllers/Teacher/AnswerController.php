<?php

namespace App\Http\Controllers\Teacher;

use App\Answer;
use App\Examination;
use App\Question;
use App\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create($room_id, $examination_id,$question_id)
    {
        $room = Room::find($room_id);
        $examination = Examination::find($examination_id);
        $question = Question::find($question_id);

        $answers = $question->createdAnswers;
        return view('teacher.answer.create', compact('room', 'examination','question','answers'));
    }
    public function store(Request $request, $room_id, $examination_id,$question_id)
    {
        return $request;
        $room = Room::find($room_id);
        $examination = Examination::find($examination_id);
        $question = Question::find($question_id);
        $answer = new Answer();
        $answer->question_id = $question_id;
        $answer->content = $request->answer_content;

        $answer->save();

        $answers = $question->createdAnswers;
        return view('teacher.answer.create', compact('room', 'examination','question','answers'));





    }
}
