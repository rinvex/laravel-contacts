<?php

declare(strict_types=1);

use Faker\Generator as Faker;

$factory->define(Rinvex\Contacts\Models\Contact::class, function (Faker $faker) {
    return [
        'addressable_type' => $faker->randomElement(['App\Models\Company', 'App\Models\Product', 'App\Models\User']),
        'addressable_id' => $faker->randomNumber(),
        'given_name' => $faker->firstName,
        'family_name' => $faker->lastName,
        'title' => $faker->jobTitle,
        'organization' => $faker->company,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'source' => $faker->randomElement(['conference', 'random', 'website']),
        'method' => $faker->randomElement(['phone', 'email', 'sms']),
        'country_code' => $faker->countryCode,
        'language_code' => $faker->languageCode,
        'birthday' => $faker->date(),
        'gender' => $faker->randomElement(['male', 'female']),
    ];
});
