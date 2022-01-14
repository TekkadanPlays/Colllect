<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Model\Colllection;
use App\Service\ColllectionService;
use Nelmio\ApiDocBundle\Annotation as ApiDoc;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ColllectionController extends AbstractController
{
    public function __construct(
        private readonly ColllectionService $colllectionService
    ) {
    }

    /**
     * List all Colllections.
     *
     * @ApiDoc\Areas({"default"})
     *
     * @SWG\Tag(name="Colllections")
     * @SWG\Response(
     *     response=200,
     *     description="Returned when Colllections are listed",
     *     @SWG\Schema(ref="#/definitions/ColllectionList")
     * )
     */
    #[Route(path: '/', name: 'list', methods: ['GET'])]
    public function listColllections(): JsonResponse
    {
        $colllections = $this->colllectionService->list();

        return $this->json($colllections);
    }

    /**
     * Create a Colllection.
     *
     * @ApiDoc\Areas({"default"})
     *
     * @SWG\Tag(name="Colllections")
     * @ApiDoc\Operation(
     *     consumes={"application/x-www-form-urlencoded"}
     * )
     *
     * @SWG\Parameter(
     *     name="name",
     *     in="formData",
     *     description="Name of the colllection",
     *     required=false,
     *     type="string"
     * )
     *
     * @SWG\Response(
     *     response=201,
     *     description="Returned when Colllection was created",
     *     @SWG\Schema(ref=@ApiDoc\Model(type=Colllection::class))
     * )
     * @SWG\Response(
     *     response=400,
     *     description="Returned when form is invalid"
     * )
     */
    #[Route(path: '/', name: 'create', methods: ['POST'])]
    public function createColllection(Request $request): JsonResponse
    {
        $response = $this->colllectionService->create($request);
        if ($response instanceof FormInterface) {
            return $this->json($response, Response::HTTP_BAD_REQUEST);
        }

        return $this->json($response, Response::HTTP_CREATED);
    }

    /**
     * Get a Colllection.
     *
     * @ApiDoc\Areas({"default"})
     *
     * @SWG\Tag(name="Colllections")
     *
     * @SWG\Parameter(
     *     name="encodedColllectionPath",
     *     in="path",
     *     description="Encoded colllection path",
     *     type="string"
     * )
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returned when Colllection is found",
     *     @SWG\Schema(ref=@ApiDoc\Model(type=Colllection::class))
     * )
     * @SWG\Response(
     *     response=404,
     *     description="Returned when Colllection file is not found"
     * )
     */
    #[Route(path: '/{encodedColllectionPath}', name: 'get', methods: ['GET'])]
    public function getColllection(string $encodedColllectionPath): JsonResponse
    {
        $colllection = $this->colllectionService->get($encodedColllectionPath);

        return $this->json($colllection);
    }

    /**
     * Update a Colllection.
     *
     * @ApiDoc\Areas({"default"})
     *
     * @SWG\Tag(name="Colllections")
     * @ApiDoc\Operation(
     *     consumes={"application/x-www-form-urlencoded"}
     * )
     *
     * @SWG\Parameter(
     *     name="name",
     *     in="formData",
     *     description="Name of the colllection",
     *     required=false,
     *     type="string"
     * )
     *
     * @SWG\Response(
     *     response=200,
     *     description="Returned when Colllection was updated",
     *     @SWG\Schema(ref=@ApiDoc\Model(type=Colllection::class))
     * )
     * @SWG\Response(
     *     response=400,
     *     description="Returned when form is invalid"
     * )
     */
    #[Route(path: '/{encodedColllectionPath}', name: 'update', methods: ['PUT'])]
    public function updateColllection(Request $request, string $encodedColllectionPath): JsonResponse
    {
        $response = $this->colllectionService->update($encodedColllectionPath, $request);

        return $this->json($response);
    }

    /**
     * Delete a Colllection.
     *
     * @ApiDoc\Areas({"default"})
     *
     * @SWG\Tag(name="Colllections")
     *
     * @SWG\Parameter(
     *     name="encodedColllectionPath",
     *     in="path",
     *     description="Encoded colllection path",
     *     type="string"
     * )
     * @SWG\Response(
     *     response=204,
     *     description="Returned when Colllection file is deleted"
     * )
     */
    #[Route(path: '/{encodedColllectionPath}', name: 'delete', methods: ['DELETE'])]
    public function deleteColllection(string $encodedColllectionPath): Response
    {
        $this->colllectionService->delete($encodedColllectionPath);

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
