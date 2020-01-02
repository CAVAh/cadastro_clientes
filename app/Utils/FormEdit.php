<?php

namespace App\Utils;

class FormEdit
{
    /**
     * Cria um campo de texto
     *
     * @param string $name
     * @param string $value
     * @param integer $maxlength
     * @param bool $required
     * @param string $class
     * @return string
     */
    public static function text($name, $value, $maxlength, $required = false, $class = '')
    {
        $defaultClass = 'form-control ';
        $class        = trim($defaultClass . $class);
        $required     = $required ? 'required' : '';

        echo '<div class="form-group">
            <label for="' . $name . '">' . __('attr.' . $name) . ':</label>
            <input type="text" id="' . $name . '" name="' . $name . '" class="' . $class . '" maxlength="' . $maxlength . '" value="' . old($name, $value) . '" ' . $required . '/>
        </div>';
        return '';
    }

    public static function select($name, $items, $value, $id = 'id', $field = 'nome', $required = false)
    {
        $required = $required ? 'required' : '';

        echo
            '<div class="form-group">
                <label for="' . $name . '">' . __('attr.' . $name) . ':</label>
                     <select class="form-control" id="' . $name . '" name="' . $name . '" ' . $required . '>';

        if (!$required) {
            echo '<option value="">--- Selecione ---</option>';
        }

        if(!empty($items)) {
            foreach ($items as $item) {
                echo '<option value="' . $item->{$id} . '" ' . (old($name, $item->{$id}) == $value ? 'selected' : '') . '>' . $item->{$field} . '</option>';
            }
        }

        echo
        '  </select>
         </div>';

        return '';
    }

    public static function date($name, $value, $required = false, $class = 'date')
    {
        return self::text($name, $value, 10, $required, $class);
    }

    public static function enum($name, $value, $enum, $required = false)
    {
        echo '
        <div class="form-group">
            <label for="' . $name . '">' . __('attr.' . $name) . ':</label><br>';

        foreach ($enum as $k => $item) {
            $required = $required && !$k ? 'required' : '';
            $checked  = old($name, $value) == $item ? 'checked' : '';

            echo '
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="' . $name . '" id="' . $name . $item . '" value="' . $item . '" ' . $required . ' ' . $checked . '>
                <label class="form-check-label" for="' . $name . $item . '">' . __('attr.' . $name . $item) . '</label>
            </div>';
        }

        echo '</div>';
        return '';
    }

    public static function textarea($name, $value)
    {
        echo '
        <div class="form-group">
            <label for="' . $name . '">' . __('attr.' . $name) . ':</label>
            <textarea id="' . $name . '" class="form-control" name="' . $name . '" rows="3">' . old($name, $value) . '</textarea>
        </div>';

        return '';
    }
}
