<?php

namespace App\Utils;

class PhoneValidation
{
    public function validate($attribute, $value)
    {
        return $this->isValidate($attribute, $value);
    }

    /**
     * Função que verifica se o número do telefone é válido (com o formato (XX) XXXX-XXXX)
     * Caso o telefone tiver 14 dígitos será fixo: (DD) ZXXX-XXXX
     * Sendo: D = 1~9 | Z = 2~5 | X = 0~9
     *
     * @access public
     *
     * @param string $value Número de telefone a ser verificado
     *
     * @return bool        Retorna true se for válido, false se for inválido
     */
    protected function isValidate($attribute, $value)
    {
        return preg_match("/\(([1-9]{2})\) ([2-5])([0-9]{3})-([0-9]{4})/", $value);
    }
}
