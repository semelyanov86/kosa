<?php

use App\Models\BusinessEvent;
use App\Models\Contact;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('business_event_contact', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(BusinessEvent::class);
            $table->foreignIdFor(Contact::class);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_event_contact');
    }
};
