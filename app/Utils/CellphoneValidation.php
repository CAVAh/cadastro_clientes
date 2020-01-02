<?php

namespace App\Utils;

class CellphoneValidation
{
    public function validate($attribute, $value)
    {
        return $this->isValidate($attribute, $value);
    }

    /**
     * Função que verifica se o número do telefone é válido (com o formato (XX) XXXXX-XXXX ou (XX) XXXX-XXXX).
     * Caso o telefone tiver 15 dígitos será celular: (DD) YDXXX-XXXX
     * Exceção: Caso o telefone tiver 14 dígitos poderá ser celular se iniciado em: 79, 78, 77 ou 70 (Nextel): (DD) SNXX-XXXX
     * Sendo: D = 1~9 | Y = 9 | X = 0~9 | S = 7 | N = 7,8,0
     *
     * @access public
     *
     * @param string $value Número de celular a ser verificado
     *
     * @return bool        Retorna true se for válido, false se for inválido
     */
    protected function isValidate($attribute, $value)
    {
        $len = strlen($value);

        if ($len == 15) {
            if (preg_match("/\(([1-9]{2})\) ([9])([1-9])([0-9]{3})-([0-9]{4})/", $value)) {
                return true;
            }
        } elseif ($len == 14) {
            if (preg_match("/\(([1-9]{2})\) 7([780])([0-9]{2})-([0-9]{4})/", $value)) {
                return true;
            }
        }

        return false;
    }
}
