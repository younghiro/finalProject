<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
define('STATION_NUMBER',6);
define('START_STATION', 0);

$stations    = array('one', 'two', 'three', 'four', 'five','six');

//adjacencyMatrix
//Each array has the time from the each station to the data id numbers's stations
$adjacencyMatrix = array(
    //one', 'two', 'three', 'four', 'five', 'six'
    array(0, 12, 28, 0, 0, 0),  //from one
    array(12, 0, 10, 13, 0, 0), //from two
    array(28, 10, 0, 11, 7, 0), //from three
    array(0, 13, 11, 0, 0, 9),  //from four
    array(0, 0, 7, 0, 0, 4),    //from five
    array(0, 0, 0, 9, 4, 0)     //from six
);

for ($i=0; $i < STATION_NUMBER; $i++) {
    $currentCost[$i] = -1; //Here, minus one is infinity
    $fix[$i]         = false;
}

//we set 0 as the starting point
$currentCost[START_STATION] = 0;

//this loop finish until every node is checked
while (true) {
    //the times are set -1 as infinity
    $minStation = -1;
    $minTime    = -1;
    for ($i = 0; $i < STATION_NUMBER; $i++) {
        if (!$fix[$i] && ($currentCost[$i] != -1)) {
            //Check for stations where the pattern has not yet been identified and where the travel time is short.
            if ($minTime == -1 || $minTime > $currentCost[$i]) {
                $minTime    = $currentCost[$i];
                $minStation = $i;
            }
        }
    }
    if ($minTime == -1) {
        //whole stations are checked or the first time is infinity
        break;
    }

    // check for times between cuurent station to whole next stations 自分の駅から伸びているすべての駅の所要時間を調べる
    for ($i = 0; $i < STATION_NUMBER; $i++) {
        if (!$fix[$i] && $adjacencyMatrix[$minStation][$i] > 0) {
            // new time is the time where we came from and next station
            $newTime = $minTime + $adjacencyMatrix[$minStation][$i]; 
            //comparing the time and time which is alraedy checked and from another route
            if ($currentCost[$i] == -1 || $currentCost[$i] > $newTime) {
                $currentCost[$i] = $newTime;
            }
        }
    }
    // mark as we already checked it
    $fix[$minStation] = true;
}
for ($i = 0; $i < STATION_NUMBER; $i++) {
    echo ($stations[START_STATION] . "→" . $stations[$i] . "：" . $currentCost[$i] . "min");
    echo '<br>';
}

?>
</body>
</html>