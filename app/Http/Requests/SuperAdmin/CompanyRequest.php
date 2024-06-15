<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //validações don campos
            'name' => 'required|string',
            'email' => 'required|email|unique:companies,companyemail',
            'nif' => 'required|string|unique:companies,companynif',
            'type' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "O campo nome é obrigatorio",
            "name.string" => "O campo nome deve ser um conjuto de caracteres",
            "email.email" => "O campo email deve obedecer padrões do email",
            "email.unique" => "Este email já exite no sistema",
            "email.unique" => "Este NIF já exite no sistema",
        ];
    }
}