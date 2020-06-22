<?php
/**
 * @file
 * Contains \Drupal\resume\Form\ResumeForm.
 */
namespace Drupal\task\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Core\Database\Database;
class TaskForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'resume_form';
  }
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['task'] = array(
      '#type' => 'textfield',
      '#title' => t('Task Name:'),
      '#required' => TRUE,
    );
    $form['description'] = array(
      '#type' => 'textfield',
      '#title' => t('Task Description:'),
      '#required' => TRUE,
    );
     $form['duration'] = array (
      '#type' => 'select',
      '#title' => ('Duration'),
      '#options' => array(
        'monthly' => t('monthly'),
        'daily' => t('daily'),
        'other' => t('other'),

      ),
    );
    /*$form['candidate_copy'] = array(
      '#type' => 'checkbox',
      '#title' => t('Send me a copy of the application.'),
    );*/
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    );
    return $form;
  }
  /**
   * {@inheritdoc}
   */
    
  /**
   * {@inheritdoc}
   */
  /*public function submitForm(array &$form, FormStateInterface $form_state) {
   // drupal_set_message($this->t('@can_name ,Your application is being submitted!', array('@can_name' => $form_state->getValue('candidate_name'))));
    foreach ($form_state->getValues() as $key => $value) {
      drupal_set_message($key . ': ' . $value);
    }
  }*/

  public function submitForm(array &$form, FormStateInterface $form_state) {
  $conn = Database::getConnection();
  $conn->insert('task')->fields(
    array(
      'task' => $form_state->getValue('task'),
      'description' => $form_state->getValue('description'),
      'duration' => $form_state->getValue('duration'),
    )
  )
  ->execute();
  drupal_set_message(t('Form Submitted Successfully'), 'status', TRUE);
  $url = Url::fromRoute('hello_world');
  $form_state->setRedirectUrl($url);
 }


}
