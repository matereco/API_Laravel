<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//atentar com os nomes da $table, $primarykey, $fillable.
//Devem ser exatamente iguais para utilizar os metodos 

class TestModel extends Model
{
    protected $table = 'jogos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nome',
        'genero',
        'desenvolvedor',
        'distribuidor',
        'metacritic',    
    ];
    //public $timestamps = false;
}
