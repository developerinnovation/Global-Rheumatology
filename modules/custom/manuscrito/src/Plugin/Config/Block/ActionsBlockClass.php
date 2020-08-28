<?php 

namespace Drupal\manuscrito\Plugin\Config\Block;

use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;
use Drupal\manuscrito\Plugin\Block\ActionsBlock;
use Drupal\user\Entity\User;
use Drupal\Core\Url;
use Drupal\node\Entity\Node;

/**
 * Manage config a 'ActionsBlockClass' block
 */
class ActionsBlockClass {
    protected $instance;
    protected $configuration;

    /**
     * @param \Drupal\manuscrito\Plugin\Block\ActionsBlock $instance
     * @param $config
     */
    public function setConfig(ActionsBlock &$instance, &$config){
        $this->instance = &$instance;
        $this->configuration = &$config;
    }

    /**
     * {@inheritdoc}
     */
    public function defaultConfiguration() {
        return [];
    }

  
    /**
     * @param \Drupal\manuscrito\Plugin\Block\ActionsBlock $instance
     * @param $config
     */
    public function build(ActionsBlock &$instance, $configuration){ 
        \Drupal::service('page_cache_kill_switch')->trigger();
        $nid = $configuration['node'];
        $node = \Drupal\node\Entity\Node::load($nid);
        $build = [
            '#theme' => 'actions',
            '#data' => $this->preparate($node),
        ];

        return $build;
    }

    public function preparate($node){
        if($node != null){
            $nid = $node->get('nid')->getValue()[0]['value'];
            $uid = \Drupal::currentUser()->id();
            return [
                'url' => \Drupal::service('path.alias_manager')->getAliasByPath('/node/'. $nid),
                'urlEdit' => '/update/'.str_replace('manuscrito_','',$node->bundle()).'/'.$nid,
                'assign' => '/assign/'.$nid.'/'.hash('md5',$nid,false),
                'qualify' => '/article/qualify/'.$nid.'/'.hash('md5',$nid,false),
                'comments_autor' => '/comments/review/autor/'.$nid.'/'.hash('md5','autor',false).'/'.hash('md5',$nid,false),
                'comments_editor' => '/comments/review/editor/'.$nid.'/'.hash('md5','editor',false).'/'.hash('md5',$nid,false),
                'comments_register' => '/comments/register/article/'.$uid.'/'.$nid.'/author',
                'status' => $node->get('status')->getValue()[0]['value'],
                'uid_autor' => $node->getOwnerId() == $uid ? true : false,
            ];
        }
    }

    public function bundleLabel($node_type){
        $bundle_label = \Drupal::entityTypeManager()
            ->getStorage('node_type')
            ->load($node_type)
            ->label();
        return ucfirst(str_replace('Manuscrito', '', $bundle_label)); 
    }

}
