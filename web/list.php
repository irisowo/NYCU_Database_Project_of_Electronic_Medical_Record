<!DOCTYPE html>
  <?php
      include 'head.html';
  ?>
  <!-- Back to top button -->
  <!--end of BackTo Topo Button-->

  <body id="List">
    <div class="" id="home">
        <!-- Header block-->
        <nav class="navbar navbar-expand-xl">
          <div class="container h-100">
            <a class="navbar-brand" href="index.php">
              <h1 class="tm-site-title mb-0">共 病 關 係 分 析 平 台</h1>
            </a>
            <button
              class="navbar-toggler ml-auto mr-0"
              type="button"
              data-toggle="collapse"
              data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
            <i class="fas fa-bars tm-nav-icon"></i>
            </button>
            <!--end of back-to-SEARCHPAGE buttom-->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto mr-3 h-100">
                <!--nav item1-->
                <li class="nav-item">
                  <a class="nav-link" href="index.php">
                    <i class="far fa-user"></i> Home
                    <span class="sr-only">(current)</span>
                  </a>
                </li>
                 <!--nav item2-->
                <li class="nav-item">
                  <a class="nav-link active" href="list.php">
                    <i class="far fa-user"></i> List
                  </a>
                </li>
                <!--end of nav item-->
              </ul>
            </div>
          </div>
        </nav>
        <!--end of Header block-->
        <!-- Block-->
        <div class="container mt-5">
        <div class="row tm-content-row">
          <div class="col-12 tm-block-col">
            <!------classification block------>
            <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
              <h2 class="tm-block-title">選擇分類</h2>
              <p class="text-white">科別</p>

              <?php
              $page_type = null;
              if(isset($_POST['page_type'])){
                  $page_type = $_POST['page_type'];
              }
              ?>
              <form name="page_type" action="" method="post">
                <select class ="custom-select" name="page_type" id="dropbox" onchange="this.form.submit()">
                    <option value="--"<?php if($page_type == "--"){ echo " selected"; }?>>請選擇科別</option>
                    <option value="IM"<?php if($page_type == "IM"){ echo " selected"; }?>>內科</option>
                </select>
              </form>
            </div>
            <!------search block------>
            <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
              <h2 class="tm-block-title">查詢任一欄位資料</h2>              
              <form method="post" action="" class="tm-signup-form row">
                <div class="form-group col-12">
                  <label for="name">搜尋：</label>
                  <input type="search" class="light-table-filter form-control validate" data-table="order-table" placeholder="請輸入關鍵字">
                </div>
              </form>
            </div>

            <!---div class for changing text-->
            <?php
              switch($page_type){
                  case '--': break;
                  case 'IM': include_once('php/IM.php'); break;
                  default: break;
              }
            ?>
            <!--aside-->
            <!---end of div class for changing text-->
          </div>
        </div>
  </div>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  </body>
</html>