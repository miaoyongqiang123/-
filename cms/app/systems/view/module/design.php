<extend file='resource/view/admin/module'/>
<block name="content">
	<!-- TAB NAVIGATION -->
	<ul class="nav nav-tabs" role="tablist">
		<li ><a href="{{u('index')}}" >模块列表</a></li>
		<li class="active"><a href="{{u('design')}}" >设计模块</a></li>
	</ul>
	<form action="" method="POST" class="form-horizontal" role="form">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">模块列表</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">模块标识</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" placeholder="请输入模块英文名称">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">模块中文名称</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="title"  placeholder="请输入模块中文名称">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">模块描述</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="description"  placeholder="请输入模块描述">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">预览图</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input class="form-control" name="preview" readonly="" value="">
                            <div class="input-group-btn">
                                <button onclick="upImagePc(this)" class="btn btn-default" type="button">选择图片</button>
                            </div>
                        </div>
                        <div class="input-group" style="margin-top:5px;">
                            <img src="{{__ROOT__}}/node_modules/hdjs/dist/static/image/nopic.jpg" class="img-responsive img-thumbnail" width="150">
                            <em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片"
                                onclick="removeImg(this)">×</em>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary">提交</button>
	</form>
    <script>
        require(['hdjs']);
        //上传图片
        function upImagePc() {
            require(['hdjs'], function (hdjs) {
                var options = {
                    multiple: false,//是否允许多图上传
                    //data是向后台服务器提交的POST数据
                    data: {name: '后盾人', year: 2099},
                };
                hdjs.image(function (images) {
                    //上传成功的图片，数组类型
                    $("[name='preview']").val(images[0]);
                    $(".img-thumbnail").attr('src', images[0]);
                }, options)
            });
        }

        //移除图片
        function removeImg(obj) {
            $(obj).prev('img').attr('src', '../dist/static/image/nopic.jpg');
            $(obj).parent().prev().find('input').val('');
        }
    </script>
</block>