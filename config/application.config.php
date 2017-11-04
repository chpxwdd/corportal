<?php

return array(
// This should be an array of module namespaces used in the application.
  'modules' => array(
    'ZendDeveloperTools',
    'DoctrineModule',
    'DoctrineORMModule',
    'Zf2DoctrineAutocomplete',
    'Core',
    'Dashboard',
    'Contact',
    'Geo',
//	'Scores',
    'Currency',
    'Corporate',
    'Staff',
//	'Workflow',
//	'Worktime',
//	'Lunch',
  ),
  'module_listener_options' => array(
    'module_paths' => array(
      './module',
      './vendor',
    ),
    'config_glob_paths' => array(
      'config/autoload/{,*.}{global,local}.php',
    ),
    'check_dependencies' => true,
  ),
);
