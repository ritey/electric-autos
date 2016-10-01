<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('user_id');
            $table->integer('user_type_id')->default(1)->nullable()->index();
            $table->integer('dealer_id')->nullable()->index();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('dealers', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('dealer_id')->nullable()->index();
            $table->integer('package_id')->nullable()->index();
            $table->string('name',128);
            $table->string('email',128)->nullable();
            $table->string('phone',32)->nullable();
            $table->string('mobile',32)->nullable();
            $table->string('location',64)->nullable();
            $table->string('website',256)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('serialized')->default(0);
            $table->string('package_group')->index();
            $table->string('name')->index();
            $table->text('value');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('user_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('makes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('models', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('make_id');
            $table->string('name');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('resources', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('enabled')->default(1)->index();
            $table->boolean('sold')->default(0)->index();
            $table->integer('sort_order')->default(0)->index();
            $table->integer('car_type_id')->index()->nullable();
            $table->integer('user_id')->index();
            $table->integer('dealer_id')->index();
            $table->integer('make_id')->index();
            $table->integer('model_id')->index();
            $table->string('name',128);
            $table->decimal('price',8,2)->nullable()->index();
            $table->string('fuel',8)->nullable()->index();
            $table->string('year',4)->nullable()->index();
            $table->string('colour',12)->nullable()->index();
            $table->string('reg',12)->nullable();
            $table->string('gearbox')->nullable()->index();
            $table->integer('doors')->nullable()->index();
            $table->string('slug',128)->nullable()->index();
            $table->integer('mileage')->nullable()->index();
            $table->text('content')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('uploads', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('enabled')->default(1);
            $table->string('user_id',36);
            $table->string('folder')->index();
            $table->string('extension',12);
            $table->string('filename',256);
            $table->string('maskname',128);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('resources_to_uploads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('resource_id');
            $table->integer('upload_id');

            $table->index('resource_id');
            $table->index('upload_id');
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('serialized')->default(0);
            $table->string('settings_group')->index();
            $table->string('name')->index();
            $table->text('value');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('tweets', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('enabled')->default(1)->index();
            $table->string('name')->nullable();
            $table->string('tweet',140)->nullable();
            $table->timestamp('tweeted_at')->nullable();
            $table->timestamp('next_at')->nullable();
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
        Schema::drop('dealers');
        Schema::drop('packages');
        Schema::drop('makes');
        Schema::drop('models');
        Schema::drop('users');
        Schema::drop('user_types');
        Schema::drop('resources');
        Schema::drop('resources_to_uploads');
        Schema::drop('settings');
        Schema::drop('tweets');
    }
}