
我个人写的demo都在这里，没新增一个demo，我都会来更新此文件，说明功能：

1.csv_download.php

将数组文件使用逗号作为分隔符,生成一份csv文件,由页面强制直接下载.

2.two_dimension_sort.php

将二维数组按照其中某个键值的大小顺序进行排序

3.http_request.php

用php模拟出http的post请求

4.access_control_allow_origin

开放文件的跨域访问

5.child_thread.php

测试子进程,执行完后,log.txt文件内容如下:

father thread,pid=2225

children!

father thread,pid=2226

children!

father thread,pid=2227

children!

father thread,pid=2228

children!

father thread,pid=2229

children!

father thread,pid=2230

children!

father thread,pid=2231

children!

father thread,pid=2232

children!

father thread,pid=2233

children!

6.php_mailer.php

通过php自带的simple mail transfer protocol(SMTP)来实现邮件的发送功能

只是一个简单的demo,考虑不严谨之处还望谅解

log里面的信息如下:

2016-01-14 09:56:18pm : Trying to smtp.qq.com:25

2016-01-14 09:56:18pm : Connected to relay host smtp.qq.com

2016-01-14 09:56:18pm : message send!

2016-01-14 09:56:19pm : mail has been sent!


7.socket/

php中socket通讯的demo,包括server端和client端,server端需要在cli上运行

8.music.php

网易音乐接口,通过指定参数获取资源,返回json格式的数据


9.redis/

redis的使用demo,在linux服务器上需要安装redis数据库,php需要安装redis扩展(phpredis-master)

      key.php

         redis中key的使用demo

      hash.php

         redis中hash散列表的使用demo(包括大部分函数的demo)

      list.php

         redis中list的使用demo(感觉与栈类似)

      subscribe.php

         redis中的消息订阅demo




