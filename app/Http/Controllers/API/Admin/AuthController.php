<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'registration']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $data = request(['email', 'password']);

        $user=User::query()
            ->where('email',$data['email'])
            ->first();

        if (!Hash::check($data['password'], $user->password)){
            return response()->json(['error' => 'Неверный пароль'], 401);
        };

        $token = Auth::guard('api')->tokenById($user->id);

        return $this->respondWithToken($token);
    }

    /**
     * User registration
     */
    public function registration(RegisterUserRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);
        User::query()
            ->create($data);

        return response()->json(['message' => 'Пользователь зарегистрирован!']);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
        ]);
    }
}
