<?php

declare(strict_types=1);

namespace App\Tests\Traits;

use Faker\Factory;
use Faker\Generator;

trait WithFakerTrait
{
    private ?Generator $faker;

    public function faker(): Generator
    {
        if (!isset($this->faker)) {
            $this->faker = Factory::create();
        }

        return $this->faker;
    }
}
