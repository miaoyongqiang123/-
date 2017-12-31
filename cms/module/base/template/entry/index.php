<extend file='resource/view/admin/wechat'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="{{url('base.entry.index')}}" >关键词列表</a></li>
        <li ><a href="{{url('base.entry.post')}}" >关键词添加</a></li>
    </ul>
    <!-- TAB CONTENT -->
    <table class="table table-hover">
        <thead>
        <tr>
            <th>编号</th>
            <th>关键词</th>
            <th>回复内容</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <foreach from="$field" key="$k" value="$v">
            <tr>
                <td>{{$v['id']}}</td>
                <td>{{$v->keyword()->keyword}}</td>
                <td>{{$v['content']}}</td>
                <td>
                    <div class="btn-group btn-group-xs">
                        <a href="{!! url('base.entry.post',['id'=>$v['id']]) !!}" class="btn btn-primary">编辑</a>
                        <button type="button" onclick="del({{$v['id']}})" class="btn btn-danger">删除</button>
                    </div>
                </td>
            </tr>
        </foreach>
        </tbody>
    </table>
    <script>
        function del(id){
            require(['hdjs'], function (hdjs) {
                hdjs.confirm('确定删除吗?', function () {
                    location.href = "{{url('base.entry.del')}}" + '&id=' + id;
                })
            })
        }
    </script>
</block>