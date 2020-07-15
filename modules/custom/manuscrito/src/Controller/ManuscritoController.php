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
                '#title' => t('Contenido no encontrado'),
                '#body' => '<p>'.t('No hemos encontrado en la revista GLOBAL RHEUMATOLOGY una url válida para su búsqueda por favor verifique la url ingresada en su navegador').'</p>',
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
                    ->condition('status', $status)
                    ->condition('uid', $uid)
                    ->condition('field_articulo_en_revision', [$nid], 'NOT IN')
                    ->condition('type','revision_de_articulos')
                    ->sort('created' , 'DESC')
                    ->execute();
                
                if($nids){
                    
                    return [
                        '#theme' => 'error_list',
                        '#title' => t('Artículo calificado con anterioridad'),
                        '#body' => '<p>'.t('Hemos detectado que ya realizaste la calificación en GLOBAL RHEUMATOLOGY del artículo').' "'.$title.'", '.t('si crees que es un error comunícate con nuestro equipo de soporte.').'</p>',
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
        if(\Drupal::currentUser()->id() != 0){
            if($rol == 'autor' || $rol == 'editor' || $rol == 'revisor'){
                $article = \Drupal::entityManager()->getStorage('node')->load($nid);        
                if(hash('md5',$rol,false) == $tokenRol && hash('md5',$nid,false) == $tokenNid && $article){
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
        date_default_timezone_set('America/Bogota');
        setlocale(LC_ALL, 'es_Es');

        $contents = [];
        foreach ($nodes as $node) {
            $nid = $node->get('nid')->getValue()[0]['value'];
            if($type != 'created'){
                if($rol == 'revisor'){

                    $comments_revisor = '/comments/review/revisor/'.$node->get('field_articulo_en_revision')->getValue()[0]['target_id'].'/'.hash('md5','revisor',false).'/'.hash('md5',$nid,false);
                }
                $comments_autor = '/comments/review/autor/'.$nid.'/'.hash('md5','autor',false).'/'.hash('md5',$nid,false);
                $comments_editor = '/comments/review/editor/'.$nid.'/'.hash('md5','editor',false).'/'.hash('md5',$nid,false);
                
                if($type == 'assigned' && $rol == 'revisor'){ 
                    $qualify = '/article/qualify/'.$node->get('field_articulo_en_revision')->getValue()[0]['target_id'].'/'.hash('md5',$nid,false);
                }
                if($type != 'assigned'){
                    $assign = '/assign/'.$nid.'/'.hash('md5',$nid,false);
                    $statusId = $node->get('field_estado_del_articulo')->getValue()[0]['target_id'];
                    $statusName = Term::load($statusId);
                    $valueStatusName =  $statusName->get('name')->getValue()[0]['value'];
                }
            }

            $content = [
                'nid' => $nid,
                'title' => $node->get('title')->getValue()[0]['value'],
                'type' => $this->bundleLabel($node->bundle()),
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
            ];
            array_push($contents,$content);
        }
        return $contents;
    }

    public function assign(Request $request, $nid = NULL, $tokenNid = NULL){

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

                return [
                    '#theme' => 'error_list',
                    '#title' => t('Revisión aceptada.'),
                    '#body' => '<p>'.t('Gracias por aceptar la revisión del artículo'). ': "'.$titleArticle.'", '.t('registrado en').' GLOBAL RHEUMATOLOGY.</p>',
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

    public function getComments(Request $request, $uid = NULL, $nid = NULL, $type = NULL){
        
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

}