# NYCU_Web_for_Project_of_NHIRD

## **PHP** 
### **index.php**
* `include php/Template.php`
### **search_result.php**
* `show the comorbidities associated with the selected diseases`
* **Result(1) : Distance**
    * `include php/distance.php, which executes plot_icd9.py`
* **Result(2) : Association rule**：
    * `include php/association.php`
    * `association_result.txt is the output of association.ipynb`
## **PYTHON** 
### **plot_icd9.py**
* `input : distance_matrix.txt, which is the output of 專題/Cal_Dist(0713).ipynb`

## **txt** 
### Example of /txt/ICD9.txt
* `若存100筆常見代碼，/txt/ICD9_Chinese_name則存對應的100筆icd9的中文`
* `因存成 condensed matrix形式，/txt/distance_matrix.txt 有 100+99+...+1 項距離`
* `/txt/distance_matrix_pr.txt 為rank等分200份跑的結果 `

###### tags: `專題`
