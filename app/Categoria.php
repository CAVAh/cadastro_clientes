<?php

namespace App;

/**
 * @property mixed nome
 * @property mixed id
 */
class Categoria extends CustomModel
{
    protected $table = 'categorias';
    protected $fillable = ['id', 'nome'];
}
