<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait HandleFailedValidation
{

    use HttpResponseJson;

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->responseJson(false,null,$validator->errors()->first())
        );
    }
}
