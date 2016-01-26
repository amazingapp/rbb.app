<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SessionsControllerTest extends MasterTestCase
{
    /** @test */
    public function it_should_login_a_registered_user()
    {
        $this->createUser(['password' => '123', 'employee_id' => '1234']);

        $this->visit('/login')
                   ->type('1234', 'employee_id')
                   ->type('123', 'password')
                   ->press('Sign In')
                   ->seePageIs('/home');
    }

    protected function createUser($overrides = [])
    {
        return factory(Banijya\User::class)->create($overrides);
    }
}
