# -*- coding: UTF-8 -*-
import requests #导入爬虫的库，不然调用不了爬虫的函数
from lxml import etree
import redis
import os,time,random

r = redis.StrictRedis(host='127.0.0.1', password='m3uIsFelacOVil65', port=6379, db=1)

# list 转成Json格式数据
def listToJson(lst):
    import json
    import numpy as np
    keys = [str(x) for x in np.arange(len(lst))]
    list_json = dict(zip(keys, lst))
    str_json = json.dumps(list_json, indent=2, ensure_ascii=False)  # json转为string
    return str_json

def loadDexList():
    print('loadDexList------->')
    #设置头部信息,伪装浏览器
    headers = {
	    "User-Agent":"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.122 Safari/537.36"
    }
    response = requests.get("http://47.243.20.83/index.php", headers=headers)
    response.encoding = response.apparent_encoding #设置编码格式
    selector = etree.HTML(response.text)
	
    con = selector.xpath('//div[@id="internaltx"]')
    if(len(con) == 0):
        return []
		
    trs = con[0].xpath('//tbody/tr')

    list = []
    for i in range(len(trs)):
        cols = trs[i].xpath('.//td')
        i=0
        arr = []
        for vo in cols:
            v = vo.xpath('.//span/a/text()')
            if(len(v)==0):
                v = vo.xpath('.//span/text()')
            if(len(v)==0):
                v = vo.xpath('.//a/text()')
            if(len(v)==0):
                v = vo.xpath('.//text()')
            arr.append((',').join(v))
            i = i+1
        list.append(arr)
    return list
	
#每隔30-60秒执行1次
while True:
    dexList = loadDexList()
    r.set('DEX_LIST', listToJson(dexList), px=60*1000)
    sleeptime = random.randint(30, 60)#30-60随机数
    print('sleep-->' + str(sleeptime))
    time.sleep(sleeptime)
