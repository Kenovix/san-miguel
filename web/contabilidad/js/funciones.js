
function EnviaFormSC() {

	document.FormMesa.submit();
		
}

function EnviaFormDepar() {

	document.FormDepar.submit();
		
}

function incrementa(id) {

	document.getElementById(id).value++;
	

}

function decrementa(id) {

if(document.getElementById(id).value > 1)
	document.getElementById(id).value--;

}

function refresca(seg) {
	setTimeout('document.location.reload()',seg);
}

function asigna_valores_iniciales(id){

	var ini;
	ini=document.getElementById(id).value;
	if (ini==""){
		
		document.getElementById(id).value=0;
		
	}

} 

function CargarCosto(){

var val1;
var val2;
var total;

val1=document.getElementById('existencias_edit').value;
val2=document.getElementById('costounitario_edit').value;
total=val1*val2;
document.getElementById('costototal_edit').value=total;

}

function RepiteFuncion(fun,seg) {
	setInterval(fun,seg);
}

function envia(){ 
if (confirm('¿Estas seguro que deseas registrar este egreso?')){ 
      document.FrmArriendos.submit();
      document.FrmArriendos.reset();
    } 

} 