#!/usr/bin/python 
import sys
import pandas as pd
import numpy as np
from scipy import stats
import math
import csv
#import pylab
#from matplotlib import pyplot as plt
import scipy.cluster.hierarchy as sch
from sklearn.cluster import AgglomerativeClustering
from scipy.cluster.hierarchy import fcluster,dendrogram, linkage,cophenet
from scipy.spatial.distance import pdist, squareform
from sklearn.neighbors import NearestNeighbors
from sklearn.neighbors import KNeighborsClassifier
# path configuration
icd9_path = 'txt/common_IM_icd9.csv'
icd9_name_path = 'txt/IM_icd9_chinese_name.txt'
distance_matrix_path = 'txt/distance_matrix.txt'
#output_path = './py_result.txt'
# Global variables
IM＿icd9 = []
IM_icd9_chinese_name = []
IM_icd9_cnt=0

#===============================================================
# 按Distance由近到遠印出
#===============================================================
def print_distance_list_of(_icd9):
    icd9_chosen=_icd9
    D_List={}

    for i in range(IM_icd9_cnt):
        if (icd9_chosen==i):
            continue
        cur_dist=(float)(Distance_matrix[icd9_chosen][i])
        if (cur_dist<=0.025):
            D_List[cur_dist]=i

    sorted_D_List=(sorted(D_List.items(), key=lambda item: item[0]))

    title="==================="+str(IM_icd9[icd9_chosen])+"===================||"
    print(str(title))
    for key_value in sorted_D_List:
        idx=(key_value[1])
        print(str(IM_icd9[idx])+'--'+IM_icd9_chinese_name[idx][:-1]+'--'+str(key_value[0])+'||' )
    
#===============================================================
# other tool function
#===============================================================     
def get_icd9_idx(icd9_str):
    for i in range(IM_icd9_cnt):
        if (str(IM_icd9[i]) == str(icd9_str)):
            return (i)   
    return -1


if __name__ == '__main__':
    #---------------------------------------------
    # save icd9 of internal medince(目前只存內科的疾病名稱)
    #---------------------------------------------
    with open(icd9_path, "r") as file1:
        isline0=1
        for line in file1.readlines():
            if(isline0):
                isline0=1
                line=line[-6:]
            IM_icd9.append(str(line.strip()))
            IM_icd9_cnt+=1
    file1.close()

    with open(icd9_name_path, "r") as file1:
        isline0=1
        for line in file1.readlines():
            IM_icd9_chinese_name.append(line)
    file1.close()

    #---------------------------------------------
    # load the pre_computed Distance_matrix(plot_icd9輸出的distance matrix)                       
    #---------------------------------------------
    pre_Distance_matrix=[]
    Distance_matrix = np.zeros(shape =(IM_icd9_cnt,IM_icd9_cnt))
    with open(distance_matrix_path, "r") as file1:
        isline0=1
        cnt=0
        for line in file1.readlines():
            if(isline0):
                isline0=0
                line=line[1:]
            cnt+=1
            pre_Distance_matrix.append(float(line))
    Distance_matrix=squareform(pre_Distance_matrix)
    #Condensed_Distance_matrix = squareform(Distance_matrix)

    #---------------------------------------------
    # KNN
    #---------------------------------------------          
    icd9_idx = get_icd9_idx(sys.argv[1])
    if(icd9_idx==-1):
        print(" Failed to find the icd9 ||")
        #print(" Failed to find the icd9 ")
    else:
        mode = (int)(sys.argv[3])
        if(mode==1):
            neighbor_num = (int)(sys.argv[2]) + 1 
            neighbor_upper_bound=0.05
            KNN = NearestNeighbors(n_neighbors=neighbor_num, radius=neighbor_upper_bound, algorithm='auto', metric='precomputed')
            KNN.fit(Distance_matrix)
            distances, indices = KNN.kneighbors(Distance_matrix)
            result_cnt=0
            line1=1
            for i in range(0,neighbor_num):
                if(line1):
                    neigh_idx=indices[icd9_idx][i]
                    print(IM_icd9_chinese_name[neigh_idx],'||')
                    line1=0
                else:
                    neigh_idx=indices[icd9_idx][i]
                    result_cnt+=1
                    print(IM_icd9[neigh_idx],'>',IM_icd9_chinese_name[neigh_idx],'>',distances[icd9_idx][i],'>||')
            if(result_cnt==0):
                print("&nbsp;&nbsp;&nbsp; No result. &nbsp;&nbsp;&nbsp;.")
       
        elif(mode==2):
            level = (int)(sys.argv[2])
            neighbor_upper_bound=0.01*level
            KNN = NearestNeighbors(n_neighbors=IM_icd9_cnt,radius=neighbor_upper_bound, algorithm='auto', metric='precomputed')
            KNN.fit(Distance_matrix)
            distances, indices = KNN.kneighbors(Distance_matrix)
            result_cnt=0
            line1=1
            for i in range (0,len(indices[0])):
                if(distances[icd9_idx][i]>=neighbor_upper_bound):
                    continue
                elif(line1):
                    neigh_idx=indices[icd9_idx][i]
                    print(IM_icd9_chinese_name[neigh_idx],'||')
                    line1=0
                else:
                    neigh_idx=indices[icd9_idx][i]
                    result_cnt+=1
                    print(IM_icd9[neigh_idx],'>',IM_icd9_chinese_name[neigh_idx],'>',distances[icd9_idx][i],'>||')
            if(result_cnt==0):
                print("&nbsp;&nbsp;&nbsp; No result. &nbsp;&nbsp;&nbsp; Please try a higher level.")        
        else :
            print("input form error")
