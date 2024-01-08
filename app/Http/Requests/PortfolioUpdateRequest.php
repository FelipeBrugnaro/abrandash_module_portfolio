<?php

namespace Modules\Portfolio\app\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class PortfolioUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(Auth::user()->permission('EDIT_PORTFOLIO')){
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image'       => ['nullable', 'image', 'max:1024'],
            'title'       => ['required','string','max:255'],
            'description' => ['required','string','max:255'],
            'body'        => ['nullable','min:3'],
            'status'      => ['required', 'boolean']
        ];
    }
}
