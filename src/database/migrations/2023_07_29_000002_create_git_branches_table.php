
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
        Schema::create('git_branches', function (Blueprint $table) {
            $table->string('name');
            $table->string('user');
            $table->string('source');
            $table->string('repository_id');
            $table->timestamps();
            $table->unique(['name', 'user', 'source']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('git_branches');
    }
};
