<?php
 
/**
* @file 
* Contains \Drupal\talkify\Controller\TalkifyController.
*/
namespace Drupal\talkify\Controller ;
use Drupal\Core\Controller\ControllerBase ;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Render\Renderer;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\user\Entity\Role;

class TalkifyController extends ControllerBase
{ 
    public function config(){
        $build['talkify_config_form'] = $this->formBuilder->getForm('Drupal\talkify\Plugin\Config\Form\ConfigFormClass');
        return $build;
    }
}