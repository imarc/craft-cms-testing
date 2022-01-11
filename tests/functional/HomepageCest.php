<?php

namespace tests;

use FunctionalTester;
use Codeception\Util\HttpCode;

class HomepageCest
{
    /**
     * @param FunctionalTester $I
     */
    public function _before(FunctionalTester $I)
    {
    }

    /**
     * @param FunctionalTester $I
     */
    public function testHomePage(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeElement('#page-home');
    }
}
