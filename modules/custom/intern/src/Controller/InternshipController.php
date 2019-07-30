<?php

/**
 * Controller for Intern Module
 */

namespace Drupal\intern\Controller;

use Drupal\Core\Controller\ControllerBase;

class InternshipController extends ControllerBase {
    
    public function content() {
        return array(
            '#type' => 'markup',
            '#markup' => '<div>Hello Class Summer of 2019</div>'
        );
    }

    public function dynamicContent($count) {
        // createNode($count);
        return array(
            '#type' => 'markup',
            '#markup' => '<div>Hello Class Summer of ' . $count . '</div>', 
        );
    }
}