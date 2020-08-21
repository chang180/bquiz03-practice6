<div id="mm">
  <div class="half" style="vertical-align:top;">
    <h1>預告片介紹</h1>
    <div class="rb tab" style="width:95%;">
      <div style="height:300px">
        <div id="ani" style="position:relative">
          <img id="showpost" style="width:200px;height:280px;"><br>
          <div id="showlist"></div>
        </div>
      </div>
      <div style="height:100px;display:flex">
        <div onclick="pp(1)">&#9664;</div>
        <?php
        $posters = $Poster->all(['sh' => 1], " ORDER BY rank DESC ");
        foreach ($posters as $key => $p) {
        ?>
          <div class="im" id="ssaa<?= $key; ?>"><img onclick="change(<?= $key; ?>)" src="img/<?= $p['img']; ?>" style="width:60px;height:70px;"><br><span><?= $p['name']; ?></span></div>
        <?php
        }
        ?>
        <div onclick="pp(2)">&#9654;</div>
      </div>
    </div>
  </div>
  <div class="half">
    <h1>院線片清單</h1>
    <div class="rb tab" style="width:95%;">
      <div style="display:flex;flex-wrap:wrap;">
        <?php
        $total = $Movie->count(['sh' => 1]);
        $div = 4;
        $pages = ceil($total / $div);
        $now = $_GET['p'] ?? 1;
        $start = ($now - 1) * $div;

        $movies = $Movie->all(['sh' => 1], " ORDER BY rank DESC LIMIT $start,$div");
        foreach ($movies as $m) {
        ?>
          <div style="width:48%;border:1px solid black;">
          <div style="display:flex">
            <div><img src="img/<?= $m['poster']; ?>" style="width:60px;height:80px;"> </div>
            <div>
              <div>片名：<?= $m['name']; ?></div>
              <div>分級：<img src="icon/<?= $m['level']; ?>.png"><?= $level[$m['level']]; ?></div>
              <div>上映日期：<br><?= $m['date']; ?></div>
            </div>
          </div>
          <a href="?do=intro&id=<?= $m['id']; ?>"><button>劇情簡介</button></a><a href="?do=order&name=<?= $m['name']; ?>"><button>線上訂票</button></a> </div>
        <?php
        }
        ?>
      </div>
      <div class="ct">
        <?php
        for ($i = 1; $i <= $pages; $i++) {
          $font = ($now == $i) ? "32px" : "20px";
          echo "<a href='?p=$i' style='font-size:$font'>$i</a>";
        }
        ?>

      </div>
    </div>
  </div>
</div>
<script>
  var nowpage = 0,
    num = <?= count($posters); ?>,
    anim = <?= $_SESSION['ani']; ?>,
    po = 0;

  change(0);

  function change(post) {
    // console.log(post);
    po = post;
    $("#showpost").attr("src", $("#ssaa" + post).find("img").attr("src"));
    $("#showlist").text($("#ssaa" + post).find("span").text());
  }

  setInterval(() => {
    ani();
    po++;
    if (po >= num) po = 0;
  }, 3000);

  function ani() {
    switch (anim) {
      case 1:
        $("#ani").fadeOut();
        change(po);
        $("#ani").fadeIn();
        break;
      case 2:
        $("#ani").slideToggle();
        change(po);
        $("#ani").slideToggle();
        break;
      default:
        $("#ani").animate({
          left: "-=200px",
          opacity: "0"
        });
        change(po);
        $("#ani").animate({
          left: "+=200px",
          opacity: "1"
        });
        break;
    }
  }

  function pp(x) {
    var s, t;
    if (x == 1 && nowpage - 1 >= 0) {
      nowpage--;
    }
    if (x == 2 && (nowpage + 1) <= num * 1 - 4) {
      nowpage++;
    }
    $(".im").hide()
    for (s = 0; s <= 3; s++) {
      t = s * 1 + nowpage * 1;
      $("#ssaa" + t).show()
    }
  }
  pp(1)
</script>