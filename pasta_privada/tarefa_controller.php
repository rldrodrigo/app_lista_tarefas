<?php

//Lembrando que é necessário colocar o caminho a partidr do tarefa_controller que está na pasta pública

require "./pasta_privada/tarefa.model.php";
require "./pasta_privada/tarefa.service.php";
require "./pasta_privada/conexao.php";

$tarefa = new Tarefa();
$tarefa->__set('tarefa', $_POST['tarefa']);

$conexao = new Conexao();

$tarefaService = new TarefaService($conexao, $tarefa);

$tarefaService->inserir();

header('Location: nova_tarefa.php?inclusao=1');
