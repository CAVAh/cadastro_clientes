<?php

namespace App\Utils;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

class FormCreate
{
    /**
     * @var MessageBag
     */
    private static $errors = '';

    /**
     * Criar um campo de texto no formulário de criação
     *
     * @param string  $name
     * @param int     $maxlength
     * @param bool    $required
     * @param string  $class
     * @param string  $classGroup
     * @param string  $type
     * @return string
     */
    public static function text(string $name, int $maxlength, bool $required = false, string $class = '', string $classGroup = '', string $type = 'text')
    {
        $defaultClass = 'form-control ';

        if (self::$errors instanceof MessageBag) {
            $class .= self::$errors->has($name) ? 'is-invalid' : '';
        }

        $class    = trim($defaultClass . $class);
        $required = $required ? 'required' : '';

        echo '<div class="form-group ' . $classGroup . '">
            <label for="' . $name . '">' . __('attr.' . $name) . '</label>
            <input type="' . $type . '" id="' . $name . '" name="' . $name . '" class="' . $class . '" maxlength="' . $maxlength . '" value="' . old($name) . '" ' . $required . '/>
        </div>';

        return '';
    }

    /**
     * Criar um campo de seleção no formulário de criação
     *
     * @param string            $name
     * @param array|Collection  $values
     * @param string            $id
     * @param string            $field
     * @param bool              $required
     * @param string            $classGroup
     * @param string            $class
     * @return string
     */
    public static function select(string $name, $values, string $id = 'id', string $field = 'nome', bool $required = false, string $classGroup = '', string $class = '')
    {
        $required = $required ? 'required' : '';
        $class    = $class . ' form-control ';

        if (self::$errors instanceof MessageBag) {
            $class .= self::$errors->has($name) ? 'is-invalid' : '';
        }

        $class = trim($class);

        echo
            '<div class="form-group ' . $classGroup . '">
                <label for="' . $name . '">' . __('attr.' . $name) . '</label>
                     <select class="' . $class . '" id="' . $name . '" name="' . $name . '" ' . $required . '>
                         <option value="">--- Selecione ---</option>';

        if (!empty($values)) {
            foreach ($values as $value) {
                echo '<option value="' . $value->{$id} . '" ' . (old($name) ? (old($name) == $value->{$id} ? 'selected' : '') : '') . '>' . $value->{$field} . '</option>';
            }
        }

        echo
        '  </select>
         </div>';

        return '';
    }

    /**
     * @param string $name
     * @param $values
     * @param string $classGroup
     * @param bool $required
     * @param string $class
     * @return string
     */
    public static function selectCol(string $name, $values, string $classGroup, bool $required = false, string $class = '')
    {
        return self::select($name, $values, 'id', 'nome', $required, $classGroup, $class);
    }

    /**
     * Criar um campo de data no formulário de criação
     *
     * @param string  $name
     * @param bool    $required
     * @param string  $classGroup
     * @return string
     */
    public static function date(string $name, bool $required = false, string $classGroup = '')
    {
        return self::text($name, 10, $required, 'date placeholder', $classGroup);
    }

    /**
     * Criar um campo de CPF no formulário de criação
     *
     * @param string  $name
     * @param bool    $required
     * @param string  $classGroup
     * @return string
     */
    public static function cpf(string $name, bool $required = false, string $classGroup = '')
    {
        return self::text($name, 14, $required, 'cpf placeholder', $classGroup);
    }

    /**
     * Criar um campo de CEP no formulário de criação
     *
     * @param string  $name
     * @param bool    $required
     * @param string  $classGroup
     * @return string
     */
    public static function cep(string $name, bool $required = false, string $classGroup = '')
    {
        return self::text($name, 9, $required, 'cep placeholder', $classGroup);
    }

