<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('username', 255)->unique();
            $table->string('password');
            $table->string('full_name', 255);
            $table->string('email', 320)->unique(); // According to *RFC 5321*, {64}@{255} = 320. (https://www.rfc-editor.org/rfc/rfc5321#section-4.5.3).
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
        Schema::dropIfExists('teachers');
    }
}
