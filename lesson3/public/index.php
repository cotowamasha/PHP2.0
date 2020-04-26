<?php
echo '<pre>';
use App\services\Autoloader;
use App\services\DB;

include dirname(__DIR__) . '/services/Autoloader.php';
spl_autoload_register([new Autoloader(), 'loadClass']);

/**
 * массив обЪектов
 */
$user = new \App\models\User();
$users = $user->getAll();
var_dump($users);

/**
 * объект
 */
$user = new \App\models\User();
$users = $user->getOne(2);
var_dump($users);
/**
 * добавление в бд информации через save()
 */
$user = new \App\models\User();

$user->login = 'mk';
$user->password = '123';
$user->name = 'maria';

$user->save();
/**
 * изменение в бд информации через save()
 */
$user = new \App\models\User();

$user->id = 3;
$user->login = 'log1';
$user->password = '098';
$user->name = 'name1';

$user->save();
/**
 * удаление из бд
 */
$user = new \App\models\User();

$user->id = 3;

$user->delete();


print "</pre>";