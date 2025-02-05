<?php

namespace Homeful\Contacts\Data;

use Homeful\Contacts\Models\Customer;
use Spatie\LaravelData\Data;

class LinearData extends Data
{
    public function __construct(
        public string $buyer_first_name,
        public ?string $buyer_middle_name,
        public string $buyer_last_name,
        public string $buyer_name,
    ){}

    public static function fromModel(Customer $customer):self
    {
        $data = $customer->getData();
        return new self(
            buyer_first_name: strtoupper($data->first_name ?? ''),
            buyer_middle_name: strtoupper($data->middle_name ?? ''),
            buyer_last_name: strtoupper($data->last_name ?? ''),
            buyer_name: strtoupper(collect([
                $data->first_name,
                $data->middle_name,
                $data->last_name,
                $data->name_suffix
            ])->filter()->implode(' ')),
        );
    }

    public static function convertNumberToWords($number, $isFraction = true, $postfix = '') {
        if($number != '' && $number != 0){
            if($isFraction){
                if (fmod($number, 1) == 0) {
                    // If the number is an integer
                    return strtoupper(\NumberFormatter::create('en', \NumberFormatter::SPELLOUT)
                            ->format((int)$number)) . $postfix;
                } else {
                    // If the number has a fractional part
                    return strtoupper(\NumberFormatter::create('en', \NumberFormatter::SPELLOUT)
                            ->format((int)$number))
                        . ' AND '
                        . str_pad((int)round(($number - (int)$number) * 100), 2, '0', STR_PAD_LEFT)
                        . '/100'
                        . $postfix;
                }
            }else{
                $formatter = new \NumberFormatter('en', \NumberFormatter::SPELLOUT);

                if (strpos($number, '.') !== false) {
                    $parts = explode('.', $number);
                    $wholePart = $formatter->format($parts[0]);

                    // Check if the fractional part is not zero
                    if ((int)$parts[1] !== 0) {
                        $fractionalPart = $formatter->format($parts[1]);
                        return $wholePart . ' AND ' . $fractionalPart;
                    }

                    // If the fractional part is zero, return only the whole part
                    return $wholePart . $postfix;
                }

                // For whole numbers, convert directly
                return $formatter->format($number) . $postfix;
            }
        }else{
            return '';
        }
    }
}
