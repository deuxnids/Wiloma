<?php

namespace Ghw\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GhwUserBundle extends Bundle
{
	public function getParent()
  {
    return 'FOSUserBundle';
  }
}
