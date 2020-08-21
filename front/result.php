<?php $row=$Ord->find(['no'=>$_GET['no']]); ?>
感謝您的訂購，您的訂單編號是：<?=$_GET['no'];?><br>
電影名稱：<?=$row['name'];?><br>
日期：<?=$row['date'];?><br>
場次：<?=$row['session'];?><br>
座位：<br>
<?php
$seat=unserialize($row['seat']);
foreach($seat as $s) echo $s,",";
?>
<br>
共<?=$row['qt'];?>張電影票<br>
<div class="ct"><button onclick="location.href='index.php'">確認</button></div>