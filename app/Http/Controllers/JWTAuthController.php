<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTAuthController extends Controller
{
    public function index(): View
    {
        $users = User::latest()->paginate(10);
        return view('user.index', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create(): View
    {
        return view('user.create');
    }

    // Registrar um novo usuário
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('user.create')
                ->withErrors($validator);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = JWTAuth::fromUser($user);

        return redirect()->route('user.index')
            ->with('user', $user)
            ->with('token', $token);
    }

    // Autenticar o usuário e gerar um token JWT
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return redirect()->route('welcome')
                ->withErrors('error', 'Unauthorized');
        }

        return redirect()->route('welcome')
            ->withCookie(cookie('token', $token, 60));
    }

    // Logout do usuário (invalidar o token)
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === 1) {
            return redirect()->route('user.index')
                ->withErrors(['error' => 'You cannot delete The Administrator']);
        }
        $user->delete();
        return redirect()->route('user.index')
            ->with('success', 'Author deleted successfully.');
    }
}
