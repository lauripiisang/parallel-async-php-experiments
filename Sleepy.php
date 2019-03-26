<?php

namespace Experiment;

class Sleepy
{

    public function __construct($v = 1)
    {
        $this->v = $v;
    }

    function sleepMessage($duration = null, $message = 'Sleeping')
    {
        if (!$duration) {
            $duration = $this->v;
        }

        echo date('H:i:s ') . $message . ' for ' . $duration . ' s'.  PHP_EOL;
        sleep($duration);
        $outMessage = date('H:i:s ') . "Done $message after $duration s";
        echo $outMessage . PHP_EOL;
        return $outMessage;
    }
}
