<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommentsControllerTest extends MasterTestCase
{

    /** @test */
    public function should_be_redirected_to_the_post_url_once_comment_is_left_on_the_status()
    {
        $user1 = $this->createUser();
        $user2 = $this->createUser();
        $post1 = $this->createPosts(['user_id' => $user1->id, 'body' => 'Status from user 1']);
        $post2 = $this->createPosts(['user_id' => $user2->id, 'body' => 'Status from user 2']);

        $this->makeFriendWith($user1, $user2);
    }

    /** @test */
    public function it_should_be_able_to_comment_on_users_that_are_friends_with()
    {
        //arrange


        //act

        //assert
    }


    /** @test */
    public function should_not_be_able_to_comment_on_users_whom_are_not_friends()
    {

    }

 }
