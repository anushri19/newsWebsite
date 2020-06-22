<?php
namespace Drupal\task\Plugin\views\field;

use Drupal\views\Plugin\views\field\FieldPluginBase;
use Drupal\views\ResultRow;


class Task extends FieldPluginBase {
  /**
   * {@inheritdoc}
   */
  public function execute(ViewExecutable $view) {
     if ($access_tokens = $this->resumeAccessTokenManager->loadMultipleAccessToken()) {
       $index = 0;
       foreach ($access_tokens as $id => $access_token) {
         if ($data = $this->resumeClient->getResourceOwner($access_token)) {
           $data = $data->toArray();
           $row['id'] = $data['id'];
           $row['task'] = $data['task'];
           $row['description'] = $data['description'];
           // 'index' key is required.
           $row['index'] = $index++;
           $view->result[] = new ResultRow($row);
         }
       }
     }
   }
