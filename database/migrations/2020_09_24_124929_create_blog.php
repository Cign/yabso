<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('blog', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });

        // Schema::create('users', function (Blueprint $table) { $table->id();
        //     $table->string('name'); $table->string('firstname'); $table->string('email')->unique(); $table->string('password'); $table->boolean('newsletter'); $table->boolean('admin')->default(false); $table->timestamp('last_seen')->nullable(); $table->rememberToken(); $table->timestamps();
        //     });

                Schema::create('categories', function(Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->string('title', 128)->unique();
                $table->text('description')->nullable();
                $table->timestamps();
                });
                Schema::create('articles', function(Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->string('title', 128);
                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
                $table->integer('categorie_id')->unsigned();
                $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
                $table->text('intro_text');
                $table->text('full_text');
                $table->enum('allow_comment', array('no', 'yes'))->default('yes');
                $table->timestamps();
                });
                Schema::create('comments', function(Blueprint $table) {
                $table->increments('id')->unsigned();
                $table->string('title', 128);
                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
                $table->integer('article_id')->unsigned();
                $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade')->onUpdate('cascade');
                $table->text('text');
                $table->timestamps();
                });
                Schema::create('skills', function(Blueprint $table) {
                    $table->increments('id')->unsigned();

                    $table->timestamps();
                    });

                    Schema::create('experience', function(Blueprint $table) {
                        $table->increments('id')->unsigned();

                        $table->timestamps();
                        });
                        Schema::create('project', function(Blueprint $table) {
                            $table->increments('id')->unsigned();

                            $table->timestamps();
                            });
                            Schema::create('plan', function(Blueprint $table) {
                                $table->increments('id')->unsigned();

                                $table->timestamps();
                                });
                                Schema::create('services', function(Blueprint $table) {
                                    $table->increments('id')->unsigned();

                                    $table->timestamps();
                                    });
                                    Schema::create('plans', function(Blueprint $table) {
                                        $table->increments('id')->unsigned();

                                        $table->timestamps();
                                        });
                                        Schema::create('contact', function(Blueprint $table) {
                                            $table->increments('id')->unsigned();

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
        Schema::table('articles', function($table) { $table->dropForeign('articles_categorie_id_foreign'); $table->dropForeign('articles_user_id_foreign');
        });
        Schema::table('comments', function($table) {
        $table->dropForeign('comments_user_id_foreign');
        $table->dropForeign('comments_article_id_foreign'); });
        Schema::dropIfExists('categories');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('articles');
    }
}
