<?php

namespace App\Utils;

class CepValidation
{
    public function validate($attribute, $value)
    {
        return $this->isValidate($attribute, $value);
    }

    protected function isValidate($attribute, $value)
    {
        return preg_match('/^[0-9]{5,5}([- ]?[0-9]{3,3})?$/', $value);
    }
}
