<?php 

require __DIR__.'/vendor/autoload.php';

define('TITLE', 'Editar Vaga');
use \App\Entity\Vaga;

//Validação do id
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
   header("Location: index.php?status=error ");
   exit;
}

//Consulta vaga
$obVaga =  Vaga::getVaga($_GET['id']);
// validação da vaga
 if(!$obVaga instanceof Vaga){
   header("Location: index.php?status=error ");
   exit;
 }

//validar se os itens chegaram corretamente
if(isset($_POST['titulo'],$_POST['descricao'], $_POST['ativo'])){
   //gerenciamento de cadastro
     
   $obVaga->titulo = $_POST['titulo'];
   $obVaga->descricao = $_POST['descricao'];
   $obVaga->ativo = $_POST['ativo'];
   // echo "<pre>"; print_r($obVaga); echo "</pre>"; exit;
   $obVaga->atualizar();
   


   header('Location: index.php?status=success');
   exit;

}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';
