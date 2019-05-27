<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 25 May 2019 16:50:15 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Usuario
 * 
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property int $ativo
 * 
 * @property \Illuminate\Database\Eloquent\Collection $contas
 *
 * @package App\Models
 */
class Usuario extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'ativo' => 'int'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'email',
		'password',
		'remember_token',
		'ativo'
	];

	public function contas()
	{
		return $this->belongsToMany(\App\Models\Conta::class, 'usuarios_contas', 'usuario_pfk', 'conta_pfk');
	}
}
