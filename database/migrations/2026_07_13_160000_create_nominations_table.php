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
        Schema::create('nominations', function (Blueprint $table) {
            $table->id();
            $table->string('nomination_number')->nullable()->unique();
            $table->string('nominator_name');
            $table->string('nominator_email');
            $table->string('nominator_x_handle')->nullable();
            $table->boolean('self_nomination')->default(false);
            $table->string('nominee_name');
            $table->string('nominee_x_handle');
            $table->string('show_name')->nullable();
            $table->json('categories');
            $table->text('reason');
            $table->text('links')->nullable();
            $table->json('attachments')->nullable();
            $table->unsignedInteger('amount_due');
            $table->string('payment_method');
            $table->string('payment_reference')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('nominations');
    }
};
