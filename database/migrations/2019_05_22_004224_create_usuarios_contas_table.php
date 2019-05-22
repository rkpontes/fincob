<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsuariosContasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuarios_contas', function(Blueprint $table)
		{
			$table->integer('usuario_pfk')->index('fk_usuarios_has_contas_usuarios_idx');
			$table->integer('conta_pfk')->index('fk_usuarios_has_contas_contas1_idx');
			$table->primary(['usuario_pfk','conta_pfk']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuarios_contas');
	}

}
