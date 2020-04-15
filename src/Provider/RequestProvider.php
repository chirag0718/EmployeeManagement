<?php
/**
 * Created by PhpStorm.
 * User: Neha
 * Date: 3/29/2020
 * Time: 3:00 PM
 */

namespace chirag\Employee\Provider;

use chirag\Employee\CustomSetting;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class RequestProvider implements ServiceInterface
{
    protected $headers;
    protected $url;
    protected $client;

    public function __construct($url, $headers = [])
    {
        $this->url = $url;
        $this->headers = $headers;
        $this->client = new Client();
    }

    /**
     * Calling the Get API
     * @return string
     */
    public function get()
    {
        try {
            $response = $this->client->get(CustomSetting::website_url() . $this->url, $this->headers);
            return $this->jsonResponse($response);
        } catch (RequestException $e) {
            return $this->StatusCodeHandling($e);
        }
    }
    /**
     * Calling the Post API
     * @return string
     */
    public function post()
    {
        try {
            $response = $this->client->post(CustomSetting::website_url() . $this->url, $this->headers);
            return $this->jsonResponse($response);
        } catch (RequestException $e) {
            return $this->StatusCodeHandling($e);
        }
    }


    /** Updating the url
     * @return mixed|string
     */
    public function patch()
    {
        try {
            $response = $this->client->patch(CustomSetting::website_url() . $this->url, $this->headers);
            return $this->jsonResponse($response);
        } catch (RequestException $e) {
            return $this->StatusCodeHandling($e);
        }
    }

    /**
     * Calling the Delete API
     * @return string
     */
    public function delete()
    {
        try {
            $response = $this->client->delete(CustomSetting::website_url() . $this->url, $this->headers);
            return $this->jsonResponse($response);
        } catch (RequestException $e) {
            return $this->StatusCodeHandling($e);
        }
    }

    /**
     * Set statuscode here
     * @param $exception
     * @return string
     */
    private function StatusCodeHandling($exception)
    {
        $statusCode = $exception->getResponse()->getStatusCode();
        switch ($statusCode) {
            case 404:
                $response = "Resource not found";
                break;
            case 204:
                $response = "Resource is deleted";
                break;
            default:
                $response = ($statusCode == 500) ? 'Whoops, looks like something went wrong' : $exception->getMessage();
                break;
        }
        return $response;
    }

    /** Response after calling API
     * @param $response
     * @return mixed
     */
    private function jsonResponse($response) {
        return  $response->getBody()->getContents();
    }
}