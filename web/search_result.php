<!DOCTYPE html>
<?php
    include 'header.php';
    // Modify the command to execute python
    $user_name = get_current_user();
    $KNN_cmd = "python3 plot_icd9.py";
    $Association_rule_cmd = "python3 association.py";
?>

<body id="ResultPage">
    <div class="" id="home">
        <!-- Header block-->
        <nav class="navbar navbar-expand-xl">
          <div class="container h-100">
            <a class="navbar-brand" href="index.php">
              <h1 class="tm-site-title mb-0">Search page</h1>
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
        <!--end of Header block-->

        <!-- Result block-->
        <div class="container mt-5">
            <div class="col-12 tm-block-col">
                <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                    <h2 class="tm-block-title2">Result </h2>
                    <?php
                        $message = ""; // error message
                        //MODE 1: input k
                        if( isset($_POST['neighbor_num']) )
                        {
                            $name =  $_POST['name'];
                            $neighbor_num = $_POST['neighbor_num'];
                            $mode = 1;

                            // -----------block1---------------
                            putenv("PYTHONIOENCODING=utf-8");
                            $command = ("$KNN_cmd $name $neighbor_num $mode 2>&1");
                            $output = shell_exec($command);
                            $result_array=explode('||',$output);
                            $line1 = 1;
                            echo "<div class='col-12 m-block-col'>
                                  <div class='tm-bg-primary-dark tm-block tm-block-h-auto tm-block-taller tm-block-scroll'>
                                  <table class='table'>";
                            if(count($result_array)>2){
                              echo "    <thead>
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
                                  if((float)($pieces[2])<=0.02){
                                    echo"moving'></div>";
                                  }
                                  elseif((float)($pieces[2])<=0.04){
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
                              echo"</tbody></table></div></div>"; 

                              // -----------block2---------------
                              $command = ("$Association_rule_cmd $name $neighbor_num $mode 2>&1");                              
                              $output = shell_exec($command);
                              $result_array=explode('||',$output);
                              $line1 = 1;
                              echo "<div class='col-12 m-block-col'>
                                    <div class='tm-bg-primary-dark tm-block tm-block-h-auto tm-block-taller tm-block-scroll'>
                                    <table class='table'>";
                              if(count($result_array)>1){
                                echo "    <thead>
                                          <tr>
                                              <th scope='col'>No1_icd9</th>
                                              <th scope='col'>No2_icd9</th>
                                              <th scope='col'>Supprt</th>
                                              <th scope='col'>Confidence</th>
                                              <th scope='col'>Lift</th>
                                              
                                          </tr>
                                          </thead>
                                          <tbody>";
                              }
                              foreach ($result_array as $value) {
                                  if($line1){
                                    print " <h2 class='tm-block-title'> ".$value." &nbsp&nbsp </h2>";   
                                    $line1 = 0;
                                    continue;
                                  }
                                  $pieces = explode('>', $value);
                                  if( isset($pieces[1]) ){//remove the space on the last line
                                    echo "<tr>";
                                    echo"<td>$pieces[0]</td>";
                                    echo"<td><b>$pieces[1]</b></td>
                                         <td><b>$pieces[2]</b></td>
                                         <td><b>$pieces[3]</b></td>
                                         <td><b>$pieces[4]</b></td>
                                         </tr>";
                                  }
                                }
                                echo"</tbody></table></div></div>"; 
                          }
                        //MODE 2: select level
                        if( isset($_POST['type']) )
                        {
                            // Get data from post
                            $name =  $_POST['name'];
                            $type = $_POST['type'];
                            $mode = 2;      
                            //execute python
                            putenv("PYTHONIOENCODING=utf-8");
                            $command = ("$KNN_cmd $name $type $mode 2>&1");
                            $output = shell_exec($command);
                            $result_array=explode('||',$output);
                            $line1 = 1;
                            if( isset($result_array[2])){ //exclude the space line and the error message line
                              echo "<div class='col-12 tm-block-col'>
                                      <div class='tm-bg-primary-dark tm-block tm-block-h-auto tm-block-taller tm-block-scroll'>
                                      <table class='table'>";
                              echo "    <thead>
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
                                print " <h2 class='tm-block-title'>搜尋 : ".$name." ( ".$value.") ,&nbsp&nbsp level =   ".$type." (distance<=".$type*0.01.") </h2>";
                                $line1 = 0;
                                continue;
                              }
                              $pieces = explode('>', $value);
                              if( isset($pieces[1]) ){//remove the space on the last line
                                echo "<tr>
                                <td><b>$pieces[0]</b></td> 
                                <td><b>$pieces[1]</b></td>
                                <td><b>$pieces[2]</b></td>
                                      </tr>";
                              }
                              else{
                                echo "<div class='col-12 tm-block-col tm-block-title2 '>$value</div>";
                              }
                            }
                            echo"</tbody></table></div></div>"; 
                        }
                    ?>
                </div>
            </div>
        </div>
        <!--end of Result block-->
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>