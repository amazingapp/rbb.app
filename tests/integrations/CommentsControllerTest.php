<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommentsControllerTest extends MasterTestCase
{

    /** @test */
    public function should_be_redirected_to_the_post_url_once_comment_is_left_on_the_home_page()
    {
        $user1 = $this->createUser();
        $user2 = $this->createUser();

        $post1 = $this->createPosts(['user_id' => $user1->id, 'body' => 'Status from user 1']);

        $this->makeFriendWith($user1, $user2);

        $this->be($user2);

        $this->visit('/home')
              ->type('This is a status', "body")
              ->press('Leave comment')
              ->seePageIs("/@{$user1->employee_id}/posts/{$post1->id}")
              ->see('This is a status');
    }


    /** @test */
    public function owner_should_be_able_to_comment_to_his_own_post()
    {
        $user1 = $this->createUser();

        $this->be($user1);

        $post1 = $this->createPosts(['user_id' => $user1->id, 'body' => 'This is a test status.']);

        $this->visit('/home')
        ->type('This is a comment!','body')
             ->press('Leave comment')
             ->seePageIs("/@{$user1->employee_id}/posts/{$post1->id}")
             ->see("This is a comment!");
    }

    /** @test */
    public function should_be_able_to_comment_on_users_post_only_if_are_friends_with()
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
