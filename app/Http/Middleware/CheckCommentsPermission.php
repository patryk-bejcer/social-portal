<?php

namespace App\Http\Middleware;

use App\Comment;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckCommentsPermission
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
        $comment_exists = Comment::where([
            'id' => $request->comment,
            'user_id' => Auth::id(),
        ])->exists();

        if ( ! Auth::check() || ! $comment_exists && !is_admin()) {
            abort(403, 'Brak dostępu');
        }

        return $next($request);
    }
}
