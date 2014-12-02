<?php
/**
 * Created by PhpStorm.
 * User: Jacob Wörman
 * Date: 11/29/2014
 * Time: 2:56 PM
 */

namespace Levelsystem\CLevelSystem;

class LevelcontrollerTest extends \PHPUnit_Framework_TestCase
{





   public function testSomethingRandom(){
   
   $X = 4;
   $Y = 8;
   $level = 4;
   
    $users = new \Levelsystem\Levelsystem\CLevelSystem($X, $Y, $level);
            if($users->currentlevel() == 1){
                echo "YOU GAIN LEVEL";
				return true;
            }elseif($users->currentlevel() == -1){
                echo "Sorry, you lost level";
				return false;
            }else{
                echo "You're still in current level.";
				return false;
            }
   
   
   }



}