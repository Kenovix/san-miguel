
function EnviaFormSC() {

	document.FormMesa.submit();
		
}

function EnviaForm(idForm) {
	
	document.getElementById(idForm).submit();
		
}

function EnviaFormDepar() {

	document.FormDepar.submit();
		
}

function EnviaFormOrden() {

	document.FormOrden.submit();
		
}

function incrementa(id) {

	document.getElementById(id).value++;
	

}

function decrementa(id) {

if(document.getElementById(id).value > 1)
	document.getElementById(id).value--;

}
function cargar(){

$("#contenido").load("contpedidos.php");

}

function refresca(seg) {
	setTimeout("cargar()",seg);
}


function cargarMesas(){

$("#contenidoMesas").load("contMesas.php");

}

function refrescaMesas(seg) {
	setTimeout("cargarMesas()",seg);
}

function posiciona(id){ 
   
   document.getElementById(id).focus();
}

function CalculeDevuelta() {

	var total;
	var paga;
	var devuelta;
	
	total = document.getElementById("TxtTotalH").value;
	paga = document.getElementById("TxtPaga").value;
	devuelta= paga - total;
	
	document.getElementById("TxtDevuelta").value=devuelta;

}

function CalculeTotal() {

	var Subtotal;
	var IVA;
	var Total;
	
	Subtotal = parseInt(document.getElementById("TxtSubtotal").value);
	IVA = parseInt(document.getElementById("TxtIVA").value);
	Total= parseInt(Subtotal) + parseInt(IVA);
	
	document.getElementById("TxtTotal").value=Total;

}

function CalculeTotalImpuestos() {

	var TxtSancion;
	var TxtIntereses;
	var TxtImpuesto;
	var Total;
	
	TxtSancion = parseInt(document.getElementById("TxtSancion").value);
	TxtIntereses = parseInt(document.getElementById("TxtIntereses").value);
	TxtImpuesto = parseInt(document.getElementById("TxtImpuesto").value);
	Total= parseInt(TxtSancion) + parseInt(TxtIntereses) + parseInt(TxtImpuesto);
	
	document.getElementById("TxtTotal").value=Total;

}

function atajos()
{


shortcut("Ctrl+Q",function()
{
document.getElementById("TxtPaga").focus();
});
shortcut("Ctrl+E",function()
{
document.getElementById("TxtCodigoBarras").focus();
});
shortcut("Ctrl+B",function()
{
document.getElementById("TxtBuscarItem").focus();
});

shortcut("Ctrl+D",function()
{
document.getElementById("TxtBuscarCliente").focus();
});

shortcut("Ctrl+S",function()
{
document.getElementById("BtnGuardar").click();
});

}

function CreaRazonSocial() {

    campo1=document.getElementById('TxtPA').value;
    campo2=document.getElementById('TxtSA').value;
	campo3=document.getElementById('TxtPN').value;
    campo4=document.getElementById('TxtON').value;
	

    Razon=campo3+" "+campo4+" "+campo1+" "+campo2;

    document.getElementById('TxtRazonSocial').value=Razon;


}

function Confirmar(){
	
	if (confirm('¿Estas seguro que deseas realizar esta accion?')){ 
      this.form.submit();
      
    } 
}