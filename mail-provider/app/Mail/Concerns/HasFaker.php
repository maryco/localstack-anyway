<?php

namespace App\Mail\Concerns;

use Faker\Generator;

trait HasFaker
{
    protected Generator $faker;

    public function locale($locale)
    {
        $this->faker = fake(
            match ($locale) { 'ja' => 'ja_JP', 'en' => 'en_US'}
        );
        return parent::locale($locale);
    }
}
