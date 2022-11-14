<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;
use Slim\Factory\AppFactory;


require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/db.php';

$app = AppFactory::create();

// Middlewares
$app->addRoutingMiddleware();
$app->addBodyParsingMiddleware();

// Redireccionamiento de Rutas
$app->redirect('/', '/api/');
$app->redirect('/api/tickets', '/api/tickets/all');
$app->redirect('/api/ticket', '/api/tickets/all');

// Monitoreo de Errores
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// Ruta Principal
$app->get('/api/', function (Request $request, Response $response, $args) {
    // Estructura para el response
    $json = array(
        "endpoints" => [
            "documentacion" => "https://github.com/AndresBojaca/api-restfull-doublevpartners",
            "tickets" => "http://doublevpartnersapi.local/tickets/all"
        ],
    );
    $response->getBody()->write(json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    return $response
        ->withHeader('Content-type', 'application/json')
        ->withStatus(200);
});

// Tickets Routes

// Obtener todos los Tickets
$app->get('/api/tickets/all', function (Request $request, Response $response) {

    // Paginación
    $data = $request->getQueryParams();
    $page = (isset($data['page']) && $data['page'] > 0) ? $data['page'] : 1; // Default 1

    // Limite Máximo de Registros
    if (isset($data['limit'])) {
        // Si viene $limit en la URL
        $maxlimit = intval($data['limit']);
        if ($data['limit'] > 100) {
            // Si $limit es mayor a 100 deja maximo 100 registros
            $maxlimit = 100;
        }
    } else {
        // Si no viene $limit en la URL el default es 5
        $maxlimit = $data['limit'] = 5;
    }
    // Limite de Registros
    $limit = $maxlimit;
    $offset = (--$page) * $limit; // Default 1

    $sql = "
    SELECT * FROM tickets WHERE status != 'Cerrado' LIMIT $limit OFFSET $offset";

    try {

        $db = new DB();
        $conn = $db->connect();
        $stmt = $conn->query($sql);
        $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $db = null;

        if ($stmt->rowCount() > 0) {
            // Estructura para el response
            $json = array(
                "total_tickets" => $stmt->rowCount(),
                "limit" => $limit,
                "page" => $page + 1,
                "tickets" => $tickets
            );
            $response->getBody()->write(json_encode($json, JSON_PRETTY_PRINT));
        } else {
            $response->getBody()->write('No Se han Encontrado Tickets');
        }

        return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(200);
    } catch (PDOException $e) {

        $error = array(
            "message" => $e->getMessage()
        );
        $response->getBody()->write(json_encode($error));
        return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(500);
    }
});

// Obtener un solo ticket
$app->get('/api/tickets/{id}', function (Request $request, Response $response, array $args) {

    $id = isset($args['id']);
    $sql = "
    SELECT * FROM tickets WHERE id = $id AND status != 0";
    try {

        $db = new DB();
        $conn = $db->connect();
        $stmt = $conn->query($sql);
        $ticket = $stmt->fetch(PDO::FETCH_ASSOC);
        $db = null;

        if ($stmt->rowCount() > 0) {
            $response->getBody()->write(json_encode($ticket, JSON_PRETTY_PRINT));
        } else {
            $response->getBody()->write('No Se ha Encontrado ese Ticket en Específico');
        }

        return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(200);
    } catch (PDOException $e) {
        $error = array(
            "message" => $e->getMessage()
        );
        $response->getBody()->write(json_encode($error));
        return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(500);
    }
});

// Insertar un Ticket
$app->post('/api/tickets/add', function (Request $request, Response $response) {


    $data = $request->getParsedBody();

    // Obtenermos Parametros del Body JSON
    $user = $data['user'];
    $create_date = date('Y-m-d');
    $update_date = date('Y-m-d');
    $status = $data['status'];

    $sql = "
    INSERT INTO tickets (user, create_date, update_date, status) VALUES (:user, :create_date, :update_date, :status);";
    try {

        $db = new DB();
        $conn = $db->connect();

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':user', $user);
        $stmt->bindParam(':create_date', $create_date);
        $stmt->bindParam(':update_date', $update_date);
        $stmt->bindParam(':status', $status);

        $result = $stmt->execute();

        $db = null;
        $response->getBody()->write("Ticket Creado con Éxito!");

        return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(200);
    } catch (PDOException $e) {
        $error = array(
            "message" => $e->getMessage()
        );
        $response->getBody()->write(json_encode($error));
        return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(500);
    }
});

// Editar un Ticket
$app->put('/api/tickets/{id}', function (Request $request, Response $response, array $args): Response {


    $data = $request->getParsedBody();
    $id = $args['id'];

    // Obtenermos Parametros del Body JSON
    $user = $data['user'];
    $update_date = "2022-12-10";
    $status = $data['status'];

    $sql = "
    UPDATE tickets SET 
    user = :user,
    update_date = :update_date,
    status = :status
    WHERE id = $id";
    try {

        $db = new DB();
        $conn = $db->connect();

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':user', $user);
        $stmt->bindParam(':update_date', $update_date);
        $stmt->bindParam(':status', $status);

        $result = $stmt->execute();

        $db = null;
        $response->getBody()->write('Ticket #' . $id . ' Modificado con Éxito!');

        return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(200);
    } catch (PDOException $e) {
        $error = array(
            "message" => $e->getMessage()
        );
        $response->getBody()->write(json_encode($error));
        return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(500);
    }
});

// Eliminar un Ticket
$app->delete('/api/tickets/delete/{id}', function (Request $request, Response $response, array $args) {

    $id = $args['id'];
    $sql = "
    UPDATE tickets SET status = 0 WHERE id = $id";
    try {

        $db = new DB();
        $conn = $db->connect();
        $stmt = $conn->query($sql);
        $db = null;

        $response->getBody()->write('Ticket #' . $id . ' Eliminado con Éxito!');

        return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(200);
    } catch (PDOException $e) {
        $error = array(
            "message" => $e->getMessage()
        );
        $response->getBody()->write(json_encode($error));
        return $response
            ->withHeader('Content-type', 'application/json')
            ->withStatus(500);
    }
});


// Run app
$app->run();
