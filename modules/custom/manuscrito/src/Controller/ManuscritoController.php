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
use Drupal\taxonomy\Entity\Term;
use Drupal\media\Entity\Media;
use Drupal\file\Entity\File;

class ManuscritoController extends ControllerBase
{ 

    public function content(Request $request) {
        \Drupal::service('page_cache_kill_switch')->trigger();
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
        \Drupal::service('page_cache_kill_switch')->trigger();
        $node = $this->entityManager()->getStorage('node')->load($nid);
        $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
        $node_create_form = $this->entityFormBuilder()->getForm($node);   
        $user_rol = $user->getRoles();
        $permi = array("administrator", "editores");
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
                '#title' => t('Contenido no encontrado'),
                '#body' => '<p>'.t('No hemos encontrado en la revista GLOBAL RHEUMATOLOGY una url válida para su búsqueda por favor verifique la url ingresada en su navegador').'</p>',
            ];
        }
        
    }

    public function show(RouteMatchInterface $route_match){
        \Drupal::service('page_cache_kill_switch')->trigger();
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
        \Drupal::service('page_cache_kill_switch')->trigger();

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
    }

    public function guia(Request $request, $id = NULL){
        \Drupal::service('page_cache_kill_switch')->trigger();
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
    }

    public function thanks(Request $request, $type = NULL, $nid = NULL){
        \Drupal::service('page_cache_kill_switch')->trigger();
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
                '#title' => t('Contenido no encontrado'),
                '#body' => '<p>'.t('No hemos encontrado en la revista GLOBAL RHEUMATOLOGY una url válida para su búsqueda por favor verifique la url ingresada en su navegador').'</p>',
            ];
        }
    }

    public function error_found(Request $request){
        return [
            '#theme' => 'error_list',
            '#title' => t('Contenido no encontrado'),
            '#body' => '<p>'.t('No hemos encontrado en la revista GLOBAL RHEUMATOLOGY una url válida para su búsqueda por favor verifique la url ingresada en su navegador').'</p>',
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
                ->condition('title',  '%'.$title.'%', 'like')
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
        \Drupal::service('page_cache_kill_switch')->trigger();
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
                'update' =>  \Drupal::service('date.formatter')->format($node->get('changed')->getValue()[0]['value'], 'custom', 'M Y'),
                'node' => $node,
            ];
            array_push($contents,$content);
        }
        return $contents;
    }

    public function load_author($uid){
        \Drupal::service('page_cache_kill_switch')->trigger();
        $user =   User::load($uid); 
        $experto = [
            'uid' => $user->get('uid')->getValue()[0]['value'],
            'mail' => $user->get('mail')->getValue()[0]['value'],
            'name_author' => ucfirst($user->get('field_nombre')->getValue()[0]['value'])." ".ucfirst($user->get('field_apellidos')->getValue()[0]['value']),
            'uri' => \Drupal::service('path.alias_manager')->getAliasByPath('/user/'.$user->get('uid')->getValue()[0]['value']),
        ];
        return $experto;
    }

    public function bundleLabel($node_type){
        \Drupal::service('page_cache_kill_switch')->trigger();
        $bundle_label = \Drupal::entityTypeManager()
            ->getStorage('node_type')
            ->load($node_type)
            ->label();
        return ucfirst(str_replace('Manuscrito', '', $bundle_label)); 
    }

    public function access(){
        return [
            '#theme' => 'access',
            '#users' => 'data',
        ];
    }

      // proceso editorial
    
    /**
     * qualify
     *
     * @param  mixed $route_match
     * @param  mixed $nid
     * @return void
     * 
     * Proceso para calificar artículos por los revisores
     * 
     */
    public function qualify(RouteMatchInterface $route_match, $nid = NULL){
        \Drupal::service('page_cache_kill_switch')->trigger();
        
        $uid = \Drupal::currentUser()->id();
        $user = \Drupal\user\Entity\User::load($uid);
        $user_rol = $user->getRoles();
        $permi = array("administrator", "revisores");
        $aut = FALSE;

        foreach($user_rol as $rep){
            if (in_array($rep, $permi) and $aut != TRUE) {
                $aut = TRUE;  
            }
        }

        if($user){
            if($aut){
                $article = \Drupal::entityManager()->getStorage('node')->load($nid); 
                $title = $article->get('title')->getValue()[0]['value'].' ('.$nid.')';

                $nids = \Drupal::entityQuery('node')
                    ->condition('uid', $uid)
                    ->condition('field_articulo_en_revision', $nid)
                    ->condition('type','revision_de_articulos')
                    ->sort('created' , 'DESC')
                    ->execute();
                
                if($nids){
                    
                    return [
                        '#theme' => 'error_list',
                        '#title' => t('Artículo calificado con anterioridad'),
                        '#body' => '<p>'.t('Hemos detectado que ya realizaste la calificación en GLOBAL RHEUMATOLOGY del artículo').' "'.$title.'", '.t('si crees que es un error comunícate con nuestro equipo de soporte.').' <br> <b><a href='.\Drupal::service('path.alias_manager')->getAliasByPath('/node/'. $nid).'>'.t('Regresar al artículo').'</a></b></p>',
                    ];
                }else{
                    $typ = node_type_load('revision_de_articulos'); 
                    $node = $this->entityManager()->getStorage('node')->create(array(
                        'type' => $typ->id(),
                    ));
                    $node_create_form = $this->entityFormBuilder()->getForm($node);  
                    $revision = $article->get('title')->getValue()[0]['value'].' ('.$nid.')';
                    return [
                        '#theme' => 'article_qualify',
                        '#type' => 'markup',
                        '#revision' => $title,
                        '#markup' => render($node_create_form),
                    ];
                }
           }else{
                return [
                    '#theme' => 'error_list',
                    '#title' => t('Acceso denegado'),
                    '#body' => '<p>'.t('Hemos detectado que no tienes acceso a está sección de GLOBAL RHEUMATOLOGY, si crees que es un error comunícate con nuestro equipo de soporte.').'</p>',
                ];
            }
        }else{
            return [
                '#theme' => 'error_list',
                '#title' => t('Acceso denegado'),
                '#body' => '<p>'.t('Hemos detectado que no tiene acceso a está sección de GLOBAL RHEUMATOLOGY por favor verifique si tiene una sesión activa en nuestra plataforma.').'</p>',
            ];
        }
        
        return [
            '#theme' => 'article_revision',
            '#type' => 'markup',
            '#markup' => render($node_create_form),
        ];
    }
    
    /**
     * revisionAutor
     *
     * @param  mixed $route_match
     * @param  mixed $nid
     * @return void
     * 
     * Listado para el autor
     * 
     */
    public function revisionAutor(RouteMatchInterface $route_match, $type = NULL, $uid = NULL){
        \Drupal::service('page_cache_kill_switch')->trigger();

        $typesArticles = [
            'manuscrito_articulo_revision',
            'manuscrito_articulo_especial',
            'manuscrito_articulo_original',
            'manuscrito_ciencia_panlar',
            'manuscrito_comentarios_respues',
            'manuscrito_editorial',
            'manuscrito_mini_revision',
            'manuscrito_multimedia',
            'manuscrito_noticia',
            'manuscrito_reportajes_especiales',
            'manuscrito_rondas_clinicas'
        ];
        
        $user = \Drupal\user\Entity\User::load($uid);
        $user_rol = $user->getRoles();
        $permi = array("administrator", "autores");
        $aut = FALSE;

        foreach($user_rol as $rep){
            if (in_array($rep, $permi) and $aut != TRUE) {
                $aut = TRUE;  
            }
        }

        if($user){
            if($aut){
                switch ($type) { 
                    case 'process';
                            $status = 0;
                            $operator = 'NOT IN';
                            $statusTaxonomy = ['585'];
                        break;
                    case 'rejected';
                            $status = 0;
                            $operator = 'IN';
                            $statusTaxonomy = ['585'];
                        break;
                    case 'published';
                            $status = 1;
                            $operator = 'IN';
                            $statusTaxonomy = ['586'];
                        break;
                }
                
                $nid = \Drupal::entityQuery('node')
                    ->condition('status', $status)
                    ->condition('uid', $uid)
                    ->condition('field_estado_del_articulo', $statusTaxonomy, $operator)
                    ->condition('type',$typesArticles, 'IN')
                    ->sort('created' , 'DESC')
                    ->execute();
            
                $nodes = \Drupal\node\Entity\Node::loadMultiple($nid);
                if($nodes != NULL){
                    $array = $this->structureArticleRevision($nodes, $type);
                    return [
                        '#theme' => 'history_autor',
                        '#type' => $type,
                        '#data' => $array,
                    ];
                }else{
                    return [
                        '#theme' => 'error_list',
                        '#title' => t('No hay información'),
                        '#body' => '<p>'.t('No encontramos información asociada a la consulta realizada, si crees que es un error comunícate con nuestro equipo de soporte.').'</p>',
                    ];
                }
            }else{
                return [
                    '#theme' => 'error_list',
                    '#title' => t('Acceso denegado'),
                    '#body' => '<p>'.t('Hemos detectado que no tienes acceso a está sección de GLOBAL RHEUMATOLOGY, si crees que es un error comunícate con nuestro equipo de soporte.').'</p>',
                ];
            }
        }else{
            return [
                '#theme' => 'error_list',
                '#title' => t('Acceso denegado'),
                '#body' => '<p>'.t('Hemos detectado que no tiene acceso a está sección de GLOBAL RHEUMATOLOGY por favor verifique si tiene una sesión activa en nuestra plataforma.').'</p>',
            ];
        }

    }
    
    /**
     * revisionRevisor
     *
     * @param  mixed $route_match
     * @param  mixed $nid
     * @return void
     * 
     * Listado para el revisor
     * 
     */
    public function revisionRevisor(RouteMatchInterface $route_match, $type = NULL, $uid = NULL){
        \Drupal::service('page_cache_kill_switch')->trigger();

        $typesArticles = [
            'manuscrito_articulo_revision',
            'manuscrito_articulo_especial',
            'manuscrito_articulo_original',
            'manuscrito_ciencia_panlar',
            'manuscrito_comentarios_respues',
            'manuscrito_editorial',
            'manuscrito_mini_revision',
            'manuscrito_multimedia',
            'manuscrito_noticia',
            'manuscrito_reportajes_especiales',
            'manuscrito_rondas_clinicas'
        ];

        $user = \Drupal\user\Entity\User::load($uid);
        $user_rol = $user->getRoles();
        $permi = array("administrator", "revisores");
        $aut = FALSE;

        foreach($user_rol as $rep){
            if (in_array($rep, $permi) and $aut != TRUE) {
                $aut = TRUE;  
            }
        }

        if($user){
            if($aut){
                switch ($type) { 
                    case 'created';
                        $status = 1;
                        break;
                    case 'process';
                            $status = 0;
                            $operator = 'NOT IN';
                            $statusTaxonomy = ['585'];
                        break;
                    case 'rejected';
                            $status = 0;
                            $operator = 'IN';
                            $statusTaxonomy = ['585'];
                        break;
                    case 'published';
                            $status = 1;
                            $operator = 'IN';
                            $statusTaxonomy = ['586'];
                        break;
                    case 'assigned';
                            $status = 0;
                        break;
                    default:
                            return [
                                '#theme' => 'error_list',
                                '#title' => t('Recurso no encontrado'),
                                '#body' => '<p>'.t('No encontramos el recurso solicitado, si crees que es un error comunícate con nuestro equipo de soporte.').'</p>',
                            ];
                        break;
                }
                if($type != 'created' && $type != 'assigned'){
                    $nid = \Drupal::entityQuery('node')
                        ->condition('status', $status)
                        ->condition('field_revisor', $uid)
                        ->condition('field_estado_del_articulo', $statusTaxonomy, $operator)
                        ->condition('type',$typesArticles, 'IN')
                        ->sort('created' , 'DESC')
                        ->execute();
                }elseif($type == 'assigned'){
                    $nid = \Drupal::entityQuery('node')
                        ->condition('status', $status)
                        ->condition('type','asignacion_revisores')
                        ->condition('field_asignar_revisor', $uid)
                        ->sort('created' , 'DESC')
                        ->execute();
                }else{
                    $nid = \Drupal::entityQuery('node')
                        ->condition('uid', $uid)
                        ->sort('created' , 'DESC')
                        ->execute();
                }

                $nodes = \Drupal\node\Entity\Node::loadMultiple($nid);
                if($nodes != NULL){
                    $array = $this->structureArticleRevision($nodes, $type, 'revisor');
                    return [
                        '#theme' => 'history_revisor',
                        '#type' => $type,
                        '#data' => $array,
                    ];
                }else{
                    return [
                        '#theme' => 'error_list',
                        '#title' => t('No hay información'),
                        '#body' => '<p>'.t('No encontramos información asociada a la consulta realizada, si crees que es un error comunícate con nuestro equipo de soporte.').'</p>',
                    ];
                }
            }else{
                return [
                    '#theme' => 'error_list',
                    '#title' => t('Acceso denegado'),
                    '#body' => '<p>'.t('Hemos detectado que no tienes acceso a está sección de GLOBAL RHEUMATOLOGY, si crees que es un error comunícate con nuestro equipo de soporte.').'</p>',
                ];
            }
        }else{
            return [
                '#theme' => 'error_list',
                '#title' => t('Acceso denegado'),
                '#body' => '<p>'.t('Hemos detectado que no tiene acceso a está sección de GLOBAL RHEUMATOLOGY por favor verifique si tiene una sesión activa en nuestra plataforma.').'</p>',
            ];
        }

    }
    
    /**
     * revisionEditor
     *
     * @param  mixed $route_match
     * @param  mixed $nid
     * @return void
     * 
     * Listado para el editor
     * 
     */
    public function revisionEditor(RouteMatchInterface $route_match, $type = NULL, $uid = NULL){
        \Drupal::service('page_cache_kill_switch')->trigger();
        
        $typesArticles = [
            'manuscrito_articulo_revision',
            'manuscrito_articulo_especial',
            'manuscrito_articulo_original',
            'manuscrito_ciencia_panlar',
            'manuscrito_comentarios_respues',
            'manuscrito_editorial',
            'manuscrito_mini_revision',
            'manuscrito_multimedia',
            'manuscrito_noticia',
            'manuscrito_reportajes_especiales',
            'manuscrito_rondas_clinicas'
        ];

        $user = \Drupal\user\Entity\User::load($uid);
        $user_rol = $user->getRoles();
        $permi = array("administrator", "editores");
        $aut = FALSE;

        foreach($user_rol as $rep){
            if (in_array($rep, $permi) and $aut != TRUE) {
                $aut = TRUE;  
            }
        }

        if($user){
            if($aut){
                switch ($type) { 
                    case 'created';
                        $status = 1;
                        break;
                    case 'process';
                            $status = 0;
                            $operator = 'NOT IN';
                            $statusTaxonomy = ['585'];
                        break;
                    case 'rejected';
                            $status = 0;
                            $operator = 'IN';
                            $statusTaxonomy = ['585'];
                        break;
                    case 'published';
                            $status = 1;
                            $operator = 'IN';
                            $statusTaxonomy = ['586'];
                        break;
                }
                if($type != 'created'){
                    $nid = \Drupal::entityQuery('node')
                        ->condition('status', $status)
                        ->condition('field_revisor', $uid)
                        ->condition('field_estado_del_articulo', $statusTaxonomy, $operator)
                        ->condition('type',$typesArticles, 'IN')
                        ->sort('created' , 'DESC')
                        ->execute();
                }else{
                    $nid = \Drupal::entityQuery('node')
                        ->condition('status', $status)
                        ->condition('uid', $uid)
                        ->sort('created' , 'DESC')
                        ->execute();
                }
                $nodes = \Drupal\node\Entity\Node::loadMultiple($nid);
                if($nodes != NULL){
                    $array = $this->structureArticleRevision($nodes, $type,  'editor');
                    return [
                        '#theme' => 'history_editor',
                        '#type' => $type,
                        '#data' => $array,
                    ];
                }else{
                    return [
                        '#theme' => 'error_list',
                        '#title' => t('No hay información'),
                        '#body' => '<p>'.t('No encontramos información asociada a la consulta realizada, si crees que es un error comunícate con nuestro equipo de soporte.').'</p>',
                    ];
                }
            }else{
                return [
                    '#theme' => 'error_list',
                    '#title' => t('Acceso denegado'),
                    '#body' => '<p>'.t('Hemos detectado que no tienes acceso a está sección de GLOBAL RHEUMATOLOGY, si crees que es un error comunícate con nuestro equipo de soporte.').'</p>',
                ];
            }
        }else{
            return [
                '#theme' => 'error_list',
                '#title' => t('Acceso denegado'),
                '#body' => '<p>'.t('Hemos detectado que no tiene acceso a está sección de GLOBAL RHEUMATOLOGY por favor verifique si tiene una sesión activa en nuestra plataforma.').'</p>',
            ];
        }

    }

    public function comments(Request $request, $rol = NULL, $nid = NULL, $tokenRol = NULL, $tokenNid = NULL) {
        \Drupal::service('page_cache_kill_switch')->trigger();
        if(\Drupal::currentUser()->id() != 0){
            if($rol == 'autor' || $rol == 'editor' || $rol == 'revisor'){
                $article = \Drupal::entityManager()->getStorage('node')->load($nid);        
                if(hash('md5',$rol,false) == $tokenRol  && $article){
                    $typ = node_type_load('comentarios_para_'.$rol); 
                    $node = $this->entityManager()->getStorage('node')->create(array(
                        'type' => $typ->id(),
                    ));
                    $node_create_form = $this->entityFormBuilder()->getForm($node);  
                    $revision = $article->get('title')->getValue()[0]['value'].' ('.$nid.')';
                    return [
                        '#theme' => 'form_comments',
                        '#type' => 'markup',
                        '#revision' => $revision,
                        '#markup' => render($node_create_form),
                    ];
                }else{
                    return [
                        '#theme' => 'error_list',
                        '#title' => t('Actividad sospechosa'),
                        '#body' => '<p>'.t('Hemos detectado una actividad inusual en GLOBAL RHEUMATOLOGY, si crees que es un error comunícate con nuestro equipo de soporte.').'</p>',
                    ];
                }
            }else{
                return [
                    '#theme' => 'error_list',
                    '#title' => t('Contenido no encontrado'),
                    '#body' => '<p>'.t('No hemos encontrado en la revista GLOBAL RHEUMATOLOGY una url válida para su búsqueda por favor verifique la url ingresada en su navegador').'</p>',
                ];
            }
        }else{
            return [
                '#theme' => 'error_list',
                '#title' => t('Acceso denegado'),
                '#body' => '<p>'.t('Hemos detectado que no tiene acceso a está sección de GLOBAL RHEUMATOLOGY por favor verifique si tiene una sesión activa en nuestra plataforma.').'</p>',
            ];
        }
    }

    public function structureArticleRevision($nodes,$type, $rol = NULL) {
        \Drupal::service('page_cache_kill_switch')->trigger();
        date_default_timezone_set('America/Bogota');
        setlocale(LC_ALL, 'es_Es');
        $urlEdit = '';
        $contents = [];
        $nodesArticle = NULL;
        foreach ($nodes as $node) {
            $nid = $node->get('nid')->getValue()[0]['value'];
            if($type != 'created'){
                if($node->hasField('field_articulo_en_revision')){
                    $comments_autor = '/comments/review/autor/'.$node->get('field_articulo_en_revision')->getValue()[0]['target_id'].'/'.hash('md5','autor',false).'/'.hash('md5',$nid,false);
                    $comments_editor = '/comments/review/editor/'.$node->get('field_articulo_en_revision')->getValue()[0]['target_id'].'/'.hash('md5','editor',false).'/'.hash('md5',$nid,false);
                }else{
                    $comments_autor = '/comments/review/autor/'.$nid.'/'.hash('md5','autor',false).'/'.hash('md5',$nid,false);
                    $comments_editor = '/comments/review/editor/'.$nid.'/'.hash('md5','editor',false).'/'.hash('md5',$nid,false);
                }
                $comments_revisor = '/comments/review/revisor/'.$nid.'/'.hash('md5','revisor',false).'/'.hash('md5',$nid,false);
 
                if($type == 'assigned' && $rol == 'revisor'){ 
                    if($node->hasField('field_articulo_en_revision')){
                        $idArticle = $node->get('field_articulo_en_revision')->getValue()[0]['target_id'];
                        $qualify = '/article/qualify/'.$node->get('field_articulo_en_revision')->getValue()[0]['target_id'].'/'.hash('md5',$nid,false);
                    }

                    $urlEdit ='/update/'.str_replace('manuscrito_','',$node->bundle()).'/'.$nid;
                    $nodesArticle = \Drupal\node\Entity\Node::load($idArticle);
                    
                }
                if($type != 'assigned'){
                    $assign = '/assign/'.$nid.'/'.hash('md5',$nid,false);
                    $statusId = $node->get('field_estado_del_articulo')->getValue()[0]['target_id'];
                    $statusName = Term::load($statusId);
                    $valueStatusName =  $statusName->get('name')->getValue()[0]['value'];
                    $urlEdit ='/update/'.str_replace('manuscrito_','',$node->bundle()).'/'.$nid.'#edit-field-estado-del-articulo';
                    $listRevisor = $this->getRevisorAssigned($nid);
                }
            }

            $content = [
                'titleArticle' => $nodesArticle != NULL ? $nodesArticle->get('title')->getValue()[0]['value'] : '',
                'urlArticle' => $nodesArticle != NULL ? \Drupal::service('path.alias_manager')->getAliasByPath('/node/'. $idArticle) : '',
                'nid' => $nid,
                'title' => $node->get('title')->getValue()[0]['value'],
                'type' => $this->bundleLabel($node->bundle()),
                'record' => '/article/'.$nid.'/all/record',
                'url' => \Drupal::service('path.alias_manager')->getAliasByPath('/node/'. $nid),
                'autor' => $this->load_author($node->getOwnerId()),
                'date' =>  \Drupal::service('date.formatter')->format($node->get('created')->getValue()[0]['value'], 'custom', 'd M Y'),
                'update' =>  \Drupal::service('date.formatter')->format($node->get('changed')->getValue()[0]['value'], 'custom', 'd M Y'),
                'status' => isset($valueStatusName) ? $valueStatusName : '',
                'publish' => '',
                'comments_autor' => isset($comments_autor) ? $comments_autor : '',
                'comments_editor' => isset($comments_editor) ? $comments_editor : '',
                'comments_revisor' => isset($comments_revisor) ? $comments_revisor : '',
                'assign' => isset($assign) ? $assign : '',
                'qualify' => isset($qualify) ? $qualify : '',
                'node' => $node,
                'urlEdit' => isset($urlEdit) ? $urlEdit : '',
                'listRevisor' => $listRevisor != '' ? $listRevisor : t('No hay revisores asignados'),
            ];
            array_push($contents,$content);
        }
        return $contents;
    }

    public function assign(Request $request, $nid = NULL, $tokenNid = NULL){
        \Drupal::service('page_cache_kill_switch')->trigger();
        if(\Drupal::currentUser()->id() != 0){

            $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
            $user_rol = $user->getRoles();
            $permi = array("administrator", "editores");
            $aut = FALSE;

            foreach($user_rol as $rep){
                if (in_array($rep, $permi) and $aut != TRUE) {
                    $aut = TRUE;  
                }
            }
            if($aut){
                $article = \Drupal::entityManager()->getStorage('node')->load($nid);        
                if(hash('md5',$nid,false) == $tokenNid && $article){
                    $typ = node_type_load('asignacion_revisores'); 
                    $node = $this->entityManager()->getStorage('node')->create(array(
                        'type' => $typ->id(),
                    ));
                    $node_create_form = $this->entityFormBuilder()->getForm($node);  
                    $revision = $article->get('title')->getValue()[0]['value'].' ('.$nid.')';
                    return [
                        '#theme' => 'assign_revisor',
                        '#type' => 'markup',
                        '#revision' => $revision,
                        '#markup' => render($node_create_form),
                    ];
                }else{
                    return [
                        '#theme' => 'error_list',
                        '#title' => t('Actividad sospechosa'),
                        '#body' => '<p>'.t('Hemos detectado una actividad inusual en GLOBAL RHEUMATOLOGY, si crees que es un error comunícate con nuestro equipo de soporte.').'</p>',
                    ];
                }
            }else{
                return [
                    '#theme' => 'error_list',
                    '#title' => t('Acceso denegado'),
                    '#body' => '<p>'.t('Hemos detectado que no tienes acceso a está sección de GLOBAL RHEUMATOLOGY, si crees que es un error comunícate con nuestro equipo de soporte.').'</p>',
                ];
            }
        }else{
            return [
                '#theme' => 'error_list',
                '#title' => t('Acceso denegado'),
                '#body' => '<p>'.t('Hemos detectado que no tiene acceso a está sección de GLOBAL RHEUMATOLOGY por favor verifique si tiene una sesión activa en nuestra plataforma.').'</p>',
            ];
        }
    }

    public function assignResponse(Request $request, $nid = NULL, $tokenNid = NULL){
        \Drupal::service('page_cache_kill_switch')->trigger();
        $assign = \Drupal::entityManager()->getStorage('node')->load($nid);        
        if(hash('md5',$nid,false) == $tokenNid && $assign){
            $accept = $assign->get('field_revisor_acepto_revision')->getValue()[0]['value'];
            $revisionId = $assign->get('title')->getValue()[0]['value'];

            $articleId = $assign->get('field_articulo_en_revision')->getValue()[0]['target_id'];
            $article = \Drupal::entityManager()->getStorage('node')->load($articleId);       
            $titleArticle = $article->get('title')->getValue()[0]['value'];

            if(!$accept || $accept != 1 || $accept != '1') {
                
                $idrevisor = $assign->get('field_asignar_revisor')->getValue()[0]['target_id'];
                $revisor = User::load($idrevisor);
                $revisorMail = $revisor->get('mail')->getValue()[0]['value'];
                $editor = User::load($assign->getOwnerId());
                $editorMail = $editor->get('mail')->getValue()[0]['value'];
                $revisorName = ucfirst($revisor->get('field_nombre')->getValue()[0]['value'])." ".ucfirst($revisor->get('field_apellidos')->getValue()[0]['value']);
                $tokenExtra = 'El revisor <b>'.$revisorName.'</b> aceptó la revisión del artículo "'.$titleArticle.'", podrá verificar la asignación buscando el Id '.$revisionId.'<br> en el listado de asignaciones realizadas por usted.';
                
                $assign->set('field_revisor_acepto_revision',1);
                $assign->save();
                
                exec_mail('assignResponse', $article, $nid, $editorMail, $tokenExtra);
                $urlAcept = \Drupal::request()->getSchemeAndHttpHost().'/user/login?destination='.\Drupal::service('path.alias_manager')->getAliasByPath('/node/'.$articleId);
                $body = '<p>'.t('Gracias por aceptar la revisión del artículo'). ': "'.$titleArticle.'", '.t('registrado en').' GLOBAL RHEUMATOLOGY.</p><br> <p>'.t('puede ver el artículo realizando clic en el siguiente enlace ').': <a href="'.$urlAcept.'">'.$urlAcept.'</a></p>';
                return [
                    '#theme' => 'error_list',
                    '#title' => t('Revisión aceptada.'),
                    '#body' => $body,
                ];
            }else{
                return [
                    '#theme' => 'error_list',
                    '#title' => t('Revisión aceptada con anterioridad'),
                    '#body' => '<p>'.t('Hemos detectado que ya aceptó la revisión del artículo'). ': "'.$titleArticle.'", '.t('registrado en').' GLOBAL RHEUMATOLOGY, '.t('gracias por utilizar nuestra plataforma.').'</p>',
                ];
            }
        }else{
            return [
                '#theme' => 'error_list',
                '#title' => t('Actividad sospechosa'),
                '#body' => '<p>'.t('Hemos detectado una actividad inusual en GLOBAL RHEUMATOLOGY, si crees que es un error comunícate con nuestro equipo de soporte.').'</p>',
            ];
        }
    }

    public function rejectedResponse(Request $request, $nid = NULL, $tokenNid = NULL){
        \Drupal::service('page_cache_kill_switch')->trigger();
        $assign = NULL;
        if(hash('md5',$nid,false) == $tokenNid){
            $assign = \Drupal::entityManager()->getStorage('node')->load($nid);  
            $rechazo = $assign->get('field_revisor_rechazo_revision')->getValue()[0]['value'];      
            if($rechazo == '1' || $rechazo == 1 ) {

                $accept = $assign->get('field_revisor_acepto_revision')->getValue()[0]['value'];
                $revisionId = $assign->get('title')->getValue()[0]['value'];

                $articleId = $assign->get('field_articulo_en_revision')->getValue()[0]['target_id'];
                $article = \Drupal::entityManager()->getStorage('node')->load($articleId);       
                $titleArticle = $article->get('title')->getValue()[0]['value'];
                
                $idrevisor = $assign->get('field_asignar_revisor')->getValue()[0]['target_id'];
                $revisor = User::load($idrevisor);
                $revisorMail = $revisor->get('mail')->getValue()[0]['value'];
                $editor = User::load($assign->getOwnerId());
                $editorMail = $editor->get('mail')->getValue()[0]['value'];
                $revisorName = ucfirst($revisor->get('field_nombre')->getValue()[0]['value'])." ".ucfirst($revisor->get('field_apellidos')->getValue()[0]['value']);
                $tokenExtra = 'El revisor <b>'.$revisorName.'</b> no aceptó la revisión del artículo "'.$titleArticle.'", por lo cual la asignación relacionada al Id '.$revisionId.'<br> será retirada de la plataforma.';
                
                exec_mail('rejectedResponse', $article, $nid, $editorMail, $tokenExtra);

                return [
                    '#theme' => 'error_list',
                    '#title' => t('Revisión rechazada.'),
                    '#body' => '<p>'.t('Lamentamos su desición de rechazar la revisión del artículo'). ': "'.$titleArticle.'", '.t('registrado en').' GLOBAL RHEUMATOLOGY.</p>',
                ];
                $assign->set('field_revisor_rechazo_revision',1);
                $assign->save();
            }else{
                return [
                    '#theme' => 'error_list',
                    '#title' => t('Revisión rechazada con anterioridad'),
                    '#body' => '<p>'.t('Hemos detectado que rechazó con anterioridad la revisión del artículo registrado en').' GLOBAL RHEUMATOLOGY, '.t('gracias por utilizar nuestra plataforma.').'</p>',
                ];
            }
        }else{
            return [
                '#theme' => 'error_list',
                '#title' => t('Actividad sospechosa'),
                '#body' => '<p>'.t('Hemos detectado una actividad inusual en GLOBAL RHEUMATOLOGY, si crees que es un error comunícate con nuestro equipo de soporte.').'</p>',
            ];
        }
    }

    public function getComments(Request $request, $uid = NULL, $nid = NULL, $type = NULL){
        \Drupal::service('page_cache_kill_switch')->trigger();
        date_default_timezone_set('America/Bogota');
        setlocale(LC_ALL, 'es_Es');

        $article = NULL;

        switch ($type) { 
            case 'author';
                    $status = 0;
                    $typeComments = 'comentarios_para_autor';
                break;
            case 'editor';
                    $status = 0;
                    $typeComments = 'comentarios_para_editor';
                break;
            case 'reviser';
                    $status = 0;
                break;
            default: 
                    return [
                        '#theme' => 'error_list',
                        '#title' => t('Recurso no encontrado'),
                        '#body' => '<p>'.t('No encontramos el recurso solicitado, si crees que es un error comunícate con nuestro equipo de soporte.').'</p>',
                    ];
                break;
        }
        if($type != 'reviser'){
            $nodes = \Drupal::entityQuery('node')
                ->condition('status', $status)
                ->condition('type', $typeComments)
                ->condition('field_articulo_en_revision', $nid)
                ->sort('created' , 'DESC')
                ->execute();
        }else{
            $nodes = \Drupal::entityQuery('node')
                ->condition('status', $status)
                ->condition('uid', $uid)
                ->sort('created' , 'DESC')
                ->execute();
        }

        $article = \Drupal\node\Entity\Node::load($nid); 
        if($article == NULL || !$article){
            return [
                '#theme' => 'error_list',
                '#title' => t('Recurso no encontrado'),
                '#body' => '<p>'.t('No encontramos el recurso solicitado, si crees que es un error comunícate con nuestro equipo de soporte.').'</p>',
            ];
        }else{
            $titleArticle = $article->get('title')->getValue()[0]['value'];
            $nodes = \Drupal\node\Entity\Node::loadMultiple($nodes);
            if($nodes != NULL){
                $contents = [];
                foreach ($nodes as $node) {
                    if($type == 'reviser'){
                        $commnetsTo = $typeComments == 'comentarios_para_autor' ? t('Para el autor') : t('Para el editor');
                    }
                    $content = [
                        'id' => $node->get('title')->getValue()[0]['value'],
                        'date' =>  \Drupal::service('date.formatter')->format($node->get('created')->getValue()[0]['value'], 'custom', 'd M Y'),
                        'comment' => $node->get('field_comentarios')->getValue()[0]['value'],
                        'to' => isset($commnetsTo) ? $commnetsTo : '',
                    ];
                    array_push($contents,$content);
                }
                return [
                    '#theme' => 'history_comments',
                    '#type' => $type,
                    '#titleArticle' => $titleArticle,
                    '#data' => $contents,
                ];
            }else{
                return [
                    '#theme' => 'error_list',
                    '#title' => t('No hay comentarios'),
                    '#body' => '<p>'.t('No encontramos comentarios asociadas al artículo '). $titleArticle .', '.t('si crees que es un error comunícate con nuestro equipo de soporte.').'</p>',
                ];
            }
        }
    }

    public function getRevisorAssigned($nidArticle){
        \Drupal::service('page_cache_kill_switch')->trigger();

        $data = [];
        $nid = NULL;
        $textAutor = '';

        $nid = \Drupal::entityQuery('node')
            ->condition('type','asignacion_revisores')
            ->condition('field_articulo_en_revision', $nidArticle)
            ->sort('created' , 'DESC')
            ->execute();

        if($nid != NULL){
            $nodes = \Drupal\node\Entity\Node::loadMultiple($nid);
            foreach ($nodes as $node) {
                $revisorId = $node->get('field_asignar_revisor')->getValue()[0]['target_id'];
                $autor = $this->load_author($revisorId);
                array_push($data,$autor);
            }

            if(count($data) > 0){
                $textAutor .= '<ul>';
                foreach ($data as $autor) {
                    $textAutor .= '<li>';
                        $textAutor .= '<a href="mailto:'.$autor['mail'].'">'.$autor['name_author'].' => '. $autor['mail'].'</a>';
                    $textAutor .= '</li>';
                }
                $textAutor .= '</ul>';
            }

        }
        return $textAutor;
    }

    public function getHistory($nid){
        \Drupal::service('page_cache_kill_switch')->trigger();
        $article = \Drupal::entityManager()->getStorage('node')->load($nid);
        $nodesCommentToAutor = NULL;
        $nodesCommentToEditor = NULL;
        $nodesAsign = NULL;
        $nodesRevision = NULL;

        $arrNodesCommentToAutor = [];
        $arrNodesCommentToEditor = [];
        $arrNodesAsign = [];
        $arrNodesRevision = [];

        $nodesCommentToAutor = \Drupal::entityQuery('node')
            ->condition('type', 'comentarios_para_autor')
            ->condition('field_articulo_en_revision', $nid)
            ->sort('created' , 'DESC')
            ->execute();

        $nodesCommentToEditor = \Drupal::entityQuery('node')
            ->condition('type', 'comentarios_para_editor')
            ->condition('field_articulo_en_revision', $nid)
            ->sort('created' , 'DESC')
            ->execute();
        
        $nodesAsign = \Drupal::entityQuery('node')
            ->condition('type','asignacion_revisores')
            ->condition('field_articulo_en_revision', $nid)
            ->sort('created' , 'DESC')
            ->execute();
            
        $nodesRevision = \Drupal::entityQuery('node')
            ->condition('type','revision_de_articulos')
            ->condition('field_articulo_en_revision', $nid)
            ->sort('created' , 'DESC')
            ->execute();

        if($nodesCommentToAutor != NULL){
            $nodes = \Drupal\node\Entity\Node::loadMultiple($nodesCommentToAutor);
            foreach ($nodes as $node) {
                $data = [
                    'author' => $this->load_author($node->getOwnerId()),
                    'comment' => $node->get('field_comentarios')->getValue()[0]['value'],
                    'created' => \Drupal::service('date.formatter')->format($node->get('created')->getValue()[0]['value'], 'custom', 'd M Y'),
                    'id' => $node->get('title')->getValue()[0]['value'],
                ];
                array_push($arrNodesCommentToAutor,$data);
            }
        }
        if($nodesCommentToEditor != NULL){
            $nodes = \Drupal\node\Entity\Node::loadMultiple($nodesCommentToEditor);
            foreach ($nodes as $node) {
                $data = [
                    'author' => $this->load_author($node->getOwnerId()),
                    'comment' => $node->get('field_comentarios')->getValue()[0]['value'],
                    'created' => \Drupal::service('date.formatter')->format($node->get('created')->getValue()[0]['value'], 'custom', 'd M Y'),
                    'id' => $node->get('title')->getValue()[0]['value'],
                ];
                array_push($arrNodesCommentToEditor,$data);
            }
        }
        if($nodesAsign != NULL){
            $nodes = \Drupal\node\Entity\Node::loadMultiple($nodesAsign);
            foreach ($nodes as $node) {
                $data = [
                    'revisor' => $this->load_author($node->get('field_asignar_revisor')->getValue()[0]['target_id']),
                    'author' => $this->load_author($node->getOwnerId()),
                    'created' => \Drupal::service('date.formatter')->format($node->get('created')->getValue()[0]['value'], 'custom', 'd M Y'),
                    'response' => $node->get('field_revisor_acepto_revision')->getValue()[0]['value'] == 1 ? t('Revisión aceptada') : $node->get('field_revisor_rechazo_revision')->getValue()[0]['value'] == 1 ? t('Revisión rechazada') : 'noResponse',
                    'dateResponse' => \Drupal::service('date.formatter')->format($node->get('changed')->getValue()[0]['value'], 'custom', 'd M Y'),
                    'id' => $node->get('title')->getValue()[0]['value'],
                ];
                array_push($arrNodesAsign,$data);
            }
        }
        if($nodesRevision != NULL){
            $nodes = \Drupal\node\Entity\Node::loadMultiple($nodesRevision);
            foreach ($nodes as $node) {
                $pr1 = $node->get('field_pregunta_1')->getValue()[0]['value'];
                $pr2 = $node->get('field_pregunta_3')->getValue()[0]['value'];
                $pr3 = $node->get('field_pregunta_3')->getValue()[0]['value'];
                $pr4 = $node->get('field_pregunta_4')->getValue()[0]['value'];
                $pr5 = $node->get('field_pregunta_5')->getValue()[0]['value'];
                $decision = $node->get('field_decision_revisor')->getValue()[0]['value'];
                switch ($decision) {
                    case 'aceptado':
                      $TextDecision = 'Aceptado';
                      break;
                    
                    case 'aceptado_condicion':
                      $TextDecision = 'Aceptado con condiciones';
                      break;
                    
                    case 'rechazado':
                      $TextDecision = 'Rechazado';
                      break;
                }

                $data = [
                    'author' => $this->load_author($node->getOwnerId()),
                    'created' => \Drupal::service('date.formatter')->format($node->get('created')->getValue()[0]['value'], 'custom', 'd M Y'),
                    'question_1' => t('¿Qué tan original le parece el manuscrito asignado?').' : '.$pr1,
                    'question_2' => t('¿Qué tan relevante es la información presentada en este manuscrito?').' : '.$pr2,
                    'question_3' => t('¿Qué tan bien estructurada le parece la información presentada?').' : '.$pr3,
                    'question_4' => t('¿Qué tan bien presentado está el contenido del manuscrito?').' : '.$pr4,
                    'question_5' => t('¿Qué tan claro es el mensaje que deja el manuscrito?').' : '.$pr5,
                    'decision' => $TextDecision,
                    'comentario' => isset($node->get('field_comentarios')->getValue()[0]['value']) ? $node->get('field_comentarios')->getValue()[0]['value'] : 'Ninguno',
                    'promedio' => ($pr1 + $pr2 +$pr3 + $pr4 + $pr5 )/5 ,
                    'id' => $node->get('title')->getValue()[0]['value'],
                ];
                array_push($arrNodesRevision,$data);
            }
        }
        $nodeDetail = \Drupal\node\Entity\Node::load($nid);
        $cesionDerechos = \Drupal\file\Entity\File::load($nodeDetail->get('field_cesion_derechos')->getValue()[0]['target_id']);
        $decision = $nodeDetail->get('field_estado_del_articulo')->getValue()[0]['target_id'];
        switch ($decision) {
            case '586':
                $TextDecision = t('Aceptado y publicado');
                break;
            
            case '584':
                $TextDecision = t('Aceptado con condiciones');
                break;
            
            case '573':
                $TextDecision = t('En revisión');
                break;

            case '572':
                $TextDecision = t('Sin asignar');
                break;

            case '571':
                $TextDecision = t('Recibido');
                break;
            
            case '585':
                $TextDecision = t('Rechazado');
                break;
        }
        $detailNode = [
            'id' => $nid,
            'cesionDerechos' => file_create_url($cesionDerechos->getFileUri()),
            'editor' => $this->load_author($nodeDetail->get('field_revisor')->getValue()[0]['target_id']),
            'commentEnd' => isset($nodeDetail->get('field_comentarios')->getValue()[0]['value']) ? $nodeDetail->get('field_comentarios')->getValue()[0]['value'] : t('No hay comentarios registrados'),
            'sendComment' => isset($nodeDetail->get('field_enviar_comentarios')->getValue()[0]['value']) ? $nodeDetail->get('field_enviar_comentarios')->getValue()[0]['value'] : t('No'),
            'decision' => $TextDecision,
        ];

        return [
            '#theme' => 'all_history',
            '#id' => $nid,
            '#url' => \Drupal::service('path.alias_manager')->getAliasByPath('/node/'. $nid),
            '#article' => $article->get('title')->getValue()[0]['value'],
            '#arrNodesCommentToAutor' => isset($arrNodesCommentToAutor) ? $arrNodesCommentToAutor : NULL,
            '#arrNodesCommentToEditor' => isset($arrNodesCommentToEditor) ? $arrNodesCommentToEditor : NULL,
            '#arrNodesRevision' => isset($arrNodesRevision) ? $arrNodesRevision : NULL,
            '#arrNodesAsign' => isset($arrNodesAsign) ? $arrNodesAsign : NULL,
            '#node' => $detailNode,
        ];
    }
}