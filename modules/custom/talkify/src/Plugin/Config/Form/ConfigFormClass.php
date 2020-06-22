<?php  

namespace Drupal\talkify\Plugin\Config\Form;  

use Drupal\Core\Form\FormStateInterface;  

class ConfigFormClass{  
    /**  
     * {@inheritdoc}  
     */  
    protected function getEditableConfigNames() {  
        return [  
            'talkify.adminSettings',  
        ];  
    }  

    /**  
     * {@inheritdoc}  
     */  
    public function getFormId() {  
        return 'talkify_form_config';  
    } 

    /**  
     * {@inheritdoc}  
     */  
    public function buildForm(array $form, FormStateInterface $form_state) {  
        $config = \Drupal::config('talkify.adminSettingsConfig');  

        

        $form['class_id'] = [  
            '#type' => 'textfield',  
            '#title' => t('clase o id'),  
            '#description' => t('agregue la clase o id donde se observarán los controles de audio ej: ".left .box .top"'),  
            '#default_value' => $config->get('class_id'),  
        ]; 
        
        $form['api_key'] = [  
            '#type' => 'textfield',  
            '#title' => t('api Key'),  
            '#description' => t('apiKey adquirida en <a href="https://talkify.net/" target="_blank">Talkify</a>'),  
            '#default_value' => $config->get('api_key'),  
        ]; 

        $form['host'] = [  
            '#type' => 'textfield',  
            '#title' => t('host'),  
            '#description' => t('Host Ej: https://talkify.net'),  
            '#default_value' => $config->get('host'),  
        ]; 
        
        $form['speech_baseUrl'] = [  
            '#type' => 'textfield',  
            '#title' => t('speech BaseUrl'),  
            '#description' => t('url complementaria de la versión Ej: /api/speech/v1'),  
            '#default_value' => $config->get('speech_baseUrl'),  
        ]; 

        $form['voice'] = [  
            '#type' => 'select',  
            '#title' => t('Voces'),  
            '#description' => t('seleccione la voz del reproductor, para escuchar las voces ingrese al sitio web de <a href="https://talkify.net/text-to-speech" target="_blank">Talkify</a>, las voces marcadas como Premium o Exclusive son para la versión paga'),  
            '#default_value' => $config->get('voice'),  
            '#options' => array(
                'Automatic voice detection' => t('Automatic voice detection - talkify '),
                'Hoda' => t('Hoda - ar-EG (Exclusive)'),
                'Naayf' => t('Naayf - ar-SA (Exclusive)'),
                'Ivan' => t('Ivan - bg-BG (Exclusive)'),
                'Jakub' => t('Jakub - cs-CZ (Exclusive)'),
                'Gwyneth' => t('Gwyneth - cy-GB (Premium)'),
                'Naja' => t('Naja - da-DK (Premium)'),
                'Mads' => t('Mads - da-DK (Premium)'),
                'Alma' => t('Alma - da-DK (Premium)'),
                'Helle' => t('Helle - da-DK (Exclusive)'),
                'Michael' => t('Michael - de-AT (Exclusive)'),
                'Karsten' => t('Karsten - de-CH (Exclusive)'),
                'Hedda' => t('Hedda - de-DE (Standard)'),
                'Hans' => t('Hans - de-DE (Premium)'),
                'Marlene' => t('Marlene - de-DE (Premium)'),
                'Vicki' => t('Vicki - de-DE (Premium)'),
                'Laura' => t('Laura - de-DE (Premium)'),
                'Luca' => t('Luca - de-DE (Premium)'),
                'Stefanos' => t('Stefanos - el-GR (Exclusive)'),
                'Russell' => t('Russell - en-AU (Premium)'),
                'Nicole' => t('Nicole - en-AU (Premium)'),
                'Catherine' => t('Catherine - en-AU (Exclusive)'),
                'Hayley' => t('Hayley - en-AU (Exclusive)'),
                'Charlotte' => t('Charlotte - en-CA (Exclusive)'),
                'Hazel' => t('Hazel - en-GB (Standard)'),
                'Amy' => t('Amy - en-GB (Premium)'),
                'Emma' => t('Emma - en-GB (Premium)'),
                'Brian' => t('Brian - en-GB (Premium)'),
                'Sophia' => t('Sophia - en-GB (Premium)'),
                'Noah' => t('Noah - en-GB (Premium)'),
                'Mia' => t('Mia - en-GB (Premium)'),
                'Oscar' => t('Oscar - en-GB (Premium)'),
                'Susan' => t('Susan - en-GB (Exclusive)'),
                'George' => t('George - en-GB (Exclusive)'),
                'Sean' => t('Sean - en-IE (Exclusive)'),
                'Aditi' => t('Aditi - en-IN (Premium)'),
                'Raveena' => t('Raveena - en-IN (Premium)'),
                'Heera' => t('Heera - en-IN (Exclusive)'),
                'Priya' => t('Priya - en-IN (Exclusive)'),
                'Ravi' => t('Ravi - en-IN (Exclusive)'),
                'David' => t('David - en-US (Standard)'),
                'Zira' => t('Zira - en-US (Standard)'),
                'Joey' => t('Joey - en-US (Premium)'),
                'Justin' => t('Justin - en-US (Premium)'),
                'Matthew' => t('Matthew - en-US (Premium)'),
                'Ivy' => t('Ivy - en-US (Premium)'),
                'Kimberly' => t('Kimberly - en-US (Premium)'),
                'Salli' => t('Salli - en-US (Premium)'),
                'Joanna' => t('Joanna - en-US (Premium)'),
                'Kendra' => t('Kendra - en-US (Premium)'),
                'Kevin' => t('Kevin - en-US (Premium)'),
                'Sarah' => t('Sarah - en-US (Premium)'),
                'Edward' => t('Edward - en-US (Premium)'),
                'Deborah' => t('Deborah - en-US (Premium)'),
                'Joseph' => t('Joseph - en-US (Exclusive)'),
                'Elizabeth' => t('Elizabeth - en-US (Exclusive)'),
                'Jessa' => t('Jessa - en-US (Exclusive)'),
                'Benjamin' => t('Benjamin - en-US (Exclusive)'),
                'Helena' => t('Helena - es-ES (Standard)'),
                'Camila' => t('Camila - es-ES (Premium)'),
                'Luciana' => t('Luciana - es-ES (Exclusive)'),
                'Pablo' => t('Pablo - es-ES (Exclusive)'),
                'Hilda' => t('Hilda - es-MX (Standard)'),
                'Raul' => t('Raul - es-MX (Exclusive)'),
                'Penelope' => t('Penelope - es-US (Premium)'),
                'Miguel' => t('Miguel - es-US (Premium)'),
                'Heidi' => t('Heidi - fi-FI (Exclusive)'),
                'Chloe' => t('Chloe - fr-CA (Premium)'),
                'Raphael' => t('Raphael - fr-CA (Premium)'),
                'Caroline' => t('Caroline - fr-CA (Exclusive)'),
                'Guillaume' => t('Guillaume - fr-CH (Exclusive)'),
                'Hortense' => t('Hortense - fr-FR (Standard)'),
                'Mathieu' => t('Mathieu - fr-FR (Premium)'),
                'Lea' => t('Lea - fr-FR (Premium)'),
                'Celine' => t('Celine - fr-FR (Premium)'),
                'Louise' => t('Louise - fr-FR (Premium)'),
                'Louis' => t('Louis - fr-FR (Premium)'),
                'Julie' => t('Julie - fr-FR (Exclusive)'),
                'Paul' => t('Paul - fr-FR (Exclusive)'),
                'Asaf' => t('Asaf - he-IL (Exclusive)'),
                'Kalpana' => t('Kalpana - hi-IN (Exclusive)'),
                'Hemant' => t('Hemant - hi-IN (Exclusive)'),
                'Matej' => t('Matej - hr-HR (Exclusive)'),
                'Szabolcs' => t('Szabolcs - hu-HU (Exclusive)'),
                'Andika' => t('Andika - id-ID (Exclusive)'),
                'Dora' => t('Dora - is-IS (Premium)'),
                'Karl' => t('Karl - is-IS (Premium)'),
                'Lucia' => t('Lucia - it-IT (Standard)'),
                'Carla' => t('Carla - it-IT (Premium)'),
                'Bianca' => t('Bianca - it-IT (Premium)'),
                'Giorgio' => t('Giorgio - it-IT (Premium)'),
                'Gabriella' => t('Gabriella - it-IT (Premium)'),
                'Cosimo' => t('Cosimo - it-IT (Exclusive)'),
                'Haruka' => t('Haruka - ja-JP (Standard)'),
                'Mizuki' => t('Mizuki - ja-JP (Premium)'),
                'Takumi' => t('Takumi - ja-JP (Premium)'),
                'Yui' => t('Yui - ja-JP (Premium)'),
                'Ayumi' => t('Ayumi - ja-JP (Exclusive)'),
                'Ichiro' => t('Ichiro - ja-JP (Exclusive)'),
                'Heami' => t('Heami - ko-KR (Standard)'),
                'Seoyeon' => t('Seoyeon - ko-KR (Premium)'),
                'Ha-yoon' => t('Ha-yoon - ko-KR (Premium)'),
                'Minji' => t('Minji - ko-KR (Premium)'),
                'Kim' => t('Kim - ko-KR (Premium)'),
                'Rizwan' => t('Rizwan - ms-MY (Exclusive)'),
                'Liv' => t('Liv - nb-NO (Premium)'),
                'Martine' => t('Martine - nb-NO (Premium)'),
                'Olivia' => t('Olivia - nb-NO (Exclusive)'),
                'Hulda' => t('Hulda - nb-NO (Exclusive)'),
                'Lotte' => t('Lotte - nl-NL (Premium)'),
                'Ruben' => t('Ruben - nl-NL (Premium)'),
                'Hanna' => t('Hanna - nl-NL (Exclusive)'),
                'Ewa' => t('Ewa - pl-PL (Premium)'),
                'Maja' => t('Maja - pl-PL (Premium)'),
                'Jacek' => t('Jacek - pl-PL (Premium)'),
                'Jan' => t('Jan - pl-PL (Premium)'),
                'Paulina' => t('Paulina - pl-PL (Exclusive)'),
                'Ricardo' => t('Ricardo - pt-BR (Premium)'),
                'Vitoria' => t('Vitoria - pt-BR (Premium)'),
                'Daniel' => t('Daniel - pt-BR (Exclusive)'),
                'Ines' => t('Ines - pt-PT (Premium)'),
                'Cristiano' => t('Cristiano - pt-PT (Premium)'),
                'Heloisa' => t('Heloisa - pt-PT (Exclusive)'),
                'Helia' => t('Helia - pt-PT (Exclusive)'),
                'Carmen' => t('Carmen - ro-RO (Premium)'),
                'Andrei' => t('Andrei - ro-RO (Exclusive)'),
                'Maxim' => t('Maxim - ru-RU (Premium)'),
                'Tatyana' => t('Tatyana - ru-RU (Premium)'),
                'Olga' => t('Olga - ru-RU (Premium)'),
                'Sergey' => t('Sergey - ru-RU (Premium)'),
                'Irina' => t('Irina - ru-RU (Exclusive)'),
                'Pavel' => t('Pavel - ru-RU (Exclusive)'),
                'Ekaterina' => t('Ekaterina - ru-RU (Exclusive)'),
                'Michaela' => t('Michaela - sk-SK (Premium)'),
                'Filip' => t('Filip - sk-SK (Exclusive)'),
                'Lado' => t('Lado - sl-SI (Exclusive)'),
                'Hedvig' => t('Hedvig - sv-SE (Standard)'),
                'Astrid' => t('Astrid - sv-SE (Premium)'),
                'Linda' => t('Linda - sv-SE (Premium)'),
                'Valluvar' => t('Valluvar - ta-IN (Exclusive)'),
                'Chitra' => t('Chitra - te-IN (Exclusive)'),
                'Pattara' => t('Pattara - th-TH (Exclusive)'),
                'Filiz' => t('Filiz - tr-TR (Premium)'),
                'Arda' => t('Arda - tr-TR (Premium)'),
                'Beyza' => t('Beyza - tr-TR (Premium)'),
                'Seda' => t('Seda - tr-TR (Exclusive)'),
                'Nastya' => t('Nastya - uk-UA (Premium)'),
                'Anastasia' => t('Anastasia - uk-UA (Exclusive)'),
                'An' => t('An - vi-VN (Exclusive)'),
                'Huihui' => t('Huihui - zh-CN (Standard)'),
                'Zhiyu' => t('Zhiyu - zh-CN (Premium)'),
                'Yaoyao' => t('Yaoyao - zh-CN (Exclusive)'),
                'Kangkang' => t('Kangkang - zh-CN (Exclusive)'),
                'Tracy' => t('Tracy - zh-HK (Exclusive)'),
                'Danny' => t('Danny - zh-HK (Exclusive)'),
                'Yating' => t('Yating - zh-TW (Exclusive)'),
                'HanHan' => t('HanHan - zh-TW (Exclusive)'),
                'Zhiwei' => t('Zhiwei - zh-TW (Exclusive)'),
            ),
        ];
        

        return $form;  
    } 

    /**  
     * {@inheritdoc}  
     */  
    public function submitForm(array &$form, FormStateInterface $form_state) {  

        $config = \Drupal::configFactory()->getEditable('talkify.adminSettingsConfig');
        $config
            ->set('class_id', $form_state->getValue('class_id'))  
            ->set('api_key', $form_state->getValue('api_key'))  
            ->set('host', $form_state->getValue('host'))  
            ->set('speech_baseUrl', $form_state->getValue('speech_baseUrl')) 
            ->set('voice', $form_state->getValue('voice'))  
            ->save();  
    }  
} 