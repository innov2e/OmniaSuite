<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('territories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->foreignId('territory_id')->nullable()->constrained();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        
        Schema::create('organization_units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('level')->default(0);
            $table->string('path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->foreign('parent_id')->references('id')->on('organization_units');
            $table->index('path');
        });
        
        Schema::create('document_classifications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->foreign('parent_id')->references('id')->on('document_classifications');
        });
        
        Schema::create('document_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color')->default('#gray');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('classification_id')->constrained('document_classifications');
            $table->foreignId('sub_classification_id')->nullable()->constrained('document_classifications');
            $table->foreignId('status_id')->constrained('document_statuses');
            $table->date('valid_from')->nullable();
            $table->date('expires_at')->nullable();
            $table->foreignId('territory_id')->nullable()->constrained();
            $table->foreignId('location_id')->nullable()->constrained();
            $table->foreignId('organization_unit_id')->nullable()->constrained();
            $table->jsonb('external_urls')->nullable();
            $table->jsonb('metadata')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
            $table->timestamps();
            
            $table->index('expires_at');
            $table->index(['classification_id', 'status_id']);
            $table->index('territory_id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('documents');
        Schema::dropIfExists('document_statuses');
        Schema::dropIfExists('document_classifications');
        Schema::dropIfExists('organization_units');
        Schema::dropIfExists('locations');
        Schema::dropIfExists('territories');
    }
};