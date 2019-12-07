<?php

$router->get('/voluntarios/cadastrar/{nome}/{email}/{cpf}/{telefone}/{ra}/{curso}', function ($nome, $email, $cpf, $telefone, $ra, $curso) {
    $voluntario = (object) [
        'codVoluntario' => 1
    ];
    return json_encode($voluntario);
});

$router->get('/voluntarios/alterar/{codvoluntario}/{nome}/{email}/{cpf}/{telefone}/{ra}/{curso}', function ($codvoluntario, $nome, $email, $cpf, $telefone, $ra, $curso) {
    $voluntario = array(
        'codVoluntario' => $codvoluntario,
        'nome' => $nome,
        'email' => $email,
        'cpf' => $cpf,
        'telefone' => $telefone,
        'ra' => $ra,
        'curso' => $curso
    );
    return json_encode($voluntario);
});

$router->get('/voluntarios/listar', function () {
    $voluntarios = array(
        array(
            'codVoluntario' => 1, 'nome' => 'Teste', 'email' => 'uniarp1@uniarp.com', 'cpf' => 05335653025,
            'telefone' => '4998349562', 'ra' => 025377, 'curso' => 'Sistemas'
        ),
        array(
            'codVoluntario' => 2, 'nome' => 'Teste 2', 'email' => 'uniarp2@uniarp.com', 'cpf' => 01212312312,
            'telefone' => '4998349562', 'ra' => 025317, 'curso' => 'Sistemas'
        )
    );
    return json_encode($voluntarios);
});

$router->get('/voluntarios/excluir/{codVoluntario}', function ($codVoluntario) {
    $status = (object) [
        'status' => true
    ];
    return json_encode($status);
});

$router->get('/validador/validarDocumento/{token}', function ($token) {
    $tokenDados = (object) [
        'participante' => 'Maurício da Silva',
        'data' => '2019/05/21',
        'evento' => 'Sedepex',
        'numeroHoras' => '6'
    ];
    return json_encode($tokenDados);
});

$router->get('/documentos/listar/{filtros}', function ($filtros) {
    $documentos = array(
        array(
            'codDocumento' => 1, 'codParticipante' => 1, 'nome' => 'Teste', 'cpf' => '08302158999', 'tipo' => 'Certificado', 'numeroHoras' => '12'
        ),
        array(
            'codDocumento' => 2, 'codParticipante' => 1, 'nome' => 'Teste 2', 'cpf' => '03241158999', 'tipo' => 'Declaracao', 'numeroHoras' => '15'
        )
    );
    return json_encode($documentos);
});

$router->get('/documentos/gerar/{codigoInscricao}', function ($codigoInscricao) {
    $documento = (object) [
        'codDocumento' => 1
    ];
    return json_encode($documento);
});

/* OPA OPA MEU CONSAGRADO */

$router->get('/evento/listar/{filtro}/{valor}', function ($filro, $valor) {
    return 'status:true';
});

$router->get('/evento/visulizar/{codigoEvento}', function ($codigoEvento) {
    $evento = (object) [
        'codigoEvento' => $codigoEvento,
        'titulo' => "Teste",
        'qtoMinInscritos' => 5,
        'status' => "Aberto"
    ];
    return json_encode($evento);
});

$router->get('/participante/inscricao/{codigoParticipante}/{codigoAtividade}',function($codigoParticipante,$codigoAtividade){
    $participante = (object) [
        'codInscricao' => 1
    ];
    return json_encode($participante);
});

$router->get('/validar/{chave}', function ($chave) {
    if ($chave === "mestre") {
        return '{status:true}';
    }
    return '{status:false}';
});


$router->get('/participantes/login/{cpf}/{senha}', function ($cpf, $senha) {
    $participante = (object) [
        'status'=> true
    ];
    return json_encode($participante); 
});

$router->get('/participantes/cadastro/{nome}/{cpf}/{senha}/{telefone}/{email}/{ra}', function ($nome, $cpf, $senha, $telefone, $email, $ra) {
    return;
});

$router->get('/participantes/cancelarInscricao/{codigoInscricao}', function ($codigoInscricao) {
    return;
});

$router->get('/participantes/ingresso/{codigoInscricao}', function ($codigoInscricao) {
    return;
});

$router->get('/palestrantes/cadastrar/{nome}/{cpf}/{telefone}/{email}/{biografia}/{areaAtuacao}', function ($nome, $cpf, $telefone, $email, $biografia, $areaAtuacao) {
    return;
});

$router->get('/palestrantes/alterar/{codigoPalestrante}/{mudancas}', function ($codigoPalestrante, $mudancas) {
    return;
});

$router->get('/palestrantes/visualizar/{codigoPalestrante}/', function ($codigoPalestrante) {
    return;
});

$router->get('/palestrantes/listar/{filtros}/', function ($filtros) {
    return;
});

$router->get('/participantes/excluir/{codigoPalestrante}/', function ($codigoPalestrante) {
    return;
});

$router->get('/eventos/listar/{filtros}/', function ($filtros) {
    return;
});

$router->get('/eventos/listarInscritos/{filtros}/', function ($filtros) {
    return;
});

$router->get('/eventos/detalhesInscrito/{filtros}/', function ($filtros) {
    return;
});

$router->get('/eventos/cadastrar/{titulo}/{periodoInicial}/{periodoFinal}/{dtIncricaoInicio}/{dtIncricaoFim}/{qtdMinInscritos}/{qtdMaxInscritos}/{modeloDoc}/{area}/{equipe}/{atividades}', function ($titulo, $periodoInicial, $periodoFinal, $dtIncricaoInicio, $dtIncricaoFim, $qtdMinInscritos, $qtdMaxInscritos, $modeloDoc, $area, $equipe, $atividades) {
    return;
});

$router->get('/eventos/alterar/{codigoEvento}/{mudancas}/', function ($codigoEvento, $mudancas) {
    return;
});

$router->get('/eventos/excluir/{codigoEvento}/', function ($codigoEvento) {
    return;
});

$router->get('/eventos/cancelar/{codigoEvento}/', function ($codigoEvento) {
    return ;  
});
