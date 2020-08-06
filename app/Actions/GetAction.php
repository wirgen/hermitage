<?php

namespace App\Actions;

use livetyping\hermitage\foundation\Util;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetAction extends \livetyping\hermitage\app\actions\GetAction
{
    public function __invoke(string $filename, Request $request, Response $response): Response
    {
        if ($access_original = getenv('ACCESS_ORIGINAL_IMAGE')) {
            $access_original = ($access_original != 'false');
        } else {
            $access_original = true;
        }

        if (!$access_original && Util::isOriginal($filename)) {
            return $response->withStatus(403);
        }

        return parent::__invoke($filename, $request, $response);
    }
}
