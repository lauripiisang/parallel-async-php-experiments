<?php
require_once './vendor/autoload.php';

use React\EventLoop\Factory as EventLoopFactory;
use React\EventLoop\TimerInterface;
use WyriHaximus\React\ChildProcess\Closure\ClosureChild;
use WyriHaximus\React\ChildProcess\Closure\MessageFactory;
use WyriHaximus\React\ChildProcess\Messenger\Factory as MessengerFactory;
use WyriHaximus\React\ChildProcess\Messenger\Messages\Payload;
use WyriHaximus\React\ChildProcess\Messenger\Messenger;
$loop = EventLoopFactory::create();
MessengerFactory::parentFromClass(ClosureChild::class, $loop)->then(function (Messenger $messenger) use ($loop): void {
    $messenger->on('error', function ($e): void {
        echo 'Error: ', \var_export($e, true), \PHP_EOL;
    });
    $i = 0;
    $loop->addPeriodicTimer(1, function (TimerInterface $timer) use (&$i, $messenger, $loop): void {
        if ($i >= 13) {
            $loop->cancelTimer($timer);

            $messenger->softTerminate();
            return;
        }
        $messenger->rpc(MessageFactory::rpc(function () {
            return ['time' => \time()]; // Note that you ALWAYS MUST return an array
        }))->done(function (Payload $payload): void {
            echo $payload['time'], \PHP_EOL;
        });
        $i++;
    });

});
$loop->run();
