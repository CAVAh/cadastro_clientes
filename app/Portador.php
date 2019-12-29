<?php

namespace App;

/**
 * @property mixed nome
 * @property mixed id
 */
class Portador extends CustomModel
{
    protected $table = 'portadores';
    protected $fillable = ['id', 'nome'];
}
