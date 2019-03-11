<?php
define('__ROOT_DIR', realpath(dirname(__FILE__)));
$base_url = explode('/', $_SERVER['PHP_SELF']);
array_pop($base_url);
define('__BASE_URL', implode('/', $base_url).'/');
require_once(__ROOT_DIR . "/config/config.php");
require_once(__ROOT_DIR . '/classes/AutoLoader.class.php');
$request = Request::getCurrentRequest();
try {
    $ip = Ip::findOneBy(array('IP' => $_SERVER['REMOTE_ADDR']));
    if ($ip->getId() == null) {
        $ip = new Ip(array(
            'IP' => $_SERVER['REMOTE_ADDR'],
            'IP_BANNI' => 0,
        ));
        $ip->save();
    }
    if ($ip->getIpBanni()) {
        throw new Error("This IP is ban", 403);
    }
    if (LogConnection::countByIdIp($ip->getId(), new \DateTime("-5sec")) > 3) {
        throw new Error("Too many request in the last 5 seconds, please wait", 429);
    }
    $connection = new LogConnection(array(
        'ID_IP' => $ip->getId(),
        'DATE' => new \DateTime(),
    ));
    $connection->save();
    $request->setConnection($connection);

    $controller = Dispatcher::dispatch($request);
    $controller->execute();
} catch (Exception $e) {
    $controller = new ErrorController($request);
    $controller->setError(new Error($e->getMessage()));
    $controller->execute();
} catch (Error $e) {
    $controller = new ErrorController($request);
    $controller->setError($e);
    $controller->execute();
}
