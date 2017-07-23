<!DOCTYPE html> 
<html>
<head>
	<title>在库管理</title>
	<?php include ('includeJquery.html'); ?>
</head>
<script language="JavaScript">


</script>

<body>
<div data-role="page" id="delConfirm">
	<div data-role="header"  data-add-back-btn="true">
    <a href="/wshop/public/delScanInventory" data-rel="back" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-btn-icon-left ui-icon-arrow-l">戻る</a>
		<h1>出库确认</h1>
	</div><!-- /header -->

    <div role="main" class="ui-content">
	<form method="post" action="/wshop/public/delInventory" data-ajax="false">
    <table data-role="table" id="table-custom-2" data-mode="columntoggle" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="a" data-column-btn-text="选择项" data-column-popup-theme="a">
        <thead>
            <tr>
                <th data-priority="1">商品图片</th>
                <th data-priority="2">商品名称</th>
                <th data-priority="3">出库数量</th>
            </tr>
            </thead> 
            <tbody>
            <?php
                foreach($delConfirm as $confirm){
            ?>
                    <td align="center"><?php if($confirm['img_url']!=""){?><img height=100 src="<?php echo $confirm['img_url'];?>" alt="无效图片" class="ui-btn-center" /><?php }else{echo "图片未编辑";}?> </td>
                    <td><?php if($confirm['name_cn']!=""){echo $confirm['name_cn'];}else{echo "产品名未编辑";}?>
                    <br>产品JAN码:<?php echo $confirm['jancode'];?>
                    <br>产品日文名:<?php echo $confirm['name_jp'];?>
						<input type="hidden" id="_ID_jan" name="jan[]" data-clear-btn="true" value="<?php echo $confirm['jancode'];?>">
					</td>
	                <td><input type="text" id="addAcount" name="addAcount[]" data-clear-btn="true" value="<?php echo $confirm['addAcount'];?>"></td>
                </tr>
            <?php
                }
            ?>

            </tbody>
        </table>
        <input type="submit" value="确定出库">
        </form>


	</div>
	<div data-role="footer" data-position="fixed">
		<h4>copy right</h4>
	</div><!-- /footer -->
</div><!-- /page -->


</body>
</html>

