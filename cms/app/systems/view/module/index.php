<extend file='resource/view/admin/module'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="{{u('index')}}" >模块列表</a></li>
        <li ><a href="{{u('design')}}" >设计模块</a></li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">模块列表</h3>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>模块标识</th>
                    <th>模块中文名称</th>
                    <th>预览图</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <foreach from="$field" key="$k" value="$v">
                    <tr>
                        <td>{{$k+1}}</td>
                        <td>{{$v['name']}}</td>
                        <td>{{$v['title']}}</td>
                        <td><img src="{{$v['preview']}}" style="width: 50px" alt=""></td>
                        <td>
                            <div class="btn-group btn-group-xs">
                                <if value="$v['isinstall']">
                                    <button type="button" class="btn btn-danger" onclick="uninstall('{{$v['name']}}')">卸载</button>
                                    <else/>
                                    <button type="button" class="btn btn-primary" onclick="install('{{$v['name']}}')">安装</button>
                                    <button class="btn btn-danger" onclick="del('{{$v['name']}}')">删除</button>
                                </if>
                            </div>
                        </td>
                    </tr>
                </foreach>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        //安装
        function install(name) {
            require(['hdjs'], function (hdjs) {
                hdjs.confirm('确定安装该模块?', function () {
                    location.href = "{!! u('install') !!}" + '&name='+name;
                })
            })
        }
        //卸载模块
        function uninstall(name) {
            require(['hdjs'], function (hdjs) {
                hdjs.confirm('确定要卸载模块?', function () {
                    location.href = "{!! u('uninstall') !!}" + '&name='+name;
                })
            })
        }
        //删除模块
        function del(name) {
            require(['hdjs'], function (hdjs) {
                hdjs.confirm('确定要删除吗?', function () {
                    location.href = "{!! u('del') !!}" + '&name='+name;
                })
            })
        }
    </script>
</block>