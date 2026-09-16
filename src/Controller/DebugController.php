<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DebugController extends AbstractController
{
    public function env(): Response
    {
        return new Response(
            '<pre>' . print_r([
                'JWT_SECRET_KEY' => getenv('JWT_SECRET_KEY'),
                'JWT_PUBLIC_KEY' => getenv('JWT_PUBLIC_KEY'),
                'JWT_PASSPHRASE' => getenv('JWT_PASSPHRASE'),
                'APP_ENV' => getenv('APP_ENV'),
                'KERNEL_PROJECT_DIR' => getenv('KERNEL_PROJECT_DIR'),
            ], true) . '</pre>'
        );
    }
}
