<div id="mm">
    <form id="order-form">
        <h1 class="ct">線上訂票</h1>
        電影：<select name="name" id="name">
            <?php
            $movies = $Movie->all(['sh' => 1]);
            foreach ($movies as $m) {
                $sel = ($m['name'] == $_GET['name']) ? "selected" : "";
                echo "<option $sel>" . $m['name'] . "</option>";
            }
            ?>
        </select><br>
        日期<select name="date" id="date">
            <?php
            $day = date("Y-m-d");
            for ($i = 1; $i <= 3; $i++) {
                echo "<option>$day</option>";
                $day = date("Y-m-d", strtotime("$day +1 day"));
            }
            ?>
        </select><br>
        場次時間：<select name="session" id="session">
            <?php
            for ($i = 1; $i <= 5; $i++) {
                echo "<option value=" . $session[$i] . ">$session[$i] 剰餘座位 20</option>";
            }
            ?>
        </select><br>
        <div class="ct"><button type="button" onclick="booking()">確定</button><button type="reset">重置</button></div>
    </form>

    <div id="seat-form" style="display:none;">
        <div id="seat"></div><br>
        您選擇的電影是：<span id="mName"></span><br>
        您選擇的時刻是：<span id="mDate"></span>&nbsp;<span id="mSession"></span><br>
        您已經勾選了<span id="ticket">0</span> 張票，最多可以購買4張票<br>
        <button onclick="prev()">回上一步</button><button id="send">完成訂票</button>
    </div>
</div>
<script>
    let name, date, session;
    let ticket = 0;
    let seat = [];

    function booking() {
        $("#order-form,#seat-form").toggle();
        name = $("#name").val();
        date = $("#date").val();
        session = $("#session").val();

        $("#mName").text(name);
        $("#mDate").text(date);
        $("#mSession").text(session);

        $.post("api/getseat.php", {
            name,
            date,
            session
        }, function(res) {
            $("#seat").html(res);
        $(".seat").on("change",function(){
            if(this.checked){
                if (ticket>3) this.checked=false;
                else{
                    ticket++;
                    seat.push(this.value);
                }
            }else{
                ticket--;
                seat.splice(seat.indexOf(this.value),"1");
            }
            $("#ticket").text(ticket);
            $("#send").on("click",function(){
                $.post("api/order.php",{name,date,session,seat},function(no){
                    location.href=`?do=result&no=${no}`
                })
            })
        })
        })

    }

    function prev() {
        $("#order-form,#seat-form").toggle();
        $("#seat").html("");
    }
</script>