<?php
include_once "../base.php";

for($i=1;$i<=20;$i++){
    echo "<img src='icon/03D02.png'><input type='checkbox' value='$i' class='seat'>";

    if($i%5==0) echo "<br>";
}
