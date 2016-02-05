// search index for WYSIWYG Web Builder
var database_length = 0;

function SearchPage(url, title, keywords, description)
{
   this.url = url;
   this.title = title;
   this.keywords = keywords;
   this.description = description;
   return this;
}

function SearchDatabase()
{
   database_length = 0;
   this[database_length++] = new SearchPage("Menu.php", "SoftConTech", "softcontech administrar ingresos egresos clientes proveedores informes salir cartera cuentas por pagar menu rendimientos cuentasxpagar inventarios bajas sincronizar barras ", "");
   this[database_length++] = new SearchPage("Administrar.php", "SoftConTech", "softcontech menu administrar cartera ingresos rendimientos egresos cuentasxpagar inventarios bajas sincronizar barras informes finanzas gestion de colaboradores impuestos retenciones libro diario mayor cuentas frecuentes informe facturacion click para agregar modificar ", "");
   this[database_length++] = new SearchPage("Cartera.php", "SoftConTech", "softcontech cartera completa cuenta donde ingresa el dinero menu administrar ingresos rendimientos egresos cuentasxpagar inventarios bajas sincronizar barras informes ", "");
   this[database_length++] = new SearchPage("Ingresos.php", "SoftConTech", "softcontech asociar factura buscar digite el numero de la otros ingresos cualquier dato asociado menu administrar cartera rendimientos egresos cuentasxpagar inventarios bajas sincronizar barras informes ", "");
   this[database_length++] = new SearchPage("Rendimientos.php", "Rendimientos", "rendimientos fecha nbsp seleccione la cuenta financieros movimiento banco concepto total guardar numero de documento esta ventana mostrará si se realizó no el registro ", "");
   this[database_length++] = new SearchPage("Egresos2.php", "Egresos", "egresos gastos compra de activos menu administrar cartera ingresos rendimientos cuentasxpagar inventarios bajas sincronizar barras informes ", "");
   this[database_length++] = new SearchPage("PagarCuentas.php", "SoftConTech", "softcontech cuentas por pagar seleccione la cuenta origen del pago favor oprima el boton para actualizar las alertas página menu administrar cartera ingresos rendimientos egresos cuentasxpagar inventarios bajas sincronizar barras informes ", "");
   this[database_length++] = new SearchPage("Inventarios2.php", "Inventarios", "inventarios gestion de gestión inicializar dar baja sincronizar precios venta imprimir códigos barra esta accion reiniciará todos los kardex se recomienda realizar un backup antes continuar menu administrar cartera ingresos rendimientos egresos cuentasxpagar bajas barras informes kits ordenes salida entrada activos ", "");
   this[database_length++] = new SearchPage("Baja.php", "SoftConTech", "softcontech dar de baja busque el producto menu administrar cartera ingresos rendimientos egresos cuentasxpagar inventarios bajas sincronizar barras informes ", "");
   this[database_length++] = new SearchPage("SincPrecios.php", "SoftConTech", "softcontech sincronizar precios seleccione el servidor que desea actualizar menu administrar cartera ingresos rendimientos egresos cuentasxpagar inventarios bajas barras informes esta sección permitirá los listados de desde este otro usted se recomienda prudencia ya acción es irreversible ", "");
   this[database_length++] = new SearchPage("PrintBarras.php", "SoftConTech", "softcontech imprimir codigo de barras código filas menu administrar cartera ingresos rendimientos egresos cuentasxpagar inventarios bajas sincronizar informes ", "");
   this[database_length++] = new SearchPage("kits.php", "SoftConTech", "softcontech contruir kit agregue al inventario retorne elementos del busque el para empezar construir que desea gestionar menu administrar cartera ingresos rendimientos egresos cuentasxpagar inventarios bajas sincronizar barras informes ", "");
   this[database_length++] = new SearchPage("Informes.php", "SoftConTech", "softcontech movimiento de cuentas balance general informe ventas fecha inicial seleccione el rango para reporte imprimir movimientos final comprobacion facturación menu administrar cartera ingresos rendimientos egresos cuentasxpagar inventarios bajas sincronizar barras informes ", "");
   return this;
}
