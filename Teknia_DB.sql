create database servicio_tecnico_db;
use servicio_tecnico_db;
create table localidad(
	id_localidad int not null auto_increment primary key,
    pais varchar(30) not null,
    provincia varchar(30) not null,
    ciudad varchar(30) not null,
    barrio varchar(30) not null
);

create table seguro(
	id_seguro int not null auto_increment primary key,
    tipo_seg varchar(30) not null,
    nombre_aseg varchar(30) not null,
    monto_aseg int not null
);

create table sueldo(
	id_sueldo int not null auto_increment primary key,
    sueldo_hora int not null,
    sueldo_hora_ext int not null,
    forma_pago varchar(15) not null
);

create table impuestos(
	id_impuestos int not null auto_increment primary key,
    tipo_imp varchar(30) not null,
    monto_imp int not null
);

create table precio(
	id_precio int not null auto_increment primary key,
    precio_mano_obra int not null,
    precio_rep int not null
);

create table articulo_reparar(
	id_articulo_reparar int not null auto_increment primary key,
    nombre_art_rep varchar(30) not null,
    tipo_art_rep varchar(30) not null,
    fallas varchar(70)
);

create table garantia_servicio(
	id_garantia_servicio int not null auto_increment primary key,
    tiempo_garantia varchar(30) not null,
    tipo_garantia varchar(30) not null
);

create table pago(
	id_pago int not null auto_increment primary key,
    nombre_banco varchar(30) not null,
    numero_cuenta int not null,
    comprobante varchar(255) not null
);

create table direccion_empleado(
	id_dire_empleado int not null auto_increment primary key,
    calle_emp varchar(30) not null,
    altura_emp int(4) not null,
    cod_postal_emp int(4) not null,
    id_localidad int not null unique,
    foreign key (id_localidad) references localidad(id_localidad)
);

create table direccion_cliente(
	id_dire_cliente int not null auto_increment primary key,
    calle_cli varchar(30) not null,
    altura_cli int(4) not null,
    cod_postal_cli int(4) not null,
    id_localidad int not null unique,
    foreign key (id_localidad) references localidad(id_localidad)
);

create table direccion_sucursal(
	id_dire_sucursal int not null auto_increment primary key,
    calle_suc varchar(30) not null,
    altura_suc int(4) not null,
    cod_postal_suc int(4) not null,
    id_localidad int not null unique,
    foreign key (id_localidad) references localidad(id_localidad)
);

create table direccion_proveedor(
	id_dire_proveedor int not null auto_increment primary key,
    calle_prov varchar(30) not null,
    altura_prov int(4) not null,
    cod_postal_prov int(4) not null,
    id_localidad int not null unique,
    foreign key (id_localidad) references localidad(id_localidad)
);

create table inventario_productos(
	id_inv_productos int not null auto_increment primary key,
    cantidad_prod int not null,
    id_articulo_reparar int not null,
    foreign key (id_articulo_reparar) references articulo_reparar(id_articulo_reparar)
);

create table contrato_empleado(
	id_contrato_emple int not null auto_increment primary key,
    fecha_cont date not null,
    turno varchar(15) not null,
    id_sueldo int not null unique,
    foreign key (id_sueldo) references sueldo(id_sueldo)
);

create table repuestos(
	id_repuesto int not null auto_increment primary key,
    nombre_rep varchar(30) not null,
    tipo_rep varchar(30) not null,
    id_precio int not null unique,
    foreign key (id_precio) references precio(id_precio)
);

create table factura_servicio(
	id_factura_servicio int not null auto_increment primary key,
    fecha_factura date not null,
    id_pago int unique,
    id_garantia_servicio int not null unique,
    foreign key (id_pago) references pago(id_pago),
    foreign key (id_garantia_servicio) references garantia_servicio(id_garantia_servicio)
);

create table proveedor(
	id_proveedor int not null auto_increment primary key,
    nombre_prov varchar(30) not null,
    id_dire_proveedor int not null,
    id_repuesto int not null unique,
    foreign key (id_dire_proveedor) references direccion_proveedor(id_dire_proveedor),
    foreign key (id_repuesto) references repuestos(id_repuesto)
);

create table inventario_repuestos(
	id_inv_repuestos int not null auto_increment primary key,
    cantidad_rep int not null,
    id_repuesto int not null,
    foreign key (id_repuesto) references repuestos(id_repuesto)
);

create table presupuestos(
	id_presupuesto int not null auto_increment primary key,
    precio_reparacion_tot int not null,
    id_repuesto int not null,
    foreign key (id_repuesto) references repuestos(id_repuesto)
);

create table sucursales(
	id_sucursal int not null auto_increment primary key,
    cant_empleados int not null,
    reparaciones_hechas int not null,
    id_dire_sucursal int not null,
    id_inv_repuestos int not null unique,
    id_inv_productos int not null unique,
    id_impuestos int not null,
    foreign key (id_dire_sucursal) references direccion_sucursal(id_dire_sucursal),
    foreign key (id_inv_repuestos) references inventario_repuestos(id_inv_repuestos),
    foreign key (id_inv_productos) references inventario_productos(id_inv_productos),
    foreign key (id_impuestos) references impuestos(id_impuestos)
);

create table empleado(
	id_empleado int not null auto_increment primary key,
    nombre_emple varchar(30) not null,
    apellido_emple varchar(30) not null,
    dni_emple int(8) not null,
    telefono_emple varchar(11) not null,
    horas_trabajdas int not null,
    horas_extra int not null,
    id_dire_empleado int not null,
    id_contrato_emple int not null unique,
    id_sucursal int not null,
    id_seguro int not null unique,
    foreign key (id_dire_empleado) references direccion_empleado(id_dire_empleado),
    foreign key (id_contrato_emple) references contrato_empleado(id_contrato_emple),
    foreign key (id_sucursal) references sucursales(id_sucursal),
    foreign key (id_seguro) references seguro(id_seguro)
);

create table sucursales_proveedor(
    id_proveedor int not null,
    id_sucursal int not null,
    primary key (id_proveedor, id_sucursal),
    foreign key (id_proveedor) references proveedor(id_proveedor),
    foreign key (id_sucursal) references sucursales(id_sucursal)
);

create table orden_servicio(
	id_orden_servicio int not null auto_increment primary key,
    fecha_orden date not null,
    fecha_est_fin date not null,
    id_sucursal int not null,
    id_articulo_reparar int not null unique,
    id_presupuesto int not null unique,
    foreign key (id_sucursal) references sucursales(id_sucursal),
    foreign key (id_articulo_reparar) references articulo_reparar(id_articulo_reparar),
    foreign key (id_presupuesto) references presupuestos(id_presupuesto)
);

create table cliente(
	id_cliente int not null auto_increment primary key,
    nombre_cli varchar(30) not null,
    apellido_cli varchar(30) not null,
    dni_cli int(8) not null,
    telefono_cli varchar(11) not null,
    id_dire_cliente int not null,
    id_orden_servicio int not null,
    foreign key (id_dire_cliente) references direccion_cliente(id_dire_cliente),
    foreign key (id_orden_servicio) references orden_servicio(id_orden_servicio)
);

create table orden_entrega(
	id_orden_entrega int not null auto_increment primary key,
    fecha_entrega date not null,
    id_orden_servicio int not null unique,
    id_factura_servicio int not null unique,
    foreign key (id_orden_servicio) references orden_servicio(id_orden_servicio),
    foreign key (id_factura_servicio) references factura_servicio(id_factura_servicio)
);