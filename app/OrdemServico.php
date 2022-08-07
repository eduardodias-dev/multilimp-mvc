<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    //
    protected $table = 'ordemservicos';
    protected $primaryKey  = 'OrdemServicoId';

    protected $fillable = [
        'ClienteId'
    ];

    public $timestamps = false;

    public $nomeCliente = '';
}
