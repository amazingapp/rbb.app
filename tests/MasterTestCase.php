<?php

abstract class MasterTestCase extends TestCase
{
    protected function createUser($overrides = [])
    {
        return factory(Banijya\User::class)->create($overrides);
    }

    protected function signIn($user)
    {
        $this->actingAs($user)->visit('/home');
    }

    protected function createPosts($overrides = [], $times = 1)
    {
        return factory(Banijya\Post::class, $times)->create($overrides);
    }

    protected function createUserAndSignIn()
    {
        $creds = ['employee_id' => 1, 'password' => '1'];

        $user = $this->createUser( $creds );

        $this->signIn($user);

        return $user;
    }
}