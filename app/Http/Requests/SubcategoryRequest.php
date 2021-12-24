<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubcategoryRequest extends FormRequest
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
        if(request()->routeIs('admin.subcategories.store')) {
            $nameRule = 'required|string|unique:subcategories|max:255';
        } elseif (request()->routeIs('admin.subcategories.update')) {
            $id = $this->route('subcategory');
            $nameRule ='required|string|max:255|unique:subcategories,name,' . $id;
        }
        return [
            'name' => $nameRule,
            'category_id' => 'required|integer|exists:categories,id'
        ];
    }
}
