<?php

namespace App\Db;

use \PDO;
use \PDOException;

class Database {
     
    const HOST = 'localhost';
    const NAME = 'wdev_vagas';
    const USER = 'root';
    CONST PASS = '';

    // nome da tabela a ser manipulada
    private $table;

    //instancia de conexão com o banco de dados
    
    private $connection;
    
    // Define a tabela
    public function __construct($table = null) {
        $this->table = $table;
        $this->setConnection();
    }


    //Metodo responsavel por criar uma conexão com o banco
    private function setConnection() {

        try {
            $this->connection =new PDO('mysql:host='.self::HOST.';dbname='.self::NAME, self::USER, self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //configurando o banco para caso aconteceça algum problema, ele pare na hora
        }catch(PDOException $e) {
            die('Error: ' . $e->getMessage());
        }

    }

    //Metodo por executar querys dentro do banco de dados
    public function execute($query, $params = []) {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        }catch(PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    //Inserção dados no banco
    public function insert($values){
        //Dados da query
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');
        // echo "<pre>"; print_r($binds); echo "</pre>"; exit;  //debug

        //monta a query
        $query = 'INSERT INTO '.$this->table.' ('.implode(',', $fields).') VALUES ('.implode(",", $binds).')';
        //Executa o insert
        $this->execute($query,array_values($values));
        //retorna o id inserido
        return $this->connection->lastInsertId();
        

    }

    //Metodo responsavel por consulta no banco
    public function select($where = null, $order = null, $limit = null, $fields =  '*') {
        // Dados da Query
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';
        
        $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit.' ';
        return $this->execute($query);
    }

    public function update($where, $values) {
        //dados da query
        $fields = array_keys($values);

        //montar query
        $query = 'UPDATE '.$this->table. ' SET ' . implode('=?,',$fields) .'=? WHERE ' .$where;
        
        $this->execute($query, array_values($values));
        return true;
    }

    public function delete($where) {
        $query = 'DELETE FROM ' .$this->table. ' WHERE ' . $where;

        $this->execute($query);
        //Retorna sucesso
        return true;
    }

}


?>