<?php

namespace App\Http\Controllers;
use DB;
use App\Inventory;
use App\GetProductInfo;
use Illuminate\Http\Request;

class InventoryController extends Controller
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
        $results = DB::select("SELECT products.img_url,products.name_cn,products.name_jp,products.jancode,inventory.id,inventory.invAcount,
        inventory.postAcount,inventory.status FROM inventory,products where inventory.productsId=products.id");
        //dd($results);
        return view('inventory',['allInventory'=> $results]);
    }

    public function addScanInventory()
    {
        return view('addScanInventory');
    }

    public function delScanInventory()
    {
        return view('delScanInventory');
    }

    //入库确认画面
    public function addConfirm(Request $request)
    {
        $allJan=$request->input("jan");

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
        return view('addConfirm',['addConfirm'=> $results]);
        //
    }



    //入库处理
    public function addInventory(Request $request)
    {
        $allJan=$request->input("jan");
        $allAddAcount=$request->input("addAcount");

        for ($i = 0; $i < count($allJan); $i++) {
            $productsId=DB::select("SELECT id FROM products where jancode='".$allJan[$i]."'");
                if($productsId!=null){
                    $invAcounts=DB::select("SELECT invAcount FROM inventory where productsId=".$productsId[0]->id);
                    if($invAcounts!=null){
                        $affected = DB::update("update inventory set invAcount=invAcount+".$allAddAcount[$i]." where productsId='".$productsId[0]->id."'");
                    }else{
                        $affected = DB::insert("insert into inventory (productsId,invAcount) values ('".$productsId[0]->id."','".$allAddAcount[$i]."')");
                    }
                }else{
                    $affected = DB::insert("insert into products (jancode) values ('".$allJan[$i]."')");
                    $insertProductsId=DB::select("SELECT id FROM products where jancode='".$allJan[$i]."'");
                    $affected = DB::insert("insert into inventory (productsId,invAcount) values ('".$insertProductsId[0]->id."','".$allAddAcount[$i]."')");
                }
        }

        return redirect('/inventory');
    }

    //出库确认画面
    public function delConfirm(Request $request)
    {
        $allJan=$request->input("jan");

        $allJanUnique=array_count_values ($allJan);

        $results = array();

        foreach($allJanUnique as $key=>$val){
            if($key!=""){
            $products=DB::select("SELECT img_url,name_cn,name_jp,id FROM products where jancode='".$key."'");
                if($products!=null){
                    $inventory=DB::select("SELECT id FROM inventory where productsId=".$products[0]->id);
                    if($inventory!=null){
                        array_push($results,array('img_url'=>$products[0]->img_url,'name_cn'=>$products[0]->name_cn,'name_jp'=>$products[0]->name_jp,'addAcount'=>$val,'jancode'=>$key));
                    }else{
                        array_push($results,array('img_url'=>$products[0]->img_url,'name_cn'=>'该商品没有入库信息，请先入库','name_jp'=>$products[0]->name_jp,'addAcount'=>$val,'jancode'=>$key));
                    }
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
                    array_push($results,array('img_url'=>$img_rul_tmp,'name_cn'=>'该商品没有入库信息，请先入库','name_jp'=>$name_jp_tmp,'addAcount'=>$val,'jancode'=>$key));
                }
            }
        }

        //dd($results);
        //$results = DB::select("SELECT * FROM products");
        return view('delConfirm',['delConfirm'=> $results]);
        //
    }

    public function delInventory(Request $request)
    {
        $allJan=$request->input("jan");
        $allAddAcount=$request->input("addAcount");

        for ($i = 0; $i < count($allJan); $i++) {
            $productsId=DB::select("SELECT id FROM products where jancode='".$allJan[$i]."'");
                if($productsId!=null){
                    $invAcounts=DB::select("SELECT invAcount FROM inventory where productsId=".$productsId[0]->id);
                    if($invAcounts!=null){
                        $affected = DB::update("update inventory set invAcount=invAcount-".$allAddAcount[$i]." where productsId='".$productsId[0]->id."'");
                    }else{
                        //$affected = DB::insert("insert into inventory (productsId,invAcount) values ('".$productsId[0]->id."','".$allAddAcount[$i]."')");
                    }
                }else{
                    $affected = DB::insert("insert into products (jancode) values ('".$allJan[$i]."')");
                    //$insertProductsId=DB::select("SELECT id FROM products where jancode='".$allJan[$i]."'");
                    //$affected = DB::insert("insert into inventory (productsId,invAcount) values ('".$insertProductsId[0]->id."','".$allAddAcount[$i]."')");
                }
        }

        return redirect('/inventory');
        //
    }
    //
}
