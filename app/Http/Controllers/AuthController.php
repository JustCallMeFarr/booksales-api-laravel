<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * POST /api/register - daftar akun baru (role otomatis "user").
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->refresh();

        return response()->json([
            'success' => true,
            'message' => 'Registrasi berhasil',
            'data' => $user,
        ], 201);
    }

    /**
     * POST /api/login - login dan dapatkan token JWT.
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $token = auth('api')->attempt($validator->validated());

        if (! $token) {
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah',
            ], 401);
        }

        $user = auth('api')->user();
        $user->forceFill(['last_access' => now()])->save();

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data' => [
                'user' => $user,
                'token' => $token,
                'token_type' => 'Bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60,
            ],
        ]);
    }

    /**
     * GET /api/me - data akun yang sedang login.
     */
    public function me(): JsonResponse
    {
        $user = auth('api')->user();

        if ($user === null) {
            return response()->json([
                'success' => false,
                'message' => 'Anda belum login atau token tidak valid',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data akun',
            'data' => $user,
        ]);
    }

    /**
     * POST /api/logout - membuat token yang sedang dipakai tidak berlaku lagi.
     */
    public function logout(): JsonResponse
    {
        if (auth('api')->user() === null) {
            return response()->json([
                'success' => false,
                'message' => 'Anda belum login atau token tidak valid',
            ], 401);
        }

        auth('api')->logout();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil',
        ]);
    }
}
