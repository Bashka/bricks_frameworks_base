<?php
namespace Bricks\Frameworks\Base\Controller;
use Bricks\ServiceLocator\Manager as Locator;
use Bricks\TemplateEngine\Php\Template;

abstract class Controller{
  protected $locator;
  protected $controller;
  protected $action;

  public function __construct(Locator $locator, $controller, $action){
    $this->locator = $locator;
    $this->controller = $controller;
    $this->action = $action;
  }

  /**
   * Формирует шаблон представления для текущего контроллера.
   * Параметры метода позволяют запросить шаблон для метода любого контроллера.
   *
   * @param string $controller [optional] Имя целевого контроллера.
   * @param string $action [optional] Имя целевого метода.
   *
   * @return Template Шаблон, используемый для данного метода контроллера.
   */
  public function template($controller = null, $action = null){
    if(is_null($controller)){                                                                                  
      $controller = $this->controller;                                                                         
    }                                                                                                          
    if(is_null($action)){                                                                                                                              
      $action = $this->action;                                                                                 
    }

    $template = new Template($this->locator['loader']->path('Bricks\Frameworks\Base\Template\\' . $controller . '\\' . $action, 'html'));
    $template->controller = $controller;
    $template->action = $action;

    return $template;
  }
}
