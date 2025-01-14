<?php

namespace Healsdata\GamermelGenerators\Controller;

use Google\Service\Exception as GoogleServiceException;
use Healsdata\GamermelGenerators\Repository\CategoryRepository;
use Healsdata\GamermelGenerators\Repository\GeneratorRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;
use Twig\Error\Error as TwigError;

class CategoryController
{
    public function __construct(
        private readonly GeneratorRepository $generatorRepository,
        private readonly CategoryRepository  $categoryRepository
    )
    {
    }

    /**
     * @throws TwigError
     * @throws GoogleServiceException
     */
    public function list(Request $request, Response $response, string $generator): Response
    {
        $generatorDto = $this->generatorRepository->getBySlug($generator);

        if (!$generatorDto) {
            throw new HttpNotFoundException($request, "{$generator} is not a valid generator");
        }

        $categories = $this->categoryRepository->getByGenerator($generatorDto);

        return Twig::fromRequest($request)->render(
            $response,
            'category.html.twig',
            [
                'generator' => $generatorDto,
                'categories' => $categories,
            ]
        );
    }
}