<?php

namespace App\Controller\Main;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
    /**
     * @return string[]
     */
    public function renderDefault(): array
    {
        return [
            'title' => 'Alluserstasks | Main Page',
        ];
    }
}