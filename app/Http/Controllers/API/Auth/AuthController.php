<?php

namespace App\Http\Controllers\API\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserForHomeResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function me()
    {
        $user = Auth::user();

        $user = User::with('subscriptionHistory')->find($user->id);
        return successResponse(UserForHomeResource::make($user));
    }

    public function loginWithPhone(Request $request)
    {
        $validate = validate($request->all(), [
            'phone' => 'required',
            'password' => 'required'
        ]);

        if ($validate !== true) return $validate;

        $user = User::where('phone', $request->phone)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            if (is_null($user)) {
                return authFailed();
            }
            // User is not active
            elseif (!$user->is_active) {
                return errorResponse("User is not active!");
            } else {
                $user->token = $user->createToken('token')->plainTextToken;
                return successResponse(UserForHomeResource::make($user));
            }
        } else {
            return authFailed();
        }
    }

    public function loginWithLogin(Request $request)
    {
        $validate = validate($request->all(), [
            'login' => 'required',
            'password' => 'required'
        ]);

        if ($validate !== true) return $validate;

        $user = User::where('login', $request->login)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            if (is_null($user)) {
                return authFailed();
            }
            // User is not active
            elseif (!$user->is_active) {
                return errorResponse("User is not active!");
            } else {
                return successResponse([
                    'id' => $user->id,
                    'name' => $user->name,
                    'phone' => $user->phone,
                    'login' => $user->login,
                    'email' => $user->email,
                    'is_active' => $user->is_active,
                    'token' => $user->createToken('token')->plainTextToken,
                    // 'role' => $user->role,
                ]);
            }
        } else {
            return authFailed();
        }
    }

    public function loginWithEmail(Request $request)
    {
        $validate = validate($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validate !== true) return $validate;

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            if (is_null($user)) {
                return authFailed();
            }
            // User is not active
            elseif (!$user->is_active) {
                return errorResponse("User is not active!");
            } else {
                return successResponse([
                    'id' => $user->id,
                    'name' => $user->name,
                    'phone' => $user->phone,
                    'login' => $user->login,
                    'email' => $user->email,
                    'is_active' => $user->is_active,
                    'token' => $user->createToken('token')->plainTextToken,
                    // 'role' => $user->role,
                ]);
            }
        } else {
            return authFailed();
        }
    }

    public function logout()
    {
        Auth::user()->tokens->each(function ($token) {
            $token->delete();
        });

        return successResponse([
            'message' => "User logged out!"
        ]);
    }
}
