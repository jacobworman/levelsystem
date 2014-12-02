<?php
/**
 * Created by PhpStorm.
 * User: Jacob Wörman
 * Date: 11/29/2014
 * Time: 2:56 PM
 */

namespace Jacobworman\Levelsystem;

/**
 * A controller for users and admin related events.
 *
 */
class TestlevelController extends \PHPUnit_Framework_TestCase
{





    public function testAction()
    {
			
			$X = 4;
			$Y = 6;
			$level = 5;

            $users = new \Anax\LevelSystem\CLevelSystem($X, $Y, $level);
            if($users->currentlevel() == 1){
                echo "YOU GAIN LEVEL";
				return true;
            }elseif($users->currentlevel() == -1){
                echo "Sorry, you lost level";
				return false;
            }else{
                echo "You're still in current level.";
            }



    }



}