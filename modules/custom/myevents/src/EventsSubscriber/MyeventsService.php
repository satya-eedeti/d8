<?php

namespace Drupal\myevents\EventsSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use  Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use  Symfony\Component\HttpKernel\KernelEvents;
/**
 * Class MyeventsService.
 *
 * @package Drupal\myevents
 */
class MyeventsService implements EventSubscriberInterface {
  /**
   * Constructor.
   */
  public function __construct() {

  }

  public static function getSubscribedEvents() {
  	$events[KernelEvents::RESPONSE][] = array('myCustHeader');
  	return $events;
  }

  public function myCustHeader(FilterResponseEvent $events) {
  	$response = $events->getResponse();
  	$response->headers->add(['Access-Control-Allow-Origin' => '*']);
  }

}
