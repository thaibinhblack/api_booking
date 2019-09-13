<?php 
namespace App\Http\Middleware;
use Closure;
class Cors
{

    public function handle($request, Closure $next)
    {
        return $next($request)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Controll-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS')
        ->header('Access-Controll-Allow-Headers', 'Content-Type', 'Authorization');
    }
}