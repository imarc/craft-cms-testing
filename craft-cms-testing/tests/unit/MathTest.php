<?php

namespace tests;

use modules\anvil\services\Base;
use modules\anvil\services\ProductItems;

use Codeception\Test\Unit;
use Craft;
use UnitTester;

class MathTest extends Unit
{
    public function testConvertDecimalToFraction()
    {
        $service = new Base();

        $comparisons = [
            '.5' => '1/2',
            '1.25' => '1 1/4',
            '1.5' => '1 1/2',
            '2.375' => '2 3/8',
            '2.75' => '2 3/4',
            '2.875' => '2 7/8',
        ];

        foreach ($comparisons as $decimal => $fraction) {
            $converted = $service->convertDecimalToFraction($decimal);

            $this->assertEquals($converted, $fraction);
        }
    }

    public function testConvertFractionToDecimal()
    {
        $service = new ProductItems();

        $comparisons = [
            '1/2' => '.5',
            '1 1/4' => '1.25',
            '1 1/2' => '1.5',
            '2 3/8' => '2.375',
            '2 3/4' => '2.75',
            '2 7/8' => '2.875',
        ];

        foreach ($comparisons as $fraction => $decimal) {
            $converted = $service->convertFractionToDecimal($fraction);

            $this->assertEquals($converted, $decimal);
        }
    }

    // Other math/conversion methods to test
    /*
    SeismicReport: npsToDN, inOrMm, inOrCm, ftOrM, lbOrKg, lbPerFootOrKgPerM, npsOrDn. psiOrKpa. in3OrCm3
    */
}
