# Teknia — Sistema de Gestión de Servicio Técnico

Teknia es una aplicación web para la gestión integral de un servicio técnico de reparaciones. Permite administrar órdenes de servicio, clientes, empleados, inventario, finanzas y sucursales desde una interfaz con control de acceso por roles.

---

## Tecnologías utilizadas

- **Frontend:** HTML, CSS, JavaScript (Vanilla)
- **Backend:** PHP (API REST con respuestas JSON)
- **Base de datos:** MySQL / MariaDB
- **Servidor local recomendado:** XAMPP, Laragon o equivalente

---

## Estructura del proyecto

```
Teknia/
├── html/                         # Páginas y estilos (versión de desarrollo)
│   ├── index.html
│   ├── inicio_sesion.html
│   ├── crear_cuenta.html
│   ├── servicios-*.html
│   ├── personal-*.html
│   ├── inventario-*.html
│   ├── finanzas-*.html
│   ├── sucursales-*.html
│   ├── administracion-*.html
│   └── *.css
├── javascript/                   # Scripts del frontend (versión de desarrollo)
│   ├── tablas.js                 # Lógica central: sesión, tablas dinámicas, CRUD
│   ├── estadisticas.js           # Dashboard de inicio por rol
│   ├── login.js / signup.js
│   └── [módulo].js               # Un archivo JS por sección
├── php/                          # Backend PHP (versión de desarrollo)
│   ├── conexion.php              # Configuración de la conexión a la DB
│   ├── consulta.php              # Endpoints GET para SELECT
│   ├── insercion.php             # Endpoints POST para INSERT
│   ├── actualizacion.php         # Endpoints POST para UPDATE
│   ├── eliminacion.php           # Endpoints POST para DELETE
│   ├── login_proceso.php         # Autenticación y manejo de sesión
│   ├── get_rol.php               # Verificación de sesión activa
│   ├── procesar_registro.php     # Registro de nuevos clientes
│   └── migracion_cliente.php     # Migración de datos de clientes
├── full/                         # Versión integrada (HTML + JS + PHP en un solo directorio)
├── Teknia_db_final.sql           # Script de creación de la base de datos
└── db negocio servicio tecnico inserts.sql  # Datos de prueba
```

---

## Requisitos previos

- PHP 7.4 o superior
- MySQL 5.7 / MariaDB 10.4 o superior
- Servidor web con soporte para PHP (Apache, Nginx, XAMPP, Laragon, etc.)

---

## Instalación

**1. Clonar el repositorio**
```bash
git clone https://github.com/thivabre/Teknia.git
cd Teknia
```

**2. Crear la base de datos**

Importar el script SQL en tu gestor (phpMyAdmin, MySQL Workbench o terminal):
```bash
mysql -u root -p < Teknia_db_final.sql
```

Opcionalmente, cargar los datos de prueba:
```bash
mysql -u root -p servicio_tecnico_db < "db negocio servicio tecnico inserts.sql"
```

**3. Configurar la conexión**

Editar `php/conexion.php` (o `full/conexion.php`) con los datos de tu entorno:
```php
$ubicacion = "127.0.0.1:3307";  // host:puerto de tu MySQL
$usuario   = "root";
$clave     = "";
$base      = "servicio_tecnico_db";
```

**4. Servir el proyecto**

Copiar la carpeta `full/` a la raíz de tu servidor web (por ejemplo `htdocs/` en XAMPP) y acceder desde el navegador:
```
http://localhost/Teknia/full/index.html
```

---

## Sistema de roles

El sistema controla el acceso a cada sección según el rol del usuario logueado. Los roles se determinan automáticamente al iniciar sesión:

| Rol | Acceso |
|---|---|
| `cliente` | Servicios, sucursales, historial propio, presupuestos y facturas |
| `empleado` | Todo lo anterior + inventario y gestión de clientes |
| `jefe_sucursal` | Todo lo anterior + finanzas (garantías, impuestos, precios) y personal |
| `jefe_general` | Acceso completo incluyendo administración (contratos, sueldos, localidades, seguros) |

### Inicio de sesión

- **Clientes:** se registran con nombre, apellido, DNI y teléfono desde la pantalla de creación de cuenta.
- **Empleados / Jefes:** ingresan con su ID de empleado y nombre. El rol se asigna automáticamente según los campos `jefe_sucursal` y `jefe_general` en la tabla `empleado`.

---

## Módulos del sistema

### Servicios
- Crear órdenes de servicio para artículos a reparar
- Consultar órdenes activas
- Gestionar presupuestos y facturas
- Ver historial de órdenes

### Personal
- Gestión de clientes
- Gestión de empleados
- Vista de jefes de sucursal y jefe general

### Inventario
- Control de stock de repuestos
- Catálogo de repuestos disponibles
- Gestión de productos en reparación

### Finanzas *(jefe_sucursal y jefe_general)*
- Garantías de servicio
- Precios (mano de obra y repuestos)
- Impuestos

### Sucursales
- Información de sucursales
- Creación de nuevas sucursales
- Ubicaciones

### Administración *(jefe_general)*
- Contratos de empleados
- Sueldos
- Seguros
- Localidades

---

## Base de datos

La base de datos `servicio_tecnico_db` contiene 28 tablas organizadas en los siguientes grupos:

- **Entidades principales:** `cliente`, `empleado`, `sucursales`, `proveedor`
- **Operaciones:** `orden_servicio`, `orden_entrega`, `factura_servicio`, `presupuestos`
- **Inventario:** `inventario_repuestos`, `inventario_productos`, `repuestos`, `articulo_reparar`
- **Tablas intermedias (N:M):** `intermedia_inv_rep`, `intermedia_inv_prod`, `intermedia_rep_pres`, `sucursales_proveedor`
- **Configuración:** `sueldo`, `seguro`, `impuestos`, `precio`, `garantia_servicio`, `pago`
- **Direcciones:** `direccion_empleado`, `direccion_cliente`, `direccion_sucursal`, `direccion_proveedor`, `localidad`

---

## API Backend

Todos los endpoints devuelven JSON. El parámetro `accion` determina la operación a ejecutar.

| Archivo | Método | Descripción |
|---|---|---|
| `consulta.php` | GET | Consultas SELECT sobre todas las tablas |
| `insercion.php` | POST | Inserciones con validación y transacciones |
| `actualizacion.php` | POST | Actualizaciones de registros existentes |
| `eliminacion.php` | POST | Eliminación de registros |
| `login_proceso.php` | POST | Autenticación (cliente / empleado) |
| `get_rol.php` | GET | Verificación de sesión activa |
| `procesar_registro.php` | POST | Registro de nuevos clientes |

Ejemplo de consulta:
```
GET php/consulta.php?accion=consulta_empleado
```

---

## Notas de desarrollo

- La carpeta `full/` contiene la versión integrada del proyecto (HTML, JS y PHP en el mismo directorio) y es la recomendada para despliegue.
- Las carpetas `html/`, `javascript/` y `php/` corresponden a la versión separada, útil durante el desarrollo.
- `tablas.js` es el núcleo del frontend: gestiona la sesión, renderiza tablas dinámicas y centraliza las llamadas a la API.

---
