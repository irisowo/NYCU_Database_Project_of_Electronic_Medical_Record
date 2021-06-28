# NYCU_Web_for_Project_of_NHIRD

## **PHP** 
  ### **header.php**
* `html 的 <head></head>`
### **index.php**
* `html`
### **search_result.php**
* 路徑
`若執行python 有問題，請修改 line 5 的 $KNN_cmd`
`範例 : <?php $KNN_cmd = "python3 plot_icd9.py"; ?>`
* **KNN 實作**
    * `plot_icd9.py`

* **Association rule 實作**：
    * `php 讀取association_result.txt`
    * `association_result.txt 來自 association.ipynb輸出`
    * <img src="https://i.imgur.com/AzVsTBL.png" width = "500"/>
### **list.php**
* `php/IM.php : 列出內科常見代碼表`
* `php/tmp.php(空白模板)`


## **PYTHON** 
### **plot_icd9.py**
* `讀取distance_matrix.txt`
* `假設 /txt/common_IM_icd9.txt 存100筆常見代碼
      /txt/IM_icd9_chinese_name存對應的100筆icd9的中文`
* `因為存成 condensed matrix形式，/txt/distance_matrix.txt，有 100+99+...+1 項距離，是 plot_icd9(日期).ipynb 輸出的結果`


###### tags: `專題`