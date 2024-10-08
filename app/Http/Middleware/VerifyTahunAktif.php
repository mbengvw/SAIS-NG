<?php

namespace App\Http\Middleware;

use App\Services\TahunService;
use Closure;
use Illuminate\Http\Request;

class VerifyTahunAktif
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $data_tahun = TahunService::getActive();
        if ($data_tahun) {
            return $next($request);
        }
        return redirect()->route('error.no_tahun_aktif');
    }
}
