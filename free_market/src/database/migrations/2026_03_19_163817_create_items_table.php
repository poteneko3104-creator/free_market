<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('pic')->nullable();
            $table->boolean('sold');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('brand');
            $table->integer('price');
            $table->string('detail');
            $table->string('condition');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
            // 一時的に外部キーチェックをオフにする
            Schema::disableForeignKeyConstraints();
            
            Schema::dropIfExists('items');
            
            // チェックをオンに戻す
            Schema::enableForeignKeyConstraints();
    }
}
