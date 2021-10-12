<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnAtUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('date_of_birth')->nullable();
            $table->bigInteger('father_id')->nullable();
            $table->bigInteger('mother_id')->nullable();
            $table->bigInteger('parent_id')->nullable();
            $table->integer('birth_order')->nullable();
            $table->string('address')->nullable();
            $table->integer('phone')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
