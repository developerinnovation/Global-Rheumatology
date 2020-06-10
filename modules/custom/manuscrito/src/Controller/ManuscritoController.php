<?php
 
/**
* @file 
* Contains \Drupal\manuscrito\Controller\ManuscritoController.
*/
namespace Drupal\manuscrito\Controller ;
use Drupal\Core\Controller\ControllerBase ;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Render\Renderer;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Component\Utility\Html ;
use Drupal\Core\Database\Connection;
use Drupal\node\Entity\Node;
use Drupal\user\Entity\Role;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\user\Entity\User;
use Drupal\Core\Url;
use Drupal\rest\ResourceResponse;

class ManuscritoController extends ControllerBase
{ 

    public function content(Request $request) {
        $type = node_type_load("manuscrito"); // replace this with the node type in which we need to display the form for
        $node = $this->entityManager()->getStorage('node')->create(array(
          'type' => $type->id(),
        ));
        $node_create_form = $this->entityFormBuilder()->getForm($node);  
 
        return array(
            '#type' => 'markup',
            '#markup' => render($node_create_form),
        );
    }

    public function edit(RouteMatchInterface $route_match, $nid = NULL){
        $node = $this->entityManager()->getStorage('node')->load($nid);
        $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
        $node_create_form = $this->entityFormBuilder()->getForm($node);   
        $user_rol = $user->getRoles();
        $permi = array("administrator", "editores","revisores");
        $aut = FALSE;

        foreach($user_rol as $rep){
            if (in_array($rep, $permi) and $aut != TRUE) {
                $aut = TRUE;  
            }
        }

 
        if($node){

            if($node->field_estado_del_articulo->target_id != 574 ){
                if($aut){
                    return array(
                        '#type' => 'markup',
                        '#markup' => render($node_create_form),
                    );    
                }else{
                    return array(
                        '#theme' => 'update_locked',
                        '#id' => $nid,
                        '#status' 
                    );  
                }                
            }else{                 
                return array(
                    '#type' => 'markup',
                    '#markup' => render($node_create_form),
                );            
            }            
        }else{
            return [
                '#theme' => 'error_list',
            ];
        }
        
    }

    public function show(RouteMatchInterface $route_match){
        $id_node = null;
        $rows = [];
        if(\Drupal::currentUser()->id() != 0 || null !== \Drupal::currentUser()->id()){
            $uid = \Drupal::currentUser()->id();
            $query =  \Drupal::database()->select('entity_wishlist', 'ew');
            $query->fields('ew', ["wid", "entity_id"]);
            $query->condition('uid', $uid, "=");
            $query->distinct();
            $list_records = $query->execute()->fetchAll();    
            foreach ($list_records as $data) {
            array_push($rows,$data->entity_id);
            }
            $id_node = implode(',',$rows);    
        }
        
        return [
        	'#theme' => 'listing_display',
        	'#id_node' => $id_node,
        ];
    }

    public function type(){
        return [
        	'#theme' => 'type_display',
        ];
    }

    public function send(Request $request, $type = NULL){
        

        $typ = node_type_load('manuscrito_'.$type); // replace this with the node type in which we need to display the form for
        $node = $this->entityManager()->getStorage('node')->create(array(
          'type' => $typ->id(),
        ));
        $node_create_form = $this->entityFormBuilder()->getForm($node);  
        
        return [
            '#theme' => 'form_list',
            '#type' => 'markup',
            '#markup' => render($node_create_form),
        ];

        /*return array(
            '#type' => 'markup',
            '#markup' => render($node_create_form),
        );*/
    }

    public function guia(Request $request, $id = NULL){
        $node = NULL;
        $data = array();
        $node = \Drupal::entityManager()->getStorage('node')->load($id);
        if($node){
            $data = [
                'title' => $node->get('title')->getValue()[0]['value'],
                'body' => $node->get('body')->getValue()[0]['value'],
            ];           
        }

        return new JsonResponse( $data );
        /*return array(
            '#type' => 'json',
            '#plain_text' =>json_encode($data)
        );*/
    }

    public function thanks(Request $request, $type = NULL, $nid = NULL){
        $node = \Drupal::entityManager()->getStorage('node')->load($nid);        
        if($node){
            return [
                '#theme' => 'thanks_list',
                '#type' => $type,
                '#id' => $nid,
            ];
        }else{
            return [
                '#theme' => 'error_list',
            ];
        }
    }

    public function error_found(Request $request){
        return [
            '#theme' => 'error_list',
        ];
    }

