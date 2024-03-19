<?php

namespace App\Http\Requests;

use App\Models\Service;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class FileRequestUpdate extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        return [
            'name'=>"required",
            'LinkForDownloade'=>"required",
        ];
    }
    public function messages()
    {


        if (App::getLocale() == 'en') {
            return [
                // 'name.required' => 'الاسم مطلوب',
                'name.unique' => 'الاسم موجود من قبل',
                'Creation_date.required' => 'Creation_date is required ',
            ];
        }
    }
}
