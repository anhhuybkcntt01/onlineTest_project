<?php

namespace App\Http\Controllers\Teacher;

use Auth;
use App\Room;
use App\RoomUser;
use App\Examination;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user = Auth::user();
        $rooms = $user->createdRooms()->paginate(5);
        return view('teacher.room.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.room.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->type == 'limit'){
            $validatedData = $request->validate(
                ['name' => ['required'],
                'type' => ['required'],
                'password' => [ 'required','min:6'],
                'avatar' => ['required'],
            ]);
        }else{
            $validatedData = $request->validate(
                ['name' => ['required'],
                'type' => ['required'],
            // 'password' => [ 'min:6', 'numeric'],
                'avatar' => ['required'],
            ]);
        }

    // $imagePath = Storage::putFile('public', $request->file('avatar'));

        $imagePath = $request->file('avatar')->store('images');
        $room = new Room();
        $room->name = $request->name;
        $room->type = $request->type;
        $room->password = $request->password;
        $room->avatar = $imagePath;
        $room->user_id = Auth::user()->id;

        $room->save();
        return redirect(route('teacher.examination.index',['room_id'=>$room->id]))
            ->with('success','Created New Room Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $room = Room::find($id);
    //     $examinations = $room->createdExams()->paginate(5);
    //     foreach ($examinations as $examination) {
    //      $current = Carbon::now();
    //      if($current < $examination->begin_time) $examination->status = 'Open soon';
    //      if($examination->begin_time <= $current && $current <= $examination->finish_time) $examination->status = 'Opening';
    //      if($current > $examination->finish_time) $examination->status = 'Closing';
    //      //$examination->status = $examination->finish_time->diffForHumans($current);

    //      $examination->save();
    //     }
    //     return view('teacher.room.show',compact('room','examinations'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view('teacher.room.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->type == 'limit'){
            $validatedData = $request->validate(
                ['name' => ['required'],
                'type' => ['required'],
                'password' => [ 'required','min:6'],
            //'avatar' => ['required'],
            ]);
        }else{
            $validatedData = $request->validate(
                ['name' => ['required'],
                'type' => ['required'],
            // 'password' => [ 'min:6', 'numeric'],
            //'avatar' => ['required'],
            ]);
        }

        $avatar = $request->avatar;
        $room = Room::find($id);
        if($avatar){
            $imagePath = $request->file('avatar')->store('images');

            $room->name = $request->name;
            $room->type = $request->type;
            if($request->type == 'free')$room->password = null;
            else $room->password = $request->password;
            $room->avatar = $imagePath;
            $room->user_id = Auth::user()->id;

        }else{

            $room->name = $request->name;
            $room->type = $request->type;
            if($request->type == 'free')$room->password = null;
            else $room->password = $request->password;

            $room->user_id = Auth::user()->id;
        }

        $room->save();
        return redirect(route('teacher.room.index'))->with('success',"Edit Room Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $room = Room::find($id);


        $room->members()->detach();
        $room->createdExams()->delete();



        $destinationPath = 'storage/'.$room->avatar;
        if(file_exists($destinationPath)){
            unlink($destinationPath);
        }
        $room->delete();
        return back()->with('success',"Delete Room Successfully");
    }
}