    public function search(Request $request){
        \Drupal::service('page_cache_kill_switch')->trigger();

        $data = [];
        $_GET["tipo"];
        if($_GET["name"] != ""){
            $data = $this->getNodeByTitle($_GET["name"]);
        }

        if($_GET["tipo"] != ""){
            $data = $this->getNodeByType($_GET["tipo"]);
        }

        if($_GET["autor"] != ""){
            $data = $this->getNodeByAuthor($_GET["autor"]);
        }

        return [
            '#theme' => 'search',
            '#users' => $this->getAllAuthor(),
            '#name' => isset($_GET["name"]) ? $_GET["name"] : NULL,
            '#tipo' => isset($_GET["tipo"]) ? $_GET["tipo"] : NULL,
            '#autor' => isset($_GET["autor"]) ? $_GET["autor"] : NULL,
            '#data' => $data,
        ];
    }

    public function getAllAuthor(){
        \Drupal::service('page_cache_kill_switch')->trigger();
        $userlist = [];
        $ids = \Drupal::entityQuery('user')
        ->condition('status', 1)
        ->condition('roles', 'autores')
        ->execute();
        $users = User::loadMultiple($ids);
        
        foreach($users as $user){
            $username = ucfirst($user->get('field_nombre')->getValue()[0]['value'])." ".ucfirst($user->get('field_apellidos')->getValue()[0]['value']);
            $list = [
                'name' => $username,
                'uid' => $user->get('uid')->value,
            ];
            array_push($userlist,$list);
        } 
    
    return $userlist;
    }

    public function getNodeByTitle($title){
        \Drupal::service('page_cache_kill_switch')->trigger();
        $nid = \Drupal::entityQuery('node')
                ->condition('status', 1)
                ->condition('title',  $title.'%', 'like')
                ->condition('type', 'plantillas_correos', '!=')
                ->condition('type', 'page', '!=')
                ->condition('type', 'manuscrito', '!=')
                ->sort('created' , 'DESC')
                ->execute();
        $nodes = \Drupal\node\Entity\Node::loadMultiple($nid);
        return $this->structureContentDest($nodes);
    }

    public function getNodeByAuthor($uid){
        \Drupal::service('page_cache_kill_switch')->trigger();
        $nid = \Drupal::entityQuery('node')
                ->condition('status', 1)
                ->condition('uid', $uid)
                ->sort('created' , 'DESC')
                ->execute();
        $nodes = \Drupal\node\Entity\Node::loadMultiple($nid);
        return $this->structureContentDest($nodes);
    }

    public function getNodeByType($type){
        \Drupal::service('page_cache_kill_switch')->trigger();
        $nid = \Drupal::entityQuery('node')
                ->condition('status', 1)
                ->condition('type', $type)
                ->sort('created' , 'DESC')
                ->execute();
        $nodes = \Drupal\node\Entity\Node::loadMultiple($nid);
        return $this->structureContentDest($nodes);
    }

    public function structureContentDest($nodes) {
        date_default_timezone_set('America/Bogota');
        setlocale(LC_ALL, 'es_Es');

        $contents = [];
        foreach ($nodes as $node) {
            $content = [
                'nid' => $node->get('nid')->getValue()[0]['value'],
                'title' => $node->get('title')->getValue()[0]['value'],
                'type' => $this->bundleLabel($node->bundle()),
                'url' => \Drupal::service('path.alias_manager')->getAliasByPath('/node/'. $node->get('nid')->getValue()[0]['value']),
                'autor' => $this->load_author($node->getOwnerId()),
                'date' =>  \Drupal::service('date.formatter')->format($node->get('created')->getValue()[0]['value'], 'custom', 'M Y'),
                'node' => $node,
            ];
            array_push($contents,$content);
        }
        return $contents;
    }

    public function load_author($uid){
        $user =   User::load($uid); 
        $experto = [
            'uid' => $user->get('uid')->getValue()[0]['value'],
            'name_author' => ucfirst($user->get('field_nombre')->getValue()[0]['value'])." ".ucfirst($user->get('field_apellidos')->getValue()[0]['value']),
            'uri' => \Drupal::service('path.alias_manager')->getAliasByPath('/user/'.$user->get('uid')->getValue()[0]['value']),
        ];
        return $experto;
    }

    public function bundleLabel($node_type){
        $bundle_label = \Drupal::entityTypeManager()
            ->getStorage('node_type')
            ->load($node_type)
            ->label();
        return ucfirst(str_replace('Manuscrito', '', $bundle_label)); 
    }

}