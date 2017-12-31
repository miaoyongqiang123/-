<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>环境检测</title>
	<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js?version=1.2.100"></script>


</head>
<body style="background: url(/resource/images/system_bg.jpg);background-size: 100% 100%;height: 100vh;">
<div style="width:1100px;margin: 0px auto 50px;padding-top: 50px;">
	<div style="background: url(/resource/images/logo.png) no-repeat;background-size:contain;height:80px;"></div>
	<br>
	<div class="panel panel-default">
		<nav class="navbar navbar-default" style="border-radius: 0px;">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#"><strong>HDCMS 百分百开源免费,可用于任意商业项目!</strong>
						<small class="text-info">使用高效的HDPHP框架构建</small>
					</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="http://www.houdunwang.com" target="_blank">培训</a></li>
						<li><a href="http://www.hdcms.com" target="_blank">官网</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="panel-body">
			<div class="col-xs-3">
				<div class="progress">
					<div class="progress-bar progress-bar-striped progress-bar-danger active" style="width: 40%;">
						40%
					</div>
				</div>
				<ul class="list-group">
					<li class="list-group-item"><strong>安装步骤</strong></li>
					<li class="list-group-item"><i class="fa fa-copyright"></i> 安装协议</li>
					<li class="list-group-item" style="background: #dff0d8"><i class="fa fa-pencil-square-o"></i> 环境检测
					</li>
					<li class="list-group-item"><i class="fa fa-database"></i> 数据库配置</li>
					<li class="list-group-item"><i class="fa fa-check-circle"></i> 完成</li>
				</ul>
			</div>
			<div class="col-xs-9">
				<div class="panel panel-default">
					<div class="panel-heading">
						服务器信息
					</div>
					<div class="panel-body" style="padding: 10px;">
						<table class="table table-hover table-striped">
							<thead>
							<tr>
								<th>参数</th>
								<th>值</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>操作系统</td>
								<td>{{$data['php_os']}}</td>
							</tr>
                            <tr>
                                <td>服务器环境</td>
                                <td>{{$data['server_software']}}</td>
                            </tr>
							<tr>
								<td>PHP版本</td>
								<td>{{$data['php_version']}}</td>
							</tr>

							</tbody>
						</table>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						HDCMS 环境要求
					</div>
					<div class="panel-body" style="padding: 10px;">
						<table class="table table-hover table-striped">
							<thead>
							<tr>
								<th>参数</th>
								<th>说明</th>
								<th>状态</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>PHP版本</td>
								<td>要求PHP版本大于5.6</td>
								<td>
                                    <?php $res = version_compare ($data['php_version'],'5.6','>')?>
                                    <if value="$res">
                                        <i class="fa fa-check-circle fa-1x alert-success"></i>
                                        <else/>
                                        <i class="fa fa-times alert-danger hd-cr-error"></i>
                                    </if>
                                </td>
							</tr>
							<tr>
								<td>PDO</td>
								<td>不支持将不能操作数据库</td>
                                <td>
                                    <if value="$data['pdo']">
                                        <i class="fa fa-check-circle fa-1x alert-success"></i>
                                        <else/>
                                        <i class="fa fa-times alert-danger hd-cr-error"></i>
                                    </if>
                                </td>
							</tr>
							<tr>
								<td>GD图像库</td>
								<td>不支持将无法处理图像</td>
                                <td>
                                    <if value="$data['gd']">
                                        <i class="fa fa-check-circle fa-1x alert-success"></i>
                                        <else/>
                                        <i class="fa fa-times alert-danger hd-cr-error"></i>
                                    </if>
                                </td>
							</tr>
							<tr>
								<td>CURL</td>
								<td>微信等远程接口将需要CURL模块</td>
                                <td>
                                    <if value="$data['curl']">
                                        <i class="fa fa-check-circle fa-1x alert-success"></i>
                                        <else/>
                                        <i class="fa fa-times alert-danger hd-cr-error"></i>
                                    </if>
                                </td>
							</tr>
							<tr>
								<td>OpenSSL</td>
								<td>需要支持</td>
                                <td>
                                    <if value="$data['openssl']">
                                        <i class="fa fa-check-circle fa-1x alert-success"></i>
                                        <else/>
                                        <i class="fa fa-times alert-danger hd-cr-error"></i>
                                    </if>
                                </td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						目录权限检测
					</div>
					<div class="panel-body" style="padding: 10px;">
						<table class="table table-hover table-striped">
							<thead>
							<tr>
								<th>目录</th>
								<th>状态</th>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>./</td>
                                <td>
                                    <if value="$data['is_writable']">
                                        <i class="fa fa-check-circle fa-1x alert-success"></i>
                                        <else/>
                                        <i class="fa fa-times alert-danger hd-cr-error"></i>
                                    </if>
                                </td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
				<a href="{{u('copyright')}}" class="btn btn-success">返回</a>
				<a href="javascript:;" onclick="next()" class="btn btn-primary">继续</a>
			</div>
		</div>
	</div>
	<div class="text-center" style="color:#fff;"> ©2010 - 2019 hdcms.com Inc.</div>
</div>
<script>
    function next() {
        //获取hd-cr-error 类长度
        var len = $('.hd-cr-error').length;
        if(len>=1){
            alert('环境不符合要求');
        }else{
            location.href = "{{u('database')}}";
        }
    }
</script>
</body>
</html>