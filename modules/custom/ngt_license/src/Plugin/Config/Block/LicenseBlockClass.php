<?php 

namespace Drupal\ngt_license\Plugin\Config\Block;

use Drupal\ngt_license\Plugin\Block\LicenseBlock;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;
use Drupal\file\Entity\File;



/**
 * Manage config a 'LicenseBlockClass' block
 */
class LicenseBlockClass {
    protected $instance;
    protected $configuration;

    /**
     * @param \Drupal\ngt_license\Plugin\Block\LicenseBlock $instance
     * @param $config
     */
    public function setConfig(LicenseBlock &$instance, &$config){
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
     * @param \Drupal\ngt_license\Plugin\Block\LicenseBlock $instance
     * @param $config
     */
    public function build(LicenseBlock &$instance, $configuration){
        \Drupal::service('page_cache_kill_switch')->trigger();

        $config = \Drupal::config('ngt_license.settings');  
        $language = \Drupal::languageManager()->getCurrentLanguage()->getId();

        if($language == 'es') {
            $title_license = $config->get('ngt_license')['title_es'];
            $txt_license = $config->get('ngt_license')['txt_es'];
        }else if($language == 'en') {
            $title_license = $config->get('ngt_license')['title_en'];
            $txt_license = $config->get('ngt_license')['txt_en'];
        }
        
        $build = [
            '#theme' => 'ngt_license',
            '#title_license' => $title_license,
            '#txt_license' => $txt_license,
        ];

        return $build;
    }

}