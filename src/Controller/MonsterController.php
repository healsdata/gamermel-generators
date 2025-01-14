<?php

namespace Healsdata\GamermelGenerators\Controller;

use Google\Service\Exception as GoogleServiceException;
use Healsdata\GamermelGenerators\Repository\CategoryRepository;
use Healsdata\GamermelGenerators\Repository\GeneratorRepository;
use Healsdata\GamermelGenerators\Repository\MonsterRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;
use Twig\Error\Error as TwigError;


class MonsterController
{
    public function __construct(
        private readonly GeneratorRepository $generatorRepository,
        private readonly CategoryRepository  $categoryRepository,
        private readonly MonsterRepository $monsterRepository,
    )
    {
    }

    /**
     * @throws TwigError
     * @throws GoogleServiceException
     */
    public function random(Request $request, Response $response, string $generator, string $category): Response
    {
        $generatorDto = $this->generatorRepository->getBySlug($generator);

        if (!$generatorDto) {
            throw new HttpNotFoundException($request, "{$generator} is not a valid generator");
        }

        $categoryDto = $this->categoryRepository->getBySlug($generatorDto, $category);
        if (!$categoryDto) {
            throw new HttpNotFoundException($request, "{$category} is not a valid category");
        }

        return Twig::fromRequest($request)->render(
            $response,
            'monster.html.twig',
            [
                'generator' => $generatorDto,
                'category' => $categoryDto,
                'monster' => $this->monsterRepository->random(),
            ]
        );
    }
}