<?php

$routes = new \Sys\Router\RouteCollection();

/*
  $routes->addSimpleRoute('POST', '/api/users', \Action\Api\User\Register::class);
  $routes->addSimpleRoute('POST', '/api/users/login', \Action\Api\User\Login::class);
  $routes->addProtectedRoute('POST', '/api/personalWallets', \Action\Api\Personal\Wallet\Create::class, PERMISSION_CREATE_PERSONAL_WALLET);
  $routes->addProtectedRoute('GET', '/api/personalWallets/{id}', \Action\Api\Personal\Wallet\GetOne::class, PERMISSION_READ_PERSONAL_WALLETS);
  $routes->addProtectedRoute('PUT', '/api/personalWallets/{id}', \Action\Api\Personal\Wallet\Update::class, PERMISSION_UPDATE_PERSONAL_WALLET);
  $routes->addProtectedRoute('DELETE', '/api/personalWallets/{id}', \Action\Api\Personal\Wallet\Delete::class, PERMISSION_DELETE_PERSONAL_WALLET);
 */

return $routes;
