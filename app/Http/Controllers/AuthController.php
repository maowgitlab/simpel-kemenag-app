<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\VerifyMail;
use App\Models\UserDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

class AuthController extends Controller
{
    protected $user, $userDetail;

    public function __construct(User $user, UserDetail $userDetail)
    {
        $this->user = $user;
        $this->userDetail = $userDetail;
    }

    private function generateSuccessMessage($text)
    {
        return '<script>
            Swal.fire({
                title: "Berhasil!",
                text: "' . $text . '",
                icon: "success",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        </script>';
    }

    private function generateErrorMessage($text)
    {
        return '<script>
            Swal.fire({
                title: "Gagal!",
                text: "' . $text . '",
                icon: "error",
                showConfirmButton: true
            });
        </script>';
    }

    public function login()
    {
        if (auth()->check()) {
            return back();
        }
        return view('auth.pages.login');
    }

    public function authenticate(Request $request)
    {
        // ... (Validasi dan Cek Kredensial)
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username tidak boleh kosong.',
            'password.required' => 'Password tidak boleh kosong.',
        ]);
        if (auth()->attempt($credentials)) {
            // Login Berhasil
            $request->session()->regenerate();
            $this->user->where('username', $credentials['username'])->increment('total_login');
            $message = '<script>
                Swal.fire({
                  title: "Login Berhasil!",
                  text: "Selamat Datang Kembali ' . $credentials['username'] . '.",
                  icon: "success",
                  confirmButtonText: "OK"
                });
            </script>';
            return redirect()->intended('/dashboard')->with('message', $message);
        } else {
            // Login Gagal
            $message = '<script>
                Swal.fire({
                  title: "Login Gagal!",
                  text: "Username atau password Anda salah.",
                  icon: "error",
                  confirmButtonText: "OK"
                });
            </script>';
            return back()->with('message', $message);
        }
    }

    public function logout()
    {
        if (auth()->check()) {
            $this->user->where('username', auth()->user()->username)->update(['terakhir_login' => time()]);
            session()->invalidate();
            auth()->logout();
            $message = '<script>
                Swal.fire({
                    title: "Berhasil!",
                    text: "Anda telah logout.",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            </script>';
            return redirect()->route('login')->with('message', $message);
        } else {
            return back();
        }
    }

    public function verify($username)
    {
        return view('auth.pages.verify', [
            'user' => $this->user->where('username', Crypt::decrypt($username))->first(),
        ]);
    }

    public function verifyEmail($email)
    {
        $user = $this->userDetail->where('email', $email)->first();
        if ($user->user->token === null) {
            $verificationCode = Str::random(6);
            $user->user->token = $verificationCode;
        } else {
            $user->user->update(['token' => null]);
            $verificationCode = Str::random(6);
            $user->user->token = $verificationCode;
        }
        $user->user->save();
        Mail::to($user->email)->send(new VerifyMail($verificationCode));
        $message = $this->generateSuccessMessage('Token verifikasi telah dikirimkan ke email Anda.');
        return back()->with('message', $message);
    }

    public function activate(Request $request)
    {
        $data = $request->validate([
            'token' => 'required',
        ], [
            'token.required' => 'Token tidak boleh kosong.',
        ]);
        $user = $this->user->where('token', $data['token'])->first();
        if ($user) {
            $user->update(['token' => null, 'status' => 'aktif', 'email_verified_at' => now()]);
            $message = $this->generateSuccessMessage('Akun Anda berhasil diaktifkan. Silahkan login kembali.');
            return redirect()->route('login')->with('message', $message);
        } else {
            $message = $this->generateErrorMessage('Token yang Anda masukkan tidak valid.');
            return back()->with('message', $message);
        }
    }
}
