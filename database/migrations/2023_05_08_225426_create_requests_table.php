<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
          
            $table->integer('product_id');
            $table->string('product_name');
            $table->string('qty');
            $table->string('senter_stock');
            $table->string('receiver_stock');
            $table->enum('senter_status',['pending','prepare','done','rejected'])->default('pending');
            $table->enum('receiver_status',['received','not_received','canceled'])->default('not_received');
            $table->string('details')->nullable();
            $table->string('reason')->nullable();
            $table->string('other_reason')->nullable();
            $table->string('create_by_user_id');
            $table->string('create_by_user_name');
            $table->string('receiver_national_name')->nullable();
            $table->string('receiver_national_phone')->nullable();
            $table->string('receiver_national_id')->nullable();
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
        Schema::dropIfExists('sent_requests');
    }
}
