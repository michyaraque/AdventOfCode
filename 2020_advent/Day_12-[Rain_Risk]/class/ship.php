<?php
class Ship {

    const DEVELOP_MODE = true;
    private $data = [];
    public $cords = ['north' => 0, 'east' => 0, 'south' => 0, 'west' => 0];
    public $direction = [0, 1, 0, 0];

    public function __construct(string $data) {
        $this->data = explode("\r\n", $data);
        $this->iterateCords();
    }

    public function moveShip(int $move_value, string $type): array {

        switch($type) {
            case 'N': case '0':
                $this->cords['north'] = $this->cords['north'] + $move_value;
            break;
            case 'E': case '1':
                $this->cords['east'] = $this->cords['east'] + $move_value;
            break;
            case 'S': case '2':
                $this->cords['south'] = $this->cords['south'] + $move_value;
            break;
            case 'W': case '3':
                $this->cords['west'] = $this->cords['west'] + $move_value;
            break;
        }
        return $this->cords;
    }

    public function changeDirection(int $value, string $direction): array {
        $is_facing_at = array_search(1, $this->direction);
        $this->direction[$is_facing_at] = 0;
    
        $sum_value = $value / 90;
    
        if($direction == 'L') {
            $new_direction = $is_facing_at - $sum_value;
            $new_dir = ($new_direction >= 0 ? $this->direction[$new_direction] = 1 : $this->direction[$new_direction + 4] = 1);

        } elseif($direction == 'R') {
            $new_direction = $is_facing_at + $sum_value;
            $new_dir = ($new_direction <= 3 ? $this->direction[$new_direction] = 1 :  $this->direction[$new_direction - 4] = 1);
        }
        return $this->direction;
    }

    public function iterateCords() {
        foreach($this->data as $movement) {
            preg_match("/([a-zA-Z]+)(\d+)/i", $movement, $match_data);
            $move_to = $match_data[1];
            $move_value = $match_data[2];
            if(array_intersect(['N', 'E', 'S', 'W'], [$move_to])) {
                $this->cords = $this->moveShip($move_value, $move_to);
            }
            $is_facing_at = array_search(1, $this->direction);
            switch($move_to) {
                case 'L':
                    $this->direction = $this->changeDirection($move_value, 'L');
                    $move_value = 0;
                break;
                case 'R':
                    $this->direction = $this->changeDirection($move_value, 'R');
                    $move_value = 0;
                break;
                case 'F':
                    $this->cords = $this->moveShip($move_value, $is_facing_at);
                break;
            }
            
            if(self::DEVELOP_MODE) {
                $getCordsKeys = array_keys($this->cords);
                $this->showStatus(sprintf("MOVE TO: %s+%u   | ACTUAL DIR: N: %u | E: %u | S: %u | W: %u\n", 
                    ucfirst($getCordsKeys[$is_facing_at]), 
                    $move_value, 
                    $this->cords['north'], 
                    $this->cords['east'], 
                    $this->cords['south'], 
                    $this->cords['west'])
                );
            }
        }
    }

    public function getDistance(): int {
        $get_travel_position = abs($this->cords['north'] - $this->cords['south']) + abs($this->cords['east'] - $this->cords['west']);
        return $get_travel_position;
    }

    /// UTILS

    public function showStatus($value) {
        try {
            if(!empty($value)) {
                echo $value;
            } else {
                throw new Exception('Empty message');
            }
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

}