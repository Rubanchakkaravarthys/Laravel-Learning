<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $credentials = $validator->validated();

        if (! Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid email or password.',
            ], 401);
        }

        $user = Auth::user();

        $token = $user->createToken(
            'api-token',
            $this->abilitiesForRole($user->role)
        )->plainTextToken;

        return response()->json([
            'message' => 'Login successful.',
            'user' => $user->only([
                'id',
                'name',
                'email',
                'role',
            ]),
            'token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function register(Request $request)
{
    $validated = $request->validate([
        'name' => ['required', 'string'],
        'email' => ['required', 'email','unique:users,email'],
        'password' => ['required', 'string'],
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    return response()->json([
        'message' => 'Registration successful.',
        'user' => $user->only(['id', 'name', 'email']),
    ], 201);
}

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout successful.',
        ]);
    }

    // Token revokes
    public function logoutAll(Request $request)
{
    $request->user()->tokens()->delete();

    return response()->json([
        'message' => 'Logged out from all devices successfully',
    ]);
}


    public function profile(Request $request)
    {
        return response()->json([
            'user' => $request->user()->only([
                'id',
                'name',
                'email',
                'role',
            ]),
        ]);
    }

    private function abilitiesForRole(?string $role): array
    {
        if ($role === 'admin') {
            return [
                'students:read',
                'students:create',
                'students:update',
                'students:delete',
            ];
            if (in_array($role, ['admin', 'manager'], true)) {
        $abilities[] = 'students:delete';
    }

    return $abilities;
        }

        return [
            'students:read',
            'students:create',
            'students:update',
        ];
    }
}
