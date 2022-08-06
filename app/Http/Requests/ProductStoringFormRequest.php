<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;

class ProductStoringFormRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::user()->isOfType(User::TYPE_MERCHANT);
    }

    /**
     * Get the validation rules that apply to the request.
     *p
     * @return array
     */
    public function rules()
    {
        return RuleFactory::make([
            '%name%' => 'required|string',
            '%description%' => 'required|string',
            'price' => 'required|integer|min:0',
            'is_vat_included' => 'required|boolean',
            'vat_percentage' => 'required_if:is_vat_included,false|integer|min:0|max:100',
            'shipping_cost' => 'nullable|integer|min:0',
        ]);        
    }
}
