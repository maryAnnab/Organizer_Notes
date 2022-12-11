<?php

    declare(strict_types=1);

    namespace App;
    
    use App\Exception\AppException;
    use App\Exception\ConfigurationException;
    use Throwable;


    require_once("src/Utils/debug.php");
    require_once("src/Controller.php");
    require_once("src/Exception/AppException.php");


    $configuration = require_once("config/config.php");

   
    $request = [
        'get' => $_GET, 
        'post' => $_POST
    ];

    try{

      Controller::initConfiguration($configuration);
      (new Controller($request))->run();
    } catch (ConfigurationException $e) {
      //mail('xxx@xxx.com', 'Errro', $e->getMessage());
      echo '<h1>An error has occurred in the application</h1>';
      echo 'Problem with the application, please try again in a moment';
    } catch (AppException $e) {
      echo '<h1>An error has occurred in the application</h1>';
      echo '<h3>' . $e->getMessage() . '</h3>';
    } catch (Throwable $e) {
      echo '<h1>An error has occurred in the application</h1>';
      dump($e);
    }