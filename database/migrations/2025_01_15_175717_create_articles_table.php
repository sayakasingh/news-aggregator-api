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
		    Schema::create('articles', function (Blueprint $table) {
		        $table->id();
		        $table->string('title');
		        $table->text('description');
		        $table->string('source');
		        $table->string('category');
		        $table->string('author')->nullable();
		        $table->timestamp('created_at');
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
		//
	}

}
