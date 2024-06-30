<?php

namespace FreshCMS\MalaysiaState\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('malaysia_states', function (Blueprint $table) {
            $table->id();
            $table->string('location');
            $table->string('post_office');
            $table->string('postcode');
            $table->string('state');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('malaysia_states');
    }
};
