<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->char('tipo', 1)->comment('D = Despesas
R = Receitas');
			$table->string('titulo', 100);
			$table->date('vencimento');
			$table->float('valor', 10, 0);
			$table->boolean('efetivado')->nullable();
			$table->integer('parcela')->nullable();
			$table->dateTime('data_conta');
			$table->dateTime('data_efetivacao')->nullable();
			$table->integer('categoria_fk')->index('fk_contas_categorias1_idx');
			$table->integer('pasta_fk')->index('fk_contas_pastas1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contas');
	}

}
