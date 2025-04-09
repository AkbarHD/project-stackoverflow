<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

//  kenapa extends StoreAnswerRequest ?
//  karena kita hanya ingin mengubah beberapa field saja dan sama dengan StoreAnswerRequest
class UpdateAnswerRequest extends StoreAnswerRequest
{
    public function authorize(): bool
    {
        return Gate::allows('update', $this->route('answer'));
    }
}
