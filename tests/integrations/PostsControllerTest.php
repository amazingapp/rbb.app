<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostsControllerTest extends MasterTestCase
{

    /** @test */
    public function  it_should_display_all_the_posts_of_auth_user()
    {
        //arrange
        $user = $this->createUserAndSignIn();

        $this->createPosts(['user_id' => $user->id], 5);

        //assert
        $this->seeInDatabase('posts', ['user_id' => $user->id]);
    }

    /** @test */
    public function it_should_post_a_status()
    {
        //arrange
        $user = $this->createUserAndSignIn();

        $this
            ->visit('/home')
            ->type('Testing', 'body')
            ->press('Post')
            ->see('Testing');
    }

    public function it_should_delete_a_posted_status()
    {
        $user = $this->createUserAndSignIn();
        $this->visit('/home')
            ->type('My Post Sould Be Deleted','body')
            ->press('Post')
            ->press('[value=DELETE]')
            ->see('/');
    }
}
