<?php 

require __DIR__.'/vendor/autoload.php';

define('TITLE', 'Cadastrar Vaga');
use \App\Entity\Vaga;
$obVaga = new Vaga();// nova instancia

//validar se os itens chegaram corretamente
if(isset($_POST['titulo'],$_POST['descricao'], $_POST['ativo'])){
   //gerenciamento de cadastro
   
   $obVaga->titulo = $_POST['titulo'];
   $obVaga->descricao = $_POST['descricao'];
   $obVaga->ativo = $_POST['ativo'];
   
   // echo "<pre>"; print_r($obVaga); echo "</pre>"; exit;

   $obVaga->cadastrar();

   header('Location: index.php?status=success');
   exit;

}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';
