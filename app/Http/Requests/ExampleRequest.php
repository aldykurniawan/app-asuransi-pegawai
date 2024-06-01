<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExampleRequest extends FormRequest
{
    protected $redirect;

    public function __construct()
    {
        $this->redirect = route('master.examples.index');
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
                'nama' => ['required', 'max:50'],
                // 'gambar' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:12048'],
            ];
        }

        return [
            'nama' => ['required', 'max:50'],
                // 'gambar' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:12048'],
        ];
    }
}
