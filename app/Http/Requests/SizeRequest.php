<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SizeRequest extends FormRequest
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
        if(request()->routeIs('admin.sizes.store')) {
            $nameRule = 'required|string|unique:sizes|max:50';
        } elseif (request()->routeIs('admin.sizes.update')) {
            $id = $this->route('size');
            $nameRule ='required|string|max:50|unique:sizes,name,' . $id;
        }
        return [
            'name' => $nameRule
        ];
    }
}
