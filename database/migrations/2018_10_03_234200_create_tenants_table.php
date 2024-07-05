<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('domain')->unique();
            $table->string('icon')->nullable();
            $table->string('icon_disk')->nullable();
            $table->text('invite_message')->nullable();
            $table->json('settings')->nullable();
            $table->timestamps();
        });
    }
};
