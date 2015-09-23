<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostsControllerTest extends MasterTestCase
{
     use DatabaseTransactions;

    /** @test */
    public function  it_should_display_all_the_posts_of_auth_user()
    {
        //arrange
        $user = $this->createUserAndSignIn();

        $this->createPosts(['user_id' => $user->id], 5);

        //act
        $this->signIn($user);

        //assert
        $this->seeInDatabase('posts', ['user_id' => $user->id]);
    }

    /** @test */
    public function it_should_post_a_status_and_redirect_back()
    {
        //arrange
        $user = $this->createUserAndSignIn();

        $this
            ->visit('/home')
            ->type('Testing', 'body')
            ->press('Post')
            ->seePageIs('/home')
            ->see('Testing');
    }
}
