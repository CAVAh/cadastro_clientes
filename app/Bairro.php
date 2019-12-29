<?php

namespace App;

/**
 * @property mixed nome
 * @property mixed id
 */
class Bairro extends CustomModel
{
    protected $table = 'bairros';
    protected $fillable = ['id', 'nome'];
}
