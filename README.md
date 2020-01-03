# 阿比安吉Laravel

## 项目安装

```$xslt
git clone xxxxx

# composer install
# 清理配置缓存 php artisan config:clear
# 数据库填充 php artisan db:seed
```

## 安装Redis扩展

```
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
