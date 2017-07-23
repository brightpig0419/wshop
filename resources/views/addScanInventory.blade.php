<!DOCTYPE html> 
<html>
<head>
	<title>在库管理</title>
	<?php include ('includeJquery.html'); ?>
</head>
<script language="JavaScript">

            $(document).ready(function() {

                //阻止回车键后Form的提交
                $("form").bind("keypress", function(e) {
                    if (e.keyCode == 13) {
                        return false;
                    }
                });          

            });


            function fetchproduct(id) {
                //alert(id);
            };

            function initTable()
            {
                var productsRows = $('#productsRows').val();
                if (productsRows == 0) {
                    addNewRow();
                }
            }

            function addNewRow()
            {
                var html = `
                    <tr id="_ID">
                        <td><span>JAN:</span><input type="text" id="_ID_jan" name="jan[]" data-clear-btn="true"></td>
                    </tr>
                `;

                var productsRows = $('#productsRows').val();
                $('#products').append( html.replace(/_ID/g, 'R'+productsRows) );
                $('#R'+productsRows+'_jan').keypress(function(e){
                    if (e.keyCode == 13) {
                        addNewRow();
                    };
                });
                $('#tb_products').trigger('create');                
                $('#R'+productsRows+'_jan').focus();
                $('#productsRows').val( parseInt(productsRows)+1 );
            };

            function janAdd()
            {
                alert(event.keyCode);
                addNewRow();
            }



</script>

<body onload="addNewRow();">
<div data-role="page">
	<div data-role="header">
    <a href="/wshop/public/inventory" data-rel="back" class="ui-btn ui-btn-inline ui-corner-all ui-shadow ui-btn-icon-left ui-icon-arrow-l">戻る</a>
		<h1>入库</h1>
	</div><!-- /header -->
    

	<div role="main" class="ui-content">
    请用扫码枪扫码要入库商品
                <form method="post" action="/wshop/public/addConfirm" data-ajax="false">
                    <table data-role="table" id="tb_products">
                        <tbody id="products">
                            <input type="hidden" id="productsRows" name="productsRows" value="0"/>
                        </tbody>
                    </table>
                    <input type="submit" value="确认">
                </form>
    </div>
	<div data-role="footer" data-position="fixed">
		<h4>copy right</h4>
	</div><!-- /footer -->
</div><!-- /page -->
</body>
</html>

