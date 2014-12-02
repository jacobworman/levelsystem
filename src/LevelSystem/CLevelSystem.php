<?php
/**
 * By: Jacob Wörman
 * Date: 11/29/2014
 * Time: 12:41 PM
 * Version: 1
 */

namespace Levelsystem\Levelsystem;

class CLevelSystem{

    const X = 100;

    protected $x;
    protected $y;
    protected $preLevel;
    private $output;

    /*
     * X AND Y Values comes from whatever factors you want.
     */
    public function __construct($x, $y, $preLevel = null){
        $this->x = $x;
        $this->y = $y;
        $this->preLevel = $preLevel;
	}


    /* THIS X Y
     the level line and intervall = x^-2*10x+1, -- also   y = (x^-2)*cx+1  --  also y=(c/x)+1 -- also -c = 1*x+(-y*x)

            The holy grail function: x^-2*10x+1 (The 10 in this example is basically C)

        c = level intervall/line
        +1: This says that it is better to level up Y axis. You can't set to 0. Change y = (x^-2)*cx+1 to y = (x^-2)*cx+0 and make c stand alone "c = something"
    */

    public function currentlevel(){
        /* RANDOM X AND Y */
        $userx = $this->x;
        $usery = $this->y;

        $c = 1*$userx +(-$usery*$userx); // the core function
        $currentlevel = $c*-1;

        $status = $this->levelStage($currentlevel);

        if($status === true) {
            /* increase level HERE based on the levelStage() function */

            return $this->output;

        }elseif($status === false){

            return $this->output;

        }
        return false;
    }

    protected function preLevel(){

        //The purpose of this is to set a levelStage
        if(empty($this->preLevel)){
            $this->preLevel = 10; // YOU CAN CHANGE 10. ALSO SEND TO DATABASE?
        }
        $b = self::X + ($this->preLevel)*log(self::X);
        $a = 0;

        $preLevel = $b - $a;

        return $preLevel;

    }

    /* calculate level intervall based on levelX and set next and prelevel */
    private function levelStage($currentlevel){

        /*
         * The area is x=0, x=100
         */

        $b = self::X + ($currentlevel)*log(self::X);
        $a = 0;

       // F(b) - F(a);

        $B = $b - $a;
        $A = $this->preLevel();


        /*
         * easier to level up over time. Bad solution to solve the problem.
         *
         * Everything down below basically sets a bar on how easy or hard it should be on leveling up or down.
         *
         * How well this works in practice remains to be seen. Version 1
         */
        $e = 2;
        if((strlen("$A") % 5) == 3){
            $e = 1.8;
        }elseif(((strlen("$A") % 5) >= 4)){
            $e = 1.5;
        }

        if($B > $A*$e){
            /*
             * THIS IS WHERE YOU DETERMINES WHAT OF A EFFECT ON INCREASE LEVEL WILL BE LIKE
             */

            $this->preLevel = $currentlevel; // THIS SHOULD BE SENT TO A DATABASE TO KEEP TRACK ON CURRENT LEVEL ON USER
            $this->output = 1; // example +1 of something, which will benefit in someway.
            return true;

        }elseif($B <= $A){
            /*
             * THIS IS WHERE YOU DETERMINES WHAT OF A EFFECT ON DECREASE LEVEL WILL BE LIKE
             */

            $this->preLevel = $currentlevel;
            $this->output = -1;
            return false;
        }

        // If current level
        return false;
    }


}