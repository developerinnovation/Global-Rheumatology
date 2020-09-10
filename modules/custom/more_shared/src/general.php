<?php 

namespace Drupal\more_shared;

use Drupal\file\Entity\File;
use Drupal\rest\ResourceResponse;
use Drupal\user\Entity\User;

class general{
    
    /**
     * getMoreShared
     *
     * @return array
     */
    public function getAllNodePublished(){

        $result = [];
        $data = [];

        $nodes = \Drupal::entityQuery('node')
                ->condition('status', 1)
                ->sort('created' , 'DESC')
                ->execute();

        if($nodes){
            $nodes = \Drupal\node\Entity\Node::loadMultiple($nodes);
            $endPoint = 'https://globalrheumpanlar.org';
            foreach ($nodes as $key => $node) {
                $nid = (string)$node->get('nid')->getValue()[0]['value'];
                $search = $endPoint.\Drupal::service('path.alias_manager')->getAliasByPath('/node/'. $nid);
                $response = $this->getSharedCount($search);
                if($response->og_object){
                    $data[$nid] = [
                        'count' => $response->og_object->engagement->count,
                        'url' => $response->id,
                    ];
                    array_push($result, $data);
                }
            }
        }        
        return $result;
    }

    public function getSharedCount($urlSite){
        
        $config = \Drupal::config('more_shared.settings');  
        $client_id = $config->get('more_shared')['client_id'];
        $client_secret = $config->get('more_shared')['client_secret'];
        $id_app = $config->get('more_shared')['id_app'];

        $url = 'https://graph.facebook.com';

        $query = [
            'id' => $urlSite,
            'fields' => 'og_object{engagement}',
            'access_token' => $id_app.'|'.$client_secret,
        ];


        $ch = curl_init();
        $data = http_build_query($query);
        $getUrl = $url."?".$data;
        
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $getUrl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);

        $response = curl_exec($ch);

        if(curl_error($ch)){
            return [];
        }else{
            return json_decode($response);
        }

        curl_close($ch);
    }
}
