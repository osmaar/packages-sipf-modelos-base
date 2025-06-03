<?php

namespace Sipf\ModelosBase\Models\Tecnico\Seguridad\Resguardo;

trait ObservacionesFormatoDesglosado
{
  public function getObservacionesFormatoDesglosadoAttribute()
  {

    if ($this->id_tipo_objeto != 1) {
      return $this->observaciones;
    } else {

      $dineros = $this->dineros->toArray();
      $agrupado = [];

      // Agrupar por tipo y valor
      foreach ($dineros as $dinero) {
        $tipo = $dinero['tipo_dinero'];
        $valor = $dinero['valor_dinero'];
        $descripcion = isset($dinero['pais']['description']) ? $dinero['pais']['description'] : 'Sin descripción';

        if (!isset($agrupado[$tipo][$valor])) {
          $agrupado[$tipo][$valor] = [
            'cantidad' => 0,
            'subtotal' => 0,
            'descripcion' => $descripcion
          ];
        }

        $agrupado[$tipo][$valor]['cantidad'] += $dinero['cantidad'];
        $agrupado[$tipo][$valor]['subtotal'] += $dinero['cantidad'] * $valor;
      }

      $cadenaDesglose = "";

      // Construir la cadena de desglose
      foreach ($agrupado as $tipo => $valores) {
        foreach ($valores as $valor => $datos) {
          $cantidad = $datos['cantidad'];
          $subtotal = number_format($datos['subtotal'], 2);
          $tipoPlural = $cantidad > 1 ? strtolower($tipo) . 's' : strtolower($tipo);
          $descripcion = $datos['descripcion'];
          $cadenaDesglose .= "$cantidad $tipoPlural DE $valor ($descripcion), SUBTOTAL: $subtotal\n";
        }
      }


      return $cadenaDesglose;
    }
  }
  public function getStatusFormatoDesglosadoAttribute()
  {

    $cadenaDesglose = $this->estadoResguardo ? $this->estadoResguardo->description : "NO APLICA";

    if ($this->id_tipo_objeto != 1) {
      return $cadenaDesglose;
    } else {

      $dineros = $this->dineros->toArray();


      foreach ($dineros as $dinero) {

        if (!empty($dinero['autoriza'])) {
          $cadenaDesglose = "ENTREGADO A RECURSOS FINANCIEROS";
          break;
        }
      }
      return $cadenaDesglose;
    }
  }
}
