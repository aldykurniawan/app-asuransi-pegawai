<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    protected $redirect;

    public function __construct()
    {
        $this->redirect = route('pegawais.index');
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if (request()->method() == 'POST') {
            return [
                'name'                  => ['required', 'max:50'],
                'email'                 => ['required', 'max:50'],
                'phone'                 => ['required', 'max:50'],
                'address'               => ['required', 'max:50'],
                'insurance_policies_id' => ['required'],
                // 'gambar' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:12048'],
            ];
        }

        return [
            'name'                  => ['required', 'max:50'],
            'email'                 => ['required', 'max:50'],
            'phone'                 => ['required', 'max:50'],
            'address'               => ['required', 'max:50'],
            'insurance_policies_id' => ['required'],
            // 'gambar' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:12048'],
        ];
    }
}
