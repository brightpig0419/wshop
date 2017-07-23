<!DOCTYPE html> 
<html>
<head>
        <title>在库管理</title>
        <?php include ('includeJquery.html'); ?>
</head>
<body>
<div data-role="page">
        <div data-role="header" data-position="fixed">
                <a href="#popupMenu" data-rel="popup" data-transition="slide" class="ui-btn ui-btn-icon-left ui-icon-plus">入库</a>
                <div data-role="popup" id="popupMenu" data-theme="b">
                        <ul data-role="listview" data-inset="true" style="min-width:210px;">
                        <li data-role="list-divider">请选择入库方法</li>
                        <li><a href="/wshop/public/addScanInventory" rel="external" data-transition="slide" class="ui-btn ui-btn-icon-left ui-icon-tag">按商品码入库</a></li>
                        <li><a href="#" rel="external" data-transition="slide" class="ui-btn ui-btn-icon-left ui-icon-mail">按邮单入库</a></li>
                        <li><a href="#" rel="external" data-transition="slide" class="ui-btn ui-btn-icon-left ui-icon-edit">手动入库</a></li>
                        </ul>
</div>
                
                <h1>在库一览</h1>
                <a href="/wshop/public/delScanInventory" rel="external" data-transition="slide" class="ui-btn ui-btn-icon-left ui-icon-minus">出库</a>
        </div>
        <div role="main" class="ui-content">
<table data-role="table" class="ui-body-d table-stripe ui-responsive movie-list">
    <thead>
        <tr>
            <th data-priority="1">商品图片</th>
            <th data-priority="2">商品名称</th>
            <th data-priority="3">在库数量</th>
            <th data-priority="4">运输中数量</th>
            <th data-priority="5">备注</th>
        </tr>
        </thead>
        <tbody>
<?php foreach($allInventory as $inventory){ ?>
            <tr>
<td><?php if($inventory->img_url!=""){?><img height=100 src="<?php echo $inventory->img_url;?>" alt="无效图片" class="ui-btn-center" /><?php }else{echo "图片未编辑";}?> </td>
                <td><?php if($inventory->name_cn!=""){echo $inventory->name_cn;}else{echo "产品名未编辑";}?>
                        <br>产品JAN码:<?php echo $inventory->jancode;?>
                        <br>日文产品名:<?php echo $inventory->name_jp;?>
                </td>
                <td><?php echo $inventory->invAcount;?></td>
                <td><?php echo $inventory->postAcount;?></td>
                <td><a target="_blank" href="https://www.amazon.co.jp/s/ref=nb_sb_noss?__mk_ja_JP=カタカナ&url=search-alias%3Dhpc&field-keywords=<?php echo $inventory->jancode;?>" rel="external" data-transition="slide" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-left ui-icon-shop">Amazon</a></td>
            </tr>
<?php } ?>
        </tbody>
    </table>
        </div>
        <div data-role="footer" data-position="fixed">
                <h4>copy right</h4>
        </div>
</div>
</body>
</html>
