<?php

namespace Sipf\ModelosBase\Contracts;

interface LugarMapInterface
{
  public function getDescripcion(int $id): ?string;
  public function getId(string $descripcion): ?int;
}
