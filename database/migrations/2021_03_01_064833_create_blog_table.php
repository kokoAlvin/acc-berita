<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->notNullable();
            $table->text('content')->notNullable();
            $table->bigInteger('user_id')->unsigned()->notNullable();
            
            $table->integer('status')->length(1)->nullable()->default(0);
            $table->dateTime('accepted_at')->nullable();
            $table->boolean('flag_active')->notNullable()->default(0);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('blog');
    }
}
