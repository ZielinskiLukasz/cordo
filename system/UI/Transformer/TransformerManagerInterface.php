<?php declare(strict_types=1);

namespace System\UI\Transformer;

use League\Fractal\TransformerAbstract;

interface TransformerManagerInterface
{
    public function add(TransformerAbstract $transformer, string $index): void;

    public function transform($result, string $index): array;
}
