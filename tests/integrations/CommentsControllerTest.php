<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommentsControllerTest extends MasterTestCase
{
     use DatabaseTransactions;

    /** @test */
    public function it_should_be_able_to_comment_on_users_that_are_friends_with()
    {

    }
 }
