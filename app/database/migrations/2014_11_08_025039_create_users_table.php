<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(){
		Schema::create(function($table){

			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('email')->unique; //size 60
			$table->string('password'); // size 60
			$table->string('password_temp'); // size 60
			$table->string('code'); // size 10
			$table->integer('active'); 
			$table->timestamps();
			$table->rememberToken();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}