<?php

namespace Sipf\ModelosBase\Tests;

use PHPUnit\Framework\TestCase;
use Sipf\ModelosBase\Models\Persona;

class PersonaTest extends TestCase
{
  public function test_persona_class_exists()
  {
    $this->assertTrue(class_exists(Persona::class));
  }

  public function test_persona_has_campos_busqueda_property()
  {
    $persona = new Persona();
    $this->assertIsArray($persona->camposBusqueda);
  }
}
