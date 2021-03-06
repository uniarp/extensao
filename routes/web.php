<?php

use \Illuminate\Http\Request;
use \App\Http\Controllers\ParticipanteController;
use \App\Http\Controllers\UsuarioController;
use \App\Http\Controllers\PalestranteController;
use \App\Http\Controllers\VoluntarioController;
use \App\Http\Controllers\AtividadeController;
use \App\Http\Controllers\EventoController;
use \App\Http\Controllers\DocumentoController;
use \Illuminate\Http\ResponseResponseResponseSymfony\Component\HttpFoundation\Response;

/*AREA*/
$router->get('/areas/listar', 'AreaController@listarArea');

/* VOLUNTARIO */
$router->get('/voluntarios/listar', 'VoluntarioController@listarVoluntarios');

$router->get('/voluntarios/listar/{codVoluntario}', 'VoluntarioController@listarVoluntario');

$router->post('/voluntarios/cadastrar', function () {
    $body = dadosSessao();
    $voluntario = new VoluntarioController();
    try {
        $voluntario->gravarVoluntario(
            $body['codVoluntario'] ? $body['codVoluntario'] : null,
            $body['nome'] ? $body['nome'] : '',
            $body['email'] ? $body['email'] : '',
            $body['cpf'] ? $body['cpf'] : '',
            $body['telefone'] ? $body['telefone'] : '',
            $body['ra'] ? $body['ra'] : '',
            $body['curso'] ? $body['curso'] : ''
        );
    } catch (Exception $e) {
        $response['erro'] = $e;
        return response($response, 400);
    }
    return response('true', 200);
});

$router->delete('/voluntarios/excluir/{codVoluntario}', 'VoluntarioController@excluirVoluntario');


/* PALESTRANTE */
//Listar
$router->get('/palestrantes/listar', 'PalestranteController@listarPalestrantes');

//listar por codigo
$router->get('/palestrantes/listar/{codPalestrante}', 'PalestranteController@listarPalestrante');

// Alterar ou Cadastar novo Palestrante
$router->post('/palestrantes/cadastrar', function () {
    $body = dadosSessao();
    $palestrante = new PalestranteController();
    try {
        $res = $palestrante->gravarPalestrante(
            $body['codPalestrante'] ? $body['codPalestrante'] : null,
            $body['nome'] ? $body['nome'] : '',
            $body['cpf'] ? $body['cpf'] : '',
            $body['telefone'] ? $body['telefone'] : '',
            $body['email'] ? $body['email'] : '',
            $body['biografia'] ? $body['biografia'] : '',
            $body['area'] ? $body['area'] : ''
        );
    } catch (Exception $e) {
        $response['erro'] = $e;
        return response($response, 400);
    }
    return response($res, 200);
});

//excluir
$router->delete('/palestrantes/excluir/{codPalestrante}', 'PalestranteController@excluirPalestrante');


/* PARTICIPANTE */
//Listar
$router->get('/participantes/listar/', 'ParticipanteController@listarParticipantes');

$router->get('/participantes/listar/{codParticipante}', 'ParticipanteController@listarParticipante');

$router->get('/participantes/vericaEmail/{email}', 'ParticipanteController@verificaEmail');

//Listar dados Inscrição
$router->get('/participantes/inscricao/{codInscricao}', 'ParticipanteController@dadosParaDoc');

//Cadastrar
$router->post('/participantes/cadastrar', function () {
    $body = dadosSessao();
    $participante = new ParticipanteController();

    try {
        $response = $participante->gravarParticipante(
            $body['codParticipante'] ? $body['codParticipante'] : null,
            $body['nome'] ? $body['nome'] : '',
            $body['cpf'] ? $body['cpf'] : '',
            $body['ra'] ? $body['ra'] : '',
            $body['senha'] ? $body['senha'] : '',
            $body['telefone'] ? $body['telefone'] : '',
            $body['email'] ? $body['email'] : ''
        );
    } catch (Exception $e) {
        $response['erro'] = $e;
        return response($response, 400);
    }
    return response($response, 200);
});

//Excluir
$router->delete('/participantes/excluir/{codParticipante}', 'ParticipanteController@excluirParticipante');

//LISTAR EVENTO PARTICIPANTE
$router->get('/participantes/eventos/{codParticipante}', 'ParticipanteController@listarEventos');

// Gerar QR Code
$router->get('/participantes/qrCode/{codEvento}', 'ParticipanteController@gerarQrCode');

/* USUÁRIO */
//Listar
$router->get('/usuarios/listar', 'UsuarioController@listarUsuarios');
//listar por codigo
$router->get('/usuarios/listar/{codUsuario}', 'UsuarioController@listarUsuario');

