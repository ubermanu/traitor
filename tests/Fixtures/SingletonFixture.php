<?php

namespace Traitor\Tests\Fixtures;

use Traitor\Singleton;

final class SingletonFixture
{
    use Singleton;

    /**
     * @return string
     */
    public function getValue(): string
    {
        return 'value';
    }
}
