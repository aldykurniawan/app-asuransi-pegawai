<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsurancePolicyRequest extends FormRequest
{
    protected $redirect;

    public function __construct()
    {
        $this->redirect = route('asuransis.index');
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
                'policy_number'   => ['required', 'max:50'],
                'policy_type'     => ['required', 'max:50'],
                'start_date'      => ['required', 'date'],
                'end_date'        => ['required', 'date'],
                'coverage_amount' => ['required', 'max:50'],
                'premium_amount'  => ['required', 'max:50'],
                'status'          => ['required', 'max:50'],
                'description'     => ['nullable', 'max:50'],
                // 'gambar' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:12048'],
            ];
        }

        return [
            'policy_number'   => ['required', 'max:50'],
            'policy_type'     => ['required', 'max:50'],
            'start_date'      => ['required', 'date'],
            'end_date'        => ['required', 'date'],
            'coverage_amount' => ['required', 'max:50'],
            'premium_amount'  => ['required', 'max:50'],
            'status'          => ['required', 'max:50'],
            'description'     => ['nullable', 'max:50'],
            // 'gambar' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:12048'],
        ];
    }
}
