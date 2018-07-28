<link rel="stylesheet" href="http://laravel.suhanyu.top/my_style/editor/css/jquery.tagsinput.min.css" />
<script src="http://laravel.suhanyu.top/my_style/editor/js/jquery.tagsinput.min.js"></script>

<div class="form-group">
    {!! Form::label('title') !!}
    {!! Form::text('title',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('tags') !!}
    {!! Form::text('article_tags',null,['id'=>'article_tags','class'=>'form-control','value'=>'php,laravel,tags',]) !!}
</div>
<div class="form-group" style="width:100%;">
    {!! Form::label('content','Content:') !!}
    <div style="width:100%">
        <script type="text/plain" id="container" name="content" style="width:100%;height:260px">
            {!! $initContent !!}
        </script></div>
</div>
<div class="form-group">
    {!! Form::label('publish_date','Publish_date:') !!}
    {!! Form::input('date','publish_date',date('Y-m-d H:i:s'),['class'=>'form-control']) !!}
</div>
	{!! Form::submit('发布文章',['class'=>'btn btn-primary publish-article']) !!}

<script>
    $('#article_tags').tagsInput({
        autocomplete:{selectFirst:true,width:'100px',autoFill:true}
    });

</script>