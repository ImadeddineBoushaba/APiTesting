<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("You Wellcom, $name");

    return $response;
});


/* ---------------- -----------------  ---------*/
$app = new \Slim\App;
$app->get('/livre/{tach}', function (Request $request, Response $response) {
    $tach = $request->getAttribute('tach');
    $response->getBody()->write(" this is , $tach");

    return $response;
});



/* ---------------- 2éme méthode -----------------  ---------*/
$app = new \Slim\App;
$app->get('/testtargs/{name}/{phone}', function ($request, $response ,$args) {
    $name=$args['name'];
    $phone=$args['phone'];
    $response->getBody()->write(" this is a test for args  $name you phone is $phone");

    return $response;
});

/* ------------- POST --------------*/
$app->post('/test2/demo',function(Request $rs1,Response $rs2){

	$data=$rs1 ->getParsedBody();
	$inputdata=[];
	$inputdata['name']=filter_var($data['name'],FILTER_SANITIZE_STRING);
	$inputdata['phone']=filter_var($data['phone'],FILTER_SANITIZE_STRING);
	$rs2->getBody()->write("dear ". $inputdata['name']. " your phone number is " .$inputdata['phone']);
	

});
 /*------------- JSON RESPOSE----------------*/

$app->get('/jsontest/{FirstName}/{LastName}',function($Request,$Response ,$args){

	
	$FirstName=$args['FirstName'];
	$LastName=$args['LastName'];
	$out=[];
	$out['statut']=200;
	$out['Message']=200;
	$out['FirstName']=$FirstName;
	$out['LastName']=$LastName;

	$Response->getBody()->write(json_encode($out));
	

});


 /*------------- PUT RESPOSE----------------*/

 $app->put('/testput',function($Request ,$Response){

 	$data = $Request ->getParsedBody();
 	$username=$data['UserName'];
 	$password=$data['Password'];
 	$Response->getBody() ->write("$username your password is $password");
 });


 /*------------- DELETE RESPOSE----------------*/

 $app->delete('/testdelete',function($Request ,$Response){

 	$data = $Request ->getParsedBody();
 	$username=$data['UserName'];
 	$password=$data['Password'];
 	$Response->getBody() ->write(" $username your password is $password IS DELETE  ");
 });

$app->run();