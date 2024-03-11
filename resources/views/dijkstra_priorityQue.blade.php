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


define('STATION_NUMBER', 6);
define('START_STATION', 0);

$stations    = array('A', 'B', 'C', 'D', 'E','F');

//adjacencyMatrix
//Each array has the time from the each station to the data id numbers's stations
$adjacencyMatrix = array(
    //A', 'B', 'C', 'D', 'E', 'F'
    array(0, 12, 28, 0, 0, 0),  //from A
    array(12, 0, 10, 13, 0, 0), //from B
    array(28, 10, 0, 11, 7, 0), //from C
    array(0, 13, 11, 0, 0, 9),  //from D
    array(0, 0, 7, 0, 0, 4),    //from E
    array(0, 0, 0, 9, 4, 0)     //from F
);

class MinHeap {
    public $a = array();
    public $pos = array();
    public $size;

    public function __construct($n) {
        $this->a = array_map(function ($v) {
            return array($v, PHP_INT_MAX);
        }, range(0, $n - 1));
        $this->pos = range(0, $n - 1);
        $this->size = $n;
    }

    public function extractMin() {
        list($v, $w) = $this->a[0];
        $this->swap(0, $this->size - 1);
        $this->size--;
        $this->popDown(0);
        return array($v, $w);
    }

    public function swap($i, $j) {
        $vi = $this->a[$i][0];
        $vj = $this->a[$j][0];
        list($this->a[$i], $this->a[$j]) = array($this->a[$j], $this->a[$i]);
        list($this->pos[$vi], $this->pos[$vj]) = array($this->pos[$vj], $this->pos[$vi]);
    }

    public function decreaseKey($v, $val) {
        $i = $this->pos[$v];
        $this->a[$i][1] = $val;
        $this->popUp($i);
    }

    public function contains($v) {
        return $this->pos[$v] < $this->size;
    }

    public function val($v) {
        return $this->a[$this->pos[$v]][1];
    }

    public function popUp($i) {
        $pi = floor(($i - 1) / 2);
        while ($i > 0 && $this->a[$i][1] < $this->a[$pi][1]) {
            $this->swap($i, $pi);
            $i = $pi;
            $pi = floor(($i - 1) / 2);
        }
    }

    public function popDown($i) {
        $val = $this->a[$i][1];
        $candidate = null;
        $ri = 2 * $i + 2;
        $li = 2 * $i + 1;
        if ($ri < $this->size) {
            if ($this->a[$ri][1] < $val) {
                $candidate = $ri;
            }
        }
        if ($li < $this->size) {
            if ($candidate === null) {
                if ($this->a[$li][1] < $val) {
                    $candidate = $li;
                }
            } else {
                if ($this->a[$li][1] < $this->a[$ri][1]) {
                    $candidate = $li;
                }
            }
        }
        if ($candidate !== null) {
            $this->swap($i, $candidate);
            $this->popDown($candidate);
        }
    }
}

$minHeap = new MinHeap(STATION_NUMBER);
$dist = array_fill(0, STATION_NUMBER, null);
$parent = array_fill(0, STATION_NUMBER, null);

$minHeap->decreaseKey(START_STATION, 0);
$dist[START_STATION] = 0;

while ($minHeap->size > 0) {
    list($u, $d) = $minHeap->extractMin();
    for ($v = 0; $v < STATION_NUMBER; $v++) {
        if ($adjacencyMatrix[$u][$v] > 0 && $minHeap->contains($v)) {
            if ($d + $adjacencyMatrix[$u][$v] < $minHeap->val($v)) {
                $parent[$v] = $u;
                $dist[$v] = $d + $adjacencyMatrix[$u][$v];
                $minHeap->decreaseKey($v, $d + $adjacencyMatrix[$u][$v]);
            }
        }
    }
}

for ($i = 0; $i < STATION_NUMBER; $i++) {
    echo ($stations[START_STATION] . "→" . $stations[$i] . "：" . $dist[$i] . "min");
    echo '<br>';
}
?>
</body>
</html>