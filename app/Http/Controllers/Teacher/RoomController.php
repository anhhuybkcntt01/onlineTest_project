<?php

namespace App\Http\Controllers\Teacher;

use Auth;
use App\Room;
use Illuminate\Http\Request;
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
        $rooms = $user->createdRooms()->paginate(2);
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
        $validatedData = $request->validate(
            ['name' => ['required'],
            'type' => ['required'],
            'password' => ['required', 'min:6', 'numeric'],
            'avatar' => ['required'],]);
        $room = new Room();
        $room->name = $request->name;
        $room->type = $request->type;
        $room->password = $request->password;
        $room->avatar = $request->avatar;
        $room->user_id = Auth::user()->id;

        $room->save();
        return redirect(route('teacher.room.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Room::find($id);
        return view('teacher.room.show',compact('room'));
    }

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
        $validatedData = $request->validate(
            ['name' => ['required'],
            'type' => ['required'],
            'password' => ['required', 'min:6'],
            'avatar' => ['required'],]);
        $room = Room::find($id);
        $room->name = $request->name;
        $room->type = $request->type;
        $room->password = $request->password;
        $room->avatar = $request->avatar;
        $room->user_id = Auth::user()->id;

        $room->save();
        return redirect(route('teacher.room.index'));
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
        $room->delete();
        return back();
    }
}
