<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactRelationsTable extends Migration
{
    public function up()
    {
        Schema::create(config('rinvex.contacts.tables.contact_relations'), function (Blueprint $table) {
            // Columns
            $table->integer('contact_id')->unsigned();
            $table->integer('related_id')->unsigned();
            $table->string('relation');
            $table->timestamps();

            // Indexes
            $table->primary(['contact_id', 'related_id']);
            $table->foreign('contact_id')->references('id')->on(config('rinvex.contacts.tables.contacts'))
                  ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('related_id')->references('id')->on(config('rinvex.contacts.tables.contacts'))
                  ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists(config('rinvex.contacts.tables.contact_relations'));
    }
}
