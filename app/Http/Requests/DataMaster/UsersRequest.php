<?php

namespace App\Http\Requests\DataMaster;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsersRequest extends FormRequest
{
    protected $redirect;

    public function __construct()
    {
        // dd(request()->all());
        $this->redirect = route(request()->redirectRoute);
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if (request()->method() == 'POST') {
            return [
                'name'     => 'required',
                'username' => ['required', Rule::unique('users')->whereNull('deleted_at')],
                'email'    => ['required', Rule::unique('users')->whereNull('deleted_at')],
                'password' => 'required|min:3|confirmed',
                'role'     => 'required|array',
                // 'permission' => 'required|array',
            ];
        }

        return [
            'name'     => 'required',
            'username' => ['required', Rule::unique('users')->ignore($this->user->id)->whereNull('deleted_at')],
            'email'    => ['required', Rule::unique('users')->ignore($this->user->id)->whereNull('deleted_at')],
            'role'     => 'required',
            'file'     => 'nullable|mimes:pdf|max:2048',
            // 'permission' => 'required',
        ];
    }
}
