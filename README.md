# 阿比安吉Laravel

## 项目安装

```bash
# clone项目
git clone git@github.com:liseen315/abianji.git

# 进入到docker文件夹内
cd docker

# 根据自己环境需要更改对应的配置文件
cp env-example .env

docker-compose ps

# 当看到如下的容器后证明启动成功

```

![docker-compose-ps](https://res.cloudinary.com/dnakxpzhj/image/upload/v1578288147/blog/docker-container.jpg)

```bash
# 返回项目目录
cd ..

# 进入到容器内进行进行安装
docker-compose exec workspace bash

composer install

npm install

# 设定mysql root 密码
1 update user set authentication_string=password('yourpasssword') where user='root';
2 FLUSH PRIVILEGES;
# 创建数据库
create database abianji character set utf8mb4;
# 创建新的用户
GRANT ALL ON abianji.* TO 'liseen'@'%' IDENTIFIED BY 'yourpasssword';
FLUSH PRIVILEGES;

# 开启访问权限
GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'Liseen315song' WITH GRANT OPTION;
FLUSH PRIVILEGES;

# 如果由于更改密码导致的mysql访问失败请使用如下方法解决
by setting MYSQL_VERSION=5.7 in laradock/.env
after that in your .env file see the var called DATA_PATH_HOST and go to that folder, after that delete the mysql folder there and then do the docker-compose build --no-cache mysql and then docker-compose up -d mysql

# 创建迁移
php artisan migrate
# 生成种子
php artisan db:seed

# 如果更改了网站配置字段等需要手动清理redis
flushall

# 启动容器
docker-compose up -d nginx mysql redis php-worker

# 绑定host 访问即可
127.0.0.1 abianji.com

docker-compose exec mysql bash
mysql -uliseen -pLiseen315song

# 查看mysql 时区
show variables like '%time_zone%';
+------------------+--------+
| Variable_name    | Value  |
+------------------+--------+
| system_time_zone | UTC    |
| time_zone        | SYSTEM |
+------------------+--------+
2 rows in set (0.00 sec)

# 查看mysql当前时间
select now();
+---------------------+
| now()               |
+---------------------+
| 2020-01-15 01:45:17 |
+---------------------+
1 row in set (0.01 sec)

如果时区与中国相差8小时那么可以更改docker mysql内的mysql配置
# vi my.conf [mysqld] 添加时区偏移
default-time_zone = '+8:00'

docker-compose down
docker-compose build mysql
docker-compose up

# 查看mysql查询次数
show global status where variable_name in('com_select','com_insert','com_delete','com_update');
```

## 社会化登录配置

先去[申请账号](https://github.com/settings/applications/new)

## 安装Redis扩展

```bash
# 安装phpredis
pecl install redis

# 修改php.ini
/etc/php/7.3/fpm/php.ini

# 添加到如下到php.ini
[redis]
extension=redis.so

# 重启fpm
service php7.3-fpm restart
```

## 解决Redis GUI 无法链接的问题

```$xslt
sudo vim /etc/redis/redis.conf
# 将bind 127.0.0.1 改成 bind 0.0.0.0
# 重启
sudo /etc/init.d/redis-server restart
```

## 创建自定义Helper

```
https://laravel-news.com/creating-helpers
```

## slug

```
默认使用拼音来处理slug 如果在.env中配置了有道翻译接口则会采用有道翻译接口
https://ai.youdao.com/fanyi-chart.s

Services Provider 使用jourdon/slug 自己改造去掉了百度,修复了Laravel 6.0兼容问题
```

## 邮件队列

```
# docker-compose 进不去容器使用
docker exec -it a144032d1598 /bin/sh 进
php artisan queue:work --queue=email --tries=3
```

## docker

整体参考laradock,去掉了本站无用的镜像以及相关相关配置,保持精简并根据本站优化,具体可以查看docker文件夹