    /**
     * Criar um campo de Telefone no formulário de criação
     *
     * @param string  $name
     * @param bool    $required
     * @param string  $classGroup
     * @return string
     */
    public static function phone(string $name, bool $required = false, string $classGroup = '')
    {
        return self::text($name, 14, $required, 'phone placeholder', $classGroup);
    }

    /**
     * Criar um campo de Telefone no formulário de criação
     *
     * @param string  $name
     * @param bool    $required
     * @param string  $classGroup
     * @return string
     */
    public static function cellphone(string $name, bool $required = false, string $classGroup = '')
    {
        return self::text($name, 15, $required, 'cellphone placeholder', $classGroup);
    }

    /**
     * Criar um campo de Telefone no formulário de criação
     *
     * @param string  $name
     * @param bool    $required
     * @param string  $classGroup
     * @return string
     */
    public static function email(string $name, bool $required = false, string $classGroup = '')
    {
        return self::text($name, 100, $required, '', $classGroup, 'email');
    }

    /**
     * Criar um campo de dinheiro no formulário de criação
     *
     * @param string  $name
     * @param int     $maxlength
     * @param bool    $required
     * @return string
     */
    public static function money(string $name, int $maxlength = 8, bool $required = false)
    {
        return self::text($name, $maxlength, $required, 'money');
    }

    /**
     * Criar um campo de enum (radio), por exemplo sexo, no formulário de criação
     *
     * @param string  $name
     * @param array   $enum
     * @param bool    $required
     * @param string  $classGroup
     * @param string  $classDiv
     * @return string
     */
    public static function enum(string $name, array $enum, bool $required = false, string $classGroup = '', string $classDiv = null): string
    {
        echo '
        <div class="form-group ' . $classGroup . '">
            <label for="' . $name . '">' . __('attr.' . $name) . '</label><br>';

        if (!is_null($classDiv)) {
            if (!empty($classDiv)) {
                echo '<div class="' . $classDiv . '">';
            } else {
                echo '<div>';
            }
        }

        foreach ($enum as $k => $item) {
            $required = $required && !$k ? 'required' : '';
            $checked  = old($name) == $item ? 'checked' : '';

            echo '
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="' . $name . '" id="' . $name . $item . '" value="' . $item . '" ' . $required . ' ' . $checked . '>
                <label class="form-check-label" for="' . $name . $item . '">' . __('attr.' . $name . $item) . '</label>
            </div>';
        }

        if (!is_null($classDiv)) {
            echo '</div>';
        }

        echo '</div>';
        return '';
    }

    /**
     * Alias para a função enum
     *
     * @param string  $name
     * @param array   $enum
     * @param bool    $required
     * @return string
     */
    public static function radio(string $name, array $enum, bool $required = false): string
    {
        return self::enum($name, $enum, $required);
    }

    /**
     * Criar um campo de textarea no formulário de criação
     * @param string  $name
     * @param string  $classGroup
     * @return string
     */
    public static function textarea(string $name, string $classGroup = ''): string
    {
        echo '
        <div class="form-group ' . $classGroup . '">
            <label for="' . $name . '">' . __('attr.' . $name) . '</label>
            <textarea id="' . $name . '" class="form-control" name="' . $name . '" rows="2">' . old($name) . '</textarea>
        </div>';

        return '';
    }

    /**
     * Criar um campo de checkbox no formulário de criação
     *
     * @param string  $name
     * @param bool    $required
     * @return string
     */
    public static function checkbox(string $name, bool $required = false): string
    {
        $required = $required ? 'required' : '';
        $checked  = old($name) == 'on' ? 'checked' : '';

        echo '
        <div class="form-check">
            <input type="checkbox" id="' . $name . '" name="' . $name . '" class="form-check-input" ' . $required . ' ' . $checked . '/>
            <label for="' . $name . '">' . __('attr.' . $name) . '</label>
        </div>';

        return '';
    }

    public static function setErrors($errors)
    {
        if ($errors instanceof ViewErrorBag) {
            self::$errors = $errors->getBag('default');
        }

        return '';
    }
}
