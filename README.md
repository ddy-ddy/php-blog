项目结构
```python
├── Readme.md
└── ddy
    ├── admin                        #用户控制页面文件夹
    │   ├── blogimages
    │   ├── css
    │   ├── js
    │   ├── fonts
    │   ├── images
    │   ├── includes
    │   │   ├── config.php           #链接数据库的配置    
    │   │   ├── header.php           #头部的布局
    │   │   └── sidebarmenu.php      #侧边框的布局
    │   ├── index.php                #登陆页面
    │   ├── dashboard.php            #仪表盘页面
    │   ├── create-blog.php          #创建博客页面
    │   ├── manage-blog.php          #管理博客页面
    │   ├── change-image.php         #修改博客图片页面
    │   └── update-blog.php          #更新博客页面
    │   ├── delete.php               #删除博客操作
    │   ├── change-password.php      #修改博客页面
    │   ├── logout.php               #登出操作
    ├── css
    └── js
    ├── fonts
    ├── images
    ├── includes
    │   ├── config.php              #连接数据库的配置
    │   └── header.php              #顶部的布局
    ├── index.php                   #首页
    ├── blog-detail.php             #首页具体的博客
    ├── blog-list.php               #首页所有的博客列表
```

数据库的设置:
- 表一：admin（存储用户名和密码）
    更新时间直接在数据库里面设置
- 表二：blog （存储博客信息）
    创建博客的时间和更新时间直接在数据库里面设置
    DEFAULT CURRENT_TIMESTAMP   #当插入数据的时候，该字段默认值为当前时间
    ON UPDATE current_timestamp()  #每次更新这条数据的时候,该字段都会更新成当前时间

数据库的连接:
- 使用PDO连接Mysql数据库

