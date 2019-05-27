<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 25 May 2019 16:50:15 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UsuariosConta
 * 
 * @property int $usuario_pfk
 * @property int $conta_pfk
 * 
 * @property \App\Models\Conta $conta
 * @property \App\Models\Usuario $usuario
 *
 * @package App\Models
 */
class UsuariosConta extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'usuario_pfk' => 'int',
		'conta_pfk' => 'int'
	];

	public function conta()
	{
		return $this->belongsTo(\App\Models\Conta::class, 'conta_pfk');
	}

	public function usuario()
	{
		return $this->belongsTo(\App\Models\Usuario::class, 'usuario_pfk');
	}
}
