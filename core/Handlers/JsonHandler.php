<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 12/18/17
 * Time: 8:28 PM
 */

namespace Core\Handlers;

use \Psr\Http\Message\ResponseInterface;


class JsonHandler
{
    /**
     *
     * @param ResponseInterface $response
     * @param int $statusCode
     * @param array $data
     *
     * @return ResponseInterface
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function render(ResponseInterface $response, $statusCode = 200, array $data = [])
    {
        $newResponse = $response->withHeader('Content-Type', 'application/json');
        $newResponse = $newResponse->withStatus($statusCode);
        $newResponse->getBody()->write(json_encode($data));
        return $newResponse;
    }
}



