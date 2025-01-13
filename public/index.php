<?php

declare(strict_types=1);

chdir(dirname(__DIR__));

use Healsdata\GamermelGenerators\Repository\CategoryRepository;
use Healsdata\GamermelGenerators\Repository\GeneratorRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Zeuxisoo\Whoops\Slim\WhoopsMiddleware;

require 'vendor/autoload.php';

$app = AppFactory::create();

$app->add(new WhoopsMiddleware());

$twig = Twig::create('templates', ['cache' => false]);
$app->add(TwigMiddleware::create($app, $twig));

$generatorRepository = new GeneratorRepository();
$categoryRepository = new CategoryRepository();

$app->get('/', function (Request $request, Response $response) use ($generatorRepository) {
    return Twig::fromRequest($request)->render(
        $response,
        'index.html.twig',
        [
            'generators' => $generatorRepository->list(),
        ]
    );
});

$app->get('/generator/{generator}', function (Request $request, Response $response, array $args) use ($generatorRepository, $categoryRepository) {
    $generatorSlug = $args['generator'] ?? 'none';
    $generator = $generatorRepository->getBySlug($generatorSlug);

    if (!$generator) {
        throw new HttpNotFoundException($request, "{$generatorSlug} is not a valid generator");
    }

    $categories = $categoryRepository->getByGenerator($generatorSlug);

    return Twig::fromRequest($request)->render(
        $response,
        'generator.html.twig',
        [
            'generator' => $generator,
            'categories' => $categories,
        ]
    );
})->setName('generator');

$app->get('/generator/{generator}/{category}', function (Request $request, Response $response, array $args) use ($generatorRepository, $categoryRepository) {
    $generatorSlug = $args['generator'] ?? 'none';
    $generator = $generatorRepository->getBySlug($generatorSlug);

    if (!$generator) {
        throw new HttpNotFoundException($request, "{$generatorSlug} is not a valid generator");
    }

    $categorySlug = $args['category'] ?? 'none';
    $category = $categoryRepository->getBySlug($generator['slug'], $categorySlug);
    if (!$category) {
        throw new HttpNotFoundException($request, "{$categorySlug} is not a valid category");
    }

    return Twig::fromRequest($request)->render(
        $response,
        'monster.html.twig',
        [
            'generator' => $generator,
            'category' => $category
        ]
    );
})->setName('category');


$app->run();