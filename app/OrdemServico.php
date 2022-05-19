<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    //
    protected $table = 'OrdemServicos';
    protected $primaryKey  = 'OrdemServicoId';

    protected $fillable = [
        'ClienteId'
    ];

    public $timestamps = false;

    public $nomeCliente = '';
}
