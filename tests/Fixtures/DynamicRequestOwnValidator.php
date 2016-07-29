<?php

namespace Mpociot\ApiDoc\Tests\Fixtures;

use Illuminate\Foundation\Http\FormRequest;

class DynamicRequestOwnValidator extends FormRequest
{
    public function rules()
    {
        return [
            'validatorTesting' => BasicValidator::keyword() . ':working',
        ];
    }
}
