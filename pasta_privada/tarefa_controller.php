<?php

//Lembrando que é necessário colocar o caminho a partidr do tarefa_controller que está na pasta pública

require "./pasta_privada/tarefa.model.php";
require "./pasta_privada/tarefa.service.php";
require "./pasta_privada/conexao.php";

$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if ($acao == 'inserir') {

    $tarefa = new Tarefa();
    $tarefa->__set('tarefa', $_POST['tarefa']);

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);

    $tarefaService->inserir();

    header('Location: nova_tarefa.php?inclusao=1');
} else if ($acao == 'recuperar') {

    $tarefa = new Tarefa();
    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);

    $tarefas = $tarefaService->recuperar();
} else if ($acao == 'atualizar') {

    $tarefa = new Tarefa();
    $tarefa->__set('id', $_POST['id']);
    $tarefa->__set('tarefa', $_POST['tarefa']);

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);

    if ($tarefaService->atualizar()) {
        //Seria possível através do GET passa um parâmetro e exibir uma mensagem de confirmação
        header('Location:todas_tarefas.php');
    } else {
        //Seria possível através do GET passa um parâmetro e exibir uma mensagem de erro
        //header('Location:todas_tarefas.php');
    }
} else if ($acao == 'remover') {
    $tarefa = new Tarefa();
    $tarefa->__set('id', $_GET['id']);

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->remover();

    header('Location:todas_tarefas.php');
} else if ($acao == 'marcarRealizada') {

    $tarefa = new Tarefa();
    $tarefa->__set('id', $_GET['id']);
    $tarefa->__set('id_status', 2);

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->marcarRealizada();

    header('Location:todas_tarefas.php');
}
