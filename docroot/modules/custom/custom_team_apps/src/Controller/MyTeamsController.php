<?php

namespace Drupal\custom_team_apps\Controller;

use Apigee\Edge\Exception\ApiException;
use Drupal\Component\Utility\Unicode;
use Drupal\Core\Controller\ControllerBase;
use Apigee\Edge\Api\Management\Controller\CompanyController;
use Apigee\Edge\Api\Management\Controller\CompanyAppController;
use Apigee\Edge\Api\Management\Controller\CompanyMembersController;
use http\Exception\RuntimeException;

/**
 * Displays all the available team apps to the user.
 */
class MyTeamsController extends ControllerBase {

  /**
   * Implements function to retrieve team apps of user.
   */
  public function content() {
    $account = \Drupal::currentUser();
    $current_user_email = $account->getEmail();
    $auth = \Drupal::service('apigee_edge.sdk_connector');
    $org_name = $auth->getOrganization();
    $client = $auth->getClient();
    $companies_inorg = new CompanyController($org_name, $client);
    $comp_list = $companies_inorg->getEntityIds();
    $comp_items = [];

    /* Get the companies specific to logged in user */

    foreach ($comp_list as $comp) {
      $developers_incomp = new CompanyMembersController($comp, $org_name, $client);
      $dev_comp = $developers_incomp->getMembers();
      $dev_array = $dev_comp->getMembers();
      $dev_array_list = array_keys($dev_array);
      if (in_array($current_user_email, $dev_array_list)) {
        $comp_items[] = $comp;
      }
    }

    /* Get the team apps specific to logged in user */
    $comp_final = [];
    $i = 0;
    foreach ($comp_items as $mycomp) {
      $company_app_controller = new CompanyAppController($org_name, $mycomp, $client);
      /* Get call to retrieve team display name */

      $company_mydetail = $client->get("https://api.enterprise.apigee.com/v1/organizations/$org_name/companies/$mycomp");
      $company_mydetail_results = json_decode($company_mydetail->getBody());
      $company_display_name = $company_mydetail_results->displayName;

      /* Get team display name, team app name and status */
      $all_apps = $company_app_controller->getEntities();
      ksort($all_apps);
      foreach ($all_apps as $key => $value) {
        $comp_final[$i][$key] = [
          'team_name' => $value->getCompanyName(),
          'app_name' => $value->getDisplayName(),
          'display_name' => $company_display_name,
          'status' => Unicode::ucfirst($value->getStatus()),
        ];
        $i++;
      }
    }

    /* Return result */
    if(count($comp_final) == 0){
      $result = '<p>You do not have any Team Apps<p>';
    }
    else {
      $result = '<table class="">';
      $result .= '<thead>
    <th>App Name</th>
    <th>Team Name</th>
    <th>App Status</th>
  </thead>';
      $j=0;
      foreach ($comp_final as $j => $comp) {
          foreach ($comp as $k => $v) {
              if(isset($v)) {
                  $url = '/teams/' . $v['team_name'] . '/apps?app=' . $v['app_name'];
                  $result .= '<tr><td><a href="' . $url . '">' . $v['app_name'] . '</a></td><td><a href="' . $url . '">' . $v['display_name'] . '</a></td><td><span>' . $v['status'] . '</span></td></tr>';
              }
          }
          $j++;
      }
      $result .= '</table>';
    }
    $build = [
      '#markup' => $result,
    ];
    return $build;
  }
}
