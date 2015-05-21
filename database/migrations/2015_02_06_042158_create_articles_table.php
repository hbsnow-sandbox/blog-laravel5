<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function($table)
		{
			$table->increments('id')->unsigned();
			$table->string('title', 256);
			$table->string('slug', 128)->unique;
			$table->string('text', 256)->unique;
			$table->string('state', 16);
			$table->integer('icon_id')->unsigned();
			$table->timestamps();
		});

		Schema::create('tags', function($table)
		{
			$table->increments('id')->unsigned();
			$table->string('name', 256)->unique;
			$table->string('slug', 128)->unique;
			$table->timestamps();
		});

		Schema::create('article_tag', function ($table) {
			$table->increments('id')->unsigned();
			$table->integer('article_id')->unsigned();
			$table->integer('tag_id')->unsigned();
		});

		Schema::create('icons', function($table)
		{
			$table->increments('id')->unsigned();
			$table->string('name', 256)->unique;
			$table->string('url', 256)->unique;
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('articles');
		Schema::dropIfExists('tags');
		Schema::dropIfExists('article_tag');
		Schema::dropIfExists('icons');
	}

}
