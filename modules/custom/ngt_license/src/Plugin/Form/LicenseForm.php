<?php  

namespace Drupal\ngt_license\Plugin\Form;  

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LicenseForm extends ConfigFormBase {
    /**  
     * {@inheritdoc}  
     */  
    protected function getEditableConfigNames() {  
        return [  
            'ngt_license.settings',  
        ];  
    }  

    /**  
     * {@inheritdoc}  
     */  
    public function getFormId() {  
        return 'ngt_license_form_settings';  
    } 

    /**  
     * {@inheritdoc}  
     */  
    public function buildForm(array $form, FormStateInterface $form_state) {  
        $config = $this->config('ngt_license.settings');  


        $form['#tree'] = true;

       
        // licencia

        $form['ngt_license'] = [  
            '#type' => 'details',
            '#title' => t('Configuraciones de texto para licencias'),   
            '#open' => true,  
        ]; 

        $form['ngt_license']['title_es'] = [  
            '#type' => 'textfield',
            '#title' => t('Texto para título licencia en español'),   
            '#default_value' => isset($config->get('ngt_license')['title_es']) ? $config->get('ngt_license')['title_es'] : 'Licencia',
            '#required' => true
        ]; 

        $form['ngt_license']['title_en'] = [  
            '#type' => 'textfield',
            '#title' => t('Texto para título licencia en inglés'),   
            '#default_value' => isset($config->get('ngt_license')['title_en']) ? $config->get('ngt_license')['title_en'] : 'License',
            '#required' => true
        ]; 

        $form['ngt_license']['txt_es'] = [  
            '#type' => 'textarea',
            '#title' => t('Texto para licencia en español'),   
            '#default_value' => isset($config->get('ngt_license')['txt_es']) ? $config->get('ngt_license')['txt_es'] : 'Este es un artículo de acceso abierto, distribuido bajo los términos de Creative Commons Attribution (CC .BY. NC-4). Esta permitido copiar y redistribuir el material en cualquier medio o formato.  Remezclar, transformar y construir a partir del material . Usted debe dar crédito de manera adecuada, brindar un enlace a la licencia, e indicar si se han realizado cambios. Puede hacerlo en cualquier forma razonable, pero no de forma tal que sugiera que usted o su uso tienen el apoyo de la licenciante. Usted no puede hacer uso del material con propósitos comerciales.',
            '#required' => true
        ]; 

        $form['ngt_license']['txt_en'] = [  
            '#type' => 'textarea',
            '#title' => t('Texto para licencia en inglés'),   
            '#default_value' => isset($config->get('ngt_license')['txt_en']) ? $config->get('ngt_license')['txt_en'] : 'This is an open-access article distributed by the terms of the Creative Common Attribution License (CC-BY NC-4). The use, distribution or reproduction in other forms is permitted, provided the original author(a) and the copyright owner(s) are credited and that the original publication in this journal is cited, in accordance with accepted academic practice. No use, distribution or reproduction is permitted which does not comply with this terms.',
            '#required' => true
        ]; 

        return parent::buildForm($form, $form_state);
    } 

    /**  
     * {@inheritdoc}  
     */  
    public function submitForm(array &$form, FormStateInterface $form_state) {  
        parent::submitForm($form, $form_state);

        $this->config('ngt_license.settings')
        ->set('ngt_license', $form_state->getValue('ngt_license'))  
        ->save();   

    }  

    /**  
     * {@inheritdoc}  
     */ 
    public function validateFormat(array &$form, FormStateInterface $form_state){
        parent::validateFormat($form, $form_state);
    }

}