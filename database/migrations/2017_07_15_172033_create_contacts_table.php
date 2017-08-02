<?php

declare(strict_types=1);
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    public function up()
    {
        Schema::create(config('rinvex.contacts.tables.contacts'), function (Blueprint $table) {
            // Columns
            $table->increments('id');
            $table->morphs('entity');
            $table->string('source')->nullable();
            $table->string('method')->nullable();
            $table->string('name_prefix')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('name_suffix')->nullable();
            $table->string('job_title')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('skype')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('google_plus')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('country_code', 2)->nullable();
            $table->string('language_code', 2)->nullable();
            $table->date('birthday')->nullable();
            $table->char('gender', 1)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(config('rinvex.contacts.tables.contacts'));
    }
}
