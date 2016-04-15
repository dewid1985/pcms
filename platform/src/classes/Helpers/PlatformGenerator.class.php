<?php

/**
 * Генератор
 *
 * Class PlatformGenerator
 */
class PlatformGenerator extends PlatformBase
{

    /**
     * Заглавные буквы и цифры
     *
     * @param $count
     * @return string
     */
    public function upStrNum($count)
    {
        $symbol = array(
            1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '0',
            11 => 'Q', 12 => 'W', 13 => 'E', 14 => 'R', 15 => 'T', 16 => 'Y', 17 => 'U', 18 => 'I', 19 => 'O', 20 => 'P',
            21 => 'A', 22 => 'S', 23 => 'D', 24 => 'F', 25 => 'G', 26 => 'H', 27 => 'J', 28 => 'K', 29 => 'L',
            30 => 'Z', 31 => 'X', 32 => 'C', 33 => 'V', 34 => 'B', 35 => 'N', 36 => 'M'
        );
        return $this->_generate($count, $symbol);
    }

    /**
     * Цифры
     *
     * @param $count
     * @return string
     */
    public function num($count)
    {
        $symbol = array(1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '0');
        return $this->_generate($count, $symbol);
    }

    /**
     * Генератор
     *
     * @param $count
     * @param $array
     * @return string
     */
    private function _generate($count, $array)
    {
        $count_symbol = count($array);
        $upstrnum = '';

        for ($i = 1; $i <= $count; $i++) {
            $num = rand(1, $count_symbol);
            $upstrnum .= $array[$num];
        }

        return $upstrnum;
    }
}