<?php

namespace App;

/**
 * @property mixed nome
 * @property mixed multiplas_hosp
 * @property mixed id
 * @property mixed categoria_id
 */
class Quarto extends CustomModel
{
    protected $table = 'quartos';
    protected $fillable = ['id', 'nome', 'multiplas_hosp', 'categoria', 'categoria_id'];
    protected $hidden = ['categoria_id'];
}
