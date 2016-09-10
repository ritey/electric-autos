<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {

            $table->increments('id');
            $table->boolean('enabled');
            $table->string('slug')->nullable()->index();
            $table->integer('sort_order')->default(0);
            $table->string('name',156);
            $table->string('meta_date',36)->nullable();
            $table->string('meta_author',156)->nullable();
            $table->string('meta_title',156)->nullable();
            $table->string('meta_description',156)->nullable();
            $table->string('img',256)->nullable();
            $table->text('summary')->nullable();
            $table->text('body')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('live_at')->nullable();

            $table->index('enabled');
            $table->index('sort_order');
            $table->index('live_at');

        });

        Schema::create('articles_to_uploads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id');
            $table->integer('upload_id');

            $table->index('article_id');
            $table->index('upload_id');
        });

        Schema::table('uploads', function(Blueprint $table) {
            $table->string('article_id',36)->nullable()->index()->after('user_id');
        });

        Schema::table('resources', function(Blueprint $table) {
            $table->string('length_measure',36)->nullable()->default('miles')->after('mileage');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('articles');
        Schema::drop('articles_to_uploads');

        Schema::table('uploads', function(Blueprint $table) {
            $table->dropColumn('article_id');
            $table->dropIndex('article_id');
        });

        Schema::table('resources', function(Blueprint $table) {
            $table->dropColumn('length_measure');
        });
    }
}
