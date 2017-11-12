# -*- coding: cp936 -*-
import xlwt
from xlwt import ExcelFormulaParser, ExcelFormula
import sys
from datetime import datetime

 

font0= xlwt.Font()

font0.name= 'Times New Roman'

font0.colour_index= 2

font0.bold= True

 

style0= xlwt.XFStyle()

style0.font= font0

 

style1= xlwt.XFStyle()

style1.num_format_str= 'D-MMM-YY'

 

wb= xlwt.Workbook()

ws= wb.add_sheet('A Test Sheet')

f= ExcelFormula.Formula(

"""-((1.80 + 2.898 * 1)/(1.80 + 2.898))*

AVERAGE((1.80+ 2.898 * 1)/(1.80 + 2.898);

        (1.80 + 2.898 * 1)/(1.80 + 2.898);

        (1.80 + 2.898 * 1)/(1.80 + 2.898)) +

SIN(PI()/4)""") 

ws.write(0,0, 'Test', style0)

ws.write(1,0, datetime.now(), style1)

ws.write(2,0, 1)

ws.write(2,1, 1)

ws.write(2,2, xlwt.Formula("A3+B3"))

ws.write(3,0,f)
 

wb.save('example.xls')

