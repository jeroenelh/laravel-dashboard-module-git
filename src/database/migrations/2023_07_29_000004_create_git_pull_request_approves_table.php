
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
        Schema::create('git_pull_request_approves', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->string('source');
            $table->string('state');
            $table->integer('pull_request_id');
            $table->bigInteger('user');
            $table->dateTime('submitted_at');
            $table->timestamps();
            $table->unique(['id', 'source']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('git_pull_request_approves');
    }
};
