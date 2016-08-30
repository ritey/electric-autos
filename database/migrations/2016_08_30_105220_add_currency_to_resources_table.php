<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCurrencyToResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('resources', function(Blueprint $table) {
            $table->string('currency')->nullable()->index()->after('mileage');
            $table->boolean('private')->default(0)->index()->after('sold');
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
            $table->dropColumn('currency');
            $table->dropColumn('private');
        });
    }
}
