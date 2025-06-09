<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('plan')->default('free');
            $table->jsonb('data')->nullable();
            $table->timestamps();
        });
        
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->string('domain', 255)->unique();
            $table->string('tenant_id');
            $table->timestamps();
            
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
        });
        
        Schema::create('default_document_classifications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
            
            $table->foreign('parent_id')->references('id')->on('default_document_classifications');
        });
        
        Schema::create('default_document_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color')->default('#gray');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('domains');
        Schema::dropIfExists('default_document_statuses');
        Schema::dropIfExists('default_document_classifications');
        Schema::dropIfExists('tenants');
    }
};