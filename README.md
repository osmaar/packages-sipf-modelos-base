# sipf/modelos-base

**Modelos Eloquent compartidos del sistema SIPF.**  
Este paquete contiene los modelos base reutilizables para múltiples microservicios dentro del ecosistema SIPF.

---

## 📦 Instalación

### Opción 1: vía repositorio Git

1. Agrega a tu `composer.json` en el microservicio:

```
"repositories": [
  {
    "type": "vcs",
    "url": "https://github.com/usuario/sipf-modelos-base.git"
  }
],
"require": {
  "sipf/modelos-base": "dev-master"
}
```

2. Ejecuta:

```
composer update sipf/modelos-base
```

---

### Opción 2: uso local (path)

1. Copia el package en `/packages/sipf/modelos-base` dentro del microservicio

2. En `composer.json`:

```
"repositories": [
  {
    "type": "path",
    "url": "packages/sipf/modelos-base"
  }
],
"require": {
  "sipf/modelos-base": "*"
}
```

3. Ejecuta:

```
composer update sipf/modelos-base
```

---

## 🚀 Uso

```php
use Sipf\ModelosBase\Models\Persona;

$persona = Persona::first();
echo $persona->nombre_completo;
```

---

## 🧪 Pruebas

Dentro del package puedes correr:

```
composer test
```

---

## 📁 Estructura

```
src/
├── Models/       # Modelos Eloquent
├── Traits/       # Traits reutilizables
├── Contracts/    # Interfaces para servicios externos
├── ModelosBaseServiceProvider.php
tests/            # Pruebas unitarias con PHPUnit
```

---
