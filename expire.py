# -*- coding: utf8 -*-

import pymysql, smtplib, datetime, time
from email.mime.text import MIMEText

expire_day = 86400*365*3 #파기기한 [1일(초)*365일*3년]

db_host = 'localhost' #Database 주소
db_name = 'ssproject' #Database 이름
db_user = '' #Database 계정명
db_password = '' #Database 계정 비밀번호
email_user = ''
email_password = ''

def send_mail(email_to, expire_time):
        global email_user, email_password
        
        data = """<html>
	<head><!DOCTYPE html>

	    <meta http-equiv=\"Content-Type\" content=\"IE=edge; charset=utf-8\" />

		<img src=\"http://imageshack.com/a/img923/994/3lqbTL.png\" hight=\"80\" width=\"720\">

		</br>
    


        <h2>SS 채용서류 보안 관리 솔루션 이용안내 메일입니다.</h2>


        <span style=\"font-size:15px;\">안녕하세요 귀하위 채용서류가 파기되었음을 알려드립니다.<br><br> SS솔루션의 관리자로부터 채용서류가 파기 되었습니다.<br></span><br><br>
	<table border=0 cellspacing=\"0\"><tr><td colspan=\"2\"><span style=\"font-size:15px;\"><b>[ 파기 정보 ]</b></span></td></tr>

<tr><td><span style=\"font-size:15px;\"><b>일시</b></span>&nbsp;</td><td>
        <span style=\"color: gray;font-size:15px;\">"""+datetime.datetime.fromtimestamp(expire_time).strftime("%Y-%m-%d %H:%M:%S")+"""</span></td></tr><tr><td>
        <span style=\"font-size:15px;\"><b>상태</b></span></td><td>
        <span style=\"color: gray;font-size:15px;\">자동 파기</span></td></tr></table><br><br>
      <img src=\"http://imageshack.com/a/img921/2563/8kEE7x.png\"  hight=\"100\" width=\"720\"></img>"""
        msg = MIMEText(data,"html",_charset="utf-8")
	 
        msg['Subject'] = "[SecuritySquad] 이력서 파기 알림메일입니다."
        msg['From'] = email_user
        msg['To'] = email_to
	 
        s = smtplib.SMTP_SSL('smtp.gmail.com',465)
        s.login(email_user, email_password)
        s.sendmail(msg['From'], msg['To'], msg.as_string())
        s.quit()


if __name__ == "__main__":

        while 1:
                now_time =  int(time.time())
                expire_time = now_time - expire_day

                expire_seed = []
                expire_email = []
                
                conn = pymysql.connect(host=db_host, user=db_user, password=db_password,
                                       db=db_name, charset='utf8')
                curs = conn.cursor()
                sql = "select * from user_rec where r_date<"+str(expire_time)
                curs.execute(sql)
                rows = curs.fetchall()

                for row in rows:
                        expire_seed.append(row[4])
                        expire_email.append(row[1])

                for i in range(0,len(expire_seed)):
                        curs.execute("delete from user_rec where r_seed = '"+ expire_seed[i] +"'")
                        conn.commit()
                        curs.execute("delete from rec_file where f_seed = '"+ expire_seed[i] +"'")
                        conn.commit()
                        print "Send Mail to... "+expire_email[i]
                        send_mail(expire_email[i],expire_time)
                        print "Done."

                conn.close()
                time.sleep(3600)
