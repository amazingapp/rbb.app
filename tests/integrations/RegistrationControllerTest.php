<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegistrationControllerTest extends MasterTestCase
{

    /** @test */
    public function it_should_register_a_user_and_log_him_and_redirect_to_home()
    {
           $this->visit('/register')
                   ->type('9999', 'employee_id')
                   ->type('Kabir Maharjan', 'name')
                   ->type('999999999', 'mobile')
                   ->type('kabir@hotmail.com', 'email')
                   ->type('kabir', 'password')
                   ->type('kabir', 'password_confirmation')
                   ->press('Register')
                   ->seePageIs('/home');
    }


    /** @test */
    public function it_should_not_accept_any_invalid_data()
    {
        $this->visit('/register')
                   ->type('abcd', 'employee_id')
                   ->type('', 'name')
                   ->type('adsfasf', 'mobile')
                   ->type('kabir', 'email')
                   ->type('a', 'password')
                   ->type('b', 'password_confirmation')
                   ->press('Register')
                   ->seePageIs('/register');
    }
}
