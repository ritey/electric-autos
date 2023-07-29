<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dealers', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('enabled')->default(1)->index();
            $table->uuid('dealer_id')->nullable()->index();
            $table->integer('package_id')->nullable()->index();
            $table->string('name', 128);
            $table->string('email', 128)->nullable();
            $table->string('slug', 128)->nullable()->index();
            $table->boolean('active', 128)->default(1)->index();
            $table->string('address_1', 128)->nullable();
            $table->string('address_2', 128)->nullable();
            $table->string('town', 128)->nullable();
            $table->string('city', 128)->nullable();
            $table->string('county', 128)->nullable();
            $table->string('lat', 32)->nullable();
            $table->string('lon', 32)->nullable();
            $table->string('phone', 32)->nullable();
            $table->string('mobile', 32)->nullable();
            $table->string('location', 64)->nullable();
            $table->string('website', 256)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->text('description')->nullable();
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
            $table->boolean('private')->default(0)->index();
            $table->integer('sort_order')->default(0)->index();
            $table->integer('car_type_id')->index()->nullable();
            $table->integer('user_id')->index();
            $table->integer('dealer_id')->index()->nullable();
            $table->integer('make_id')->index();
            $table->integer('model_id')->index();
            $table->integer('views')->default(0)->index();
            $table->integer('range')->default(0)->index();
            $table->string('name', 128);
            $table->decimal('price', 8, 2)->nullable()->index();
            $table->string('fuel', 8)->nullable()->index();
            $table->string('year', 4)->nullable()->index();
            $table->string('colour', 12)->nullable()->index();
            $table->string('reg', 12)->nullable();
            $table->string('gearbox')->nullable()->index();
            $table->integer('doors')->nullable()->index();
            $table->string('slug', 128)->nullable()->index();
            $table->integer('mileage')->nullable()->index();
            $table->string('length_measure', 36)->nullable()->default('miles');
            $table->string('currency')->nullable()->index();
            $table->text('content')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('live_at')->nullable()->index();
        });

        Schema::create('uploads', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('enabled')->default(1);
            $table->string('user_id', 36);
            $table->string('dealer_id')->nullable()->index();
            $table->string('article_id', 36)->nullable()->index();
            $table->string('folder')->index();
            $table->string('extension', 12);
            $table->string('filename', 256);
            $table->string('maskname', 128);
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
            $table->string('tweet', 140)->nullable();
            $table->timestamp('tweeted_at')->nullable();
            $table->timestamp('next_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('enabled');
            $table->string('slug')->nullable()->index();
            $table->integer('sort_order')->default(0);
            $table->string('name', 156);
            $table->string('meta_date', 36)->nullable();
            $table->string('meta_author', 156)->nullable();
            $table->string('meta_title', 156)->nullable();
            $table->string('meta_description', 156)->nullable();
            $table->string('img', 256)->nullable();
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

        Schema::create('history', function (Blueprint $table) {
            $table->increments('id');
            $table->string('action', 128);
            $table->string('user_id')->index();
            $table->string('description', 256)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
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
        Schema::drop('articles');
        Schema::drop('articles_to_uploads');
        Schema::drop('history');
    }
};
