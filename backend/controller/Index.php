<?php
namespace Bricks\Frameworks\Base\Controller;

class Index extends Controller{
  public function indexAction(){
    return $this->template('Index', 'index');
  }
}
