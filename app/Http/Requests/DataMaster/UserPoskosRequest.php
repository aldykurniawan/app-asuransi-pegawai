<?php

namespace App\Http\Requests\DataMaster;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserPoskosRequest extends FormRequest
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
        $userId = $this->route('userposko');

        if (request()->method() == 'POST') {
            return [
                'name'     => 'required',
                'username' => ['required', Rule::unique('users')->whereNull('deleted_at')],
                'email'    => ['required', Rule::unique('users')->whereNull('deleted_at')],
                'password' => 'required|min:3|confirmed',
                'posko_id' => 'required',
                'hp'       => 'required',
                // 'permission' => 'required|array',
            ];
        }

        return [
            'name'     => 'required',
            'username' => ['required', Rule::unique('users')->ignore($userId)->whereNull('deleted_at')],
            'email'    => ['required', Rule::unique('users')->ignore($userId)->whereNull('deleted_at')],
            'posko_id' => 'required',
            // 'file'     => 'nullable|mimes:pdf|max:2048',
            'hp' => 'required',
            // 'permission' => 'required',
        ];
    }
}
