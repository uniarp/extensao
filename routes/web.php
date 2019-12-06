<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// $router->get('/', function() {
//     return 'leticia' ;
// });

// $router->get('/validar/{chave}', function ($chave) {
//     if ($chave === "mestre") {
//         return '{status:true}' ;
//     }
//     return '{status:false}' ; 
// });

// $router->get('/imc/{altura}/{peso}', function ($altura,$peso) {
//     $alturaQ = ($altura/100)*($altura/100);
//     $imc = $peso/$alturaQ;
//     $observacao = "ta bom";
//     if ($imc <=20){
//         $observacao = "visite sua vó";
//     }
//     if ($imc >= 30){
//         $observacao = "não visite sua vó";
//     }
//     $resultado = (object)[
//         'imc' => $imc,
//         'observacao' => $observacao
//     ];
//     return json_encode ($resultado);
// });

$router->get('/voluntarios/cadastrar/{nome}/{email}/{cpf}/{telefone}/{ra}/{curso}', function ($nome, $email, $cpf, $telefone, $ra, $curso) {
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

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

// $router->get('/', function(){
//     return ' Delmison ';
// });

// $router->get('/validar/{chave}',function($chave){
//     if($chave == "mestre"){
//         return'{status:true}';
//     }
//     return'{status:false}';
// });

// $router->get('/imc/{altura}/{peso}',function($altura,$peso){
//     $alturaQ = ($altura/100) * ($altura/100);
//     $imc = $peso/$alturaQ;
//     $observacao = "Ta bom";
//     if($imc <= 20) {
//         $observacao = "visite sua vó";
//     }
//     if($imc >= 30) {
//         $observacao = "não visite sua vó";
//     }
//     $resultado = (object) [
//         'imc' => $imc,
//         'observacao' => $observacao
//     ];
//     return json_encode($resultado);
// });

$router->get('/evento/listar/{filtro}/{valor}',function($filro,$valor){
    return'status:true';
});

$router->get('/evento/visulizar/{codigoEvento}',function($codigoEvento){
    $evento = (object) [
        'codigoEvento' => $codigoEvento,
        'titulo' => "Teste",
        'qtoMinInscritos' => 5,
        'status' => "Aberto"
    ];
    return json_encode($evento);
}); 

// $router->get('/participante/inscricao/{codigoParticipante}/{codigoAtividade}',function($altura,$peso){

$router->get('/', function () {
    return 'well';
});
$router->get('/validar/{chave}', function ($chave) {
    if ($chave === "mestre") {
        return '{status:true}';
    }
    return '{status:false}';
});


$router->get('/participantes/login/{cpf}/{senha}', function ($cpf, $senha) {
        return ;  
});

$router->get('/participantes/cadastro/{nome}/{cpf}/{senha}/{telefone}/{email}/{ra}', function ($nome,$cpf,$senha,$telefone,$email,$ra) {
    return ;  
});

$router->get('/participantes/cancelarInscricao/{codigoInscricao}', function ($codigoInscricao) {
    return ;  
});

$router->get('/participantes/ingresso/{codigoInscricao}', function ($codigoInscricao) {
    return ;  
});

$router->get('/palestrantes/cadastrar/{nome}/{cpf}/{telefone}/{email}/{biografia}/{areaAtuacao}', function ($nome,$cpf,$telefone,$email,$biografia,$areaAtuacao) {
    return ;  
});

$router->get('/palestrantes/alterar/{codigoPalestrante}/{mudancas}', function ($codigoPalestrante,$mudancas) {
    return ;  
});

$router->get('/palestrantes/visualizar/{codigoPalestrante}/', function ($codigoPalestrante) {
    return ;  
});

$router->get('/palestrantes/listar/{filtros}/', function ($filtros) {
    return ;  
});

$router->get('/participantes/excluir/{codigoPalestrante}/', function ($codigoPalestrante) {
    return ;  
});

$router->get('/eventos/listar/{filtros}/', function ($filtros) {
    return ;  
});

$router->get('/eventos/listarInscritos/{filtros}/', function ($filtros) {
    return ;  
});

$router->get('/eventos/detalhesInscrito/{filtros}/', function ($filtros) {
    return ;  
});

$router->get('/eventos/cadastrar/{titulo}/{periodoInicial}/{periodoFinal}/{dtIncricaoInicio}/{dtIncricaoFim}/{qtdMinInscritos}/{qtdMaxInscritos}/{modeloDoc}/{area}/{equipe}/{atividades}', function ($titulo,$periodoInicial,$periodoFinal,$dtIncricaoInicio,$dtIncricaoFim,$qtdMinInscritos,$qtdMaxInscritos,$modeloDoc,$area,$equipe,$atividades) {
    return ;  
});

$router->get('/eventos/alterar/{codigoEvento}/{mudancas}/', function ($codigoEvento,$mudancas) {
    return ;  
});

$router->get('/eventos/excluir/{codigoEvento}/', function ($codigoEvento) {
    return ;  
});

$router->get('/eventos/cancelar/{codigoEvento}/', function ($codigoEvento) {
    return ;  
});

$router->get('/imc/{altura}/{peso}', function ($altura, $peso) {
    $alturaQ = ($altura/100) * ($altura/100);
    $imc = $peso/$alturaQ;
    $observacao = "Tá bom";
    if ($imc <= 20) {
        $observacao = "Visite sua vó";
    }
    if ($imc >= 30) {
        $observacao = "Não visite sua vó";
    }
    $resultado = (object) [
        'imc' => $imc,
        'observacao' => $observacao
    ];
    return json_encode($resultado);
});
