<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 27 May 2019 23:46:44 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Pasta
 * 
 * @property int $id
 * @property string $nome
 * 
 * @property \Illuminate\Database\Eloquent\Collection $contas
 *
 * @package App\Models
 */
class Pasta extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'nome'
	];

	public function contas()
	{
		return $this->hasMany(\App\Models\Conta::class, 'pasta_fk');
	}
}
