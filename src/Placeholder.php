<?php

/**
 * @author: Julien Mercier-Rojas <julien@jeckel-lab.fr>
 * Created at: 2023-10-13
 */

declare(strict_types=1);

namespace JeckelLab\Etl;

final class Placeholder
{
    private string $prefix;

    public function __construct(string $prefix)
    {
        $this->prefix = $prefix;
    }

    public function echo(string $v): string
    {
        return $this->prefix.$v;
    }
}
