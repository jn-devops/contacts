<?php

namespace Homeful\Contacts\Database\Factories;

use Faker\Generator as BaseGenerator;

class CustomFakerGenerator extends BaseGenerator
{
    /**
     * Get a random element from an array.
     *
     * @return mixed
     */
    public function randomElement(array $array)
    {
        if (empty($array)) {
            throw new InvalidArgumentException('Array cannot be empty.');
        }

        $index = array_rand($array);

        return $array[$index];
    }

    public function nameSuffix()
    {
        $suffixes = ['Jr.', 'Sr.', 'I', 'II', 'III', 'IV', 'V'];

        return $this->randomElement($suffixes);
    }

    public function phoneNumber(): string
    {
        $randomNumber = str_pad(rand(0, 999999999), 9, '0', STR_PAD_LEFT);

        return '+639' . $randomNumber;
    }
}
