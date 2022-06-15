<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
			$table->id();
			$table->string('key')->unique();
			$table->string('name')->nullable();
			$table->longText('about')->nullable();
			$table->longText('value')->nullable();
			$table->json('data')->nullable();
			$table->string('input')->default('text');
            $table->bigInteger('order_by')->nullable();
			$table->foreignId('setting_groups_id')->constrained();
			$table->string('permission')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
