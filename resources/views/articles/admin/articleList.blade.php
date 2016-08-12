@extends('sidebar')

@section('main-content')

<div class="col-xs-12">
    <h1> 文章列表 </h1>
    <div class="row">
        <div class="col-xs-12">
            <div class="table-responsive">
                <input class="data_token" type="hidden" value="{{ csrf_token() }}" name="_token"/>
                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="center">
                            <label>
                                <input type="checkbox" class="ace">
                                <span class="lbl"></span>
                            </label>
                        </th>
                        <th>序号</th>
                        <th>文章ID</th>
                        <th class="hidden-480">
                            <i class="icon-time bigger-110 hidden-480"></i>
                            发布时间
                        </th>

                        <th>文章标题</th>
                        <th class="hidden-480">文章状态</th>

                        <th>操作</th>
                    </tr>
                    </thead>

                    <tbody>
                    @if($data['articles']['data'])
                    @foreach($data['articles']['data'] as $k=>$row)
                    <tr>
                        <td class="center">
                            <label>
                                <input type="checkbox" class="ace">
                                <span class="lbl"></span>
                            </label>
                        </td>

                        <td>{{$k+1}}</td>
                        <td>{{$row['id']}}</td>
                        <td class="hidden-480">{{$row['publish_date']}}</td>
                        <td><a href="/articles/{{$row['id']}}">{{ $row['title'] }}</a></td>

                        <td class="hidden-480">
                        	@if($row['is_del']<1)
                            <span class="label label-sm label-success">正常</span>
                            @else
                            <span class="label label-sm label-danger">删除</span>
                            @endif
                        </td>

                        <td>
                            <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                               

                                <a class="btn btn-xs btn-info" href="/articles/{{$row['id']}}/edit">
                                    <i class="icon-edit bigger-120"></i>
                                </a>

                                <button class="btn btn-xs btn-danger delete-btn" data-id="{{$row['id']}}">
                                    <i class="icon-trash bigger-120"></i>
                                </button>

                            </div>

                            
                        </td>
                    </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>
                @if($data['articles']['last_page']>1)
                	<div class="modal-footer no-margin-top">
						<ul class="pagination pull-right no-margin">
                        	@for($i=1;$i<=$data['articles']['last_page'];$i++)
                        		<li class="<?=$data['articles']['current_page']==$i?'active' : '';?>">
            						<a href="/admin?page={{$i}}">{{$i}}</a>
            					</li>
                        	@endfor
						</ul>
					</div>
                @endif
					                
            </div><!-- /.table-responsive -->
        </div><!-- /span -->
    </div>
</div>
<script>
    $('.delete-btn').click(function(){
        if(confirm('确定删除?这可是永久删除的!')){
            var id = parseInt($(this).attr('data-id'));
            var token = $('.data_token').val();
            $.ajax({
                url: '/admin/'+id,
                type: 'DELETE',
                data:{_token:token},
                success: function(result) {
                    if(result.code>0){
                        location.href = location.href;
                    }
                }
            });
        }else{
            return false;
        }
    });


</script>
@stop