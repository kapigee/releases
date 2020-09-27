<?php

/**
 * @file
 * Theme and preprocess functions for Apigee Edge Entities.
 */

use Drupal\apigee_edge\Entity\AppInterface;
use Drupal\apigee_edge_teams\Entity\TeamMemberRoleInterface;
use Drupal\user\UserInterface;

/**
 * Implements template_preprocess_apigee_entity().
 */
function ucla_apigee_portal_preprocess_apigee_entity(&$variables) {
  /** @var \Drupal\Core\Entity\EntityInterface $entity */
  $entity = $variables['entity'];
  // Use a common preprocess for all apps.
  if ($entity instanceof AppInterface) {
    ucla_apigee_portal_preprocess_apigee_entity__app($variables);
    return;
  }

  // Entity specific preprocess functions.
  $function = __FUNCTION__ . '__' . $entity->getEntityTypeId();
  if (function_exists($function)) {
    $function($variables);
  }
}

/**
 * Implements template_preprocess_apigee_entity__app().
 */
function ucla_apigee_portal_preprocess_apigee_entity__app(array &$variables) {
  /** @var \Drupal\apigee_edge\Entity\AppInterface $app */
  $app = $variables['entity'];

  // Preprocess the app credentials so that we can render individual fields.
  if ($credentials = $app->getCredentials()) {
    $credential_variables['elements']['#credential'] = reset($credentials);
    $credential_variables['elements']['#app'] = $app;

    template_preprocess_app_credential($credential_variables);

    // Render the consumerKey and the consumerSecret as secret fields.
    foreach (['consumerKey', 'consumerSecret'] as $field_name) {
      $credential_variables['primary_wrapper'][$field_name]['value'] = [
        '#type' => 'secret',
        '#value' => $credential_variables['primary_wrapper'][$field_name]['value']['#value'],
      ];
    }

    $variables['content']['credentials'] = $credential_variables;
  }

  // Add local tasks on the app canonical route as additional tabs.
  $variables['additional_tabs'] = [];
  $attributes = new \Drupal\Core\Template\Attribute([]);
  switch ($app->getEntityTypeId()) {
    case 'team_app':
      $canonical_route_name = 'entity.team_app.canonical';
      $route_parameters = [
        'team' => $app->getAppOwner(),
        'app' => $app->getName(),
      ];
      $attributes->setAttribute('data-team', $app->getAppOwner());
      $attributes->setAttribute('data-app', $app->getName());
      break;

    default:
      $canonical_route_name = "entity.{$app->getEntityTypeId()}.canonical_by_" . str_replace('_app', '', $app->getEntityTypeId());
      $route_parameters = [
        'user' => $app->getOwnerId(),
        'app' => $app->getName(),
      ];
      $attributes->setAttribute('data-app', $app->getName());
      break;
  }
  $attributes->setAttribute('data-app-container-index', 0);
  $variables['app_attributes'] = $attributes;

  if ($tasks = Drupal::service('plugin.manager.menu.local_task')->getLocalTasks($canonical_route_name)) {
    foreach ($tasks['tabs'] as $tab) {
      $link = $tab['#link'];

      /** @var \Drupal\Core\Url $url */
      $url = $link['url'];
      if ($url->getRouteName() !== $canonical_route_name) {
        $url->setRouteParameters($route_parameters);

        $variables['additional_tabs'][] = [
          'title' => $link['title'],
          'url' => $url,
        ];
      }
    }
  }
}

/**
 * Implements template_preprocess_apigee_entity__apidoc().
 */
function ucla_apigee_portal_preprocess_apigee_entity__apidoc(&$variables) {
  // Add the view_mode to the template.
  $variables['view_mode'] = $variables['elements']['#view_mode'];

  // Add the entity to the template.
  /** @var \Drupal\Core\Entity\EntityInterface $entity */
  $variables['entity'] = $entity = $variables['elements']["#apidoc"];

  // Add a link to the entity.
  if ($variables['view_mode'] !== 'full') {
    $variables['content']['field_link'] = $entity->toLink(t('View Documentation'))
      ->toRenderable();
  }
}

/**
 * Implements template_preprocess_apigee_entity__team().
 */
function ucla_apigee_portal_preprocess_apigee_entity__team(&$variables) {

  $entity = $variables['entity'];
  $team_name = $entity->getName();
  $team_membership_manager = \Drupal::service('apigee_edge_teams.team_membership_manager');
  $members = $team_membership_manager->getMembers($team_name);

  $team_member_role_storage = \Drupal::entityTypeManager()->getStorage('team_member_role');
  $team_member_roles_by_mail = array_reduce($team_member_role_storage->loadByTeam($entity), function ($carry, TeamMemberRoleInterface $developer_role) {
    $carry[$developer_role->getDeveloper()->getEmail()] = $developer_role;

    return $carry;
  }, []);

  $team_owners = [];
  foreach ($team_member_roles_by_mail as $mail => $members) {
    foreach ($members->getTeamRoles() as $teamRole) {
      if($teamRole->id() == 'admin') {
        $user = user_load_by_mail($mail);
        $team_owners[$mail] = [
          'role' => $teamRole->label(),
          'first_name' => $user->get('first_name')->getValue()[0]['value'],
          'last_name' => $user->get('last_name')->getValue()[0]['value'],
        ];
      }
    }
  }

  $variables['team_owners'] = $team_owners;
}
