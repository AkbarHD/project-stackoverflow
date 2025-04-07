<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//  kenapa extends StoreAnswerRequest ?
//  karena kita hanya ingin mengubah beberapa field saja dan sama dengan StoreAnswerRequest
class UpdateAnswerRequest extends StoreAnswerRequest
{

}
