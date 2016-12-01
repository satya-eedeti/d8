<?php

namespace Drupal\weather;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Config\ConfigFactory;
use GuzzleHttp\Client;
use Drupal\Component\Serialization\Json;
/**
 * Class WeatherService.
 *
 * @package Drupal\weather
 */
class WeatherService {
  private $configFactory;
  private $client;
  /**
   * Constructor.
   */
  public function __construct(ConfigFactory $configFactory, Client $client) {
  	$this->configFactory = $configFactory;
  	$this->client = $client;
  }

  public function getWeatherInfo($cityname) {//echo $cityname;exit;
  	$app_id = $this->configFactory->get('mycustom.adminformbase')->get('app_id');//echo $app_id;exit;
  	$args = array('http://api.openweathermap.org/data/2.5/weather?q=' . $cityname . '&appid=' . $app_id);
	$res = $this->client->__call('GET', $args);
	$wdata_json = $res->getBody()->getContents();
	$wdata_array = Json::decode($wdata_json);
	return $wdata_array;
  }
  public static function create(ContainerInterface $container) {
	return new static(
	  $container->get('config.factory'),
	  $container->get('http_client')
	);
  }

}
