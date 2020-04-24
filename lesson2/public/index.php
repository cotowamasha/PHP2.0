<?php
include dirname(__DIR__) . '/services/Autoloader.php';
spl_autoload_register([new App\services\Autoloader(), 'loadClass']);

$bd = new App\services\DB();
$user = new App\models\Good($bd);
echo $user->getAll();
echo '<br>';
echo $user->getOne(12);
echo '<br>';
var_dump($user->getCountTest());




