<?php

namespace Drupal\srg_alexa\EventSubscriber;

use Drupal\alexa\AlexaEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\Core\Controller\ControllerBase;

/**
 * An event subscriber for Alexa request events.
 */
class RequestSubscriber implements EventSubscriberInterface {

  /**
   * Gets the event.
   */
  public static function getSubscribedEvents() {

    $events['alexaevent.request'][] = array('onDebug', 0);
    return $events;
  }

  /**
   * Called upon a request event.
   *
   * @param \Drupal\alexa\AlexaEvent $event
   *   The event object.
   */
  public function onDebug(AlexaEvent $event) {
    \Drupal::logger('srg_alexa')->notice('this is the message');
    $request = $event->getRequest();
    $response = $event->getResponse();
    switch ($request->intentName) {
      case 'AMAZON.HelpIntent':
        $response->respond('You can ask anything and I will respond with "Hello Drupal"');
        break;
      case 'HelloDrupal':
        $city = $request->data['request']['intent']['slots']['City']['value'];
        \Drupal::logger('srg_alexa')->notice('City: '.$city);
        $response->respond('Welcome to '.$city);
        break;
      case 'GetDrupal':
        $city = $request->data['request']['intent']['slots']['City']['value'];
        $date = $request->data['request']['intent']['slots']['Date']['value'];
        $number = $request->data['request']['intent']['slots']['Number']['value'];
        $response->respond('Welcome to '.$city.' Your number is:'.$number.' and the date is '.$date);
        break;
      default:
        $response->respond('The is the default'. $request->intentName.':');
        break;
    }
  }
}

/*
$city = $request->data['request']['intent']['slots']['City']['value'];
    \Drupal::logger('srg_alexa')->notice('Data: '.$request->rawData);
    \Drupal::logger('srg_alexa')->notice('intent: '.$request->intentName);
    \Drupal::logger('srg_alexa')->notice('City: '.$city);
    \Drupal::logger('srg_alexa')->notice('Data: '.$request->rawData);
    \Drupal::logger('srg_alexa')->notice('intent: '.$request->intentName);
    \Drupal::logger('srg_alexa')->notice('City: '.$city);
 */
