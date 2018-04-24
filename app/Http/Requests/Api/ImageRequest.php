<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
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
        $rules = [
            'type' => 'required|string|in:avatar,topic',
        ];

        if($this->type == 'avatar') {
            $rules['image'] = 'mimes:jpeg,bmp,png,gif|dimensions:min_with=200,min_height=200';
        } else {
            $rules['image'] = 'mimes:jpeg,bmp,png,gif';
        }

        return $rules;
    }

    public function messages()
    {
       return [
           'image.dimensions' => '图片清晰度不够，宽和高需要在200px以上',
       ];
    }
}