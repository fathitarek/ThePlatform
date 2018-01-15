<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class uploadcsvFacebookRequest extends FormRequest
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
//|mimes:csv   |in:csv
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'csv_file' => 'required',
            'date_time'=>'required',
            'app_user_id'=>'required'
        ];
    }
    public function messages() {
        return [
            'csv_file.required' => 'Please provide a CSV File',
            'date_time.required'=>'Please choose category or date-time based',
            'app_user_id.required'=>'Please provide a Account'
        ];
    }
}
