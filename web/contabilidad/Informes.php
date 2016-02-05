<?php
session_start();
   if(!isset($_SESSION["username"])){
   header("Location: index.php");
}
  $tipo = $_SESSION['tipouser'];
   if($tipo<>"administrador"){
   header("Location: Menu.php");   
	  
}
$_SESSION["Listado"]="proveedores";
include("conexion.php");
$fecha=date("Y-m-d");
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>SoftConTech</title>
<style type="text/css">
body
{
   background-color: #FFFFFF;
   color: #000000;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   line-height: 1.1875;
   margin: 0;
   padding: 0;
}
</style>
<link href="cupertino/jquery.ui.all.css" rel="stylesheet" type="text/css">
<style type="text/css">
@-webkit-keyframes animate-fade-in
{
   0% { opacity: 0;  }
   100% { opacity: 1;  }
}
@-moz-keyframes animate-fade-in
{
   0% { opacity: 0;  }
   100% { opacity: 1;  }
}
@-o-keyframes animate-fade-in
{
   0% { opacity: 0;  }
   100% { opacity: 1;  }
}
@-ms-keyframes animate-fade-in
{
   0% { opacity: 0;  }
   100% { opacity: 1;  }
}
@keyframes animate-fade-in
{
   0% { opacity: 0;  }
   100% { opacity: 1;  }
}
a
{
   color: #0000FF;
   text-decoration: underline;
}
a:visited
{
   color: #800080;
}
a:active
{
   color: #FF0000;
}
a:hover
{
   color: #0000FF;
   text-decoration: underline;
}
#jQueryTabs1
{
   padding: 4px 4px 4px 4px;
}
#jQueryTabs1 .ui-tabs-nav
{
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   padding: 4px 4px 0px 4px;
}
#jQueryTabs1 .ui-tabs-nav li
{
   font-family: Arial;
   font-weight: normal;
   font-style: normal;
   margin: 0px 2px -1px 0px;
}
#jQueryTabs1 .ui-tabs-nav li a
{
   padding: 8px 10px 8px 10px;
}
#Image3
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#wb_Form2
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#jQueryDatePicker3
{
   border: 1px #A9A9A9 solid;
   background-color: transparent;
   background-image: url(images/Informes_jQueryDatePicker3_bkgrnd.png);
   background-repeat: repeat-x;
   background-position: left top;
   color :#FFFFFF;
   font-family: "Bookman Old Style";
   font-weight: bold;
   font-style: italic;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
.ui-datepicker
{
   font-family: "Bookman Old Style";
   font-weight: normal;
   font-size: 13px;
   z-index: 1003 !important;
   display: none;
}
#wb_Text9 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text9 div
{
   text-align: left;
}
#wb_Text10 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text10 div
{
   text-align: left;
}
#Line2
{
   color: #0000FF;
   background-color: #0000FF;
   border-width: 0;
   margin: 0;
   padding: 0;
   -moz-box-shadow: 6px 6px 2px #000000;
   -webkit-box-shadow: 6px 6px 2px #000000;
   box-shadow: 6px 6px 2px #000000;
}
#wb_Text11 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text11 div
{
   text-align: left;
}
#wb_Text12 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text12 div
{
   text-align: left;
}
#jQueryDatePicker4
{
   border: 1px #A9A9A9 solid;
   background-color: transparent;
   background-image: url(images/Informes_jQueryDatePicker4_bkgrnd.png);
   background-repeat: repeat-x;
   background-position: left top;
   color :#FFFFFF;
   font-family: "Bookman Old Style";
   font-weight: bold;
   font-style: italic;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
.ui-datepicker
{
   font-family: "Bookman Old Style";
   font-weight: normal;
   font-size: 13px;
   z-index: 1003 !important;
   display: none;
}
#Button2
{
   border: 1px #A9A9A9 solid;
   background-color: transparent;
   background-image: url(images/Informes_Button2_bkgrnd.png);
   background-repeat: repeat-x;
   background-position: left top;
   color: #FFFFFF;
   font-family: "Bookman Old Style";
   font-weight: bold;
   font-style: italic;
   font-size: 13px;
}
#Image5
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#wb_Form3
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#jQueryDatePicker5
{
   border: 1px #A9A9A9 solid;
   background-color: transparent;
   background-image: url(images/Informes_jQueryDatePicker5_bkgrnd.png);
   background-repeat: repeat-x;
   background-position: left top;
   color :#FFFFFF;
   font-family: "Bookman Old Style";
   font-weight: bold;
   font-style: italic;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
.ui-datepicker
{
   font-family: "Bookman Old Style";
   font-weight: normal;
   font-size: 13px;
   z-index: 1003 !important;
   display: none;
}
#wb_Text14 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text14 div
{
   text-align: left;
}
#wb_Text15 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text15 div
{
   text-align: left;
}
#Line3
{
   color: #0000FF;
   background-color: #0000FF;
   border-width: 0;
   margin: 0;
   padding: 0;
   -moz-box-shadow: 6px 6px 2px #000000;
   -webkit-box-shadow: 6px 6px 2px #000000;
   box-shadow: 6px 6px 2px #000000;
}
#wb_Text16 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text16 div
{
   text-align: left;
}
#wb_Text17 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text17 div
{
   text-align: left;
}
#jQueryDatePicker6
{
   border: 1px #A9A9A9 solid;
   background-color: transparent;
   background-image: url(images/Informes_jQueryDatePicker6_bkgrnd.png);
   background-repeat: repeat-x;
   background-position: left top;
   color :#FFFFFF;
   font-family: "Bookman Old Style";
   font-weight: bold;
   font-style: italic;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
.ui-datepicker
{
   font-family: "Bookman Old Style";
   font-weight: normal;
   font-size: 13px;
   z-index: 1003 !important;
   display: none;
}
#Button3
{
   border: 1px #A9A9A9 solid;
   background-color: transparent;
   background-image: url(images/Informes_Button3_bkgrnd.png);
   background-repeat: repeat-x;
   background-position: left top;
   color: #FFFFFF;
   font-family: "Bookman Old Style";
   font-weight: bold;
   font-style: italic;
   font-size: 13px;
}
#Image23
{
   border: 0px #000000 solid;
   -webkit-animation: animate-fade-in 5000ms ease-in-out 0ms infinite alternate-reverse;
   -moz-animation: animate-fade-in 5000ms ease-in-out 0ms infinite alternate-reverse;
   -ms-animation: animate-fade-in 5000ms ease-in-out 0ms infinite alternate-reverse;
   animation: animate-fade-in 5000ms ease-in-out 0ms infinite alternate-reverse;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#Layer2
{
   background-color: #F5F5F5;
}
#wb_CssMenu1
{
   border: 0px #C0C0C0 solid;
   background-color: transparent;
}
#wb_CssMenu1 ul
{
   list-style-type: none;
   margin: 0;
   padding: 0;
   width: 138px;
}
#wb_CssMenu1 li
{
   float: left;
   margin: 0;
   padding: 0px 0px 4px 0px;
   width: 138px;
}
#wb_CssMenu1 a
{
   display: block;
   color: #FFFFFF;
   border: 1px #C0C0C0 solid;
   background-color: #48494A;
   background: -moz-linear-gradient(315deg,#000104 0%,#02070B 49%,#33373D 49%,#757A7C 92%,#A0A1A3 95%,#48494A 100%);
   background: -webkit-linear-gradient(315deg,#000104 0%,#02070B 49%,#33373D 49%,#757A7C 92%,#A0A1A3 95%,#48494A 100%);
   background: -o-linear-gradient(315deg,#000104 0%,#02070B 49%,#33373D 49%,#757A7C 92%,#A0A1A3 95%,#48494A 100%);
   background: -ms-linear-gradient(315deg,#000104 0%,#02070B 49%,#33373D 49%,#757A7C 92%,#A0A1A3 95%,#48494A 100%);
   background: linear-gradient(315deg,#000104 0%,#02070B 49%,#33373D 49%,#757A7C 92%,#A0A1A3 95%,#48494A 100%);
   font-family: "Trebuchet MS";
   font-weight: normal;
   font-size: 16px;
   font-style: normal;
   text-decoration: none;
   width: 126px;
   height: 26px;
   line-height: 26px;
   padding: 0px 5px 0px 5px;
   vertical-align: middle;
   text-align: center;
}
#wb_CssMenu1 li:hover a, #wb_CssMenu1 a:hover, #wb_CssMenu1 .active
{
   color: #FFFFFF;
   background-color: #000183;
   background: -moz-linear-gradient(315deg,#0046FE 0%,#000183 16%,#0046FE 30%,#000183 43%,#0046FE 58%,#000183 72%,#0046FE 86%,#000183 100%);
   background: -webkit-linear-gradient(315deg,#0046FE 0%,#000183 16%,#0046FE 30%,#000183 43%,#0046FE 58%,#000183 72%,#0046FE 86%,#000183 100%);
   background: -o-linear-gradient(315deg,#0046FE 0%,#000183 16%,#0046FE 30%,#000183 43%,#0046FE 58%,#000183 72%,#0046FE 86%,#000183 100%);
   background: -ms-linear-gradient(315deg,#0046FE 0%,#000183 16%,#0046FE 30%,#000183 43%,#0046FE 58%,#000183 72%,#0046FE 86%,#000183 100%);
   background: linear-gradient(315deg,#0046FE 0%,#000183 16%,#0046FE 30%,#000183 43%,#0046FE 58%,#000183 72%,#0046FE 86%,#000183 100%);
   border: 1px #C0C0C0 solid;
}
#wb_CssMenu1 .firstmain a
{
   margin-top: 0px;
}
#wb_CssMenu1 li.lastmain
{
   padding-bottom: 0px;
}
#wb_CssMenu1 li:hover, #wb_CssMenu1 li a:hover
{
   position: relative;
}
#wb_CssMenu1 a.withsubmenu
{
   padding: 0 5px 0 5px;
   width: 126px;
}
#wb_CssMenu1 li:hover a.withsubmenu, #wb_CssMenu1 a.withsubmenu:hover
{
}
#wb_CssMenu1 ul ul
{
   position: absolute;
   left: -9999px;
   top: -9999px;
   width: 100px;
   height: auto;
   border: none;
   background-color: transparent;
}
#wb_CssMenu1 ul :hover ul
{
   left: 138px;
   top: 0px;
   padding-top: 0px;
}
#wb_CssMenu1 .firstmain:hover ul
{
   top: 0px;
   padding-top: 0px;
}
#wb_CssMenu1 li li
{
   width: 100px;
   padding: 0 0px 0px 0px;
   border: 0px #C0C0C0 solid;
   border-width: 0 0px;
}
#wb_CssMenu1 li li.firstitem
{
   border-top: 0px #C0C0C0 solid;
}
#wb_CssMenu1 li li.lastitem
{
   border-bottom: 0px #C0C0C0 solid;
}
#wb_CssMenu1 ul ul a, #wb_CssMenu1 ul :hover ul a
{
   float: none;
   margin: 0;
   width: 86px;
   height: auto;
   white-space: normal;
   padding: 7px 6px 6px 6px;
   background-color: #AEBFCA;
   background: -moz-linear-gradient(225deg,#AEBFCA 0%,#AEBFCA 1%,#BCCDD7 5%,#87B6C0 7%,#408C9A 49%,#146478 50%,#54A1AA 93%,#9AC6CF 94%,#000000 100%);
   background: -webkit-linear-gradient(225deg,#AEBFCA 0%,#AEBFCA 1%,#BCCDD7 5%,#87B6C0 7%,#408C9A 49%,#146478 50%,#54A1AA 93%,#9AC6CF 94%,#000000 100%);
   background: -o-linear-gradient(225deg,#AEBFCA 0%,#AEBFCA 1%,#BCCDD7 5%,#87B6C0 7%,#408C9A 49%,#146478 50%,#54A1AA 93%,#9AC6CF 94%,#000000 100%);
   background: -ms-linear-gradient(225deg,#AEBFCA 0%,#AEBFCA 1%,#BCCDD7 5%,#87B6C0 7%,#408C9A 49%,#146478 50%,#54A1AA 93%,#9AC6CF 94%,#000000 100%);
   background: linear-gradient(225deg,#AEBFCA 0%,#AEBFCA 1%,#BCCDD7 5%,#87B6C0 7%,#408C9A 49%,#146478 50%,#54A1AA 93%,#9AC6CF 94%,#000000 100%);
   border: 1px #C0C0C0 solid;
   color: #FFFFFF;
   font-family: Arial;
   font-weight: normal;
   font-size: 13px;
   font-style: normal;
   line-height: 13px;
   text-align: left;
   text-decoration: none;
}
#wb_CssMenu1 ul :hover ul .firstitem a
{
   margin-top: 0px;
}
#wb_CssMenu1 ul ul :hover a, #wb_CssMenu1 ul ul a:hover, #wb_CssMenu1 ul ul :hover ul :hover a, #wb_CssMenu1 ul ul :hover ul a:hover
{
   background-color: #F85032;
   background: -moz-linear-gradient(225deg,#F85032 0%,#F16F5C 50%,#F6290C 50%,#F02F17 70%,#E73827 100%);
   background: -webkit-linear-gradient(225deg,#F85032 0%,#F16F5C 50%,#F6290C 50%,#F02F17 70%,#E73827 100%);
   background: -o-linear-gradient(225deg,#F85032 0%,#F16F5C 50%,#F6290C 50%,#F02F17 70%,#E73827 100%);
   background: -ms-linear-gradient(225deg,#F85032 0%,#F16F5C 50%,#F6290C 50%,#F02F17 70%,#E73827 100%);
   background: linear-gradient(225deg,#F85032 0%,#F16F5C 50%,#F6290C 50%,#F02F17 70%,#E73827 100%);
   border: 1px #C0C0C0 solid;
   color: #FFFFFF;
}
#wb_CssMenu1 br
{
   clear: both;
   font-size: 1px;
   height: 0;
   line-height: 0;
}
#Layer1
{
   background-color: transparent;
   background-image: url(images/Informes_Layer1_bkgrnd.png);
   background-repeat: repeat-x;
   background-position: left top;
}
#Image2
{
   border: 0px #000000 solid;
   -moz-box-shadow: 4px 4px 10px #000000;
   -webkit-box-shadow: 4px 4px 10px #000000;
   box-shadow: 4px 4px 10px #000000;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
#wb_Form1
{
   background-color: transparent;
   border: 0px #000000 solid;
}
#jQueryDatePicker1
{
   border: 1px #A9A9A9 solid;
   background-color: transparent;
   background-image: url(images/Informes_jQueryDatePicker1_bkgrnd.png);
   background-repeat: repeat-x;
   background-position: left top;
   color :#FFFFFF;
   font-family: "Bookman Old Style";
   font-weight: bold;
   font-style: italic;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
.ui-datepicker
{
   font-family: "Bookman Old Style";
   font-weight: normal;
   font-size: 13px;
   z-index: 1003 !important;
   display: none;
}
#wb_Text1 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text1 div
{
   text-align: left;
}
#wb_Text2 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text2 div
{
   text-align: left;
}
#Line1
{
   color: #0000FF;
   background-color: #0000FF;
   border-width: 0;
   margin: 0;
   padding: 0;
   -moz-box-shadow: 6px 6px 2px #000000;
   -webkit-box-shadow: 6px 6px 2px #000000;
   box-shadow: 6px 6px 2px #000000;
}
#wb_Text3 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text3 div
{
   text-align: left;
}
#wb_Text4 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   margin: 0;
   text-align: left;
}
#wb_Text4 div
{
   text-align: left;
}
#jQueryDatePicker2
{
   border: 1px #A9A9A9 solid;
   background-color: transparent;
   background-image: url(images/Informes_jQueryDatePicker2_bkgrnd.png);
   background-repeat: repeat-x;
   background-position: left top;
   color :#FFFFFF;
   font-family: "Bookman Old Style";
   font-weight: bold;
   font-style: italic;
   font-size: 13px;
   text-align: left;
   vertical-align: middle;
}
.ui-datepicker
{
   font-family: "Bookman Old Style";
   font-weight: normal;
   font-size: 13px;
   z-index: 1003 !important;
   display: none;
}
#Button1
{
   border: 1px #A9A9A9 solid;
   background-color: transparent;
   background-image: url(images/Informes_Button1_bkgrnd.png);
   background-repeat: repeat-x;
   background-position: left top;
   color: #FFFFFF;
   font-family: "Bookman Old Style";
   font-weight: bold;
   font-style: italic;
   font-size: 13px;
}
#Image1
{
   border: 0px #000000 solid;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
}
</style>
<script type="text/javascript" src="jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="jquery.ui.core.min.js"></script>
<script type="text/javascript" src="jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="jquery.ui.mouse.min.js"></script>
<script type="text/javascript" src="jquery.ui.sortable.min.js"></script>
<script type="text/javascript" src="jquery.ui.tabs.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker.min.js"></script>
<script type="text/javascript" src="jquery.ui.datepicker-es.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
   var jQueryTabs1Opts =
   {
      show: false,
      event: 'click',
      collapsible: true
   };
   $("#jQueryTabs1").tabs(jQueryTabs1Opts).find(".ui-tabs-nav").sortable();
   var jQueryDatePicker3Opts =
   {
      dateFormat: 'yy-mm-dd',
      changeMonth: false,
      changeYear: false,
      showButtonPanel: false,
      showAnim: 'slideDown'
   };
   $("#jQueryDatePicker3").datepicker(jQueryDatePicker3Opts);
   $("#jQueryDatePicker3").datepicker("setDate", "new Date()");
   $("#jQueryDatePicker3").datepicker("option", $.datepicker.regional['es']);
   var jQueryDatePicker4Opts =
   {
      dateFormat: 'yy-mm-dd',
      changeMonth: false,
      changeYear: false,
      showButtonPanel: false,
      showAnim: 'slideDown'
   };
   $("#jQueryDatePicker4").datepicker(jQueryDatePicker4Opts);
   $("#jQueryDatePicker4").datepicker("setDate", "new Date()");
   $("#jQueryDatePicker4").datepicker("option", $.datepicker.regional['es']);
   var jQueryDatePicker5Opts =
   {
      dateFormat: 'yy-mm-dd',
      changeMonth: false,
      changeYear: false,
      showButtonPanel: false,
      showAnim: 'slideDown'
   };
   $("#jQueryDatePicker5").datepicker(jQueryDatePicker5Opts);
   $("#jQueryDatePicker5").datepicker("setDate", "new Date()");
   $("#jQueryDatePicker5").datepicker("option", $.datepicker.regional['es']);
   var jQueryDatePicker6Opts =
   {
      dateFormat: 'yy-mm-dd',
      changeMonth: false,
      changeYear: false,
      showButtonPanel: false,
      showAnim: 'slideDown'
   };
   $("#jQueryDatePicker6").datepicker(jQueryDatePicker6Opts);
   $("#jQueryDatePicker6").datepicker("setDate", "new Date()");
   $("#jQueryDatePicker6").datepicker("option", $.datepicker.regional['es']);
   var jQueryDatePicker1Opts =
   {
      dateFormat: 'yy-mm-dd',
      changeMonth: false,
      changeYear: false,
      showButtonPanel: false,
      showAnim: 'slideDown'
   };
   $("#jQueryDatePicker1").datepicker(jQueryDatePicker1Opts);
   $("#jQueryDatePicker1").datepicker("setDate", "new Date()");
   $("#jQueryDatePicker1").datepicker("option", $.datepicker.regional['es']);
   var jQueryDatePicker2Opts =
   {
      dateFormat: 'yy-mm-dd',
      changeMonth: false,
      changeYear: false,
      showButtonPanel: false,
      showAnim: 'slideDown'
   };
   $("#jQueryDatePicker2").datepicker(jQueryDatePicker2Opts);
   $("#jQueryDatePicker2").datepicker("setDate", "new Date()");
   $("#jQueryDatePicker2").datepicker("option", $.datepicker.regional['es']);
});
</script>
<script language="JavaScript"> 
function pregunta(){ 
    if (confirm('¿Estas seguro que deseas ingresar el empleado?')){ 
       document.FormSubirHoja.submit() 
      
    } 
} 
</script> 
</head>
<body>
<div id="jQueryTabs1" style="position:absolute;left:159px;top:64px;width:950px;z-index:65;">
<ul>
<li><a href="#jquerytabs1-page-0"><span>Movimiento de Cuentas</span></a></li>
<li><a href="#jquerytabs1-page-1"><span>Balance General</span></a></li>
<li><a href="#jquerytabs1-page-2"><span>Informe Ventas</span></a></li>
</ul>
<div style="height:594px;overflow:auto;padding:0;" id="jquerytabs1-page-0">
<div id="wb_Form2" style="position:absolute;left:58px;top:311px;width:772px;height:250px;z-index:9;">
<form name="Form1" method="post" action="tcpdf/examples/imprimamovimiento.php" enctype="multipart/form-data" target="_blank" id="Form2">
<input type="text" id="jQueryDatePicker3" style="position:absolute;left:231px;top:92px;width:88px;height:18px;line-height:18px;z-index:0;" name="TxtFechaIni" value="2014-05-30">
<div id="wb_Text9" style="position:absolute;left:126px;top:94px;width:102px;height:16px;z-index:1;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Fecha Inicial</em></strong></span></div>
<div id="wb_Text10" style="position:absolute;left:217px;top:61px;width:323px;height:16px;z-index:2;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Seleccione el rango de fecha para el reporte</em></strong></span></div>
<hr id="Line2" style="position:absolute;left:95px;top:32px;width:566px;height:5px;z-index:3;">
<div id="wb_Text11" style="position:absolute;left:306px;top:6px;width:152px;height:32px;z-index:4;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Imprimir Movimientos</em></strong></span></div>
<div id="wb_Text12" style="position:absolute;left:412px;top:95px;width:102px;height:16px;z-index:5;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Fecha Final</em></strong></span></div>
<input type="text" id="jQueryDatePicker4" style="position:absolute;left:514px;top:93px;width:88px;height:18px;line-height:18px;z-index:6;" name="TxtFechaFinal" value="2014-05-30">
<input type="submit" id="Button2" name="" value="Imprimir reporte" style="position:absolute;left:11px;top:183px;width:744px;height:36px;z-index:7;">
<div id="Html3" style="position:absolute;left:279px;top:130px;width:210px;height:42px;z-index:8">
<?php

$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");

print(" <select name=CmbCentroCostos size=1 id=CmbCentroCostos>
	<option value=ALL>Completo</option>");
	
	
$reg = mysql_query("SELECT * FROM `servicio` ",$con) or die("La consulta a cuentasfrecuentes es erronea.".mysql_error());


if(mysql_num_rows($reg)){//Si existen resultados
   
   while($datos=mysql_fetch_array($reg)){
      echo "<option value= $datos[id]>$datos[nombre]</option>";
   }

}


echo '</select><br>';
?></div>
</form>
</div>
<div id="wb_Image3" style="position:absolute;left:232px;top:61px;width:393px;height:242px;z-index:10;">
<img src="images/img0059.png" id="Image3" alt=""></div>
</div>
<div style="height:594px;overflow:auto;padding:0;" id="jquerytabs1-page-1">
<div id="wb_Image5" style="position:absolute;left:268px;top:66px;width:288px;height:211px;z-index:20;">
<img src="images/img0084.png" id="Image5" alt=""></div>
<div id="wb_Form3" style="position:absolute;left:30px;top:302px;width:772px;height:264px;z-index:21;">
<form name="FormBalanceComprobacion" method="post" action="tcpdf/examples/balancecomprobacion.php" enctype="multipart/form-data" target="_blank" id="Form3">
<input type="text" id="jQueryDatePicker5" style="position:absolute;left:231px;top:92px;width:88px;height:18px;line-height:18px;z-index:11;" name="TxtFechaIni" value="2014-05-30">
<div id="wb_Text14" style="position:absolute;left:126px;top:94px;width:102px;height:16px;z-index:12;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Fecha Inicial</em></strong></span></div>
<div id="wb_Text15" style="position:absolute;left:217px;top:61px;width:323px;height:16px;z-index:13;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Seleccione el rango de fecha para el reporte</em></strong></span></div>
<hr id="Line3" style="position:absolute;left:95px;top:32px;width:566px;height:5px;z-index:14;">
<div id="wb_Text16" style="position:absolute;left:285px;top:8px;width:255px;height:16px;z-index:15;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Imprimir Balance de Comprobacion</em></strong></span></div>
<div id="wb_Text17" style="position:absolute;left:412px;top:95px;width:102px;height:16px;z-index:16;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Fecha Final</em></strong></span></div>
<input type="text" id="jQueryDatePicker6" style="position:absolute;left:514px;top:93px;width:88px;height:18px;line-height:18px;z-index:17;" name="TxtFechaFinal" value="2014-05-30">
<input type="submit" id="Button3" name="" value="Imprimir reporte" style="position:absolute;left:9px;top:196px;width:744px;height:36px;z-index:18;">
<div id="Html1" style="position:absolute;left:276px;top:144px;width:210px;height:42px;z-index:19">
<?php

$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");

print(" <select name=CmbCentroCostos size=1 id=CmbCentroCostos>
	<option value=ALL>Completo</option>");
	
	
$reg = mysql_query("SELECT * FROM `servicio` ",$con) or die("La consulta a cuentasfrecuentes es erronea.".mysql_error());


if(mysql_num_rows($reg)){//Si existen resultados
   
   while($datos=mysql_fetch_array($reg)){
      echo "<option value= $datos[id]>$datos[nombre]</option>";
   }

}


echo '</select><br>';
?></div>
</form>
</div>
</div>
<div style="height:594px;overflow:auto;padding:0;" id="jquerytabs1-page-2">
<div id="wb_Form1" style="position:absolute;left:39px;top:259px;width:772px;height:234px;z-index:31;">
<form name="FormReporteFacturacion" method="post" action="tcpdf/examples/imprimareportefacturacion.php" enctype="multipart/form-data" target="_blank" id="Form1">
<input type="text" id="jQueryDatePicker1" style="position:absolute;left:231px;top:92px;width:88px;height:18px;line-height:18px;z-index:22;" name="TxtFechaIniFact" value="2015-09-23">
<div id="wb_Text1" style="position:absolute;left:126px;top:94px;width:102px;height:16px;z-index:23;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Fecha Inicial</em></strong></span></div>
<div id="wb_Text2" style="position:absolute;left:217px;top:61px;width:323px;height:16px;z-index:24;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Seleccione el rango de fecha para el reporte</em></strong></span></div>
<hr id="Line1" style="position:absolute;left:95px;top:32px;width:566px;height:5px;z-index:25;">
<div id="wb_Text3" style="position:absolute;left:285px;top:8px;width:255px;height:16px;z-index:26;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Imprimir Reporte de Facturación</em></strong></span></div>
<div id="wb_Text4" style="position:absolute;left:412px;top:95px;width:102px;height:16px;z-index:27;text-align:left;">
<span style="color:#0000FF;font-family:'Bookman Old Style';font-size:13px;"><strong><em>Fecha Final</em></strong></span></div>
<input type="text" id="jQueryDatePicker2" style="position:absolute;left:514px;top:91px;width:88px;height:18px;line-height:18px;z-index:28;" name="TxtFechaFinalFact" value="2015-09-23">
<input type="submit" id="Button1" name="BtnReporFact" value="Imprimir reporte" style="position:absolute;left:13px;top:182px;width:744px;height:36px;z-index:29;">
<div id="Html4" style="position:absolute;left:285px;top:131px;width:210px;height:42px;z-index:30">
<?php

$con=mysql_connect($host,$user,$pw) or die("problemas con el servidor");
mysql_select_db($db,$con) or die("la base de datos no abre");

print(" <select name=CmbCentroCostos size=1 id=CmbCentroCostos>
	<option value=ALL>Completo</option>");
	
	
$reg = mysql_query("SELECT * FROM `servicio` ",$con) or die("La consulta a cuentasfrecuentes es erronea.".mysql_error());


if(mysql_num_rows($reg)){//Si existen resultados
   
   while($datos=mysql_fetch_array($reg)){
      echo "<option value= $datos[id]>$datos[nombre]</option>";
   }

}


echo '</select><br>';
?></div>
</form>
</div>
<div id="wb_Image1" style="position:absolute;left:324px;top:48px;width:211px;height:211px;z-index:32;">
<img src="images/img0065.png" id="Image1" alt=""></div>
</div>
</div>
<div id="Layer2" style="position:absolute;text-align:right;left:0px;top:0px;width:159px;height:100%;z-index:66;">
<div id="Layer2_Container" style="width:159px;position:relative;margin-left:auto;margin-right:0;text-align:left;">
<div id="wb_CssMenu1" style="position:absolute;left:6px;top:189px;width:138px;height:455px;z-index:51;">
<ul>
<li class="firstmain"><a href="./Menu.php" target="_self">Menu</a>
</li>
<li><a href="./Administrar.php" target="_self">Administrar</a>
</li>
<li><a href="./Cartera.php" target="_self">Cartera</a>
</li>
<li><a class="withsubmenu" href="./Ingresos.php" target="_self">Ingresos</a>

<ul>
<li class="firstitem lastitem"><a href="./Rendimientos.php" target="_self">Rendimientos</a>
</li>
</ul>
</li>
<li><a href="./Egresos2.php" target="_self">Egresos</a>
</li>
<li><a href="./PagarCuentas.php" target="_self">CuentasXPagar</a>
</li>
<li><a class="withsubmenu" href="./Inventarios2.php" target="_self">Inventarios</a>

<ul>
<li class="firstitem"><a href="./Baja.php" target="_self">Bajas</a>
</li>
<li><a href="./SincPrecios.php" target="_self">Sincronizar</a>
</li>
<li><a href="./PrintBarras.php" target="_self">Barras</a>
</li>
<li class="lastitem"><a href="./kits.php" target="_self">Bajas</a>
</li>
</ul>
</li>
<li><a class="active" href="./Informes.php" target="_self">Informes</a>
</li>
</ul>
<br>
</div>
<div id="wb_Image2" style="position:absolute;left:17px;top:92px;width:115px;height:62px;z-index:52;">
<img src="images/tslogo.png" id="Image2" alt=""></div>
</div>
</div>
<div id="Layer1" style="position:absolute;text-align:left;left:0px;top:0px;width:115%;height:64px;z-index:67;">
<div id="wb_Image23" style="position:absolute;left:981px;top:1px;width:125px;height:50px;z-index:53;">
<a href="http://www.technosoluciones.com" target="_blank"><img src="images/header-logo.png" id="Image23" alt=""></a></div>
<div id="Html2" style="position:absolute;left:6px;top:18px;width:627px;height:33px;z-index:54">
<?php

$usuario =$_SESSION['username'];
$nombre =$_SESSION['nombre'];
$apellido =$_SESSION['apellido'];
$tipo =$_SESSION['tipouser'];
echo "<em>Bienvenid@ a SoftConTech $nombre $apellido, qué deseas hacer?</em>";			
?></div>
<div id="wb_JavaScript2" style="position:absolute;left:654px;top:22px;width:191px;height:28px;z-index:55;">
<div style="color:#000000;font-size:10px;font-family:Arial;font-weight:normal;font-style:normal;text-align:left;text-decoration:none" id="copyrightnotice"></div>
<script type="text/javascript">
   var now = new Date();
   var startYear = "2006";
   var text =  "Copyright &copy; ";
   if (startYear != '')
   {
      text = text + startYear + "-";
   }
   text = text + now.getFullYear() + ", Techno Soluciones. All rights reserved. info@technosoluciones.com";
   var copyrightnotice = document.getElementById('copyrightnotice');
   copyrightnotice.innerHTML = text;
</script>


</div>
</div>
</body>
</html>