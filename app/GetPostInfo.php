<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GetPostInfo
{
    public function getPostStatus(string $postItemNo){
        $items = array();
        $productInfo = array();
        require_once 'simple_html_dom.php';
        $html = file_get_html( 'https://m.kuaidi100.com/index_all.html?postid='.$postItemNo );

        foreach ( $html->find( '.queryResult') as $item ) {
        $text = trim($item->innertext);
        array_push($items,$text);
        }
        
        /*foreach ( $items as $item ) {    
            $getStep2=str_get_html($item);
            array_push($productInfo,array('img_url'=>$getStep2->find('img')[0]->src,'name_jp'=>$getStep2->find('a')[1]->innertext));
        }*/

        //dd($productInfo);
        return $items;
    }
}
