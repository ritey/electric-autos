<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugToDealerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dealers', function(Blueprint $table) {
            $table->boolean('enabled')->default(1)->index()->after('id');
            $table->string('slug',128)->nullable()->index()->after('email');
        });

        Schema::create('history', function (Blueprint $table) {
            $table->increments('id');
            $table->string('action');
            $table->string('user_id')->index();
            $table->string('description',256)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dealers', function(Blueprint $table) {
            $table->dropColumn('enabled');
            $table->dropColumn('slug');
        });
        Schema::drop('history');
    }
}
