<?php
if(!empty($_SESSION['login'])) to("admin.php");
?>
<form action="api/login.php" method="post">
    帳號：<input type="text" name="acc" id="acc"><br>
    密碼：<input type="password" name="pw" id="pw"><br>
    <button>登入</button><button type="reset">重置</button>
</form>