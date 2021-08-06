<?php
  //--------------print table--------------
  $results =explode('######',$output);
  foreach ($results as $result) {
    $result_array=explode('||',$result);
    $line1 = 1;
    echo "<div class='tm-bg-primary-dark tm-block tm-block-h-auto'> <div class='tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll'>
          <table class='table order-table'>";
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
        print " <h2 class='tm-block-title'>搜尋 : ".$name." ( ".$value.") ,&nbsp&nbsp default number =   ".$neighbor_num."</h2>";   
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
    echo"</tbody></table>"; 
    echo"</div></div>";
  }
?>