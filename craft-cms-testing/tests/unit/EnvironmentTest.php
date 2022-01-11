<?php

namespace tests;

use Codeception\Test\Unit;
use Craft;
use UnitTester;

class EnvironmentTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;

    public function testCraftProInstalled()
    {
        $this->assertSame(
            Craft::Pro,
            Craft::$app->getEdition()
        );
    }

    public function testSessionTableConfigured()
    {
        $tables = Craft::$app->db->schema->getTableNames();

        $this->assertContains('phpsessions', $tables);
    }

    public function testUserGroups()
    {
        $valid_groups = ['anvilAdmin', 'anvilCpmAdmin', 'ascClaimsAdmins', 'priceCustomers', 'rmaCustomers', 'submittalUsers'];

        $groups = Craft::$app->userGroups->getAllGroups();

        foreach ($groups as $group) {
            $this->assertContains($group->handle, $valid_groups);
        }
    }

    public function testTagGroups()
    {
        $valid_groups = ['approvalRating', 'endConnection', 'finishes', 'material', 'pipeConnection', 'pipeTypes', 'pressureClass', 'valveType'];

        $groups = Craft::$app->tags->getAllTagGroups();

        foreach ($groups as $group) {
            $this->assertContains($group->handle, $valid_groups);
        }
    }

    public function testCategories()
    {
        $valid_groups = ['brands', 'certifications', 'priceSheets', 'products', 'resources'];

        $groups = Craft::$app->categories->getAllGroups();

        foreach ($groups as $group) {
            $this->assertContains($group->handle, $valid_groups);
        }
    }

    public function testLicenseIssues()
    {
        $info = Craft::$app->plugins->getAllPluginInfo();

        $errors = [];

        foreach ($info as $plugin) {
            if (!$plugin['isInstalled']) {
                continue;
            }
            if (!$plugin['isEnabled']) {
                continue;
            }

            $this->assertEmpty($plugin['licenseIssues'], $plugin['name']);
        }
    }

    public function testCriticalPluginsEnabled()
    {
        $critical = [
            'aws-s3',
            'retour',
            'scout',
            'sprout-forms',
            'sprout-reports',
            'sitemap',
        ];

        foreach ($critical as $handle) {
            $plugin = Craft::$app->plugins->getPluginInfo($handle);

            $this->assertNotEmpty($plugin);

            $this->assertTrue($plugin['isInstalled']);
            $this->assertTrue($plugin['isEnabled']);

            if (!empty($plugin['licenseKey'])) {
                $this->assertEquals($plugin['licenseKeyStatus'], 'valid', $plugin['name']);
            }
        }
    }
}
