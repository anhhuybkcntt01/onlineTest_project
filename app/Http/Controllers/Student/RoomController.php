<?php

namespace App\Http\Controllers\Student;

use Auth;
use App\Room;
use App\RoomUser;
use App\Examination;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $rooms = $user->joinedRooms()->paginate(5);
        return view('student.room.index', compact('rooms'));

    }

    public function getAnotherRooms()
    {
        $user = Auth::user();
        $rooms = Room::with('members')->whereDoesntHave('members', function ($query) use ($user) {
            $query->where('users.id', $user->id);
        })->paginate(5);


        return view('student.room.homepage', compact('rooms'));

    }


    public function show($id)
    {
        return view('student.room.show');

    }

    public function destroy($id)
    {
        $room_users = RoomUser::all();
        foreach ($room_users as $room) {
            if ($room->room_id == $id) {
                $room->delete();
                return back()->with('success', "Out Room Successfully");
            }
        }

    }

    public function checkPassword(Request $request, $id)
    {
        $user = Auth::user();
        $room = Room::find($id);
        $users = $room->members;//??

        // foreach ($users as $userRoom) {
        //     if($userRoom->pivot->user_id == $user->id){
        //         return view('student.room.show',compact('room'));
        //     }
        // }

        if ($room->type == 'free') {
            // $room->members()->attach($user->id);
            // $user->joinedRoom()->attach($room->id);

            $room_user = new RoomUser();
            $room_user->room_id = $room->id;
            $room_user->user_id = $user->id;
            $room_user->save();
            // return redirect(route('student.room.show', ['id' => $room->id]))->with('success', 'Join in Room Successfully !');
            return redirect(route('student.room.index'))->with('success', 'Join in Room Successfully');

        } else {
            $room_password = $request->password;
            if ($room_password) {
                if ($room->password == $room_password) {
                    $room_user = new RoomUser();
                    $room_user->room_id = $room->id;
                    $room_user->user_id = $user->id;
                    $room_user->save();
                    // return redirect(route('student.room.show', ['id' => $room->id]))->with('success', 'Join in Room Successfully !');
                    return redirect(route('student.room.index'))->with('success', 'Join in Room Successfully');
                } else {
                    return back()->with('alert', 'Your password is error');
                }
            } else {
                return back()->with('alert', 'Your password is error');
            }


        }


    }


}
