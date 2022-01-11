<?php

namespace tests;

use modules\anvil\services\MechanicalSubmittal;
use modules\anvil\services\SeismicDesign; // V1 Design
use modules\seismicsubmittal\Design; // V2 Design

use Helper\Unit as UnitHelper;

use Codeception\Test\Unit;
use Craft;
use UnitTester;

class SubmittalTest extends Unit
{
    private $project_id = 18075;
    private $mechanical_submittal_id = 8852;
    private $user_id = 1; // Imarc Admin

    public function _before()
    {
        $this->helper->loginUser($this->user_id);
    }
    public function _after()
    {
        //$this->helper->loginUser($this->user_id);
    }

    protected function _inject(UnitHelper $helper)
    {
        $this->helper = $helper;
    }

    public function testGetSubmittal()
    {
        $service = MechanicalSubmittal::getInstance();

        $submittal = $service->getSubmittal($this->mechanical_submittal_id);

        $this->assertEquals($submittal->projectId, $this->project_id);
    }


    public function testGetProjectUser()
    {
        $service = MechanicalSubmittal::getInstance();

        $user_id = $service->getProjectUser($this->mechanical_submittal_id);

        $this->assertEquals($user_id, $this->user_id);
    }
}
