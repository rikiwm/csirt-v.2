<?php

namespace App\Http\Middleware;

use App\Jobs\PostVisitorJob;
use App\Models\Post;
use App\Models\ViewVisitor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Env;
use Symfony\Component\HttpFoundation\Response;

class PostTrackVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $p = $request->route('slug');
        $postId = Post::where('slug', $p)->first()->id;
        $ip = $request->ip();
        if(Env::get('APP_ENV') == 'production') {
        PostVisitorJob::dispatch($postId, $ip);
        }
        return $next($request);
    }
}
