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

$router->get('/evento/{filtro}/{valor}',function($filro,$valor){
    return'status:true';
});

$router->get('/evento/visulizar/{codigoEvento}',function($codigoEvento){
    return 'status:true';
}); 

$router->get('/participante/inscricao/{codigoParticipante}/{codigoAtividade}',function($altura,$peso){

