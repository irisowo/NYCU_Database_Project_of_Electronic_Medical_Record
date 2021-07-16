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
* `php/All.php: 列出所有科別常見代碼`
* `php/Template.php(同上之空白模板，僅移除讀檔part)`


## **PYTHON** 
### **plot_icd9.py**
* `input : distance_matrix.txt, which is the output of 專題/Cal_Dist(0713).ipynb`

## **txt** 
* `Example : /txt/ICD9.txt 存100筆常見代碼
      /txt/ICD9_Chinese_name則存對應的100筆icd9的中文`
* `因為存成 condensed matrix形式，/txt/distance_matrix.txt 會有 100+99+...+1 項距離`
* `/txt/distance_matrix_pr.txt 為rank等分200份跑的結果 `

###### tags: `專題`