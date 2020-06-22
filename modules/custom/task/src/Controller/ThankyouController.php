<?php

namespace Drupal\task\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Database\Database;

class ThankyouController extends ControllerBase {
    public function hello() {
        return array(
                '#title' => 'Thank You',
                '#markup' => 'Form data submitted.',
            );
    }

    public function getDetails() {
  //fetch data from employee table.
  $db = \Drupal::database();
  $query = $db->select('task', 'n');
  $query->fields('n');
  $response = $query->execute()->fetchAll();
    return new JsonResponse( $response );
  }
}
