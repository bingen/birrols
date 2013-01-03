<?php

namespace Birrols\OAuthBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BirrolsOAuthBundle extends Bundle
{
    public function getParent() {
        return 'HWIOAuthBundle';
    }
}
