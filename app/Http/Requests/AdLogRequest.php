<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdLogRequest extends FormRequest
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
            'adId'=>[
                'required',
            ],
            'status'=>[
                'required',
                'in:INIT_SUCCESS,INIT_FAIL,SHOW_SUCCESS,SHOW_FAIL,CLICK_SUCCESS,CLICK_FAIL,PLAY_SUCCESS,PLAY_FAIL,DIALOG_SUCCESS,DIALOG_FAIL'
           ],
        ];
    }
}
