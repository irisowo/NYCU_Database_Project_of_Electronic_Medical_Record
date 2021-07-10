<!DOCTYPE html>
  <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="ie=edge" />
      <title>ICD9 relation</title>
      <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:400,700"
      />

      <link rel="stylesheet" href="css/fontawesome.min.css" />
      <link rel="stylesheet" href="css/bootstrap.min.css" />
      <link rel="stylesheet" href="css/new.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
      <script src="js/list.js"></script>
  </head>

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
            <!--------------------block1-------------------->
            <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
              <h2 class="tm-block-title">搜尋 k 個相似共病</h2>
              <form method="post" action="search_result.php" class="tm-signup-form row">
                <div class="form-group col-12">
                  <label for="name">輸入 ICD9 <a href="list.php"><p>(xxx.x or xxx)</p></a> </label>
                  <input id="name" name="name" type="text" class="form-control validate" required pattern=[0-9][0-9][0-9].[0-9]|[0-9][0-9][0-9] oninvalid="this.setCustomValidity('input form : xxx.x or xxx')" oninput="this.setCustomValidity('')"><br>
                  
                  <label for="name">輸入 k <p> (ranging from 1 to 100)</p> </label>
                  <input id="neighbor_num" name="neighbor_num" type="number" class="form-control validate" required pattern=[0-9][0-9][0-9] min="1" max="100" oninvalid="this.setCustomValidity('range : 1~100')" oninput="this.setCustomValidity('')" ><br>
                  
                  <div class="tm-block-h-auto">
                    <button type="submit" class="btn btn-primary btn-block btn-outline-info text-uppercase">
                      Submit
                    </button>
                  </div>
                </div>
              </form>
            </div>
            <!--------------------end of block1-------------------->
            <div class="container mt-5"></div>

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
                      <option value="--"<?php if($page_type == "--"){ echo " selected"; }?>>請選擇科別</option>
                      <option value="IM"<?php if($page_type == "IM"){ echo " selected"; }?>>內科</option>
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
                switch($page_type){
                    case '--':  break;
                    case 'IM': include_once('php/IM.php');
                    default: break;
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

