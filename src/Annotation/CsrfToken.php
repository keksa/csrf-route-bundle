<?php

namespace Genedys\CsrfRouteBundle\Annotation;

use Genedys\CsrfRouteBundle\Model\CsrfToken as BaseCsrfToken;

/**
 * @author Fabien Antoine <fabien@fantoine.fr>
 */
#[\Attribute(\Attribute::TARGET_METHOD)]
class CsrfToken extends BaseCsrfToken
{
    public function __construct(
        ?string $token = null,
        ?string $intention = null,
        string|array|null $methods = null,
    ){
        $this
            ->setToken($token)
            ->setIntention($intention)
            ->setMethods($methods);
    }

    public function toOption(): array|bool
    {
        $options = [];

        if (null !== $this->getToken()) {
            $options['token'] = $this->getToken();
        }
        if (null !== $this->getIntention()) {
            $options['intention'] = $this->getIntention();
        }
        if (null !== $this->getMethods()) {
            $options['methods'] = $this->getMethods();
        }

        return (count($options) > 0 ? $options : true);
    }
}
