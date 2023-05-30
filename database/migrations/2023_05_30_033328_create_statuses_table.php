<?php

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
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('senderUid');
            $table->string('serverTime');
            $table->string('storageLink');
            $table->enum('statusType',[0,1,2])->default(0)->comment("Text = 0, Video = 1, Image = 2 ");
            $table->string('caption');
            $table->string('timeSent');
            $table->string('imageUri')->nullable();
            $table->string('videoUri')->nullable();
            $table->string('senderPhone');
            $table->boolean('isAdmin')->default(false);
            $table->string('captionBackgroundColor')->default('#660099');
            $table->enum('statusDeliveryType',[0,1])->default(0)->comment("Pending = 0, sent = 1");
            $table->foreign('senderUid')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};
