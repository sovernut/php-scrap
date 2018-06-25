import csv
import re

condo = open("forest.csv", "r")
########### Write Log #############
# Open/Create a file to append data
filename = "forest_re.txt"

txtfile = open(filename, 'a')
###################################

csvReader = csv.reader(condo,delimiter=',')


for row in csvReader:
    YEAR = row[0]
    n = int(row[1])
    n_p = float(row[2])
    ne = int(row[3])
    ne_p = float(row[4])
    e = int(row[5])
    e_p = float(row[6])
    c = int(row[7])
    c_p = float(row[8])
    s = int(row[9])
    s_p = float(row[10])
    whole = int(row[11])
    whole_p = float(row[12])
    '''pricePer = int(pricePer)
    price = float(price)
    numBuilding = int(numBuilding)
    numFloor = int(numFloor)
    numUnit = int(numUnit)
    parking = int(parking)
    sqwa_sum = int(sqwa_sum)'''
    #max_space = float(max_space)
    #print(YEAR,n,n_p,ne,ne_p,e,e_p,c,c_p,s,s_p,whole,whole_p)
    #print(name,startPrice,start_space,pricePer,name,startPrice,developer,lat,lng,price,priceLevel,address,numBuilding,numFloor,numUnit,parking,sqwa_sum,space,start_space,max_space,pricePer,area)

    txtfile.write("%s %d %.2f %d %.2f %d %.2f %d %.2f %d %.2f %d %.2f tenantid=softnix typelog=forest_lsa7\n" % (YEAR,n,n_p,ne,ne_p,e,e_p,c,c_p,s,s_p,whole,whole_p))
