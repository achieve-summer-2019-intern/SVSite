<?php

namespace Drupal\intern\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class FeedbackForm extends FormBase {

    public function buildForm(array $form, FormStateInterface $form_state) {
        $form['first_name'] = [
            '#type' => 'textfield',
            '#title' => 'First Name',
            '#description' => 'Please input your firstname',
            '#required' => TRUE,
        ];
        $form['last_name'] = [
            '#type' => 'textfield',
            '#title' => 'Last Name',
            '#description' => 'Please input your lastname',
            '#required' => TRUE,
        ];
        $form['email'] = [
            '#type' => 'email',
            '#title' => 'Email',
            '#description' => 'Please input your email',
            '#required' => TRUE,
        ];
        $form['feedback'] = [
            '#type' => 'textarea',
            '#title' => 'Feedback',
            '#description' => 'Please input your feedback',
            '#required' => TRUE,
        ];
        $form['actions'] = [
            '#type' => 'actions',
        ];
        $form['actions']['submit'] = array(
            '#type' => 'submit',
            '#value' => $this
              ->t('Submit'),
        );
        return $form;
    }

    public function getFormId() {
        return 'intern_first_form';
    }

    public function validateForm(array &$form, FormStateInterface $form_state) {
        $first_name = $form_state->getValue('first_name');
        if (empty($first_name)) {
            $form_state->setErrorByName('title', 'Please provide a title');
        }
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        // creates a feedback form content node
        createFeedbackNode($form_state);
    }
}