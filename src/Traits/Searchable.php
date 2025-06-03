<?php

namespace Sipf\ModelosBase\Traits;

trait Searchable
{


  public function scopeBuscar($query): void
  {
    $busqueda = request()->search;

    $query->where(function ($query) use ($busqueda) {
      foreach ($this->camposBusqueda as $field) {
        $value = request()->get($field);
        if ($busqueda) {
          $query->orWhere($field, 'LIKE',  "%{$busqueda}%");
        } elseif ($value) {
          $query->where($field, 'LIKE',  "%{$value}%");
        }
      }
    });
  }
}
