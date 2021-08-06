<!DOCTYPE html>
<?php
    include 'head.html';
    // Modify the command to execute python
    //$user_name = get_current_user();
    //$KNN_cmd = "/Users/$user_name/opt/anaconda3/bin/python plot_icd9.py";
    $KNN_cmd = "python3 plot_icd9.py";
?>

<body id="ResultPage">
  <div class="" id="home">
    <!------Header block------>
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
              <a class="nav-link" href="index.php">
                <i class="far fa-user"></i> Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
          
            <li class="nav-item">
              <a class="nav-link" href="list.php">
                <i class="far fa-user"></i> List
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link active" >
                <i class="far fa-user"></i> Result
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!------end of Header block------>

    <!--------Result block-------->
    <div class="container mt-5">
      <div class="col-12 tm-block-col">
        <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
          <h2 class="tm-block-title2">Result </h2>";
          <!------search block------>
          <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
            <h2 class="tm-block-title">輸入共病數量 (maximum=100)</h2>              
            <form method="post" action="" class="tm-signup-form row">
              <div class="form-group col-12">
                <input type="text" onkeyup="this.value=this.value.replace(/\D/g,'')" class="light-table-filter form-control validate" maxlength = "3" min="1" max="100" data-table="order-table" placeholder="輸入數字" >
              </div>
            </form>
          </div>
          <!------end of search block------>
          <?php
              $message = ""; // error message
              // ----------------------MODE 1: input k----------------------
              if( isset($_POST['neighbor_num']) )
              {
                $name =  filter_var($_POST['name'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                $neighbor_num =  filter_var($_POST['neighbor_num'],FILTER_VALIDATE_INT);
                $mode = 1;
                // ----------------------block1 : KNN----------------------
                // get info from python
                putenv("PYTHONIOENCODING=utf-8");
                $command = ("$KNN_cmd $name $neighbor_num $mode 2>&1");
                $escaped_command = escapeshellcmd($command);
                $output = shell_exec($escaped_command);
                include "php/distance.php";
                // ----------------------end of block1 : KNN----------------------

                // -------------------block2 : association_rule-------------------
                $postxt = file_get_contents('txt/association_result.txt');
                include "php/association.php";
              }
              // -------------------end of block2 : association_rule-------------------
          ?>
        </div>
      </div>
    </div>
    <!--------end of Result block-------->
  </div>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>