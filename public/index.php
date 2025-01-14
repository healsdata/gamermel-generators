<?php

declare(strict_types=1);

chdir(dirname(__DIR__));

use DI\Bridge\Slim\Bridge as SlimBridge;
use Healsdata\GamermelGenerators\Controller\CategoryController;
use Healsdata\GamermelGenerators\Controller\GeneratorController;
use Healsdata\GamermelGenerators\Controller\MonsterController;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Zeuxisoo\Whoops\Slim\WhoopsMiddleware;

require 'vendor/autoload.php';

$container = new DI\Container(require('config/di.php'));

$app = SlimBridge::create($container);

$app->add(new WhoopsMiddleware());

$twig = Twig::create('templates', ['cache' => false]);
$app->add(TwigMiddleware::create($app, $twig));

$app->get('/', [GeneratorController::class, 'list'])->setName('generator');
$app->get('/generator/{generator}', [CategoryController::class, 'list'])->setName('category');
$app->get('/generator/{generator}/{category}', [MonsterController::class, 'random'])->setName('monster');

$app->run();