<?php

namespace Drupal\my_service;

class CoffeeService {

    private $name = "Sam";

    public function coffeePayment($name = "Sam") {
        echo $name . ", you owe me $40" . "\n";
    }
    public function coffeeRun() {
        $data = "Thats my coffee";
        echo $data;
    }

    public function print_arr() {
        $array = [
            "hello" => "bill", "world"=>"elie", "yee"=>12
        ];
        echo $array["hello"] . "\n";
        return $array;
    }
}