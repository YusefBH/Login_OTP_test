<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PersianToEnglish
{
    public function handle(Request $request, Closure $next): Response
    {
        $all = $request->all();
        $converted = [];
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        foreach ($all as $key => $value) {
            if (is_string($value)) {
                $converted[$key] = str_replace($persian, $english, $value);;
            } else {
                $converted[$key] = $value;
            }
        }

        $request->merge($converted);

        return $next($request);
    }
}
