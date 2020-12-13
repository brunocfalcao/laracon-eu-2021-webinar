<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHelpdeskSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('xxx')
                  ->comment('zzz');

            $table->engine = 'InnoDB';
            $table->timestamps();
            $table->softDeletes();
        });
        */

        Schema::create('action_types', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->engine = 'InnoDB';
            $table->timestamps();
        });

        Schema::create('incidents_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('action_type_id')
                  ->constrained()
                  ->comment('Type of incident action (open, assigned, reassigned, closed)');

            $table->foreignId('user_id')
                  ->constrained()
                  ->comment('The related user id that triggered this action');

            $table->string('description')
                  ->comment('Computed description given the action type');

            $table->engine = 'InnoDB';
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('profiles', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->boolean('is_admin')
                  ->default(false);

            $table->engine = 'InnoDB';
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->engine = 'InnoDB';
            $table->timestamps();
        });

        Schema::create('severities', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->engine = 'InnoDB';
            $table->timestamps();
        });

        Schema::create('priorities', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->engine = 'InnoDB';
            $table->timestamps();
        });

        Schema::create('requesters', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->string('email');

            $table->string('address_line_1')
                  ->nullable();

            $table->string('address_line_2')
                  ->nullable();

            $table->string('city')
                  ->nullable();

            $table->string('state')
                  ->nullable();

            $table->string('postal_code')
                  ->nullable();

            $table->string('country')
                  ->nullable();

            $table->string('latitude')
                  ->nullable();

            $table->string('longitude')
                  ->nullable();

            $table->engine = 'InnoDB';
            $table->timestamps();
        });

        Schema::create('incidents', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained()
                  ->comment('Current operator related assignment')
                  ->nullable();

            $table->foreignId('requester_id')
                  ->constrained()
                  ->comment('Current requested related assignment')
                  ->nullable();

            $table->string('title')
                  ->comment('The incident title, short problem description');

            $table->string('name')
                  ->comment('The user name that created the incident');

            $table->string('email')
                  ->comment('The user email that created the incident');

            $table->longtext('description')
                  ->comment('The incident detailed issue');

            $table->foreignId('severity_id')
                  ->nullable();

            $table->foreignId('priority_id')
                  ->nullable();

            $table->foreignId('category_id')
                  ->nullable();

            $table->string('external_link')
                  ->nullable();

            $table->string('attachment')
                  ->nullable();

            $table->engine = 'InnoDB';

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('incident_requester', function (Blueprint $table) {
            $table->id();

            $table->foreignId('requester_id');
            $table->foreignId('incident_id');

            $table->engine = 'InnoDB';
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('profile_id')
                  ->after('id')
                  ->nullable()
                  ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
