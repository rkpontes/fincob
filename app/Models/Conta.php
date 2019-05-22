<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 22 May 2019 00:50:00 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Conta
 * 
 * @property int $id
 * @property string $tipo
 * @property string $titulo
 * @property float $valor
 * @property int $efetivado
 * @property \Carbon\Carbon $data_conta
 * @property \Carbon\Carbon $data_efetivacao
 * 
 * @property \Illuminate\Database\Eloquent\Collection $usuarios
 *
 * @package App\Models
 */
class Conta extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'valor' => 'float',
		'efetivado' => 'int'
	];

	protected $dates = [
		'data_conta',
		'data_efetivacao'
	];

	protected $fillable = [
		'tipo',
		'titulo',
		'valor',
		'efetivado',
		'data_conta',
		'data_efetivacao'
	];

	public function usuarios()
	{
		return $this->belongsToMany(\App\Models\Usuario::class, 'usuarios_contas', 'conta_pfk', 'usuario_pfk');
	}
}
