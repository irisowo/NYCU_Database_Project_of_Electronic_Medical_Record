<?php

  $IM_icd9_csv = "txt/IM_icd9.csv";

  echo "
              <div id='divText'>
                <!---table-->
                <div class='tm-bg-primary-dark tm-block tm-block-h-auto tm-block-taller tm-block-scroll'>
  ";
  echo "
                  <table class='table order-table'>
                    <thead>
                        <tr>
                            <th scope='col'>English name</th>
                            <th scope='col'>Chinese name</th>
                            <th scope='col'>icd9(1992 version)</th>
                            <th scope='col'>Acode</th>
                        </tr>
                    </thead>
                    <tbody>
  ";
  //-------------------------------
  $f = fopen($IM_icd9_csv, "r");
  fgets($f); //skip the first row
  while (($line = fgetcsv($f)) !== false) {
    echo "<tr>";
    foreach ($line as $cell) {
        echo "<td>" . htmlspecialchars($cell) . "</td>";
    }
    echo "</tr>\n";
  }
  //-------------------------------
  echo "
                    </tbody>
                  </table>
                </div>
              </div>
  ";

?>