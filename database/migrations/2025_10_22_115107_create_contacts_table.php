<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 190);
            $table->string('position', 100);
            $table->string('address', 190);
            $table->string('city', 100);
            $table->string('zip', 50);
            $table->string('email', 80);
            $table->string('phone', 50);
            $table->string('company')->nullable();
            $table->timestamps();
            $table->foreignIdFor(User::class);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
