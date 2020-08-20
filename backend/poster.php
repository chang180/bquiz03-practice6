<form action="api/edit_poster.php" method="post">
<h1 class="ct">預告片清單</h1>
<table>
    <tr>
        <td>預告片海報</td>
        <td>預告片片名</td>
        <td>預告片排序</td>
        <td>操作</td>
    </tr>
<?php
$rows=$Poster->all([]," ORDER BY rank DESC");
foreach ($rows as $row){
?>
    <tr>
        <td><img src="img/<?=$row['img'];?>" style="width:68px;height:80px;"></td>
        <td><input type="text" name="name[]" value="<?=$row['name'];?>"></td>
        <td><input type="number" name="rank[]" value="<?=$row['rank'];?>"></td>
        <td>
        
        </td>
    </tr>
<?php } ?>
</table>
<button>修改確定</button><button type="reset">重置</button>
</form>