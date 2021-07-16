<?php
    $KNN_cmd = "python3 plot_icd9.py";
    $rt = ['status' => False];
    if( isset($_GET['neighbor_num']) and  isset($_GET['name']))
    {
      $name =  filter_var($_GET['name'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
      $neighbor_num =  filter_var($_GET['neighbor_num'],FILTER_VALIDATE_INT);
      $mode = 1;
      // ----------------------block1 : KNN----------------------
      // --------get info from python --------
      putenv("PYTHONIOENCODING=utf-8");
      $command = ("$KNN_cmd $name $neighbor_num $mode 2>&1");
      $escaped_command = escapeshellcmd($command);
      $output = shell_exec($escaped_command);
      $output=str_replace("\n","",$output);
      //--------------Make data--------------
      $data = [];
      $results =explode('######',$output);
      foreach ($results as $result) {
        $result_json = [];
        $result_array=explode('||',$result);
        
        foreach ($result_array as $index=>$value) {
          if($index == 0){
           array_push($data, [$value => &$result_json]);
           continue;
          }
          if(!$value){
           break;
          }
          $pieces = explode('>', $value);
          array_push($result_json, [
            "ICD" => $pieces[0],
            "name" => $pieces[1],
            "distance" => $pieces[2],
           ]);
        }
      }
     $rt['data'] = $data;
     $rt['status'] = True;
    }
    $response = json_encode($rt);
    header('Content-Type: application/json; charset=utf-8');
    echo $response;
      // ----------------------end of block1 : KNN----------------------
?>