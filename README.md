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

前端框架：
- 1.html和css布局：bootstrap
- 2.JavaScript应用：jquery


数据库的设置:
- 表一：admin（存储用户名和密码）
    更新时间直接在数据库里面设置
- 表二：blog （存储博客信息）
    创建博客的时间和更新时间直接在数据库里面设置
    DEFAULT CURRENT_TIMESTAMP   #当插入数据的时候，该字段默认值为当前时间
    ON UPDATE current_timestamp()  #每次更新这条数据的时候,该字段都会更新成当前时间


数据库的连接:
- 使用PDO连接Mysql数据库
```shell
//初始化POD对象
$dbh=new PDO()

//设置utf8编码
array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"

//操作数据库步骤
step1：准备查询语句
$sql = "SELECT * from blog order by rand() limit 4"

step2：建立一个PDOStatement对象
$query = $dbh->prepare($sql);

step3：执行该对象
$query->execute();

step4：主要的语句
$results = $query->fetchAll(PDO::FETCH_OBJ);   //返回一个包含结果集中所有行的数组

$query->bindParam(':imgid', $imgid, PDO::PARAM_STR); //绑定一个参数到指定的变量名

$query->rowCount();  //返回受上一个SQL语句影响的行数

$dbh->lastInsertId();  //返回最后插入行的ID或序列值






```

