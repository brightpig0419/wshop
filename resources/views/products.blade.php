<table>
<?php
    foreach($test as $product){
        ?>
        <tr><td>
        <?php
        echo $product->name;
        echo "\n";
        ?>
        </td></tr>
        <?php
    }
?>
</table>