<!DOCTYPE html>
  <?php
      include 'head.html';
  ?>

  <body id="SearchPage">
    <div class="" id="home">
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

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mr-3 h-100">
              <li class="nav-item">
                <a class="nav-link active" href="#">
                  <i class="far fa-user"></i> Home
                  <span class="sr-only">(current)</span>
                </a>
              </li>
            
              <li class="nav-item">
                <a class="nav-link" href="list.php">
                  <i class="far fa-user"></i> List
                </a>
              </li>
              
            </ul>
          </div>
        </div>
      </nav>
      <!-- Input box-->
      <div class="container mt-5">
        <div class="row tm-content-row">
          <div class="col-12 tm-block-col">
            <!-----------------------block2------------------------>
            <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
              <!------select block------>
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
                      <option value="--"<?php if($page_type == "全部"){ echo " selected"; }?>>可選擇科別</option>
                      <option value="IM"<?php if($page_type == "IM"){ echo " selected"; }?>>內科</option>
                      <option value="FM"<?php if($page_type == "FM"){ echo " selected"; }?>>家醫科</option>
                      <option value="S"<?php if($page_type == "S"){ echo " selected"; }?>>外科</option>
                      <option value="Nephro"<?php if($page_type == "Nephro"){ echo " selected"; }?>>腎臟科</option>
                      <option value="Derma"<?php if($page_type == "Derma"){ echo " selected"; }?>>皮膚科</option>
                      <option value="ENT"<?php if($page_type == "ENT"){ echo " selected"; }?>>耳鼻喉科</option>
                      <option value="NM"<?php if($page_type == "NM"){ echo " selected"; }?>>神經內科</option>
                      <option value="NS"<?php if($page_type == "NS"){ echo " selected"; }?>>神經外科</option>
                      <option value="Ortho"<?php if($page_type == "Ortho"){ echo " selected"; }?>>骨科</option>
                      <option value="GYN"<?php if($page_type == "GYN"){ echo " selected"; }?>>婦產科</option>
                      <option value="Oph"<?php if($page_type == "Oph"){ echo " selected"; }?>>眼科</option>
                      <option value="Psy"<?php if($page_type == "Psy"){ echo " selected"; }?>>精神科</option>
                  </select>
                </form>
              </div>
              <!------select block------>

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
              <!------end of search block------>

              <!---div class for changing text-->
              <?php
                $ICD9_CSV = "./txt/ICD9.csv";
                switch($page_type){
                  case '--': include_once('php/Template.php'); break;
                  case 'IM': $ICD9_CSV = "./txt/Other/IM.csv"; include_once('php/Template.php'); break;
                  case 'FM': $ICD9_CSV = "./txt/Other/FM.csv"; include_once('php/Template.php'); break;
                  case 'S': $ICD9_CSV = "./txt/Other/S.csv"; include_once('php/Template.php'); break;
                  case 'Nephro': $ICD9_CSV = "./txt/Other/Nephro.csv"; include_once('php/Template.php'); break;
                  case 'Derma': $ICD9_CSV = "./txt/Other/Derma.csv"; include_once('php/Template.php'); break;
                  case 'ENT': $ICD9_CSV = "./txt/Other/ENT.csv"; include_once('php/Template.php'); break;
                  case 'NM': $ICD9_CSV = "./txt/Other/NM.csv"; include_once('php/Template.php'); break;
                  case 'NS': $ICD9_CSV = "./txt/Other/NS.csv"; include_once('php/Template.php'); break;
                  case 'Ortho': $ICD9_CSV = "./txt/Other/Ortho.csv"; include_once('php/Template.php'); break;
                  case 'GYN': $ICD9_CSV = "./txt/Other/GYN.csv"; include_once('php/Template.php'); break;
                  case 'Oph': $ICD9_CSV = "./txt/Other/Oph.csv"; include_once('php/Template.php'); break;
                  case 'Psy': $ICD9_CSV = "./txt/Other/Psy.csv"; include_once('php/Template.php'); break;
                  default: include_once('php/Template.php'); break;
              }
              ?>
              <!--aside-->
            </div>
            <!--------------------end of block2-------------------->
          </div>
        </div>
      </div> 
      <!-- Input box-->

      <footer class="tm-footer row tm-mt-small">
        <div class="col-12 font-weight-light">
          <p class="text-center text-white mb-0 px-4 small">
           &copy 僅 供 demo 使 用 ， 無 商 用
          </p>
        </div>
      </footer>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>

