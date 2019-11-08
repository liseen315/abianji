# 阿比安吉Laravel

## 项目安装

```$xslt
git clone xxxxx

# composer install
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

## 开发中bug记录

```
- 文章编辑时无法取消选择Tag标签
```


