<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUsuariosContasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('usuarios_contas', function(Blueprint $table)
		{
			$table->foreign('conta_pfk', 'fk_usuarios_has_contas_contas1')->references('id')->on('contas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('usuario_pfk', 'fk_usuarios_has_contas_usuarios')->references('id')->on('usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('usuarios_contas', function(Blueprint $table)
		{
			$table->dropForeign('fk_usuarios_has_contas_contas1');
			$table->dropForeign('fk_usuarios_has_contas_usuarios');
		});
	}

}
