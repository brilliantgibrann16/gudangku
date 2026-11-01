<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Existing seeded movement history defines the stock baseline for demo products.
    }

    public function down(): void
    {
        // No data rollback: this migration documents the existing demo baseline only.
    }
};
