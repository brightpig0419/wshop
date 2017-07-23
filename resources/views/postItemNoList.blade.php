<!DOCTYPE html> 
<html>
<head>
        <title>邮单管理</title>
        <?php include ('includeJquery.html'); ?>
</head>
<body>
<div data-role="page">
        <div data-role="header" data-position="fixed">
                <a href="/wshop/public/addScanPostItemNo" rel="external" data-transition="slide" class="ui-btn ui-btn-icon-left ui-icon-tag">添加</a>
                <h1>邮单一览</h1>
        </div>
        <div role="main" class="ui-content">
<table data-role="table" class="ui-body-d table-stripe ui-responsive movie-list">
    <thead>
        <tr>
            <th data-priority="1">邮单类型</th>
            <th data-priority="2">邮单号码</th>
            <th data-priority="3">发货时间</th>
            <th data-priority="4">描述</th>
            <th data-priority="5">查看状态</th>
        </tr>
        </thead>
        <tbody>
<?php foreach($allPostItemNo as $postItemNo){ ?>
            <tr>
                <td><?php echo $postItemNo->type; ?></td>
                <td><?php echo $postItemNo->post_item_no; ?></td>
                <td><?php echo $postItemNo->send_time;?></td>
                <td><?php echo $postItemNo->description;?></td>
                <td><a target="_blank" href="https://m.kuaidi100.com/index_all.html?postid=<?php echo $postItemNo->post_item_no;?>" rel="external" data-transition="slide" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-icon-left ui-icon-shop">查询</a></td>
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
