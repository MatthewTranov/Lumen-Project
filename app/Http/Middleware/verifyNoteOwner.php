<?php

namespace App\Http\Middleware;
use App\TodoNote;
use Closure;

class verifyNoteOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $todoNote=TodoNote::where('id', $request->id);
        if (is_null($todoNote->first())){
            return response()->json(["success" => false, "error"=> "Todo note not found"]);
        }
	if ($todoNote->first()->owner != $_SESSION['username'])
	{
            return response()->json(["success" => false, "error"=> "logged in user is not owner"]);
	}
        return $next($request);
    }
}
?>
