<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentSecurityPolicy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $nonce = base64_encode(random_bytes(16));
        // Simpan nonce di view share agar bisa diakses dari blade
        view()->share('csp_nonce', $nonce);
        // Tambahkan CSP header ke response
        $response->headers->set(
            'Content-Security-Policy',
            "script-src 'nonce-{$nonce}' 'strict-dynamic'; object-src 'none'; base-uri 'none';"
        );

        return $response;
    }
}
