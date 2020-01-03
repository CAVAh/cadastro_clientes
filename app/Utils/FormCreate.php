<?php

namespace App\Utils;

use Illuminate\Database\Eloquent\Collection;

class FormCreate
{
    /**
     * Criar um campo de texto no formulário de criação
     *
     * @param string $name
     * @param int $maxlength
     * @param bool $required
     * @param string $class
     * @return string
     */
    public static function text(string $name, int $maxlength, bool $required = false, string $class = '')
    {
        $defaultClass = 'form-control ';
        $class        = trim($defaultClass . $class);
        $required     = $required ? 'required' : '';

        echo '<div class="form-group">
            <label for="' . $name . '">' . __('attr.' . $name) . ':</label>
            <input type="text" id="' . $name . '" name="' . $name . '" class="' . $class . '" maxlength="' . $maxlength . '" value="' . old($name) . '" ' . $required . '/>
        </div>';

        return '';
    }

    /**
     * Criar um campo de seleção no formulário de criação
     *
     * @param string $name
     * @param array|Collection $values
     * @param string $id
     * @param string $field
     * @param bool $required
     * @return string
     */
    public static function select(string $name, $values, string $id = 'id', string $field = 'nome', bool $required = false)
    {
        $required = $required ? 'required' : '';

        echo
            '<div class="form-group">
                <label for="' . $name . '">' . __('attr.' . $name) . ':</label>
                     <select class="form-control" id="' . $name . '" name="' . $name . '" ' . $required . '>
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
     * Criar um campo de data no formulário de criação
     *
     * @param string $name
     * @param bool $required
     * @return string
     */
    public static function date(string $name, bool $required = false)
    {
        return self::text($name, 10, $required, 'date');
    }

    /**
     * Criar um campo de dinheiro no formulário de criação
     *
     * @param string $name
     * @param int $maxlength
     * @param bool $required
     * @return string
     */
    public static function money(string $name, int $maxlength = 8, bool $required = false)
    {
        return self::text($name, $maxlength, $required, 'money');
    }

    /**
     * Criar um campo de enum (radio), por exemplo sexo, no formulário de criação
     *
     * @param string $name
     * @param array $enum
     * @param bool $required
     * @return string
     */
    public static function enum(string $name, array $enum, bool $required = false): string
    {
        echo '
        <div class="form-group">
            <label for="' . $name . '">' . __('attr.' . $name) . ':</label><br>';

        foreach ($enum as $k => $item) {
            $required = $required && !$k ? 'required' : '';
            $checked  = old($name) == $item ? 'checked' : '';

            echo '
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="' . $name . '" id="' . $name . $item . '" value="' . $item . '" ' . $required . ' ' . $checked . '>
                <label class="form-check-label" for="' . $name . $item . '">' . __('attr.' . $name . $item) . '</label>
            </div>';
        }

        echo '</div>';
        return '';
    }

    /**
     * Alias para a função enum
     *
     * @param string $name
     * @param array $enum
     * @param bool $required
     * @return string
     */
    public static function radio(string $name, array $enum, bool $required = false): string
    {
        return self::enum($name, $enum, $required);
    }

    /**
     * Criar um campo de textarea no formulário de criação
     * @param string $name
     * @return string
     */
    public static function textarea(string $name): string
    {
        echo '
        <div class="form-group">
            <label for="' . $name . '">' . __('attr.' . $name) . ':</label>
            <textarea id="' . $name . '" class="form-control" name="' . $name . '" rows="3">' . old($name) . '</textarea>
        </div>';

        return '';
    }

    /**
     * Criar um campo de checkbox no formulário de criação
     *
     * @param string $name
     * @param bool $required
     * @return string
     */
    public static function checkbox(string $name, bool $required = false): string
    {
        $required = $required ? 'required' : '';
        $checked  = old($name) == 'on' ? 'checked' : '';

        echo '
        <div class="form-check">
            <input type="checkbox" id="' . $name . '" name="' . $name . '" class="form-check-input" ' . $required . ' ' . $checked . '/>
            <label for="' . $name . '">'. __('attr.' . $name) .'</label>
        </div>';

        return '';
    }
}
