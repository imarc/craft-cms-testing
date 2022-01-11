<?php

namespace tests;

use modules\seismicsubmittal\services\Design;
use modules\anvil\services\SharedAccess;

//use Helper\Unit as UnitHelper;

use Codeception\Test\Unit;
use Craft;
use craft\elements\User;
use UnitTester;

class SeismicV2Test extends Unit
{
    private $user_id = 1; // Imarc Admin
    private $shared_user_id = 79527; // Bill Bushee
    private $unrelated_user_id = 79689; // Dan Collins
    private $design_id = 1;

    // public function _before()
    // {
    //     $this->helper->loginUser($this->user_id);
    // }
    // public function _after()
    // {
    //     //$this->helper->loginUser($this->user_id);
    // }

    // protected function _inject(UnitHelper $helper)
    // {
    //     $this->helper = $helper;
    // }

    /**
     * Test if the project owner has access to the design record
     */
    public function testHasAccess()
    {
        $service = new Design();

        $design = $service->findRecord($this->design_id);
        $user = User::find()->id($this->user_id)->one();

        $result = $service->hasAccess($user, $design);

        $this->assertEquals($result, true);
    }

    /**
     * Test if a user has been granted shared access to the design record
     */
    public function testHasSharedAccess()
    {
        $service = new Design();

        $design = $service->findRecord($this->design_id);
        $user = User::find()->id($this->shared_user_id)->one();

        $result = $service->hasAccess($user, $design);

        if (!$result) {
            // Grant $user shared access to the design project
            (new SharedAccess)->shareProject($design->projectId, $user->id, $user->email, true);

            $result = $service->hasAccess($user, $design);
        }

        $this->assertEquals($result, true);
    }

    /**
     * Test if an unrelated user has access to the design record
     */
    public function testDoesNotHaveAccess()
    {
        $service = new Design();

        $design = $service->findRecord($this->design_id);
        $user = User::find()->id($this->unrelated_user_id)->one();

        $result = $service->hasAccess($user, $design);

        $this->assertEquals($result, false);
    }

    public function testBraceMemberSize()
    {
        $valid_sizes = [
            '1 NPS '
        ];
    }
}
