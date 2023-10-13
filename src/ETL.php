<?php

/**
 * @author: Julien Mercier-Rojas <julien@jeckel-lab.fr>
 * Created at: 13/10/2023
 */

declare(strict_types=1);

namespace JeckelLab\Etl;

use Closure;

/**
 * @template PAYLOAD of array|object
 * @template EXTRACTED
 * @template TRANSFORMED
 * @template SUBJECT of array|object
 */
final readonly class ETL
{
    private Closure $extract;
    private Closure $transform;
    private Closure $load;

    /**
     * @param callable(PAYLOAD $payload): EXTRACTED $extract
     * @param callable(EXTRACTED $value): TRANSFORMED $transform
     * @param callable(TRANSFORMED $value, SUBJECT $contact): SUBJECT $load
     */
    public function __construct(
        callable $extract,
        callable $transform,
        callable $load
    ) {
        $this->extract = Closure::fromCallable($extract);
        $this->transform = Closure::fromCallable($transform);
        $this->load = Closure::fromCallable($load);
    }

    /**
     * @param PAYLOAD $payload
     * @param SUBJECT $contact
     * @return SUBJECT
     */
    public function apply($payload, $contact)
    {
        $load = $this->load;
        $transform = $this->transform;
        $extract = $this->extract;
        return $load(
            $transform(
                $extract($payload)
            ),
            $contact
        );
    }

}
