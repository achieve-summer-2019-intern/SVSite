<?php

namespace Drupal\intern\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class FirstForm extends FormBase {

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
        $form['user_name'] = [
            '#type' => 'textfield',
            '#title' => 'User Name',
            '#description' => 'Please input a username',
            '#required' => FALSE,
        ];
        $form['email'] = [
            '#type' => 'email',
            '#title' => 'Email',
            '#description' => 'Please input your email',
            '#required' => TRUE,
        ];
        $form['number'] = [
            '#type' => 'number',
            '#title' => 'Phone Number',
            '#description' => 'Please input your number',
            '#required' => TRUE,
        ];
        $form['password_confirm'] = [
            '#type' => 'password_confirm',
            '#title' => 'Confirm Password',
            '#description' => 'Please confirm your password',
            '#required' => TRUE,
        ];
        $form['actions'] = [
            '#type' => 'actions',
        ];

        $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => 'submit',
        ];
        return $form;
    }

    public function getFormId() {
        return 'intern_first_form';
    }

    public function validateForm(array &$form, FormStateInterface $form_state) {
        $title = $form_state->getValue('title');
        if (empty($title)) {
            $form_state->setErrorByName('title', 'Please provide a title');
        }
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        $title = $form_state->getValue('title');
        drupal_set_message("You submitted a form successfully");
    }
}