<?php

namespace App\Utils;

class Format
{
    /**
     * Formata a data de um formato amigável para o formato de Banco de Dados.
     *
     * @access public
     *
     * @param  string  $str  Data a ser formatada
     *
     * @return string  Retorna a data formatada
     */
    public static function strToDate($str)
    {
        if (!empty($str)) {
            return implode('-', array_reverse(explode('/', $str)));
        }

        return '';
    }

    /**
     * Formata a data e hora de um formato amigável para o formato de Banco de Dados.
     *
     * @access public
     *
     * @param  string  $str  Data e hora a ser formatada
     *
     * @return string  Retorna a data e hora formatada
     */
    public static function strToDateTime($str)
    {
        if (!empty($str) && strpos($str, ' ') !== false) {
            $date = explode(' ', $str);

            return self::strToDate($date[0]).' '.$date[1];
        }

        return '';
    }

    /**
     * Formata a data e hora do Banco de Dados para um formato amigável.
     *
     * @access public
     *
     * @param  string  $dateTime  Data e hora a ser formatada
     *
     * @return string  Retorna a data e hora formatada
     */
    public static function dateTimeToStr($dateTime)
    {
        if (!empty($dateTime)) {
            $data = explode(' ', $dateTime);

            return self::dateToStr($data[0]).' '.$data[1];
        }

        return '';
    }

    /**
     * Formata a data do Banco de Dados para um formato amigável.
     *
     * @access public
     *
     * @param  string  $date  Data a ser formatada
     *
     * @return string  Retorna a data formatada
     */
    public static function dateToStr($date)
    {
        if (!empty($date)) {
            return implode('/', array_reverse(explode('-', $date)));
        }

        return '';
    }

    /**
     * Função que verifica se o número em string é flutuante.
     *
     * @access public
     *
     * @param  string  $num  (Número em string a ser verificado)
     * @param  string  $decimal  (Qual é o caracter separador decimal)
     *
     * @return float|bool (FALSE se não é um número flutuante, FLOAT se for um número flutuante)
     */
    public static function validarFloat($num, $decimal = ',')
    {
        return filter_var($num, FILTER_VALIDATE_FLOAT, ['options' => ['decimal' => $decimal]]);
    }

    /**
     * Formata a string de um formato amigável para float.
     *
     * @access public
     *
     * @param  string  $str  Float a ser formatado
     *
     * @return float  Retorna o float formatado
     */
    public static function strToFloat($str)
    {
        return self::validarFloat(str_replace('.', '', $str));
    }

    /**
     * Formata o CEP em um formato amigável para XXXXX-XXX
     *
     * @param  string  $cep  CEP a ser formatado
     *
     * @return string Retorna o CEP formatado em XXXXX-XXX
     */
    public static function formatCEP($cep)
    {
        return substr($cep, 0, 5).'-'.substr($cep, 5);
    }

    /**
     * Remove todos os caracteres especiais, deixando somente os caracteres númericos (inteiro).
     *
     * @param string $str Texto a ser limpado
     *
     * @return string Texto limpo
     */
    public static function clearNumber($str) {
        return preg_replace('/[^0-9]/', '', $str);
    }
}
