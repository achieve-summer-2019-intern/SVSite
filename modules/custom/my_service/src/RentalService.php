<?php
/** 
 * Oooo so now youre not gonna be read
*/
namespace Drupal\my_service;
use Drupal\Core\Session\AccountInterface;

class RentalService { 

    private $total_cost = 0;
    private $loggedInuser;

    public function __construct(AccountInterface $loggedInuser) {
        $this->loggedInUser = $loggedInuser;
    }

    public function getInfo() {
        // echo "Whats up";
        echo $this->loggedInuser;
    }

    public function setCost($cost = 90) {
        $this->total_cost = $cost;
    }

    public function increaseCost($expense) {
        $this->total_cost += $expense;
    }

    public function decreaseCost($paid) {
        $this->total_cost -= $paid;
    }

    public function getTotalCost() {
        echo "You still owe $" . $this->total_cost . " for the rental. \n";
    }
}
