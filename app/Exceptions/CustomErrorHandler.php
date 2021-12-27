<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

class CustomErrorHandler extends Handler
{
    private array $mapExceptionToHttpCode = [
        \InvalidArgumentException::class => 422,
        \DomainException::class          => 400,
    ];

    public function render($request, Throwable $e): Response|JsonResponse
    {
        $request->headers->set('Accept', 'application/json');

        return parent::render($request, $e);
    }

    public function prepareJsonResponse($request, Throwable $e): JsonResponse
    {
        $exc = $this->exceptionToResponse($e);

        $response = ['message' => $exc['message']];

        $status  = $exc['httpStatusCode'];
        $headers = $this->isHttpException($e) ? $e->getHeaders() : [];
        $options = JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES;

        if ($status === 404) {
            $response['message'] = 'Page not found.';
        }

        return new JsonResponse($response, $status, $headers, $options);
    }

    private function exceptionToResponse(Throwable $e): array
    {
        $httpCode = $this->getHttpCodeFromException($e);

        return [
            'httpStatusCode' => $httpCode,
            'message'        => $e->getMessage(),
        ];
    }

    private function getHttpCodeFromException(Throwable $e)
    {
        return $this->mapExceptionToHttpCode[$e::class] ?? 500;
    }

}
