<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Hanya mengizinkan request dari pengguna yang sudah login (membawa token JWT)
     * dan berperan admin.
     *
     * - Belum login / token salah atau kedaluwarsa -> 401 Unauthorized
     * - Sudah login tetapi bukan admin             -> 403 Forbidden
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth('api')->user();

        if ($user === null) {
            return response()->json([
                'success' => false,
                'message' => 'Anda belum login atau token tidak valid',
            ], 401);
        }

        if ($user->role !== 'admin') {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak, hanya admin yang diizinkan',
            ], 403);
        }

        return $next($request);
    }
}
