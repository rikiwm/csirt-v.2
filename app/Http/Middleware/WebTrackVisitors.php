<?php

namespace App\Http\Middleware;

use App\Jobs\WebVisitorJob;
use App\Models\WebVisitor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Symfony\Component\HttpFoundation\Response;

class WebTrackVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();
        $agent = $request->header('User-Agent');
        $mac = $this->getMAcAddressShellExec();
        if(Env::get('APP_ENV') == 'production') {
            WebVisitorJob::dispatch($ip, $agent, $mac);
        }
        return $next($request);
    }

    private function getMAcAddressExec()
    {
        return substr(exec('getmac'), 0, 17);
    }

    private function getMAcAddressShellExec()
    {
            return substr(shell_exec('getmac'), 159,20);
    }
}
