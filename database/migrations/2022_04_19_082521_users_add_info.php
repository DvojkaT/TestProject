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
        Schema::table('users', function (Blueprint $table) {
            $table->string('image')->nullable();
            $table->string('about')->nullable();
            $table->string('type');
            $table->string('github');
            $table->string('city');
            $table->boolean('is_finished')->nullable();
            $table->string('phone');
            $table->string('birthday');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('about');
            $table->dropColumn('type');
            $table->dropColumn('github');
            $table->dropColumn('city');
            $table->dropColumn('is_finished');
            $table->dropColumn('phone');
            $table->dropColumn('birthday');
        });
    }
};
