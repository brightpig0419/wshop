<?php

namespace App\Http\Controllers;
use DB;
use App\Inventory;
use App\GetPostInfo;
use App\GetProductInfo;
use Illuminate\Http\Request;

class postItemNoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $results = DB::select("SELECT * FROM postitemno");
        $postNo=$results[0]->post_item_no; 
        $getpostinfo = new GetPostInfo;
        $postinfo=$getpostinfo->getPostStatus($postNo);
        //dd($postinfo);
        return view('postItemNoList',['allPostItemNo'=> $results,'poststatus'=> $postinfo]);
    }

    public function addScanPostItemNo()
    {
        return view('addScanPostItemNo');
    }
    
    //入库确认画面
    public function addPostItemNoConfirm(Request $request)
    {
        $abcde="abc";
        echo "54545454";
        dd("zgzgzg");

        $allJan=$request->input("jan");
        
        $postItemNo=$request->input("postItemNo");

        $allJanUnique=array_count_values ($allJan);

        $results = array();

        foreach($allJanUnique as $key=>$val){
            if($key!=""){
            $products=DB::select("SELECT img_url,name_cn,name_jp FROM products where jancode='".$key."'");
                if($products!=null){
                    array_push($results,array('img_url'=>$products[0]->img_url,'name_cn'=>$products[0]->name_cn,'name_jp'=>$products[0]->name_jp,'addAcount'=>$val,'jancode'=>$key));
                }else{
                    $getproinfo = new GetProductInfo;
                    $proinfo=$getproinfo->getInfoByJanCode($key);

                    $img_rul_tmp="";
                    $name_jp_tmp="";
                    if($proinfo!=null){
                        $img_rul_tmp=$proinfo[0]['img_url'];
                        $name_jp_tmp=$proinfo[0]['name_jp'];
                        $affected = DB::insert("insert into products (jancode,img_url,name_jp) values ('".$key."','".$img_rul_tmp."','".$proinfo[0]['name_jp']."')");
                    }
                    array_push($results,array('img_url'=>$img_rul_tmp,'name_cn'=>'商品未编辑','name_jp'=>$name_jp_tmp,'addAcount'=>$val,'jancode'=>$key));
                }
            }
        }
        return view('addPostItemNoConfirm',['addProductsConfirm'=> $results,'postItemNo'=>$postItemNo]);
        //
    }

}
    