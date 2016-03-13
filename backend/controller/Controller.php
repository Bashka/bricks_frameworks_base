<?php
namespace Bricks\Frameworks\Base\Controller;
use Bricks\ServiceLocator\Manager as Locator;
use Bricks\TemplateEngine\Php\Template;

abstract class Controller{
  protected $locator;

  public function __construct(Locator $locator){
    $this->locator = $locator;
  }

  /**
   * Формирует шаблон представления.
   *
   * @param string $controller Имя целевого контроллера.
   * @param string $action Имя целевого метода.
   *
   * @return Template Шаблон представления.
   */
  public function template($controller, $action){
    return new Template($this->locator['loader']->path('Bricks\Frameworks\Base\Template\\' . $controller . '\\' . $action, 'html'));
  }

  public function redirect($url){
    $this->locator['response']->redirect($url);
  }
}
