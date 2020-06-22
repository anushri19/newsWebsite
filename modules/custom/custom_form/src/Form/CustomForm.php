<?php
/**
 * @file
 * Contains \Drupal\custom_form\Form\CustomForm.
 */
namespace Drupal\custom_form\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Core\Database\Database;
class CustomForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_form';
  }
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => t('User Name:'),
      '#required' => TRUE,
    );
    $form['mail'] = array(
      '#type' => 'email',
      '#title' => t('Email ID:'),
      '#required' => TRUE,
    );
    $form['mobile'] = array (
      '#type' => 'tel',
      '#title' => t('Mobile no'),
    );
    $form['dob'] = array (
      '#type' => 'date',
      '#title' => t('DOB'),
      '#required' => TRUE,
    );
    $form['gender'] = array (
      '#type' => 'select',
      '#title' => ('Gender'),
      '#options' => array(
        'Female' => t('Female'),
        'male' => t('Male'),
      ),
    );
    $form['age'] = array (
      '#type' => 'radios',
      '#title' => ('Are you above 18 years old?'),
      '#options' => array(
        'Yes' =>t('Yes'),
        'No' =>t('No')
      ),
    );
    /*$form['candidate_copy'] = array(
      '#type' => 'checkbox',
      '#title' => t('Send me a copy of the application.'),
    );*/
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Register'),
      '#button_type' => 'primary',
    );
    return $form;
  }
  /**
   * {@inheritdoc}
   */
    public function validateForm(array &$form, FormStateInterface $form_state) {
      if (strlen($form_state->getValue('mobile')) < 10) {
        $form_state->setErrorByName('mobile', $this->t('Mobile number is too short.'));
      }
    }

  public function submitForm(array &$form, FormStateInterface $form_state) {
  $conn = Database::getConnection();
  $conn->insert('user')->fields(
    array(
      'name' => $form_state->getValue('name'),
      'email' => $form_state->getValue('mail'),
      'mobile' => $form_state->getValue('mobile'),
      'dob' => $form_state->getValue('dob'),
      'gender' => $form_state->getValue('gender'),
      'age' => $form_state->getValue('age'),
    )
  )
  ->execute();
   drupal_set_message(t('Form Submitted Successfully'));
 
 }


}