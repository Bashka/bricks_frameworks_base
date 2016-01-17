<?php
namespace Bricks\Frameworks\Base;
use Bricks\Autoload\Loader;
use Bricks\ServiceLocator\Manager as Locator;
use Bricks\Http\Routing\Router;
use Bricks\Http\Routing\Request;
use Bricks\Http\Routing\Response;
use Bricks\Http\Routing\RoutingException;
use Bricks\TemplateEngine\Php\Template;

class App{
  public function run(){
    // Маршрутизация статичных ресурсов.
    $request = new Request;
    if(strpos($request->path(), '.') !== false){
      return false;
    }

    $locator = new Locator;

    // Конфигурация загрузчика.
    $locator['loader'] = new Loader;
    $locator['loader']->pref('Bricks\Frameworks\Base\Controller', 'backend/controller');
    $locator['loader']->pref('Bricks\Frameworks\Base\Template', 'backend/template');

    // Маршрутизация страниц.
    $locator['router'] = new Router;
    $locator['router']->all('~^/([A-Za-z0-9_]+)/([A-Za-z0-9_]+)~',
      function(Request $request, Response $response, array $match) use($locator){
        $controllerName = ucfirst($match[0]);
        $controller = 'Bricks\Frameworks\Base\Controller\\' . $controllerName;
        $action = $match[1] . 'Action';

        if(!file_exists($locator['loader']->path($controller))){
          throw new RoutingException('Controller not found');
        }

        $controller = new $controller($locator, $controllerName, $action);
        if(!method_exists($controller, $action)){
          throw new RoutingException('Controller not found');
        }

        return $controller->$action();
      }
    );

    $locator['router']->all('~^/([A-Za-z0-9_]+)~',
      function(Request $request, Response $response, array $match) use($locator){
        $controllerName = ucfirst($match[0]);
        $controller = 'Bricks\Frameworks\Base\Controller\\' . $controllerName;

        if(!file_exists($locator['loader']->path($controller))){
          throw new RoutingException('Controller not found');
        }

        $controller = new $controller($locator, $controllerName, 'index');
        return $controller->indexAction();
      }
    );

    $locator['router']->all('~^/~',
      function() use($locator){
        $controller = new Controller\Index($locator, 'Index', 'index');
        return $controller->indexAction();
      }
    );

    // Конфигурация шаблонизатора.
    Template::helper('include', function($resource, array $env = []) use($locator){
      $template = new Template($locator['loader']->path('Bricks\Frameworks\Base\Template\\' . $resource, 'html'));
      return $template->env($env);
    });

    // Выполнение маршрутизации.
    $locator['request'] = $request;
    $locator['response'] = new Response;
    try{
      $responseBody = $locator['router']->run($locator['request'], $locator['response']);
    }
    // Обработка исключений.
    catch(RoutingException $exception){
      $responseBody = new Template($locator['loader']->path('Bricks\Frameworks\Base\Template\404', 'html'));
    }
    catch(\Exception $exception){
      $responseBody = new Template($locator['loader']->path('Bricks\Frameworks\Base\Template\500', 'html'));
    }

    // Возврат ответа.
    $locator['response']->body($responseBody);
    $locator['response']->send();

    return true;
  }
}
