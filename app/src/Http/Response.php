<?php

namespace App\src\Http;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use League\Fractal\Manager as FractalManager;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class Response
{
    public function __construct(private readonly FractalManager $fractalManager)
    {
    }

    public function withSuccess($message, array $meta = [], array $headers = []): JsonResponse
    {
        return $this->withArray(
            [
                'message' => $message,
            ],
            HttpResponse::HTTP_OK
        );
    }

    public function withArray(array $array, int $statusCode = HttpResponse::HTTP_CREATED): JsonResponse
    {
        return response()->json($array, $statusCode);
    }

    public function withItem(
        Model $data,
        JsonResource $transformer,
        int $responseCode = HttpResponse::HTTP_CREATED
    ): JsonResponse {
        $resource = new $transformer($data);

        return $resource->response()->setStatusCode($responseCode);
    }

    /**
     * @param Collection $data
     * @param ResourceCollection $transformer
     * @param int $responseCode
     *
     * @return JsonResponse
     */
    public function withItems(
        Collection $data,
        ResourceCollection $transformer,
        int $responseCode = HttpResponse::HTTP_OK
    ): JsonResponse {
        $resource = new $transformer($data);

        return $resource->response()->setStatusCode($responseCode);
    }

    public function withError(string $message, int $errorCode = HttpResponse::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        return $this->withArray(
            [
                'message' => $message,
            ],
            $errorCode
        );
    }

    public function notFound(string $message): JsonResponse
    {
        return $this->withArray(
            [
                'message' => $message,
            ],
            HttpResponse::HTTP_NOT_FOUND
        );
    }

    public function withValidationError(array $validationErrors): JsonResponse
    {
        return new JsonResponse(
            [
                'message' => 'invalid data',
                'fields'  => $validationErrors,
            ], HttpResponse::HTTP_UNPROCESSABLE_ENTITY
        );
    }

    public function parseIncludes(): void
    {
        $this->fractalManager
            ->parseIncludes(request('include') ?? []);
    }
}
