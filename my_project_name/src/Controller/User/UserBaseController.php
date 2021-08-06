<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserBaseController extends AbstractController
{
    /**
     * @return string[]
     */
    public function renderDefault(): array
    {
        return [
            'title' => 'User page',
        ];
    }
}