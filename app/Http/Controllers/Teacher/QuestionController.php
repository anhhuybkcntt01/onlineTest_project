<?php

namespace App\Http\Controllers\Teacher;

use App\Answer;
use App\Examination;
use App\Question;
use App\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create($room_id, $examination_id)
    {
        $room = Room::find($room_id);
        $examination = Examination::find($examination_id);

        return view('teacher.question.create', compact('room', 'examination'));
    }

    public function store(Request $request, $room_id, $examination_id)
    {
        $question = new Question();
        $question->examination_id = $examination_id;
        $question->content = $request->content_question;
        $question->point = $request->point;
        $question->save();
        $answers = $request->get('options');
        foreach ($answers as $index => $ans) {
            $answer = new Answer();
            $answer->question_id = $question->id;
            $answer->content = $ans;
            $answer->save();
            if ($index == $request->correct) {
                $question->correct_answer_id = $answer->id;
                $question->save();
            }
        }

        if($request->option == 1) {
            return back()->with('success', 'Create Question Successfully! Now, create more Question');
        }else{
            $examination = Examination::find($examination_id);
            $questions = $examination->createdQuestions;
            $examination->total_question = $questions->count();
            $point = 0;
            foreach ($questions as $ques){
                $point += $ques->point;
            }
            $examination->point = $point;
            $examination->save();
            return redirect(route('teacher.examination.show',['room_id'=>$room_id,'id'=>$examination_id]));

        }


    }
}
