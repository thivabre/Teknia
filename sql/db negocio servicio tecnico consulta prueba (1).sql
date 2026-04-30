use servicio_tecnico_db;
SELECT 
    os.fecha_orden, 
    os.fecha_est_fin, 
    s.cant_empleados, 
    ar.nombre_art_rep, 
    ar.tipo_art_rep, 
    ar.fallas, 
    p.precio_reparacion_tot, 
    oe.fecha_entrega
FROM orden_servicio os
JOIN sucursales s 
    ON os.id_sucursal = s.id_sucursal
JOIN articulo_reparar ar 
    ON os.id_articulo_reparar = ar.id_articulo_reparar
JOIN presupuestos p 
    ON os.id_presupuesto = p.id_presupuesto
JOIN orden_entrega oe 
    ON oe.id_orden_servicio = os.id_orden_servicio;
