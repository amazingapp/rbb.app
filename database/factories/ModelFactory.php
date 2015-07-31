<?php

$factory->define('Banijya\User', function ($faker) {
    return [
            'name'	 => $faker->name,
            'employee_id' => $faker->numberBetween(1091,21999),
            'mobile' => '984' . $faker->numberBetween(1111111,9999999),
            'dob'	=> $faker->dateTimeBetween($startDate = '-40 years', $endDate = '-20 years'),
            'designation' => $faker->word,
            'email' => $faker->email,
            'password' => 'kabir',
            'settings' => ['email_notification' => 'on'],
            'remember_token' => str_random(10),
    ];

});

$factory->define('Banijya\Post', function($faker){
   return [
       'body' => $faker->sentence(),
       'user_id' => rand(1,50)
   ];
});
$factory->define('Banijya\Conversation',function($faker){
  return [
      'last_activity' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = '-1 week'),
  ];
});

$factory->define('Banijya\Message',function($faker){
  return [
      'body' => $faker->sentence()
  ];
});

