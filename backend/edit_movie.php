<form action="api/save_movie.php" method="post" enctype="multipart/form-data">
<?php $row=$Movie->find($_GET['id']); ?>
片名：<input type="text" name="name" value="<?=$row['name'];?>"><br>
分級：<select name="level">
    <option value="1">普遍級</option>
    <option value="2">保護級</option>
    <option value="3">輔導級</option>
    <option value="4">限制級</option>
</select>
片長：<input type="text" name="length" value="<?=$row['length'];?>"><br>
上映日期：
<select name="y"><option value="2020">2020</option>
</select>年
<select name="m">
    <?php
for($i=1;$i<=12;$i++){
    echo "<option>$i</option>";
}
?>
</select>月
<select name="d">
    <?php
for($i=1;$i<=31;$i++){
    echo "<option>$i</option>";
}
?>
</select>日
<br>
發行商：<input type="text" name="publish" value="<?=$row['publish'];?>"><br>
導演：<input type="text" name="director" value="<?=$row['director'];?>"><br>
預告影片：<input type="file" name="trailer"><br>
電影海報：<input type="file" name="poster"><br>
劇情簡介：<textarea name="intro" style="width:500px;height:200px;"><?=$row['intro'];?></textarea><br>
排序：<input type="number" name="rank" value="<?=$row['rank'];?>"><br>
是否顯示(1:顯示，0:不顯示) <input type="number" name="sh" value="<?=$row['sh'];?>"><br>
<input type="hidden" name="id" value="<?=$row['id'];?>">
<div class="ct"><button>編輯確定</button><button type="reset">重置</button></div>
</form>