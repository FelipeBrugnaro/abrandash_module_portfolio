<?php

namespace Modules\Portfolio\app\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class PortfolioStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(Auth::user()->permission('CREATE_PORTFOLIO')){
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
            'image'       => ['required', 'image', 'max:1024'],
            'title'       => ['required','string','max:255'],
            'description' => ['required','string','max:255'],
            'body'        => ['required','min:3']
        ];
    }
}
