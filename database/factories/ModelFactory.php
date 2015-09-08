<?php

$factory->define(Banijya\User::class, function ($faker) {
    return [
            'name'	 => $faker->name,
            'employee_id' => $faker->numberBetween(1091,21999),
            'mobile' => '984' . $faker->numberBetween(1111111,9999999),
            'dob'	=> $faker->dateTimeBetween($startDate = '-40 years', $endDate = '-20 years'),
            'designation' => designations( array_rand( designations(), 1 )),
            'current_branch' => branches( array_rand(branches(), 1) ),
            'email' => $faker->email,
            'password' => 'kabir',
            'settings' => ['email_notification' => 'on'],
            'remember_token' => str_random(10),
    ];

});

$factory->define(Banijya\Post::class, function($faker){
   return [
       'body' => $faker->sentence(),
       'user_id' => rand(1,50)
   ];
});

$factory->define(Banijya\Conversation::class,function($faker){
  return [
      'last_activity' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = '-1 week'),
  ];
});

$factory->define(Banijya\Message::class,function($faker){
  return [
      'body' => $faker->sentence()
  ];
});
$factory->define(Banijya\Comment::class, function($faker) use($factory){
  return [
            'body' => $faker->sentence()
      ];
});
