<?php

  $IM_icd9_csv = "./txt/IM_icd9.csv";

  echo "

                <!---table-->                  
              <aside>
                <a href='#tdtop'>
                  <div class='totop'></div>
                </a>
              </aside>

                <div class='tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll'>
  ";
  echo "
                  <table class='table order-table'>
                    <thead id='tdtop'>
                        <tr>
                            <th scope='col'>English name</th>
                            <th scope='col'>Chinese name</th>
                            <th scope='col'>icd9(2001 version)</th>
                            <th scope='col'>Acode</th>
                            <th scope='col'>k = 20 </th>
                        </tr>
                    </thead>
                    <tbody>
  ";
  //-------------------------------
  $f = fopen($IM_icd9_csv, "r");
  fgets($f); //skip the first row
  while (($line = fgetcsv($f)) !== false) {
    echo "<tr>";
    $idx = 0;
    $icd9 = "000.0";
    foreach ($line as $cell) {
        echo "<td>" . htmlspecialchars($cell) . "</td>";
        if ($idx==2) {
          $icd9 = $cell;
        }
        $idx += 1;
    }
    echo"
    <td>
      <form target='_blank' method='post' action='search_result.php' class='tm-signup-form row'>
        <input id='name' name='name' type='hidden' value = $icd9 class='form-control validate' required pattern=[0-9][0-9][0-9].[0-9]|[0-9][0-9][0-9] oninput='this.setCustomValidity('')'><br>
        <input id='neighbor_num' name='neighbor_num' type='hidden' value = 20 class='form-control validate' required pattern=[0-9][0-9][0-9] min='1' max='100'  oninput='this.setCustomValidity('')' ><br>
        <button type='submit' class='btn btn-primary btn-outline-info'>submit </button>
      </form>
    </td>";
    
    echo "</tr>\n";
  }
  //-------------------------------
  echo "
                    </tbody>
                  </table>
                </div>
  ";

?>