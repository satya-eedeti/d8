<?php

namespace Drupal\mycustom\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\mycustom\FormManager;

use Drupal\weather\WeatherService;

class SimpleForm extends FormBase {
	private $formManager;
	private $weatherService;
	public function __construct(FormManager $formManager, WeatherService $weatherService) {
		$this->formManager = $formManager;
		$this->weatherService = $weatherService;
	}

	public function getFormId() {
		return "custom_simple_form";
	}
	public function buildForm(array $form, FormStateInterface $form_state) {
		//$form = array();
		$this->weatherService->getWeatherInfo();
		$form['firstname'] = array(
			'#type' => 'textfield',
			'#title' => 'Firstname',
		);
		$form['lastname'] = array(
			'#type' => 'textfield',
			'#title' => 'Lastname',
		);
		$form['submit'] = array(
			'#type' => 'submit',
			'#value' => 'Submit',
		);
		return $form;
	}
	public function validateForm(array &$form, FormStateInterface $form_state) {
		if ($form_state->getValue('firstname') == "") {
			$form_state->setErrorByName('firstname', 'Firstname can\'t be empty.');
		}
		if ($form_state->getValue('lastname') == "") {
			$form_state->setErrorByName('lastname', 'Lastname can\'t be empty.');
		}
		return TRUE;
	}
	public function submitForm(array &$form, FormStateInterface $form_state) {
		$this->formManager->addData($form_state->getValue('firstname'), $form_state->getValue('lastname'));
		drupal_set_message("Form data was submitted successfully." . print_r($this->formManager->fetchData(), TRUE));
	}
	public static function create(ContainerInterface $container) {
		return new static(
			$container->get('mycustom.form_manager'),
			$container->get('weather.info')
		);
	}

}

