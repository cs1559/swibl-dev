<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

// Routes
/* TEST DATA
 * GameID = 18737
 * TeamID = 697
 * Season = 20
 */
/*
 * /games/{id}
 * /games/schedule/{teamid}?season=
 */

$config = [
    'settings' => [
        'displayErrorDetails' => true,
        
    ],
];
$app = new \Slim\App($config);

$app->get('/games/{id}', function (Request $request, Response $response) {
    
    $parms["driver"] = "MySQL";
    $parms["host"] = "127.0.0.1";
    $parms["database"] = "games";
    $parms["user"] = "swibl";
    $parms["password"] = "bas3!ball";
    
    $db = &cjs\lib\Database::getInstance($parms);
    $db->setQuery("select * from joom_jleague_scores where id = " . $request->getAttribute('id'));
    $game = $db->loadObjectList();
    
    if($game) {
        $response->withHeader('Content-Type', 'application/json');
        $response->write(json_encode($game));
        
    } else { throw new Exception('No records found');}
    
    return $response;
});
    
    
    $app->get('/games/schedule/{teamid}', function (Request $request, Response $response, $args) {
        
        $parms["driver"] = "MySQL";
        $parms["host"] = "127.0.0.1";
        $parms["database"] = "games";
        $parms["user"] = "swibl";
        $parms["password"] = "bas3!ball";
        
        $uri = $request->getUri();
        
        $params = $request->getQueryParams();

        if (isset($params["season"])){
            $season = $params["season"];
        } else {
            $svcresponse = new cjs\lib\ServiceResponse();
            $error = new cjs\lib\Error();
            $error->setReference($uri);
            $error->setUserMessage("Missing key parameter - NO SEASON ID provided");
            $error->setMethod("index.php");
            $svcresponse->addError($error);
            $body = $response->getBody();
            $body->write(json_encode($svcresponse));
            return $response->withStatus(500)->withHeader('Content-type', 'application/json')->withBody($body);
        }
        
        $teamid = $request->getAttribute("teamid");
        
        $db = &cjs\lib\Database::getInstance($parms);
        $db->setQuery("select * from joom_jleague_scores where season = " . $season . " and (awayteam_id = " . $teamid . " or hometeam_id = " . $teamid . ")");
        $games = $db->loadObjectList();
        
        if($game) {
            $response->withHeader('Content-Type', 'application/json');
            $response->write(json_encode($games));
            
        } else { throw new Exception('No records found');}
        
        return $response;
    });
    
    
    
    $app->run();