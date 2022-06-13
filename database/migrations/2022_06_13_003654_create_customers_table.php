<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->tinyInteger('title')->nullable();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->text('address')->nullable();
            $table->string('nic')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->string('mobile')->nullable();
            $table->string('home')->nullable();
            $table->uuid('gs_office_id')->nullable();
            $table->uuid('user_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->uuid('deleted_by')->nullable();

            $table->foreign('gs_office_id')->references('id')->on('gs_offices');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('deleted_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
