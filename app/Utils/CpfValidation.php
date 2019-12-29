<?php

namespace App\Utils;

class CpfValidation
{
    public function validate($attribute, $value)
    {
        return $this->isValidate($attribute, $value);
    }

    protected function isValidate($attribute, $value)
    {
        $cpf = preg_replace('/\D/', '', $value);

        if (strlen($cpf) !== 11 || preg_match("/^{$cpf[0]}{11}$/", $cpf)) {
            return false;
        }

        // Soma os dígitos
        for ($i = 0, $j = 10, $soma1 = 0, $soma2 = 0; $i < 9; $i++, $j--) {
            $soma1 += $cpf{$i} * $j;
            $soma2 += $cpf{$i};
        }

        $resto = $soma1 % 11;

        if ($resto < 2) {
            $resto = 0;
        } else {
            $resto = 11 - $resto;
        }

        // Verifica se confere o dígito
        if ($cpf{9} != $resto) {
            return false;
        }

        $resto = ($soma1 + $soma2 + $cpf{9} * 2) % 11;

        if ($resto < 2) {
            $resto = 0;
        } else {
            $resto = 11 - $resto;
        }

        if ($cpf{10} == $resto) {
            return true;
        }

        return false;
    }
}
