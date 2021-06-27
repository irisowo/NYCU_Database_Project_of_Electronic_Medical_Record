# NYCU_Database_Project_of_Electronic_Medical_Record
* **<span style="color:#BF0060">PHP</span>** 
  * **header.php**
      * html 的 <head></head>
  * **index.php**
      * html
  * **search_result.php**
      * 若執行python 有問題，請修改 line 4,5 的 <span style="color:	#009393">$KNN_cmd 和 $Association_rule_cmd</span>
      * 範例 : <br>
      `<?php` <br>
      ` //請更改python執行指令` <br>
      <span style="color:#009393">`$KNN_cmd`</span>` = "python3 plot_icd9.py";` <br>
      <span style="color:#009393">`$Association_rule_cmd`</span>` = "python3 association.py";` <br>
       `?>`
      </span>
      * 會用到的 python 檔：
          * plot_icd9.py
          * association.py
  * **list.php**
      * php/IM.php : 列出內科常見代碼表
      * php/tmp.php(空白模板)


* **<span style="color:#BF0060">PYTHON</span>** 

  * **plot_icd9.py** ： 讀取distance_matrix.txt
      * 假設 **/txt/common_IM_icd9.txt** 存100筆常見代碼
      * **/txt/IM_icd9_chinese_name** 對應100筆icd9的中文
      * **/txt/distance_matrix.txt**，就有 100+99+...+1 項距離，因為存成 condensed matrix形式，是 plot_icd9(日期).ipynb 輸出的結果

  * **association.py** : 讀取association_result.txt
      * association.ipynb 結果放在 /web 底下的 /txt/association_result.txt
      * <img src="https://i.imgur.com/AzVsTBL.png" width = "500"/>

