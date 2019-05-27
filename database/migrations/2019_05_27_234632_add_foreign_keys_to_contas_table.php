<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToContasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('contas', function(Blueprint $table)
		{
			$table->foreign('categoria_fk', 'fk_contas_categorias1')->references('id')->on('categorias')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('pasta_fk', 'fk_contas_pastas1')->references('id')->on('pastas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('contas', function(Blueprint $table)
		{
			$table->dropForeign('fk_contas_categorias1');
			$table->dropForeign('fk_contas_pastas1');
		});
	}

}
