<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class StoreColorRequest extends FormRequest
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
            "original_hue"=>["required","string"],
            "base_color"=>["required","string"],
            "close_hue_name"=>["required","string"],
            "close_hue"=>["required","string"],
            "hsv"=>["required","string"],
        ];
    }
    protected function prepareForValidation() {//we need to transform request data so itd be fitting for storing in db
        $this->merge([

        ]);
    }
}
