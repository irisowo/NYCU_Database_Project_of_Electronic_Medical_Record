<?php
  $result_array = explode("\n",$postxt);
  echo "
        <div class='tm-bg-primary-dark tm-block tm-block-h-auto'>
        <div class='tm-bg-primary-dark tm-block tm-block-h-auto tm-block-taller tm-block-scroll'>";
  $line1 = 1;      
  if(count($result_array)>0){                           
    foreach ($result_array as $value) {
        $pieces = explode(' ',$value);
        $Is_1st_icd9_matched = strcmp( substr($pieces[0],0,5),substr($name,0,5))===0;
        $Is_2nd_icd9_matched = strcmp( substr($pieces[1],0,5),substr($name,0,5))===0;
        if( isset($pieces[1]) and ( $Is_1st_icd9_matched or $Is_2nd_icd9_matched ) ){
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
            #continue;
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
    echo"</tbody></table>";
    echo"</div><div>";
  }
?>