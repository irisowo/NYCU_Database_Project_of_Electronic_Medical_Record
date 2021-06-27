#!/usr/bin/python 
import pandas as pd
import numpy as np
import sys
import math
import csv
import mlxtend
from mlxtend.preprocessing import TransactionEncoder
from apyori import apriori

# path configuration
############################################################

txt_path = "txt/association_result.txt"

############################################################

if __name__ == '__main__':       
    icd9_idx = (str)(sys.argv[1])
    if(icd9_idx==-1):
        print(" Failed to find the icd ||")
        print(" Failed to find the icd9 ")
    else:
        mode = (int)(sys.argv[3])
        if(mode==1):
            neighbor_num = (int)(sys.argv[2]) + 1 
            with open(txt_path) as f:
                lines = f.readlines()
                line1=1
                result_cnt = 0
                for line in lines:
                    items = line.split(" ")
                    if (items[0] == icd9_idx or items[1] == icd9_idx):
                        result_cnt +=1
                        if(line1):
                            print("Association Rule ||")
                            line1 = 0
                        else:
                            print(items[0],'>',items[1],'>',items[2],'>',items[3],'>',items[4],">||")
                
                if result_cnt==0 : print(" No assotiation rule. ")
        
        else :
            print("input form error")
 