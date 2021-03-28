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
                ->range(0, 49)
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

    public function more_shared (){
        // $more_shared = $this->getAllNodePublished();
        // if(count($more_shared) > 0){
        //     $factory = \Drupal::service('tempstore.shared');
        //     $store = $factory->get('more_shared.shared');
        //     $storeJson = json_encode($more_shared);
        //     $store->set('more_shared_count', $storeJson);
        
        // }

        // $this->more_shared_process();

        $data = '{"487":{"nid":487,"count":1,"url":"https:\/\/globalrheumpanlar.org\/articulo\/conocimiento-o-ignorancia-487"},"484":{"nid":484,"count":9,"url":"https:\/\/globalrheumpanlar.org\/articulo\/los-retos-de-las-sociedades-cientificas-ante-la-pandemia-484"},"499":{"nid":499,"count":90,"url":"https:\/\/globalrheumpanlar.org\/articulo\/los-desafios-de-ser-un-centro-de-excelencia-499"},"459":{"nid":459,"count":122,"url":"https:\/\/globalrheumpanlar.org\/videos\/analisis-del-impacto-del-covid-19-en-pacientes-con-enfermedades-reumaticas-459"},"452":{"nid":452,"count":7,"url":"https:\/\/globalrheumpanlar.org\/articulo\/sonar-en-grande-y-trabajar-por-ello-en-equipo-452"},"450":{"nid":450,"count":1,"url":"https:\/\/globalrheumpanlar.org\/articulo\/octubre-rosa-en-ano-gris-plomo-450"},"430":{"nid":430,"count":2,"url":"https:\/\/globalrheumpanlar.org\/articulo\/la-carrera-por-la-vacuna-430"},"411":{"nid":411,"count":10,"url":"https:\/\/globalrheumpanlar.org\/manuscrito-articulo-original\/manifestaciones-reumaticas-y-dermatologicas-en-pacientes"},"385":{"nid":385,"count":12,"url":"https:\/\/globalrheumpanlar.org\/podcast\/una-mirada-la-vacuna-contra-el-covid-19-desde-la-reumatologia-385"}}';
        $shared = (array)json_decode($data, 1);
        uasort($shared, array($this,'sort_by_orden'));
        $prueba = $shared;
    }

    public function more_shared_process() {
        $nid = [];
        $factory = \Drupal::service('tempstore.shared');
        $store = $factory->get('more_shared.shared');
        $value = $store->get('more_shared_count');
        $more_shared_count = (array)json_decode($value, true);
        $shared = [];
        if(count($more_shared_count) > 0){
            foreach ($more_shared_count as $key => $nodes) {
                foreach ($nodes as $keyNode => $valueNode) {
                    if($valueNode['count'] > 0){
                        array_push($nid, $keyNode);
                        $shared[$keyNode] = [
                            'nid' => $keyNode,
                            'count' => $valueNode['count'],
                            'url' => $valueNode['url'],
                        ];
                    }
                    
                }
            }
            uasort($shared, array($this,'sort_by_orden'));
            $array_keys = array_keys($shared);
            $variables['more_shared_nid'] = implode(',', $array_keys);
            $variables['more_shared'] = $shared;
        }

        $data = '{"487":{"nid":487,"count":1,"url":"https:\/\/globalrheumpanlar.org\/articulo\/conocimiento-o-ignorancia-487"},"484":{"nid":484,"count":9,"url":"https:\/\/globalrheumpanlar.org\/articulo\/los-retos-de-las-sociedades-cientificas-ante-la-pandemia-484"},"499":{"nid":499,"count":90,"url":"https:\/\/globalrheumpanlar.org\/articulo\/los-desafios-de-ser-un-centro-de-excelencia-499"},"459":{"nid":459,"count":122,"url":"https:\/\/globalrheumpanlar.org\/videos\/analisis-del-impacto-del-covid-19-en-pacientes-con-enfermedades-reumaticas-459"},"452":{"nid":452,"count":7,"url":"https:\/\/globalrheumpanlar.org\/articulo\/sonar-en-grande-y-trabajar-por-ello-en-equipo-452"},"450":{"nid":450,"count":1,"url":"https:\/\/globalrheumpanlar.org\/articulo\/octubre-rosa-en-ano-gris-plomo-450"},"430":{"nid":430,"count":2,"url":"https:\/\/globalrheumpanlar.org\/articulo\/la-carrera-por-la-vacuna-430"},"411":{"nid":411,"count":10,"url":"https:\/\/globalrheumpanlar.org\/manuscrito-articulo-original\/manifestaciones-reumaticas-y-dermatologicas-en-pacientes"},"385":{"nid":385,"count":12,"url":"https:\/\/globalrheumpanlar.org\/podcast\/una-mirada-la-vacuna-contra-el-covid-19-desde-la-reumatologia-385"}}';
        $shared = (array)json_decode($data, 1);
        uasort($shared, array($this,'sort_by_orden'));
        $array_keys = array_keys($shared);
        $variables['more_shared_nid'] = implode(',', $array_keys);
        $variables['more_shared'] = $shared;
    }

    public function sort_by_orden ($a, $b) {
        return  $b['count'] - $a['count'];
    }
    
}
