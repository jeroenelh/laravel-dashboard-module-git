<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('git_repositories', function (Blueprint $table) {
            $table->string('id');
            $table->string('source');
            $table->string('user');
            $table->string('name');
            $table->boolean('is_public')->default(false);
            $table->timestamps();
            $table->unique(['id', 'source']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('git_repositories');
    }
};