//cadastar
$router->post('/usuarios/cadastrar', function () {
    $body = dadosSessao();
    $usuario = new UsuarioController();

    try {
        $usuario->cadastrarUsuario(
            $body['codUsuario'] ? $body['codUsuario'] : null,
            $body['nome'] ? $body['nome'] : '',
            $body['email'] ? $body['email'] : '',
            $body['cpf'] ? $body['cpf'] : '',
            $body['senha'] ? $body['senha'] : ''
        );
    } catch (Exception $e) {
        $response['erro'] = $e;
        return response($response, 400);
    }
    return response('true', 200);
});

//Excluir
$router->delete('/usuarios/excluir/{codUsuario}', 'UsuarioController@excluirUsuario');

//TipoAtividade
$router->get('/tipoAtividades/listar', 'TipoAtividadeController@listarTipoAtividade');

//Atividade
$router->get('/atividades/listar/{codAtividade}', 'AtividadeController@listarAtividade');

//cadastar
$router->post('/atividades/cadastrar', function () {
    $body = dadosSessao();
    $atividade = new AtividadeController();

    try {
        $res = $atividade->gravarAtividade(
            $body['codAtividade'] ? $body['codAtividade'] : null,
            $body['titulo'] ? $body['titulo'] : '',
            $body['codTipo'] ? $body['codTipo'] : '',
            $body['dataInicio'] ? $body['dataInicio'] : '',
            $body['dataFim'] ? $body['dataFim'] : '',
            $body['localizacao'] ? $body['localizacao'] : '',
            $body['descricao'] ? $body['descricao'] : '',
            $body['palestrante'] ? $body['palestrante'] : ''
        );
    } catch (Exception $e) {
        $response['erro'] = $e;
        return response($response, 400);
    }
    return response($res, 200);
});

//Excluir
$router->delete('/atividades/excluir/{codAtividade}', 'AtividadeController@excluirAtividade');


//Evento

//Cadastrar
$router->post('/eventos/cadastrar', function () {
    $body = dadosSessao();
    $evento = new EventoController();

    try {
        $res = $evento->gravarEvento(
            $body['codEvento'] ? $body['codEvento'] : null,
            $body['titulo'] ? $body['titulo'] : '',
            $body['codArea'] ? $body['codArea'] : '',
            $body['periodoInicial'] ? $body['periodoInicial'] : '',
            $body['periodoFinal'] ? $body['periodoFinal'] : '',
            $body['inscricaoInicio'] ? $body['inscricaoInicio'] : '',
            $body['inscricaoFim'] ? $body['inscricaoFim'] : '',
            $body['qtdMinInscrito'] ? $body['qtdMinInscrito'] : '',
            $body['qtdMaxInscrito'] ? $body['qtdMaxInscrito'] : '',
            $body['modeloDoc'] ? $body['modeloDoc'] : '',
            $body['voluntario'] ? $body['voluntario'] : '',
            $body['atividades'] ? $body['atividades'] : ''
        );
    } catch (Exception $e) {
        $response['erro'] = $e;
        return response($response, 400);
    }
    return response($res, 200);
});

//Cancelar Evento
$router->get('/eventos/cancelar/{codEvento}', 'EventoController@cancelarEvento');

//Listar Eventos
$router->get('/eventos/listar', 'EventoController@listarEventos');

//Listar Evento por Cod
$router->get('/eventos/listar/{codEvento}', 'EventoController@listarEvento');

//Excluir
$router->delete('/eventos/excluir/{codEvento}', 'EventoController@excluirEvento');

//Listar Inscritos
$router->get('/eventos/listarInscritos/{codEvento}', 'EventoController@listarIncritos');

//Inscrever Participante Evento
$router->post('/eventos/inscrever', function () {
    $body = dadosSessao();
    $evento = new EventoController();

    try {
        $res = $evento->inscreverParticipanteEvento($body);
    } catch (Exception $e) {
        $response['erro'] = $e->getMessage();
        return response($response, 400);
    }
    return response($res, 200);
});

//Remover Inscrito
$router->delete('/eventos/removerInscrito/{codParticipanteEvento}', 'EventoController@removerInscricaoParticipanteEvento');

//Presença Participante Evento
$router->post('/eventos/presenca', function () {
    $body = dadosSessao();
    $evento = new EventoController();

    try {
        $res = $evento->salvarPresenca($body);
    } catch (Exception $e) {
        $response['erro'] = $e->getMessage();
        return response($response, 400);
    }
    return response($res, 200);
});

//Listar Inscritos e Participantes para inscrever no Evento
$router->get('/eventos/participantesevento/{codEvento}', 'EventoController@participantesInscreverEvento');

/* DOCUMENTOS */
//Gerar Certificado
$router->post('/documento/gerarcertificado/{codInscricao}', 'DocumentoController@emitirCertificado');

//Validar Documento
$router->get('/documento/validar/{token}', 'DocumentoController@validarDocumento');

function dadosSessao()
{
    $request = new Request();
    return $request->json()->all();
}
