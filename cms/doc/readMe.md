##cms系统

2017年12月19日12:08:51

###下载框架，创建域名，上传服务器

###数据库权限修改所有人

###navicat软件安装，远程连接项目数据库

###控制器使用命令创建控制器(参考手册控制器：定义声明)

###加载后台首页模板以及登录页面的模板

###修改项目根目录下的.env文件链接数据库

###数据迁移(为了创建admin表)【数据：数据迁移】

###数据填充(为了给admin表写入数据)【数据：数据填充】




2017年12月20日10:26:37星期三

###登录功能
    |--自动验证(验证数据完整、正确性)
    |--控制器中间件(验证是否登录)
    
###修改密码
    |--依赖注入
    |--模板继承

###标签管理
    |--数据迁移（创建标签表）
    |--添加（模型动作：添加）
    |--编辑（模型动作：编辑）
    |--首页展示（分页）
    
    
2017年12月21日09:41:46（星期四）
###栏目管理
    |--创建修改表的迁移(新增几个字段)
    |--修改栏目添加的模板页面
    |--npm下载hdjs（百度搜索nodejs（http://nodejs.cn/download/），下载自己电脑对应的）
    |--使用hdjs中图片上传
        |--安装hdjs
        |--参考：http://hdjs.hdphp.com/387636，引入使用hdjs所需要的js文件
        |--参考：http://hdjs.hdphp.com/232853，将上传代码复制到我们项目中
    |--php部分代码处理   
        |--参考hdphp框架：组件--文件处理--最后(http://doc.hdphp.com/215226)
        |--master父级模板中，修改上传文件的地址以及文件列表的地址
        
    |--首页树状显示
    |--添加页面所属栏目树状显示
    |--编辑页面所属栏目处理（树状、不包含自己和自己所有子集）  
    
    |--栏目删除   


2017年12月22日10:20:03星期五
###文章添加
    |--数据表重新创建
    |--自己创建添加模板
    
###文章首页展示
    |--分页
    |--模型关联，参考手册：多表关联：http://doc.hdphp.com/294781#_36
    
###文章编辑
    |--模板文件
    |--获取旧数据
    |--编辑功能
###文章删除

###系统配置

    |--新增一个父级模板，在resource/view/admin/system.php
    |--实现站点配置功能
        |--创建一个全局中间件
        |--使用了v函数
        |--添加和编辑使用一个方法完成    
    
    
2017年12月23日11:04:58星期六
###数据备份
    |--在框架手册中搜索：备份，
    |--执行备份
    |--备份列表
    |--备份还原
    |--备份删除(参考：目录操作(Dir类))

###设置微信配置项
    |--将微信配置项数据添加到数据表中
        |--创建config表修改的迁移文件
        |--增加字段wechat_config
        |--执行添加
        |--修改中间件加载微信配置项(跟微信通信，我们设置的参数需要跟框架wechat配置文件进行合并)
        |--跟微信通信
        
###微信基本回复
    |--控制器页面建构好
    |--新建修改config表的迁移文件，增加一个微信回复的字段
    |--数据能正常添加到数据库
    |--在微信回推消息url地址，进行微信消息回复  
    
2017年12月25日09:51:19（星期一）
###运行模块
    |--自己创建module和addons目录
    |--分别在这两个目录里面创建两个模块(用来测试)
    |--创建module数据表（手动在里面写入两条测试时数据）
    |--在home/Entry控制器里面书写运行模块的方法
    
###封装url函数(生成url)
    |--需要找一个控制器方法进行测试：url(base.entry.index,['id'=>1])
    |--函数放在system/helper.php
    |--跟之前自己写框架u函数一样    
    
###封装加载模块的模板的template方法
    |--测试代码在module/base/controller/Entry.php-->index()
    |--在app/home/entry控制器类中增加了几个常量
    |--template方法在module/HdController.php里面
    
###完成关键词和回复的添加功能
    |--添加模板，将关键词提出来(system/view/wechat/keywords)
    |--创建关键词表(keyword)和回复内容表(bsae_content)
    |--添加功能：先添加回复表再添加关键词表
        |--完成关键词表时，创建Wechat类(完成关键词的编辑，删除工作)，在HdController里use导入
    |--修改编辑功能：
        |--注意编辑回复表时的模型对象：$baseContentModel = $id?BaseContent::find($id):new BaseContent();
        |--编辑关键词表数据处理：
            $data = [
            		'keyword'=>$post['keyword'],
            		'module_name'=>HD_MODULE,//HD_MODULE是当前模块名称
            		'bc_id'=>$id ? :$bc_id,
            ]; 
        |--在wechat类中保存关键词时候的模型对象的处理：$keywordModel = $id ? Keyword::find($id) :new Keyword();  
        
        
2017年12月26日11:16:56星期二
###微信功能消息回复删除功能
    |--调用了Wechat类中delKeyword方法 

###测试微信关键词回复
    |--代码在wechat  的api控制器类书写
    |--具体的逻辑代码处理，在各自模块中处理，api跳板
    |--跳转到各自模块中system/Processor类中处理
    |--新增加了HdProcessor类处理关键词回复中一些公用的部分
    
###结合文章回复图文消息
    |--在添加编辑模板中增加了三项：文章描述、关键词、跳转链接
    |--在控制器类中(模型)增加对关键词处理逻辑代码
    |--新增加了article模块，手动在数据库中添加一个article模块
    |--反复测试，修复 关键词添加、编辑、删除问题（图文回复、文本回复）

###模块设计(只生成目录)
    |--放在system/controller/Module.php
    |--验证数据不能为空
    |--验证模块不能重复设计
    |--生成基本目录结构
    |--生成微信处理器文件
    |--生成system/Processor文件
    |--成功提示

###模块列表
    |--Dir::tree('addonss')获取addons目录树
    |--循环处理将合法模块数据拿出来循环页面









    