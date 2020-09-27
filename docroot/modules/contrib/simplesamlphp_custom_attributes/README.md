CONTENTS OF THIS FILE
---------------------
   
 * Introduction
 * Requirements
 * Recommended modules
 * Installation
 * Configuration
 * Maintainers
 
INTRODUCTION
------------

This module copies [rael9's sandbox: SAML Auth Custom Attribute Mapping][1]
to use for [simpleSAMLphp Authentication][2].

Once attributes are mapped the module calls the
``hook_simplesamlphp_auth_user_attributes`` to save the values to a user's
profile on login.

[1]: https://www.drupal.org/sandbox/rael9/samlauth_custom_attributes
[2]: https://www.drupal.org/project/simplesamlphp_auth
 
REQUIREMENTS
------------
 
This module requires the following modules:
 
 * simpleSAMLphp Authentication (https://drupal.org/project/simplesamlphp_auth)
  
RECOMMENDED MODULES
-------------------

 * Markdown filter (https://www.drupal.org/project/markdown):
   When enabled, display of the project's README.md help will be rendered
   with markdown.
  
INSTALLATION
------------
 
 * Install as you would normally install a contributed Drupal module. Visit:
   https://www.drupal.org/documentation/install/modules-themes/modules-8
   for further information.
   
CONFIGURATION
-------------

Add mappings in Administration » People » SimpleSAMLphp Auth Attribute Mapping.

MAINTAINERS
-----------

Current maintainers:
 * Daniel Mundra (dmundra) - https://drupal.org/user/866436

This project has been sponsored by:
 * CASIT Web Services - https://casitwebservices.uoregon.edu/
