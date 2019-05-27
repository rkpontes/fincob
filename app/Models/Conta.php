<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 27 May 2019 23:46:44 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Conta
 * 
 * @property int $id
 * @property string $tipo
 * @property string $titulo
 * @property \Carbon\Carbon $vencimento
 * @property float $valor
 * @property int $efetivado
 * @property int $parcela
 * @property \Carbon\Carbon $data_conta
 * @property \Carbon\Carbon $data_efetivacao
 * @property int $categoria_fk
 * @property int $pasta_fk
 * 
 * @property \App\Models\Categoria $categoria
 * @property \App\Models\Pasta $pasta
 * @property \Illuminate\Database\Eloquent\Collection $usuarios
 *
 * @package App\Models
 */
class Conta extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'valor' => 'float',
		'efetivado' => 'int',
		'parcela' => 'int',
		'categoria_fk' => 'int',
		'pasta_fk' => 'int'
	];

	protected $dates = [
		'vencimento',
		'data_conta',
		'data_efetivacao'
	];

	protected $fillable = [
		'tipo',
		'titulo',
		'vencimento',
		'valor',
		'efetivado',
		'parcela',
		'data_conta',
		'data_efetivacao',
		'categoria_fk',
		'pasta_fk'
	];

	public function categoria()
	{
		return $this->belongsTo(\App\Models\Categoria::class, 'categoria_fk');
	}

	public function pasta()
	{
		return $this->belongsTo(\App\Models\Pasta::class, 'pasta_fk');
	}

	public function usuarios()
	{
		return $this->belongsToMany(\App\Models\Usuario::class, 'usuarios_contas', 'conta_pfk', 'usuario_pfk');
	}
}
