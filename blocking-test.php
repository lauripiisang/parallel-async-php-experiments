<?php

require_once './vendor/autoload.php';

function sleepMessage($duration, $message = 'Sleeping')
{
    echo date('H:i:s ') . $message . PHP_EOL;
    sleep($duration);
    $outMessage = date('H:i:s ') . "Done $message after $duration s";
    echo $outMessage . PHP_EOL;
    return $outMessage;
}

function main()
{
    $loop = React\EventLoop\Factory::create();

    $promises = [];

    for($i = 1; $i <=5; $i++){
        $promises[] = new \React\Promise\LazyPromise(function($resolve) use($i){ return $resolve(sleepMessage($i %2 === 0 ? 3 : 1, $i)); });

        echo '1' .PHP_EOL;
    }
    $messagesOut = Clue\React\Block\awaitAll($promises, $loop, 15);
    var_dump($messagesOut);

}

main();
die();
