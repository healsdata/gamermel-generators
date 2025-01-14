<?php

namespace Healsdata\GamermelGenerators\Controller;

use Healsdata\GamermelGenerators\Repository\GeneratorRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class GeneratorController
{
    public function __construct(
        private readonly GeneratorRepository $generatorRepository
    )
    {
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function list(Request $request, Response $response): Response
    {
        return Twig::fromRequest($request)->render(
            $response,
            'generator.html.twig',
            [
                'generators' => $this->generatorRepository->list(),
            ]
        );
    }

}