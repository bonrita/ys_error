<?php
/**
 * Created by PhpStorm.
 * User: bona
 * Date: 17-6-16
 * Time: 23:55
 */

namespace Drupal\ys_error_handler\EventSubscriber;


use Drupal\Core\Url;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ErrorHandler implements EventSubscriberInterface{

  /**
   * @inheritDoc
   */
  public static function getSubscribedEvents() {
    // Run before exception.logger.
    $events[KernelEvents::EXCEPTION][] = ['onException', 51];
    return $events;
  }

  /**
   * Catches a rest api exception and build a response from it.
   *
   * @param \Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent $event
   *   The event to process.
   */
  public function onException(GetResponseForExceptionEvent $event) {
    $exception = $event->getException();
    $request = $event->getRequest();

    //@todo Get value for the message from the database.
    $uri_parts = 'internal:/admin/content';
    $url = Url::fromUri($uri_parts);
    $parts = $url->getRouteParameters();

    if ($exception instanceof BrokenPostRequestException && $request->query->has(FormBuilderInterface::AJAX_FORM_REQUEST)) {
      
    }
  }

}
