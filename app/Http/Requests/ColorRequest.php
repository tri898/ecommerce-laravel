<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColorRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        if(request()->routeIs('admin.colors.store')) {
            $nameRule = 'required|string|unique:colors|max:50';
        } elseif (request()->routeIs('admin.colors.update')) {
            $id = $this->route('color');
            $nameRule ='required|string|max:50|unique:colors,name,' . $id;
        }
        return [
            'name' => $nameRule
        ];
    }
}
