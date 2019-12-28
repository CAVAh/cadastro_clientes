<?php

namespace App;

/**
 * @property mixed nome
 * @property mixed sigla
 * @property mixed id
 */
class Pais extends CustomModel
{
    protected $table = 'paises';
    protected $fillable = ['id', 'nome', 'sigla'];
}
