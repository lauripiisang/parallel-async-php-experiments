<?php
# composer require amphp/parallel

require_once './vendor/autoload.php';

use Amp\Parallel\Worker;
use Amp\Promise;
use Experiment\Sleepy;

$tenSleeps = range(1, 10);
$promises = array_map(function ($duration) {
    return Worker\enqueueCallable([(new Sleepy($duration)), 'sleepMessage'], ...[null, 'S L E E P I N G']);
}, $tenSleeps);



echo date('H:i:s ') . "- process finished";

$responses = Promise\wait(Promise\all($promises));
var_dump($responses);
/*
 * 12:54:21 S L E E P I N G for 1 s
12:54:21 S L E E P I N G for 3 s
12:54:21 S L E E P I N G for 2 s
12:54:21 S L E E P I N G for 4 s
12:54:21 S L E E P I N G for 5 s
12:54:21 S L E E P I N G for 6 s
12:54:21 S L E E P I N G for 7 s
12:54:21 S L E E P I N G for 8 s
12:54:21 S L E E P I N G for 9 s
12:54:21 S L E E P I N G for 10 s
12:54:22 Done S L E E P I N G after 1 s
12:54:23 Done S L E E P I N G after 2 s
12:54:24 Done S L E E P I N G after 3 s
12:54:25 Done S L E E P I N G after 4 s
12:54:26 Done S L E E P I N G after 5 s
12:54:27 Done S L E E P I N G after 6 s
12:54:28 Done S L E E P I N G after 7 s
12:54:29 Done S L E E P I N G after 8 s
12:54:30 Done S L E E P I N G after 9 s
12:54:31 Done S L E E P I N G after 10 s
12:54:31 - process finishedarray(10) {
  [0]=>
  string(39) "12:54:22 Done S L E E P I N G after 1 s"
  [1]=>
  string(39) "12:54:23 Done S L E E P I N G after 2 s"
  [2]=>
  string(39) "12:54:24 Done S L E E P I N G after 3 s"
  [3]=>
  string(39) "12:54:25 Done S L E E P I N G after 4 s"
  [4]=>
  string(39) "12:54:26 Done S L E E P I N G after 5 s"
  [5]=>
  string(39) "12:54:27 Done S L E E P I N G after 6 s"
  [6]=>
  string(39) "12:54:28 Done S L E E P I N G after 7 s"
  [7]=>
  string(39) "12:54:29 Done S L E E P I N G after 8 s"
  [8]=>
  string(39) "12:54:30 Done S L E E P I N G after 9 s"
  [9]=>
  string(40) "12:54:31 Done S L E E P I N G after 10 s"
}
 */
