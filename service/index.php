<?php
session_start();
require_once "cliente.php";
require_once "divida.php";
$cliente = new Cliente();
$divida = new Divida();

if(isset($_REQUEST['_method'])  ){
   $_method = $_REQUEST['_method'];
    if($_REQUEST['_action'] =='cliente'){
        switch ($_method) {
            case 'delete':
                 $id = $_GET['id'];
                 $cliente->delete($id);
             break;
             case 'POST':
                 $cliente->post();
                 break;
             case 'PUT':           
                 $cliente->put(); 
             break;

        }
    }

    if($_REQUEST['_action'] =='divida'){
        
        switch ($_method) {
            case 'delete':
                 $id = $_GET['id'];
                 $divida->delete($id);
             break;
             case 'POST':
                 $divida->post();
                 break;
             case 'PUT':           
                 $divida->put(); 
             break;

        }
    }

 
}



?>