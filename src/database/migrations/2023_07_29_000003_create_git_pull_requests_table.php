
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
        Schema::create('git_pull_requests', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->string('source');
            $table->string('title');
            $table->integer('number');
            $table->string('state');
            $table->string('repository_id');
            $table->bigInteger('user_id');
            $table->string('from_branch_id');
            $table->string('to_branch_id');
            $table->timestamps();
            $table->unique(['id', 'source']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('git_pull_requests');
    }
};
