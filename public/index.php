<?php
chdir(dirname(__DIR__));

require('backend/vendor/autoload.php');

if(php_sapi_name() == 'cli'){
  return false;
}

include('backend/App.php');
return (new Bricks\Frameworks\Base\App)->run();
