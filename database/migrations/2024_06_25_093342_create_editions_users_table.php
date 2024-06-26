<?php

use App\Models\User;
use App\Models\Edition;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('edition_user', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Edition::class);
            $table->foreignIdFor(User::class);
            $table->date('acquisition_date')->useCurrent();
            $table->unsignedInteger('quantity')->default(1);
            $table->unsignedTinyInteger('reading_status')->default(1); // 1 = Not Read Yet; 2 = Reading; 3 = Read
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edition_user');
    }
};
