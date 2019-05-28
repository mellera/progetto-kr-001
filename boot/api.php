<?php

require_once __DIR__ . '/init.php';

use Symfony\Component\Routing\Loader\PhpFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpFoundation\Request;

\Sys\Context::setConfig(new \Config\Api());

// Loader per i file delle route
$loader = new PhpFileLoader(new FileLocator(array(ROUTES_PATH)));

// Carico le route dal file route/api.php
$routes = $loader->load('api.php');

// Gestore degli eventi che verrano scatenati dal kernel
$dispatcher = new EventDispatcher();

// Recupero classe che gestirà la richiesta con tutte le informazioni necessarie
$dispatcher->addListener(KernelEvents::REQUEST, array(new \Sys\Listener\Router(new \Sys\Router\RequestMatcher($routes)), 'onKernelRequest'), -10);

// Logga la chiamata
$dispatcher->addListener(KernelEvents::REQUEST, array(new \Sys\Listener\Api\RequestLogger(), 'onKernelRequest'), -20);

// Gestione delle eccezioni personalizzata
$dispatcher->addListener(KernelEvents::EXCEPTION, array(new \Sys\Listener\Api\Exception(), 'onKernelException'));

// Kernel per la gestione della chiamata
$kernel = new HttpKernel($dispatcher, new ControllerResolver(\Sys\Context::logger()), new RequestStack(), new ArgumentResolver());

// Crao oggetto request da parametri della chiamata in ingresso
$request = Request::createFromGlobals();

// Gestione chiamata
$response = $kernel->handle($request);

// Invio del risultato
$response->send();

// Terminiamo il tutto
$kernel->terminate($request, $response);
