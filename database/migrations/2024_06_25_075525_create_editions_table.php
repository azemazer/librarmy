<?php

use App\Models\Book;
use App\Models\EditionType;
use App\Models\Editor;
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
        Schema::create('editions', function (Blueprint $table) {
            $table->id();
            $table->date('edition_date')->nullable();
            $table->integer('page_number')->nullable();
            $table->foreignIdFor(Book::class);
            $table->foreignIdFor(Editor::class);
            $table->foreignIdFor(EditionType::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('editions');
    }
};
