<?php

//CRUD
class TarefaService
{
    private $conexao;
    private $tarefa;

    //Recurso de segurança tipagem do parâmetro que está sendo recebido
    public function __construct(Conexao $conexao, Tarefa $tarefa)
    {
        $this->conexao = $conexao->conectar();
        $this->tarefa = $tarefa;
    }

    public function inserir()
    { //create
        $query = 'INSERT INTO tb_tarefas(tarefa) VALUES (:tarefa)';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->execute();
    }

    public function recuperar()
    { //read
        $query = 'SELECT 
                    t.id, s.status, t.tarefa 
                FROM 
                    tb_tarefas as t
                    LEFT JOIN tb_status as s on (t.id_status = s.id)
                    ';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function atualizar()
    { //update
        $query = 'UPDATE tb_tarefas SET tarefa = :tarefa WHERE id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->bindValue(':id', $this->tarefa->__get('id'));

        /**
         *  É possível utilizar interrogação (?) no lugar de :tarefa e de :id, e colocar o numero ordincal no bindValue
         *  $query = 'UPDATE tb_tarefas SET tarefa = ? WHERE id = ?';
         *  $stmt->bindValue(1, $this->tarefa->__get('tarefa'));
         *  $stmt->bindValue(2, $this->tarefa->__get('id'));
         */

        return $stmt->execute();
    }

    public function remover()
    { //delete
        $query = 'DELETE FROM tb_tarefas WHERE id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id', $this->tarefa->__get('id'));
        $stmt->execute();
    }

    public function marcarRealizada()
    { //update status
        $query = 'UPDATE tb_tarefas SET id_status = :id_status WHERE id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
        $stmt->bindValue(':id', $this->tarefa->__get('id'));

        return $stmt->execute();
    }
}
