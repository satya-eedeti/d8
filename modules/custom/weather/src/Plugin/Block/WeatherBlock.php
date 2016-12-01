<?php
namespace Drupal\weather\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

use Drupal\weather\WeatherService;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;

/**
 * Provides a 'WeatherBlock' block.
 *
 * @Block(
 *   id = "weather_block",
 *   admin_label = @Translation("Weather Block"),
 *   category = @Translation("Block"),
 * )
 */
class WeatherBlock extends BlockBase implements ContainerFactoryPluginInterface{
  //$WeatherService = new WeatherService();
  private $weatherService;

  public function __construct(array $configuration, $plugin_id, $plugin_definition, WeatherService $weatherService) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->weatherService = $weatherService;
  }

  public function blockForm($form, FormStateInterface $form_state) {
    $form['cityname'] = array(
    	'#type' => 'textfield',
    	'#title' => 'City Name',
      '#default_value' => $this->configuration['cityname'],
    );
    return $form;
  }

  public function build() {
    $weather_info = $this->weatherService->getWeatherInfo($this->configuration['cityname']);
    return [
      '#theme' => 'weather_display',
      '#description' => 'Weather forecast',
      '#weather_info' => $weather_info,
      '#city' => $this->configuration['cityname'],
      '#attached' => ['library' => ['weather/weather_display']],
      '#attributes' => [],
    ];
  }

  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['cityname'] = $form_state->getValue('cityname');
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('weather.info')
    );
  }
}
