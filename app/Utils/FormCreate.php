<?php

namespace App\Utils;

class FormCreate
{
    public static function text($name, $maxlength, $required = false, $class = '')
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

    public static function select($name, $values, $id = 'id', $field = 'nome', $required = false)
    {
        $required = $required ? 'required' : '';
        echo
            '<div class="form-group">
                <label for="' . $name . '">' . __('attr.' . $name) . ':</label>
                     <select class="form-control" id="' . $name . '" name="' . $name . '" ' . $required . '>
                         <option value="">--- Selecione ---</option>';

        if(!empty($values)) {
            foreach ($values as $value) {
                echo '<option value="' . $value->{$id} . '" ' . (old($name) ? (old($name) == $value->{$id} ? 'selected' : '') : '') . '>' . $value->{$field} . '</option>';
            }
        }

        echo
        '  </select>
         </div>';

        return '';
    }

    public static function date($name, $required = false, $class = 'date')
    {
        return self::text($name, 10, $required, $class);
    }

    public static function enum($name, $enum, $required = false)
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

    public static function textarea($name)
    {
        echo '
        <div class="form-group">
            <label for="' . $name . '">' . __('attr.' . $name) . ':</label>
            <textarea id="' . $name . '" class="form-control" name="' . $name . '" rows="3">' . old($name) . '</textarea>
        </div>';

        return '';
    }
}
