<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Проверяем, что пользователь существует и у него есть наш метод isAdmin(),
        // и что этот метод возвращает true.
        if ($request->user() && $request->user()->isAdmin()) {
            // Если да - пропускаем запрос дальше.
            return $next($request);
        }

        // Если нет - выдаем ошибку "Доступ запрещен".
        abort(403);
    }
}
