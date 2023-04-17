<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Vaga {

    /*
    identificadr unic da vagas
    * @var integer
    */
    public $id; 
    /*
    Titulo da Vaga
    @var string
    */ 
    public $titulo;
    /*
    Descrição da vaga(pode conter html)
    @var string
    */
    public $descricao;
     /*
    Define se a vaga está ativa
    * @var string(s/n)
    */
    public $ativo;
     /*
    Data de publicação da vaga
    @var string
    */
    public $data;

    /*
    Método responsável por cadastrar uma nova vaga no banco
    @retorn boolean
    */
    public function cadastrar(){
        // Definir a data
        $this->data = date('Y-m-d H:i:s');

        //Inserir a vaga no banco
        $obDataBase = new Database('vagas');
        $this->id = $obDataBase->insert([
                            'titulo' => $this->titulo,
                            'descricao' => $this->descricao,
                            'ativo' => $this->ativo,
                            'data' => $this->data
                        ]);
            //    echo "<pre>"; print_r($this); echo "</pre>"; exit;  //debug
        //Retornar sucesso.
        return true;
    }

    public function atualizar() {
        return (new Database('vagas'))->update('id = '. $this->id, [
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'ativo' => $this->ativo,
            'data' => $this->data
        ]);
    }

    public function excluir() {
        return (new Database('vagas'))->delete('id = '. $this->id);
    }

    //Metodo responsavel pelo retorno das vagas
    public static function getVagas($where = null, $order = null, $limit = null) {
        return (new Database('vagas'))->select($where,$order,$limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function getVaga($id) {
        return (new Database('vagas'))->select('id = '.$id)->fetchObject(self::class);
    }

    
}