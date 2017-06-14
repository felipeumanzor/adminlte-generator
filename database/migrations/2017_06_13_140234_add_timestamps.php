<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimestamps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('levels', function (Blueprint $table) {
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('subjects', function (Blueprint $table) {
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('contents', function (Blueprint $table) {
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('ratings', function (Blueprint $table) {
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('files', function (Blueprint $table) {
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
        
        Schema::table('file_comments', function (Blueprint $table) {
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
        
        Schema::table('content_comments', function (Blueprint $table) {
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
        
        Schema::table('favorites', function (Blueprint $table) {
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
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
