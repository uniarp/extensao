<?php

$router->get('/voluntarios/cadastrar/{nome}/{email}/{cpf}/{telefone}/{ra}/{curso}', function ($nome, $email, $cpf, $telefone, $ra, $curso) {
<<<<<<< Updated upstream
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
=======
    return true;
});

$router->get('/voluntarios/alterar/{nome}/{email}/{cpf}/{telefone}/{ra}/{curso}', function ($nome, $email, $cpf, $telefone, $ra, $curso) {
    return true;
});

$router->get('/voluntarios/listar', function () {
    return true;
});

$router->get('/voluntarios/excluir/{codVoluntario}', function ($codVoluntario) {
    return true;
});

$router->get('/validador/validarDocumento/{token}', function ($token) {
    return true;
});

$router->get('/documentos/listar/{filtros}', function ($filtros) {
    return true;
});

$router->get('/documentos/gerar/{codigoInscricao}', function ($codigoInscricao) {
    return true;
});

$router->get('/validador/validarDocumento/{token}', function ($token) {
    return true;
});


$router->get('/evento/listar/{filtro}/{valor}',function($filro,$valor){
    return'status:true';
});

$router->get('/evento/visualizar/{codigoEvento}',function($codigoEvento){
>>>>>>> Stashed changes
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

<<<<<<< Updated upstream
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
=======
$router->get('/eventos/listarEvento/{codEvento}/', function ($codEvento) {
    $evento = (object) [
        'codEvento'=> $codEvento,
        'titulo'=> 'Teste 2',
        'periodoInicial'=> '2020-10-10',
        'periodoFinal'=> '2020-10-15',
        'inscricaoInicio'=> '2020-09-20',
        'inscricaoFim'=> '2020-10-05',
        'qtdMinInscrito'=> 5,
        'status'=> 'Aberto',
        'qtdMaxInscrito'=> 20,
        'modelDoc'=> 'https;//modeloSead.png',
        'area' => ['Engenharia', 'Direiro'],
        'equipe' => ['Mauricio','Delmison','Gabriel'],
        'atividades' => ['Abertura', 'Palestra', 'Fechamento']

    ];

    

    return json_encode($evento);
});

$router->get('/eventos/listarInscritos/{filtros}/', function ($filtros) {
    $inscritos = array(
        array(
            'codInscrito'=> 1,
            'Nome'=> 'Gabriel Soares',
            'email'=> 'uniarp1@uniarp.com',
            'cpf'=> '05335653025',
            'telefone'=> '4998349562',
            'senha'=> 'senha123',
            'ra'=> '025960'),
        array(
            'codInscrito' => 123,
            'nome' => 'Daniel Conte',
            'email' => 'uniarp1@uniarp.com',
            'cpf' => '053111122',
            'telefone' => '4998349562',
            'senha' => 'senha321',
            'ra' => null
        )
    );

    return json_encode($inscritos); 

});

$router->get('/eventos/detalhesInscrito/{codInscrito}/', function ($codInscrito) {
    $inscrito = (object) [
        'codInscrito'=> $codInscrito,
        'Nome'=> 'Gabriel Soares',
        'email'=> 'uniarp1@uniarp.com',
        'cpf'=> '05335653025',
        'telefone'=> '4998349562',
        'senha'=> 'senha123',
        'ra'=> '025960'
    ];

    return json_encode($inscrito); 
});

$router->get('/eventos/cadastrar/{titulo}/{periodoInicial}/{periodoFinal}/{dtIncricaoInicio}/{dtIncricaoFim}/{qtdMinInscritos}/{qtdMaxInscritos}/{modeloDoc}/{area}/{equipe}/{atividades}', function ($titulo,$periodoInicial,$periodoFinal,$dtIncricaoInicio,$dtIncricaoFim,$qtdMinInscritos,$qtdMaxInscritos,$modeloDoc,$area,$equipe,$atividades) {
    $evento = (object) [
        'codEvento'=> 1,
        'titulo'=> 'Teste 2',
        'periodoInicial'=> '2020-10-10',
        'periodoFinal'=> '2020-10-15',
        'inscricaoInicio'=> '2020-09-20',
        'inscricaoFim'=> '2020-10-05',
        'qtdMinInscrito'=> 5,
        'status'=> 'Aberto',
        'qtdMaxInscrito'=> 20,
        'modelDoc'=> 'https;//modeloSead.png',
        'area' => ['Engenharia', 'Direiro'],
        'equipe' => ['Mauricio','Delmison','Gabriel'],
        'atividades' => ['Abertura', 'Palestra', 'Fechamento']

    ];

    

    return json_encode($evento);  
});

$router->get('/eventos/alterar/{codigoEvento}/{mudancas}/', function ($codigoEvento,$mudancas) {
    $evento = (object) [
        'codEvento'=> $codigoEvento,
        'titulo'=> 'Teste 2',
        'periodoInicial'=> '2020-10-10',
        'periodoFinal'=> '2020-10-15',
        'inscricaoInicio'=> '2020-09-20',
        'inscricaoFim'=> '2020-10-05',
        'qtdMinInscrito'=> 5,
        'status'=> 'Aberto',
        'qtdMaxInscrito'=> 20,
        'modelDoc'=> 'https://modeloTeste2.png',
        'area' => ['Engenharia', 'Direiro'],
        'equipe' => ['Mauricio','Delmison','Gabriel'],
        'atividades' => ['Abertura', 'Palestra', 'Fechamento']
    ];

    return json_encode($evento);  
>>>>>>> Stashed changes
});

$router->get('/eventos/excluir/{codigoEvento}', function ($codigoEvento) {
    $evento = (object) [
        'status' => true
    ];

    return json_encode($evento);  
});
<<<<<<< Updated upstream
=======

$router->get('/eventos/cancelar/{codigoEvento}', function ($codigoEvento) {
    $evento = (object) [
        'codigoEvento' => $codigoEvento,
        'status' => 'true'
    ];

    return json_encode($evento);  
});


>>>>>>> Stashed changes
