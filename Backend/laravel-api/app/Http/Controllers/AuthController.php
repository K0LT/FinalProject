<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Registo de novo utilizador (SPA + Sanctum com cookies).
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'surname'               => ['nullable', 'string', 'max:255'],
            'email'                 => ['required', 'email', 'max:255', 'unique:users,email'],
            'password'              => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number'          => ['required', 'string', 'max:20'],
            'gender'                => ['nullable', 'string', 'max:50'],
            'client_since'          => ['nullable', 'date'],
        ]);

        // Role "por defeito" para novos utilizadores (3 = Patient)
        $defaultRoleId = 3;

        $user = User::create([
            'role_id'  => $defaultRoleId,
            'name'     => $data['name'],
            'surname'  => $data['surname'] ?? '',
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Create associated Patient record
        $patient = Patient::create([
            'user_id'      => $user->id,
            'phone_number' => $data['phone_number'] ?? null,
            'address'      => '',
            'gender'       => $data['gender'] ?? null,
            'client_since' => $data['client_since'] ?? now()->toDateString(),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return response()->json([
            'message' => 'Registo efectuado com sucesso.',
            'user'    => $user->load('patient'),
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
            'remember' => ['boolean'],
        ]);

        if (! Auth::attempt(
            ['email' => $credentials['email'], 'password' => $credentials['password']],
            $request->boolean('remember')
        )) {
            throw ValidationException::withMessages([
                'email' => 'As credenciais fornecidas não são válidas.',
            ]);
        }

        $request->session()->regenerate();

        return response()->json([
            'message' => 'Sessão iniciada com sucesso.',
            'user'    => $request->user(),
            'auth_token' => $request->user()->createToken('auth_token')->plainTextToken,
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'Sessão terminada com sucesso.',
        ]);
    }

    // TEMP GET USER FROM BEARER TOKEN
    public function user(Request $request){
        return response()->json($request->user());
    }

    /**
     * Web Login - Redireciona para o perfil do cliente ou dashboard admin
     */
    public function webLogin(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
            'remember' => ['boolean'],
        ]);

        if (! Auth::attempt(
            ['email' => $credentials['email'], 'password' => $credentials['password']],
            $request->boolean('remember')
        )) {
            return back()->withErrors([
                'email' => 'As credenciais fornecidas não são válidas.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        // Redirect based on user role
        $user = Auth::user();
        if ($user->role->name === 'Admin') {
            return redirect()->route('admin.dashboard');
        }
        
        return redirect()->route('user.profile');
    }

    /**
     * Web Register - Cria utilizador e redireciona para perfil
     */
    public function webRegister(Request $request)
    {
        $data = $request->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'surname'               => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'email', 'max:255', 'unique:users,email'],
            'password'              => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number'          => ['nullable', 'string', 'max:20'],
            'gender'                => ['nullable', 'string', 'max:50'],
            'age'                   => ['nullable', 'integer'],
            'weight'                => ['nullable', 'numeric'],
            'height'                => ['nullable', 'numeric'],
            'goals'                 => ['nullable', 'string'],
            'terms'                 => ['required', 'accepted'],
        ]);

        // Role 3 = Patient
        $user = User::create([
            'role_id'  => 3,
            'name'     => $data['name'],
            'surname'  => $data['surname'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Create associated Patient record
        $patient = Patient::create([
            'user_id'      => $user->id,
            'phone_number' => $data['phone_number'] ?? null,
            'address'      => '',
            'gender'       => $data['gender'] ?? null,
            'client_since' => now()->toDateString(),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('user.profile');
    }

    /**
     * Web Logout
     */
    public function webLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
