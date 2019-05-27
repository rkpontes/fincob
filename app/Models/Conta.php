<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 25 May 2019 16:50:15 +0000.
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
 * @property int $parcela
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
		'efetivado' => 'int',
		'parcela' => 'int'
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
		'parcela',
		'data_conta',
		'data_efetivacao'
	];

	public function usuarios()
	{
		return $this->belongsToMany(\App\Models\Usuario::class, 'usuarios_contas', 'conta_pfk', 'usuario_pfk');
	}
}
