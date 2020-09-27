<?php

/**
 * @file
 * Contains \Drupal\custom_team_apps\EventSubscriber\BootSubscriber.
 */

namespace Drupal\custom_team_apps\EventSubscriber;

use Drupal\Core\Cache\Cache;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\user\Entity\User;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;


class BootSubscriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    return [KernelEvents::REQUEST => ['onEvent', 31]];
  }

  public function onEvent(\Symfony\Component\HttpKernel\Event\GetResponseEvent $event) {
    \Drupal::moduleHandler()->addModule('apigee_edge_teams', 'modules/contrib/apigee_edge/modules/apigee_edge_teams');
    \Drupal::moduleHandler()->load('apigee_edge_teams');
    $path = \Drupal::request()->getpathInfo();
    $path_args = explode('/', $path);
    if ($path_args[1] == 'teams') {
      //\Drupal::service('cache.render')->invalidateAll();
      Cache::invalidateTags(['team']);
    }
  }
}
