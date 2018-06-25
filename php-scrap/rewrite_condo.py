import csv
import re
import pandas as pd

condo = open("condo.csv", "r")
########### Write Log #############
# Open/Create a file to append data
filename = "condo_price.txt"

txtfile = open(filename, 'a')
csvfile = open("log.csv", 'a')
###################################
 
csvReader = csv.reader(condo)
header = csvReader.__next__()
name_Index = header.index("ชื่อโครงการ")
startPrice_Index = header.index("ราคาเริ่มต้น")
developer_Index = header.index("บริษัท")
lat_Index = header.index("lat")
long_Index = header.index("long")
price_Index = header.index("ราคา(text)")
priceLevel_Index = header.index("ระดับราคา")
address_Index = header.index("ที่อยู่")
numBuilding_Index = header.index("จำนวนอาคาร")
numFloor_Index = header.index("จำนวนชั้น")
numUnit_Index = header.index("จำนวนยูนิต")
parking_Index = header.index("ที่จอดรถ(%)")
projectArea_Index = header.index("พื้นที่โครงการ")
space_Index = header.index("พื้นที่ใช้สอย")
startSpace_Index = header.index("พื้นที่ห้องเริ่มต้น(ตรม.)")
maxSpace_Index = header.index("พื้นที่ห้องสูงสุด(ตรม.)")
area_Index = header.index("เขตพื้นที่")

 
for row in csvReader:
    name = row[name_Index]
    startPrice = row[startPrice_Index]
    developer = row[developer_Index]
    lat = row[lat_Index]
    lng = row[long_Index]
    price = row[price_Index]
    priceLevel = row[priceLevel_Index]
    address = row[address_Index]
    numBuilding = row[numBuilding_Index]
    numFloor = row[numFloor_Index]
    numUnit = row[numUnit_Index]
    parking = row[parking_Index]
    projectArea = row[projectArea_Index]
    space = row[space_Index]
    start_space = row[startSpace_Index]
    max_space = row[maxSpace_Index]
    area = row[area_Index]
    # if '-' not in space:
    #     space = space+'- 0'
    # s = space.split("-")
    # start_space = s[0]
    # max_space = s[1]
    if not start_space:
        start_space = '0'
   
    #print(start_space,max_space)
    start_space = float(start_space)   
    #max_space = float(max_space) 
    #startPrice = int(startPrice)
    rai = [int(s) for s in re.findall(r"(\d+) ไร่", projectArea)]
    if not rai:
        rai = 0
    ngan = [int(s) for s in re.findall(r"(\d+) งาน", projectArea)]
    if not ngan:
        ngan = 0
    sqwa = [int(s) for s in re.findall(r"(\d+) ตร.ว.", projectArea)]
    if not sqwa:
        sqwa = 0
    
    #sqwa_ngan =  map(lambda x: x * 100, ngan)
    sq_r = pd.Series(rai)
    sqwa_rai = sq_r[0]*400
    sq_n = pd.Series(ngan)
    sqwa_ngan = sq_n[0]*100
    sqwa_sum = sqwa_rai+sqwa_ngan+sqwa
    startPrice = int(startPrice)
    #print(projectArea,rai,ngan,sqwa,sqwa_sum)
    if start_space > 0:
        pricePer = startPrice/start_space
    else:
        pricePer = 0
    #pricePer = float("{0:.2f}".format(pricePer))
    pricePer = int(pricePer)
    price = float(price)
    numBuilding = int(numBuilding)
    numFloor = int(numFloor)
    numUnit = int(numUnit)
    parking = int(parking)
    sqwa_sum = int(sqwa_sum)
    #max_space = float(max_space)
    print(name,startPrice,start_space,pricePer,name,startPrice,developer,lat,lng,price,priceLevel,address,numBuilding,numFloor,numUnit,parking,sqwa_sum,space,start_space,max_space,pricePer,area)
    
    csvfile.write("%s,%d,%s,%s,%s,%.2f,%s,%s, %d,%d,%d,%d,%d,%s,%.2f,%s,%d,%s\n" % (name,startPrice,developer,lat,lng,price,priceLevel,address,numBuilding,numFloor,numUnit,parking,sqwa_sum,space,start_space,max_space,pricePer,area))
    txtfile.write("Name: %s startPrice: %d Developer: %s Coordinates: %s,%s Price: %.2f Price Level: %s Address: %s Buliding: %d Floors: %d Unit: %d Parking: %d Project Area: %d Space: %s Start Space: %.2f Max Space: %s Price Per Sqm: %d Area: %s tenantid=softnix typelog=listcondo\n" % (name,startPrice,developer,lat,lng,price,priceLevel,address,numBuilding,numFloor,numUnit,parking,sqwa_sum,space,start_space,max_space,pricePer,area))