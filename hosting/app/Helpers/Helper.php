<?php


namespace App\Helpers;


/**
 * Class Helper
 * @package App\Helpers
 */

class Helper
{

    /**
     * @param int $number
     * @return int
     */

    public static function getFibonacci(int $number): int
    {
        if ($number < 1) { // номера элемента меньше 1 не существует, заканчиваем функцию
            return false;
        }
        if ($number <= 2) { // если это один из первых элементов, нетрудно увидеть как они определяются
            return ($number - 1);
        }
        $pre_pre = 0;
        $current = 1;
        for ($i = 2; $i <= $number; $i++) {
            $pre = $current;
            $current = $pre + $pre_pre;
            $pre_pre = $pre;
        }
        return $current;
    }

}
