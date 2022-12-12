<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExternalRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('external_requests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('request_category', 255)->default('');
            $table->string('request_serive', 255)->default('');
            $table->string('request_action', 255)->default('');
            $table->dateTime('request_date')->nullable();
            $table->text('request', 255)->nullable();
            $table->text('response', 255)->nullable();
            $table->text('error', 255)->nullable();
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
        Schema::dropIfExists('external_requests');
    }
}
