<?php  

namespace Drupal\more_shared\Plugin\Form;  

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class moreSharedForm extends ConfigFormBase {
    /**  
     * {@inheritdoc}  
     */  
    protected function getEditableConfigNames() {  
        return [  
            'more_shared.settings',  
        ];  
    }  

    /**  
     * {@inheritdoc}  
     */  
    public function getFormId() {  
        return 'more_shared_form_settings';  
    } 

    /**  
     * {@inheritdoc}  
     */  
    public function buildForm(array $form, FormStateInterface $form_state) {  
        $config = $this->config('more_shared.settings');  

        $form['#tree'] = true;

        // login

        $form['more_shared'] = [  
            '#type' => 'details',
            '#title' => t('Configuraciones para facebook'),   
            '#open' => true,  
        ]; 

        $form['more_shared']['client_id'] = [  
            '#type' => 'textfield',
            '#title' => t('Client Id App'),   
            '#default_value' => isset($config->get('more_shared')['client_id']) ? $config->get('more_shared')['client_id'] : '',
            '#required' => true
        ]; 

        $form['more_shared']['client_secret'] = [  
            '#type' => 'textfield',
            '#title' => t('Client secret'),   
            '#default_value' => isset($config->get('more_shared')['client_secret']) ? $config->get('more_shared')['client_secret'] : '',
            '#required' => true
        ]; 

        $form['more_shared']['id_app'] = [  
            '#type' => 'textfield',
            '#title' => t('Id de la aplicación'),   
            '#default_value' => isset($config->get('more_shared')['id_app']) ? $config->get('more_shared')['id_app'] : '',
            '#required' => true
        ]; 

        return parent::buildForm($form, $form_state);
    } 

    /**  
     * {@inheritdoc}  
     */  
    public function submitForm(array &$form, FormStateInterface $form_state) {  
        parent::submitForm($form, $form_state);

        $this->config('more_shared.settings')
        ->set('more_shared', $form_state->getValue('more_shared'))  
        ->save();   

    }  

    /**  
     * {@inheritdoc}  
     */ 
    public function validateFormat(array &$form, FormStateInterface $form_state){
        parent::validateFormat($form, $form_state);
    }

}