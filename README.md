# 阿比安吉Laravel

## 项目安装

```bash
# clone项目
git clone git@github.com:liseen315/abianji.git

# 进入到docker文件夹内
cd docker

# 根据自己环境需要更改对应的配置文件
cp env-example .env

# 安装镜像并启动对应容器
docker-compose up -d nginx mysql redis

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


# 绑定host 访问即可
127.0.0.1 abianji-dev.com
```

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
php artisan queue:work --queue=email --tries=3
```

## docker

整体参考laradock,去掉了本站无用的镜像以及相关相关配置,保持精简并根据本站优化,具体可以查看docker文件夹
