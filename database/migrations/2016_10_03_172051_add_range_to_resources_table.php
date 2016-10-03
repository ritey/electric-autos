<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRangeToResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resources', function(Blueprint $table) {
            $table->integer('views')->default(0)->index()->after('model_id');
            $table->integer('range')->default(0)->index()->after('views');
            $table->timestamp('live_at')->nullable()->index()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resources', function(Blueprint $table) {
            $table->dropColumn('views');
            $table->dropColumn('range');
            $table->dropColumn('live_at');
        });
    }
}
