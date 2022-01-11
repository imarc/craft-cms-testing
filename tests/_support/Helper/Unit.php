<?php
namespace Helper;

use craft\elements\User;
use craft\test\CraftConnector;

use Codeception\Module;

/**
 * Class Unit
 *
 * Here you can define custom actions.
 * All public methods declared in helper class will be available in $I
 *
 */
class Unit extends Module
{
    /**
     * Logs in a user
     * 
     * @param $identity mixed An ID or email address
     * @return void
     */
    public function loginUser($identity)
    {
        if (is_int($identity)) {
            $user = User::findOne(['id' => $identity]);
        } else {
            $user = User::findOne(['email' => $identity]);
        }

        (new CraftConnector)->findAndLoginUser($user->id);
    }
}
