<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			//$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('email')->unique; //size 60
			$table->string('username')->nullable();
			$table->string('password')->nullable(); // size 60
			$table->string('password_temp')->nullable(); // size 60
			$table->string('code')->nullable(); // size 10
			$table->integer('active')->nullable(); 
			$table->timestamps();
			$table->rememberToken()->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users', function(Blueprint $table)
		{
			//
			Schema::dropIfExists('users');
		});
	}

}
