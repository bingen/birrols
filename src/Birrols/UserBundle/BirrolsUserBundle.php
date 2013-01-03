<?php

namespace Birrols\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BirrolsUserBundle extends Bundle
{
    public function getParent() {
        return 'FOSUserBundle';
    }
}
