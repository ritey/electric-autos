<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDealersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dealers', function(Blueprint $table) {
            $table->boolean('active',128)->default(1)->index()->after('slug');
            $table->string('address_1',128)->nullable()->after('active');
            $table->string('address_2',128)->nullable()->after('address_1');
            $table->string('town',128)->nullable()->after('address_2');
            $table->string('city',128)->nullable()->after('town');
            $table->string('county',128)->nullable()->after('city');
            $table->string('lat',32)->nullable()->after('county');
            $table->string('lon',32)->nullable()->after('lat');
            $table->text('description')->nullable()->after('updated_at');
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
            $table->dropColumn('active');
            $table->dropColumn('address_1');
            $table->dropColumn('address_2');
            $table->dropColumn('town');
            $table->dropColumn('city');
            $table->dropColumn('county');
            $table->dropColumn('lat');
            $table->dropColumn('lon');
            $table->dropColumn('description');
        });
    }
}
