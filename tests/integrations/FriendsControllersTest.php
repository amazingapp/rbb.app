<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FriendsController extends MasterTestCase
{

     /** @test */
     public function it_should_send_a_friend_request()
     {
        //create senario
        $firstUser = $this->createUser();

        $secondUser = $this->createUser();

        //act
        $this->signIn($firstUser);

        $secondUserProfile = "/@{$secondUser->employee_id}";

        $userShouldSee = "Friend request sent to {$secondUser->name}";

        //assert
        $this->visit($secondUserProfile)
            ->press('Send Request')
            ->seePageIs($secondUserProfile)
            ->see($userShouldSee)
            ->see('Your request is pending');
     }


     /** @test */
     public function it_should_confirm_friend_requests_sent_by_other_user()
     {
        //create senario
        $firstUser = $this->createUser();

        $secondUser = $this->createUser();

        $this->signIn($firstUser);

        $secondUserProfile = "/@{$secondUser->employee_id}";

        $this->visit($secondUserProfile)->press('Send Request');

        $this->flushSession();

        $this->signIn($secondUser);

        $this->visit('/friends/requests')
             ->see($firstUser->name)
             ->press('Confirm')
             ->seePageIs('/friends/requests')
             ->see("You and {$firstUser->name} are friends.");
     }

      /** @test */
     public function it_should_delete_friend_requests_sent_by_other_user()
     {
        //create senario
        $firstUser = $this->createUser();

        $secondUser = $this->createUser();

        $this->signIn($firstUser);

        $secondUserProfile = "/@{$secondUser->employee_id}";

        $this->visit($secondUserProfile)->press('Send Request');

        $this->flushSession();

        $this->signIn($secondUser);

        $visit = '/friends/requests';

        $this->visit($visit)
             ->see($firstUser->name)
             ->press('Delete Request')
             ->seePageIs($visit)
             ->see("You have declined friend request from {$firstUser->name}.");
     }

     /** @test */
     public function should_see_you_and_friends_are_friends_when_you_view_another_users_profile()
     {
        $firstUser = $this->createUser();

        $secondUser = $this->createUser();

        $this->be($firstUser);

        $this->makeFriendWith($firstUser, $secondUser);

        $this->visit("/@{$secondUser->employee_id}")
                ->see("You and {$secondUser->name} are friends.");
     }
}