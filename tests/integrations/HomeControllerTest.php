<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Banijya\User;
use Banijya\Post;
class HomeControllerTest extends MasterTestCase
{
     /** @test */
     public function should_be_able_to_see_auth_users_post_as_well_as_other_users_post_in_home_page()
     {

         $user1 = $this->createUser();
         $user2 = $this->createUser();
         $user3 = $this->createUser();
         $this->be($user1);
         $post1 = $this->createPosts(['user_id' => $user1->id, 'body' => 'Status from user 1']);
         $post2 = $this->createPosts(['user_id' => $user2->id, 'body' => 'Status from user 2']);
         $post3 = $this->createPosts(['user_id' => $user3->id, 'body' => 'Status from user 3']);


         $this->makeFriendWith($user1, $user2);
         $this->makeFriendWith($user1, $user3);

         $this->assertTrue($user1->isFriendsWith($user2));
         $this->assertTrue($user1->isFriendsWith($user3));
         $this->assertFalse($user2->isFriendsWith($user3));

         $this->visit('/home')
                ->see($post1->body)
                ->see($post2->body)
                ->see($post3->body);
     }
 }