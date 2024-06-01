<?php

namespace App\Http\Controllers\API;

use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Models\DataMaster\ConfigEmail;
use App\Models\User;
use App\Traits\FileHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    use FileHandler;

    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function login(Request $request)
    {
        try {
            $validated = $request->validate([
                'username'  => 'required',
                'password'  => 'required',
                'fcm_token' => 'nullable',
            ]);
            if (Auth::attempt(['username' => $validated['username'], 'password' => $validated['password']])) {
                $user = Auth::user();

                // check is_active user !== 1
                if ($user->is_active == 0) {
                    throw new CustomException(null, 'ERROR_UNAUTHORISED_LOGIN', 'User not active');
                }

                return $this->sendResponse([
                    'authorization' => 'Bearer',
                    'token'         => $user->createToken('MyApp')->plainTextToken,
                    'urole'         => $user->getRoleNames(),
                ], 'USER_LOGIN_SUCCESSFULLY');
            } else {
                throw new CustomException(null, 'ERROR_UNAUTHORISED_LOGIN', 'User not found');
            }
        } catch (\Exception $e) {
            throw new CustomException($e, 'ERROR_UNAUTHORISED_LOGIN', 'User not found');
        }
    }

    public function register(Request $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'email'    => 'required|unique:users|email',
                'username' => 'required|unique:users',
                'nik'      => 'required|unique:wargas|numeric',
                'no_hp'    => 'required|unique:wargas',
                'name'     => 'required',
                'password' => 'required|confirmed',
            ]);
            $validated['password'] = Hash::make($validated['password']);
            $requestUser           = [
                'name'      => $validated['name'],
                'username'  => $validated['username'],
                'email'     => $validated['email'],
                'password'  => $validated['password'],
                'hp'        => $validated['no_hp'],
                'is_active' => 0,
            ];
            $data = $this->model->create($requestUser);
            $data->syncRoles('user');
            DB::commit();

            return $this->sendResponse([
                'data' => $data,
            ], 'USER_REGISTER_SUCCESSFULLY');
        } catch (\Exception $e) {
            DB::rollback();
            throw new CustomException($e, 'ERROR_REGISTER', 'Register failed!');
        }
    }

    public function logout(Request $request)
    {
        try {
            if (auth()->check()) {
                auth()->user()->tokens()->delete();

                return $this->sendResponse([
                    'success' => true,
                ], 'USER_LOGOUT_SUCCESSFULLY');
            }

            return $this->sendError('ACTION_FAIL', ['error' => 'UNAUTHORISED']);
        } catch (\Exception $e) {
            throw new CustomException($e, 'ERROR_UNAUTHORISED_LOGIN', 'User not found');
        }
    }

    // change-password
    public function changePassword(Request $request)
    {
        try {
            $validated = $request->validate([
                'password' => 'required|confirmed',
            ]);
            $user           = Auth::user();
            $user->password = Hash::make($validated['password']);
            $user->save();

            return $this->sendResponse([
                'success' => true,
            ], 'USER_CHANGE_PASSWORD_SUCCESSFULLY');
        } catch (\Exception $e) {
            throw new CustomException($e, 'ERROR_CHANGE_PASSWORD', 'User not found');
        }
    }

    // change profile user
    public function changeProfile(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'      => 'required',
                'email'     => ['required', 'email', Rule::unique('users')->ignore(Auth::id())],
                'username'  => ['required', Rule::unique('users')->ignore(Auth::id())],
                'fcm_token' => 'nullable',
            ]);

            $userFields = [
                'name'     => $validated['name'],
                'username' => $validated['username'],
                'email'    => $validated['email'],
                'hp'       => $validated['no_hp'],
            ];

            Auth::user()->update($userFields);

            return $this->sendResponse(['data' => Auth::user()], 'USER_CHANGE_PROFILE_SUCCESSFULLY');
        } catch (\Exception $e) {
            throw new CustomException($e, 'ERROR_CHANGE_PROFILE', 'User not found');
        }
    }

    public function forgetPassword(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
            ]);

            // Mengambil data konfigurasi email dari database
            $data = ConfigEmail::firstOrFail(); // Gunakan firstOrFail untuk memastikan bahwa data konfigurasi ada

            // Mengatur konfigurasi mail sesuai data dari database
            $config = [
                'driver' => $data->mailer,
                'host'   => $data->host,
                'port'   => $data->port,
                'from'   => [
                    'address' => $data->email,
                    'name'    => 'APP - BELUM ADA NAMA',
                ],
                'encryption' => $data->enc,
                'username'   => $data->username,
                'password'   => Crypt::decryptString($data->check),
            ];

            // Mengatur konfigurasi secara dinamis
            Config::set('mail', $config);

            // Pastikan untuk memperbarui instance driver mail sesudah konfigurasi diubah
            (new \Illuminate\Mail\MailServiceProvider(app()))->register();

            // Kirim reset link
            $status = Password::sendResetLink(
                array_merge($request->only('email'), ['is_active' => 1])
            );

            if ($status == Password::RESET_LINK_SENT) {
                return $this->sendResponse([
                    'success' => true,
                ], 'USER_FORGET_PASSWORD_SUCCESSFULLY');
            } else {
                throw new CustomException(null, 'ERROR_FORGET_PASSWORD', 'User not found');
            }
        } catch (\Exception $e) {
            throw new CustomException($e, 'ERROR_FORGET_PASSWORD', 'User not found');
        }
    }
}
