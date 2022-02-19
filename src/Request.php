<?php

namespace Plugrbase\TwitterApi;

use Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException as GuzzleConnectException;
use GuzzleHttp\Exception\GuzzleException;
use Plugrbase\TwitterApi\Exceptions\AuthorizationException;
use Plugrbase\TwitterApi\Exceptions\ConflictException;
use Plugrbase\TwitterApi\Exceptions\ConnectException;
use Plugrbase\TwitterApi\Exceptions\FailedActionException;
use Plugrbase\TwitterApi\Exceptions\NotFoundException;
use Plugrbase\TwitterApi\Exceptions\RequestException;
use Plugrbase\TwitterApi\Exceptions\ValidationException;
use Psr\Http\Message\ResponseInterface;

trait Request
{
    /**
     * Make a GET request and return the response.
     */
    public function get(string $uri, mixed $data = [])
    {
        return $this->request('get', $uri, $data);
    }

    /**
     * Make a POST request and return the response.
     */
    public function post(string $uri, mixed $data = [])
    {
        return $this->request('post', $uri, $data);
    }

    /**
     * Make a DELETE request and return the response.
     */
    public function delete(string $uri, mixed $data = [])
    {
        return $this->request('delete', $uri, $data);
    }

    /**
     * Make request to API and return response.
     *
     * @return object
     */
    public function request(string $method, string $uri, array $data = [])
    {
        try {
            return $this->guzzle->request($method, $uri, $data);
        } catch (ClientException $e) {
            return $this->handleRequestError($e->getResponse());
        } catch (GuzzleException $e) {
            throw new RequestException($e);
        } catch (GuzzleConnectException $e) {
            throw new ConnectException($e);
        }
    }

    /**
     * Handle request errors.
     *
     * @param  \Psr\Http\Message\ResponseInterface  $response
     * @return void
     *
     * @throws \Exception
     * @throws \Plugrbase\TwitterApi\Exceptions\AuthorizationException
     * @throws \Plugrbase\TwitterApi\Exceptions\ConflictException
     * @throws \Plugrbase\TwitterApi\Exceptions\FailedActionException
     * @throws \Plugrbase\TwitterApi\Exceptions\NotFoundException
     * @throws \Plugrbase\TwitterApi\Exceptions\ValidationException
     */
    protected function handleRequestError(ResponseInterface $response)
    {
        if ($response->getStatusCode() == 400) {
            throw new FailedActionException((string) $response->getBody());
        }

        if ($response->getStatusCode() == 401) {
            throw new AuthorizationException();
        }

        if ($response->getStatusCode() == 404) {
            throw new NotFoundException();
        }

        if ($response->getStatusCode() == 409) {
            throw new ConflictException();
        }

        if ($response->getStatusCode() == 422) {
            throw new ValidationException(json_decode((string) $response->getBody(), true));
        }

        throw new Exception((string) $response->getBody());
    }
}
