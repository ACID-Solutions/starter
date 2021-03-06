<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibraryMediaCategoriesTable extends Migration
{
    public function up(): void
    {
        Schema::create('library_media_categories', function (Blueprint $table) {
            $table->id();
            // ToDo: change column type if your app is not multilingual
            $table->json('title');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('library_media_categories');
    }
}
