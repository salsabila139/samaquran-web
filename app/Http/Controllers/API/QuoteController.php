<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Validator;

class QuoteController extends Controller
{
    public function index()
    {
        $quote = Quote::orderBy('id', 'DESC')->get();

        return response()->json([
            'status'        => 1,
            'message'       => "Berhasil Get Data Quote",
            'data'          => $quote,
        ], Response::HTTP_OK);
    }

    public function daftar(Request $request)
    {
        $psn = [
            'name.required'      => "Nama wajib diisi.",

            'password.required'  => "Password wajib diisi.",
            'password.confirmed' => "Password konfirmasi tidak sesuai.",
            'password.min'       => "Password minimal diisi dengan 5 karakter.",

            'email.required'     => "Email wajib diisi.",
            'email.email'        => "Email tidak valid.",
            'email.unique'       => "Email sudah terdaftar.",
        ];

        $validasi = Validator::make($request->all(), [
            'name'               => "required",
            'email'              => "required|unique:users|email",
            'password'           => "required|min:5"
        ], $psn);

        if ($validasi->fails()) {
            $val = $validasi->errors()->all();
            // return $this->errorWoy("Failed", $val[0]);
            return $this->errorWoy(0, $val[0]);
        }

        $user = User::create(array_merge($request->all(), [
            'password' => bcrypt($request->password)
        ]));

        if ($user) {
            return response()->json([
                // 'status'    => 'Success',
                'status'    => 1,
                'message'   => "$user->email, has been registered",
                'data'      => $user
            ], Response::HTTP_OK);
        }

        // return $this->errorWoy('Failed', 'Registration failed');
        return $this->errorWoy(0, "Registration failed");
    }

    public function masuk(Request $request)
    {
        // dd($request->all());
        // die();

        $user = User::where('email', $request->email)->first();

        if ($user) {

            if (password_verify($request->password, $user->password)) {
                return response()->json([
                    // 'status'    => 'Success',
                    'status'    => 1,
                    'message'   => "Welcome, $user->name",
                    'data'      => $user
                ], Response::HTTP_OK);
            }

            // return $this->errorWoy("Failed", "Password wrong.");
            return $this->errorWoy(0, "Password wrong.");
        }
        // return $this->errorWoy("Failed", "Email not registered.");
        return $this->errorWoy(0, "Email not registered.");
    }

    public function errorWoy($sts, $pesan)
    {
        return response()->json([
            'status'    => $sts,
            'message'   => $pesan
        ], Response::HTTP_UNAUTHORIZED);
    }

}
