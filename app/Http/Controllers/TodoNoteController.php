<?php

namespace App\Http\Controllers;

use App\TodoNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TodoNoteController extends Controller
{
    public function userNotes($username)
    {
        $userNotes = TodoNote::select('id', 'content','completionTime')->where('owner', $username)->get()->all();
        return response()->json(["success" => true, "data" => $userNotes]);
    }

    public function currentUserNotes()
    {
        return TodoNoteController::userNotes($_SESSION['username']);
    }

    public function create(Request $request)
    {
	  $this->validate($request, [
	  'content' => 'required',
	 ]);

        $todoCard = new TodoNote;
        $todoCard->owner = $_SESSION['username'];
        $todoCard->content = $request->content;
        $todoCard->completionTime = null;
        $todoCard->complete = false;
        $todoCard->save();
        return response()->json(["success" => true, "newId" => $todoCard->id]);
    }

    public function setComplete($id, Request $request)
    {
	  $this->validate($request, [
	  'complete' => 'required',
	 ]);
        $todoNote=TodoNote::where('id', $id)->first();
        if (!is_bool($request->complete)){
            return response()->json(["success" => false, "error" => "complete is not true or false"]);
        }
        if ($request->complete){
	    $todoNote->completionTime = DB::raw('now()');
	    $todoNote->complete = true;
        }
        else{
	    $todoNote->completionTime = null;
	    $todoNote->complete = false;
        }

        $todoNote->save();
        return response()->json(["success" => true]);
    }

    public function delete($id)
    {
        $todoNote=TodoNote::where('id', $id);
        $todoNote->delete();
        return response()->json(["success" => true]);
    }
}
?>
