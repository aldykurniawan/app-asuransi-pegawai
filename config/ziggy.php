<?php

return [
  'groups' => [
    'guest' => [
      '_debugbar.*',
      'fe.*',
      'login',
      'login.*',
      'password.*',
      'register',
      'register.*',
    ],
    'auth' => ['*'],
  ],
];
