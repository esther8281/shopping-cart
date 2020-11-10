<?php

namespace App\Traits;

use Exception;
use PDOException;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use Symfony\Component\Debug\Exception\FatalErrorException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait RestExceptionHandlerTrait
{

    /**
     * Creates a new JSON response based on exception type.
     *
     * @param Request $request
     * @param Exception $e
     * @return \Illuminate\Http\JsonResponse
     */
    protected function getJsonResponseForException(Request $request, Exception $e)
    {
        switch(true) {
            case $this->isModelNotFoundException($e):
                $retval = $this->modelNotFound();
            break;
            case $this->isAuthenticationException($e):
                $retval = $this->authenticationFailed();
            break;
            case $this->isQueryException($e):
                $retval = $this->queryFailed($e);
            break;
            case $this->isPDOException($e):
                $retval = $this->pdoFailed($e);
            break;
            case $this->isNotFoundHttpException($e):
                $retval = $this->notFoundHttp($e);
            break;
            case $this->isReflectionException($e):
                $retval = $this->reflectionFailed($e);
            break;
            case $this->isFatalThrowableError($e):
                $retval = $this->fatalThrowableError($e);
            break;
            case $this->isFatalErrorException($e):
                $retval = $this->fatalErrorException($e);
            break;
            default:
                $retval = $this->badRequest();
        }

        return $retval;
    }

    /**
     * Returns json response for generic bad request.
     *
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function badRequest($message='Bad request', $statusCode=400)
    {
        return apiResponse($message, $statusCode, $message, []);
    }

    /**
     * Returns json response for Eloquent model not found exception.
     *
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function modelNotFound($message='Record not found', $statusCode=404)
    {
        return apiResponse($message, $statusCode, $message, []);
    }

    /**
     * Determines if the given exception is an Eloquent model not found.
     *
     * @param Exception $e
     * @return bool
     */
    protected function isModelNotFoundException(Exception $e)
    {
        return $e instanceof ModelNotFoundException;
    }


    /**
     * Determines if the given exception is an Eloquent model not found.
     *
     * @param Exception $e
     * @return bool
     */
    protected function isAuthenticationException(Exception $e)
    {
        return $e instanceof AuthenticationException;
    }

    /**
     * Returns json response for Eloquent model not found exception.
     *
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function authenticationFailed($message='Authentication failed', $statusCode=401)
    {
        return apiResponse($message, $statusCode, $message, []);
    }

    /**
     * Determines if the given exception is an Eloquent model not found.
     *
     * @param Exception $e
     * @return bool
     */
    protected function isQueryException(Exception $e)
    {
        return $e instanceof QueryException;
    }

    /**
     * Returns json response for Eloquent model not found exception.
     *
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function queryFailed($e, $api_identifier='Query failed', $statusCode=422)
    {
        $message = $e->getMessage();
        return apiResponse($api_identifier, $statusCode, $message, []);
    }

    /**
     * Determines if the given exception is an Eloquent model not found.
     *
     * @param Exception $e
     * @return bool
     */
    protected function isPDOException(Exception $e)
    {
        return $e instanceof PDOException;
    }

    /**
     * Returns json response for Eloquent model not found exception.
     *
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function pdoFailed($e, $api_identifier='PDO failed', $statusCode=422)
    {
        $message = $e->getMessage();
        return apiResponse($api_identifier, $statusCode, $message, []);
    }

    /**
     * Determines if the given exception is an Eloquent model not found.
     *
     * @param Exception $e
     * @return bool
     */
    protected function isNotFoundHttpException(Exception $e)
    {
        return $e instanceof NotFoundHttpException;
    }

    /**
     * Returns json response for Eloquent model not found exception.
     *
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function notFoundHttp($e, $message='Route not found', $statusCode=404)
    {
        return apiResponse($message, $statusCode, $message, []);
    }

    /**
     * Determines if the given exception is an Eloquent model not found.
     *
     * @param Exception $e
     * @return bool
     */
    protected function isReflectionException(Exception $e)
    {
        return $e instanceof \ReflectionException;
    }

    /**
     * Returns json response for Eloquent model not found exception.
     *
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function reflectionFailed($e, $api_identifier='Reflection exception', $statusCode=422)
    {
        $message = $e->getMessage();
        return apiResponse($message, $statusCode, $message, []);
    }

    /**
     * Determines if the given exception is an Eloquent model not found.
     *
     * @param Exception $e
     * @return bool
     */
    protected function isFatalThrowableError(Exception $e)
    {
        return $e instanceof FatalThrowableError;
    }

    /**
     * Returns json response for Eloquent model not found exception.
     *
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function fatalThrowableError($e, $api_identifier='Fatal throwable error', $statusCode=422)
    {
        $message = $e->getMessage();
        return apiResponse($message, $statusCode, $message, []);
    }

    /**
     * Determines if the given exception is an Eloquent model not found.
     *
     * @param Exception $e
     * @return bool
     */
    protected function isFatalErrorException(Exception $e)
    {
        return $e instanceof FatalErrorException;
    }

    /**
     * Returns json response for Eloquent model not found exception.
     *
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function fatalErrorException($e, $api_identifier='Fatal error', $statusCode=422)
    {
        $message = $e->getMessage();
        return apiResponse($message, $statusCode, $message, []);
    }
}