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
        <?php
            echo " <div class='tm-bg-primary-dark tm-block tm-block-h-auto'>
                    <h2 class='tm-block-title2'>Result </h2>";
            $message = ""; // error message
            // ----------------------MODE 1: input k----------------------
            if( isset($_POST['neighbor_num']) )
            {
              $name =  filter_var($_POST['name'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
              $neighbor_num =  filter_var($_POST['neighbor_num'],FILTER_VALIDATE_INT);
              $mode = 1;
              // ----------------------block1 : KNN----------------------
              // --------get info from python --------
              putenv("PYTHONIOENCODING=utf-8");
              $command = ("$KNN_cmd $name $neighbor_num $mode 2>&1");
              $escaped_command = escapeshellcmd($command);
              $output = shell_exec($escaped_command);
              
              //--------------print table--------------
              $results =explode('######',$output);
              foreach ($results as $result) {
                $result_array=explode('||',$result);
                $line1 = 1;
                echo "<div class='tm-bg-primary-dark tm-block tm-block-h-auto'>
                      <div class='tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll'>
                      <table class='table'>";
                if(count($result_array)>2){
                  echo "
                        <thead>
                          <tr>
                              <th scope='col'>icd9</th>
                              <th scope='col'>name</th>
                              <th scope='col'>distance</th>
                          </tr>
                        </thead>
                        <tbody>";
                }
                foreach ($result_array as $value) {
                  if($line1){
                    print " <h2 class='tm-block-title'>搜尋 : ".$name." ( ".$value.") ,&nbsp&nbsp k =   ".$neighbor_num."</h2>";   
                    $line1 = 0;
                    continue;
                  }
                  $pieces = explode('>', $value);
                  if( isset($pieces[1]) ){//remove the space on the last line
                    echo "<tr>";
                    echo "<td><div class='tm-status-circle ";
                    
                    if((float)($pieces[2]) <= 0.05){
                      echo"moving'></div>";
                    }
                    elseif((float)($pieces[2])<=0.1){
                      echo"pending'></div>";
                    }
                    else{
                      echo"cancelled'></div>";
                    }
                    echo"$pieces[0]</td>";
                    echo"<td><b>$pieces[1]</b></td>
                        <td><b>$pieces[2]</b></td>
                        </tr>";
                  }
                }
                echo"</tbody></table></div>"; 
                echo"</div>";
            }
            echo"</div>"; 
              // ----------------------end of block1 : KNN----------------------

              // -------------------block2 : association_rule-------------------
              $postxt = file_get_contents('txt/association_result.txt');
              $result_array = explode("\n",$postxt);
              echo "
                    <div class='tm-bg-primary-dark tm-block tm-block-h-auto'>
                    <div class='tm-bg-primary-dark tm-block tm-block-h-auto tm-block-taller tm-block-scroll'>";
              $line1 = 1;      
              if(count($result_array)>1){                           
                foreach ($result_array as $value) {
                    $pieces = explode(' ',$value);
                    
                    if( isset($pieces[1]) and ((strcmp($pieces[0],$name)===0) or (strcmp($pieces[1],$name)===0))){
                      if($line1){  
                        echo "
                        <table class='table'>
                          <thead>
                              <tr>
                                  <th scope='col'>No1_icd9</th>
                                  <th scope='col'>No2_icd9</th>
                                  <th scope='col'>Supprt</th>
                                  <th scope='col'>Confidence</th>
                                  <th scope='col'>Lift</th>                                   
                              </tr>
                          </thead>
                          <tbody>";
                        echo " <h2 class='tm-block-title'> Association Result &nbsp&nbsp </h2>";   
                        $line1 = 0;
                        continue;
                      }
                      $support = substr($pieces[2], 0, 7);
                      $confidence = substr($pieces[3], 0, 7);
                      $lift = substr($pieces[4], 0, 7);
                      echo "<tr>";
                      echo"<td>$pieces[0]</td>";
                      echo"<td>$pieces[1]</td>
                          <td><b>$support</b></td>
                          <td><b>$confidence</b></td>
                          <td><b>$lift</b></td>
                          </tr>";
                    }
                }
                if ($line1 == 1 ){
                  echo " <h2 class='tm-block-title'>No Association Result &nbsp&nbsp </h2>"; 
                }
                echo"</tbody></table></div>";
                echo"<div>";
              }
            }
            // -------------------end of block2 : association_rule-------------------
              
          // ----------------------MODE 2: select level ----------------------
          // ------------------------end of Mode 2----------------------------
        ?>
      </div>
    </div>
    <!--------end of Result block-------->
  </div>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>