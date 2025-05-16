<?php

namespace App\Http\Controllers;

use App\Contracts\AuthInterface;
use App\Services\AdminServices;
use App\Services\MahasiswaServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            if (Auth::user()->isAdmin()) {
                return $this->processLogin(new AdminServices);
            } else {
                return $this->processLogin(new MahasiswaServices);
            }
        }

        throw ValidationException::withMessages([
            'email' => ['Kredensial yang diberikan tidak cocok dengan data kami.'],
        ]);
    }

    /**
     * Menampilkan halaman register
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Proses register
     */
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'nim' => 'required|string|unique:mahasiswa',
                'prodi_id' => 'required|exists:prodi,id',
                'tahun_masuk' => 'required|digits:4',
                'alamat' => 'nullable|string',
                'no_hp' => 'nullable|string|max:15',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $mahasiswaService = new MahasiswaServices();
            return $mahasiswaService->register($request);
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Proses logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        Session::forget('mahasiswa');

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }


    /* Private Function */
    private function processLogin(AuthInterface $authInt)
    {
        $user = Auth::user();
        return $authInt->login($user);
    }
}
