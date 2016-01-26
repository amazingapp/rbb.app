<?php
use Banijya\User;
use Banijya\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;

abstract class MasterTestCase extends TestCase
{
    use DatabaseMigrations;

    protected function createUser($overrides = [])
    {
        return factory(User::class)->create($overrides);
    }

    protected function signIn($user)
    {
        $this->actingAs($user)->visit('/home');
    }

    protected function createPosts($overrides = [], $times = 1)
    {
        return factory(Post::class, $times)->create($overrides);
    }

    protected function createUserAndSignIn()
    {
        $creds = ['employee_id' => 1, 'password' => '1'];

        $user = $this->createUser( $creds );

        $this->signIn($user);

        return $user;
    }

    protected function makeFriendWith( $user1 , $user2 )
    {
        $user1->addFriend($user2);
        $user2->acceptFriendRequest($user1);
    }
}