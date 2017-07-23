<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GetProductInfo
{
    public function getInfoByJanCode(string $jancode){
        $items = array();
        $productInfo = array();
        require_once 'simple_html_dom.php';
        $html = file_get_html( 'http://askillers.com/jan/?index=1&word='.$jancode );

        foreach ( $html->find( '.item') as $item ) {
        $text = trim($item->innertext);
        array_push($items,$text);
        }
        
        foreach ( $items as $item ) {    
            $getStep2=str_get_html($item);
            array_push($productInfo,array('img_url'=>$getStep2->find('img')[0]->src,'name_jp'=>$getStep2->find('a')[1]->innertext));
        }

        //dd($productInfo);
        return $productInfo;
    }
}
