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
			$table->char('tipo', 1)->nullable();
			$table->string('titulo', 100)->nullable();
			$table->float('valor', 10, 0)->nullable();
			$table->boolean('efetivado')->nullable();
			$table->dateTime('data_conta')->nullable();
			$table->dateTime('data_efetivacao')->nullable();
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
