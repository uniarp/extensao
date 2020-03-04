<?php

use \Illuminate\Http\Request;
use app\Http\Controllers\ParticipanteController;

$router->get('testeconte', function () use ($router) {
    return app('db')->select("select * from palestrante");
});

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

$router->get('/eventos/listar/{filtro}/{valor}', function ($filro, $valor) {
    return 'status:true';
});

$router->get('/eventos/visulizar/{codigoEvento}', function ($codigoEvento) {
    $evento = (object) [
        'codigoEvento' => $codigoEvento,
        'titulo' => "Teste",
        'periodoInicial' => '2019-10-10',
        'periodoFinal' => '2019-10-15',
        'inscricaoInicio' => '2019-09-20',
        'inscricaoFim' => '2019-10-05',
        'qtoMinInscritos' => 5,
        'status' => "Aberto",
        'qtdMaxInscrito' => 20,
        'modelDoc' => 'Https://modeloSead.png'
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

$router->get('/participantes/cancelarInscricao/{codigoInscricao}', function ($codigoInscricao) {
    $participante = (object) [
        'status' => "true"
    ];
    return json_encode($participante);
});

$router->get('/participantes/ingresso/{codigoInscricao}', function ($codigoInscricao) {
    $participante = (object) [
        'qrCode' => 'http://s.glbimg.com/jo/g1/f/original/2011/05/17/qrcode.jpg'
    ];
    return json_encode($participante); 
});

$router->get('/palestrantes/cadastrar/{nome}/{cpf}/{telefone}/{email}/{biografia}/{areaAtuacao}', function ($nome,$cpf,$telefone,$email,$biografia,$areaAtuacao) {
    $palestrante = (object) [
        'codPalestrante' => 123,
        'status' => "true"
    ];
    return json_encode($palestrante);
});

$router->get('/palestrantes/alterar/{codigoPalestrante}/{mudancas}', function ($codigoPalestrante,$mudancas) {
    $palestrante = (object) [
        'codPalestrante' => 123,
        'status' => "true"
    ];
    return json_encode($palestrante);
});

$router->get('/palestrantes/visualizar/{codigoPalestrante}/', function ($codigoPalestrante) {
    $palestrante = (object) [
        'codPalestrante' => 123,
        'nome' => "teste",
        'email' => "uniarp1@uniarp.com",
        'cpf' => "05335653025",
        'telefone' => "4998349562",
        'biografia' => "formado desde 2000, professor e palestrante"
    ];
    return json_encode($palestrante);
});

$router->get('/palestrantes/listar/{filtros}/', function ($filtros) {
    $palestrante = array(
        array(
        'codPalestrante' => 1,
        'nome' => "Teste1",
        'email' => "uniarp1@uniarp.com",
        'cpf' => "11111111111",
        'telefone' => "492222222",
        'biografia' => "formado desde 2000, professor e palestrante"
        ),
        array(
        'codPalestrante' => 2,
        'nome' => "Teste2",
        'email' => "uniarp2@uniarp.com",
        'cpf' => "22222222222",
        'telefone' => "492222222",
        'biografia' => "professor adjunto"
        )
    );
    return json_encode($palestrante);
});

$router->get('/participantes/listar/', 'ParticipanteController@listarParticipante');

$router->post('/participantes/cadastrar', function() {
    $body = dadosSessao();
    $participante = new ParticipanteController();

    try {
        $participante->cadastrarParticipante($body['codParticipante'], $body['nome'], $body['cpf'], $body['ra'], $body['senha'],
            $body['telefone'], $body['email']);
    } catch(Exception $e) {
        $response['erro'] = $e;
        return json_encode($response);
    }
    return $body;
});

$router->delete('/participantes/excluir/{codParticipante}', function($codParticipante) {
    return $codParticipante;
});

$router->get('/eventos/listarEvento/{codEvento}/', function ($codEvento) {
    $evento = (object) [
        'codEvento'=> $codEvento,
        'titulo'=> 'Teste 2',
        'periodoInicial'=> '2020-10-10',
        'periodoFinal'=> '2020-10-15',
        'inscricaoInicio'=> '2020-09-20',
        'inscricaoFim'=> '2020-10-05',
        'qtdMinInscritos'=> 5,
        'status'=> 'Aberto',
        'qtdMaxInscritos'=> 20,
        'modeloDoc'=> 'https;//modeloSead.png',
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
        'titulo'=> 'Teste 1',
        'periodoInicial'=> '2020-10-10',
        'periodoFinal'=> '2020-10-15',
        'inscricaoInicio'=> '2020-09-20',
        'inscricaoFim'=> '2020-10-05',
        'qtdMinInscritos'=> 5,
        'status'=> 'Aberto',
        'qtdMaxInscritos'=> 20,
        'modeloDoc'=> 'https;//modeloTeste1.png',
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
        'qtdMinInscritos'=> 5,
        'status'=> 'Aberto',
        'qtdMaxInscritos'=> 20,
        'modeloDoc'=> 'https://modeloTeste2.png',
        'area' => ['Engenharia', 'Direiro'],
        'equipe' => ['Mauricio','Delmison','Gabriel'],
        'atividades' => ['Abertura', 'Palestra', 'Fechamento']
    ];

    return json_encode($evento);  
});

$router->get('/eventos/excluir/{codigoEvento}', function ($codigoEvento) {
    $evento = (object) [
        'status' => true
    ];

    return json_encode($evento);  
});

$router->get('/eventos/cancelar/{codigoEvento}', function ($codigoEvento) {
    $evento = (object) [
        'codigoEvento' => $codigoEvento,
        'status' => 'true'
    ];

    return json_encode($evento);  
});

$router->get('/eventos/listar/{filtros}', function ($filtros) {
    $evento = array(
        array(
            'codEvento' => 1,
            'titulo' => 'Teste',
            'periodoInicial' => '2019-10-10',
            'periodoFinal' => '2019-10-15',
            'inscricaoInicio' => '2019-09-20',
            'inscricaoFim' => '2019-10-05',
            'qtdMinInscrito' => 5,
            'status' => 'Aberto',
            'qtdMaxInscrito' => 20,
            'modelDoc' => 'ambos'
        ),
        array(
            'codEvento' => 2,
            'titulo' => 'Teste 2',
            'periodoInicial' => '2019-10-10',
            'periodoFinal' => '2019-10-15',
            'inscricaoInicio' => '2019-09-20',
            'inscricaoFim' => '2019-10-05',
            'qtdMinInscrito' => 5,
            'status' => 'Aberto',
            'qtdMaxInscrito' => 20,
            'modelDoc' => 'ambos'
        )
    );
    return json_encode($evento);
});

function dadosSessao() {
    $request = new Request();
    return $request->json()->all();
}