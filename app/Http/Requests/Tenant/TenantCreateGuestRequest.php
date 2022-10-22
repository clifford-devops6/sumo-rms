<?php

namespace App\Http\Requests\Tenant;

use Illuminate\Foundation\Http\FormRequest;

class TenantCreateGuestRequest extends FormRequest
{
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
        return [
            'name'=>'required|string|max:255',
            'identification_type'=>'required|string|max:50',
            'identification_number'=>'string|required|max:100',
            'cellphone_one'=>'required|max:13|min:10',
            'cellphone_two'=>'nullable|max:13|min:10',
            'address'=>'nullable|string',
            'vehicle_reg'=>'nullable|string|max:50',
            'email_address'=>'required_if:cellphone,null|string|email',

        ];
    }
}
