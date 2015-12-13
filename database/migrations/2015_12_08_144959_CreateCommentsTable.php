<?php

/*
 * This file is part of Gitamin.
 *
 * Copyright (C) 2015-2016 The Gitamin Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $t) {
            $t->engine = 'InnoDB';

            $t->increments('id');
            $t->text('message');
            $t->string('target_type');
            $t->integer('author_id');
            $t->timestamps();
            $t->integer('project_id');
            $t->string('attachment')->nullable();
            $t->string('line_code')->nullable();
            $t->string('commit_id')->nullable();
            $t->integer('target_id');
            $t->boolean('system')->default(false);
            $t->text('st_diff')->nullable();
            $t->integer('updated_by_id')->nullable();
            $t->boolean('is_award')->default(false);

            $t->softDeletes();

            $t->index('author_id');
            $t->index('commit_id');
            $t->index(['created_at', 'id']);
            $t->index('created_at');
            $t->index('is_award');
            $t->index('line_code');
            $t->index(['target_id', 'target_type']);
            $t->index('target_type');
            $t->index(['project_id', 'target_type']);
            $t->index('project_id');
            $t->index('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comments');
    }
}
