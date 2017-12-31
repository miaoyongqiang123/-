<extend file='resource/view/admin/wechat'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li ><a href="{{url('base.entry.index')}}" >关键词列表</a></li>
        <if value="Request::get('id')">
            <li class="active"><a href="{{url('base.entry.post',['id'=>Request::get('id')])}}" >关键词编辑</a></li>
            <else/>
            <li class="active"><a href="{{url('base.entry.post')}}" >关键词添加</a></li>
        </if>

    </ul>
    <!-- TAB CONTENT -->
    <form action="" method="POST" class="form-horizontal" role="form">
        <div class="panel panel-default">
        	  <div class="panel-heading">
        			<h3 class="panel-title">关键词添加</h3>
        	  </div>
        	  <div class="panel-body">
                  <include file="resource/view/wechat/keyword"/>
                  <div class="form-group">
                      <label for="" class="col-sm-2 control-label">回复内容</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" name="content" value="{{$oldData['content']}}">
                      </div>
                  </div>
        	  </div>
        </div>
        <button class="btn btn-primary">提交</button>
    </form>
</block>