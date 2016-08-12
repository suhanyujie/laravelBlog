<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>爱生活-锲而不舍</title>
<meta name="keywords" content="亡命之徒|寻觅|苏汉宇|850099803" />
<meta name="description" content="苏汉宇个人博客，是记录博主学习和成长,结束交流的一个自媒体博客。关注于web后端技术(PHP)和服务端编程的学习研究,同时喜欢前端工程化,喜欢Node,Vue,webPack等等..！" />
<meta name="baidu-site-verification" content="B29FDA674B" />
<meta http-equiv="Cache-Control" content="no-transform " />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<meta name="HandheldFriendly" content="True" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="//cdn.bootcss.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" href="//cdn.bootcss.com/highlight.js/8.5/styles/monokai_sublime.min.css">
<style>
.content-wrap { background:url(//i2.buimg.com/141169079dbd0294.jpg) ;}
.navbar{ margin-bottom:0;}
/* 鼠标选中颜色 */
::-moz-selection{background:#93C; color:#FCF;} 
::selection {background:#93C; color:#FCF;} 
.content-wrap .main-content article,.content-wrap .main-content .little-label{ background:#fff;border:1px solid #ccc; margin-top:20px; padding:10px; border-radius:10px; opacity:0.7; } 

.content-wrap .main-content article .post-content{ margin:10px auto; }
.content-wrap .main-content article .post-permalink{ margin-bottom:10px; }

/* 返回顶部 */
#back-to-top{ position: fixed;z-index: 99; left: 50%; bottom: 60px; width: 40px; height: 48px;border-radius:5px; margin-left: 510px;margin-right:30px;background:url(//icon.zol-img.com.cn/mainpage/20150210/index-icon-20150505.png)no-repeat;background-position:50% -386px;background-color:#fafafa;text-indent:-9999em;font:0/0 arial;overflow:hidden;}
#back-to-top:hover{ background-color:#6393E2; }

</style>
<base target="_blank"/>
<script>
	//  1. Sidebar Position
	var sidebar_left = false; // Set true or flase for positioning sidebar on left

	//  2. Recent Post count
	var recent_post_count = 3;
</script>

<script>
	var _hmt = _hmt || [];
</script>
<style type="text/css">
	.container  .post-content pre code .hljs-variable{
		color:#f92672;
	}
	.container .post-content pre{
		font-size:12px;
		background:#f7f7f7;
	}
</style>
</head>

<body class="home-template">
	<!-- start navigation -->
@include('articles.nav')


<!-- end navigation -->
	<!-- start site's main content area -->
	<section class="content-wrap">
		<div class="container">
			<div class="row">
				<main class="col-md-8 main-content">
					@foreach($data['articles']['data'] as $row)
						<article id=52 class="post tag-laravel-5-1 tag-artisan">
                        	<div class="post-head">
                        		<h1 class="post-title">
                        			<a href="{{url('articles',$row['id'])}}">{{$row['title']}}</a>
                        		</h1>
                        		<div class="post-meta">
                        			<span class="author">作者：<a href="//weibo.com/u/1889337694">suhy</a></span>
                        			&bull;
                        			<time class="post-date" datetime="{{ $row['publish_date'] }}"
                        				title="{{ $row['publish_date'] }}">{{ $row['publish_date'] }}</time>
                        		</div>
                        	</div>
                        	<div class="post-content">
                        		{!! mb_substr(strip_tags($row['content']['content']),0,200,'utf-8') !!}
                        	</div>
                        	<div class="post-permalink">
                        		<a href="{{url('articles',$row['id'])}}" class="btn btn-default">阅读全文</a>
                        	</div>
                        
                        	<footer class="post-footer clearfix">
                        		<div class="pull-left tag-list">
                        			 <span class='glyphicon glyphicon-eye-open' style="padding-left:10px;"><span style="padding-left:3px;">共有136人浏览</span></span>
                        		</div>
                        		<div class="pull-right share"></div>
                        	</footer>
                        </article>
					@endforeach
					
					<nav class="pagination" role="navigation">
						@if(isset($data['articles']['prev_page_url']))
							<a class="older-posts" href="{{$data['articles']['prev_page_url']}}"><i class="fa">上一页</i></a>
						@endif
    					@if(isset($data['articles']['next_page_url']))
							<a class="older-posts" href="{{$data['articles']['next_page_url']}}"><i class="fa">下一页</i></a>
						@endif
					</nav>
				</main>

				<aside class="col-md-4 sidebar">
	<!-- start widget -->
	<!-- end widget -->

	<!-- start tag cloud widget -->
	<div class="widget">
		<h4 class="title">最近文章</h4>
		<ul style="list-style:none;padding:0px;font-size:14px;">
	  	  	<li><a href="/detail/22.html" class="list-group-item" style="border:none;">Socket.io的实时竞拍系统实现</a></li>
		</ul>
	</div>
	<!-- end tag cloud widget -->

	<!-- start widget -->
		<div class="widget">
		<h4 class="title">博文分类</h4>
		<ul style="list-style:none;padding:0px;font-size:14px;">
			<li><a href="/list/13.html" class="list-group-item" style="border:none;">PHP<span class="badge">3</span></a></li>
		</ul>
	</div>
		<!-- end widget -->
	
	<!-- start tag cloud widget -->
		<div class="widget little-label">
    		<h4 class="title">标签云</h4>
    		<div class="content tag-cloud">
    						<a href="/tag/5.html" class="label label-info">Mysql</a>
    						<a href="/tag/6.html" class="label label-info">Yaf</a>
    						<a href="/tag/7.html" class="label label-info">Yar</a>
    						<a href="/tag/8.html" class="label label-info">Mongodb</a>
    						<a href="/tag/9.html" class="label label-info">Amoeba</a>
    						<a href="/tag/10.html" class="label label-info">PHP进程管理</a>
    						<a href="javascript:void(0);">...</a>
    		</div>
    	</div>
		<!--  end tag cloud widget -->
		
		
		<div class="widget little-label">
    		<h4 class="title">友情链接</h4>
    		<div class="content tag-cloud">
    			<a href="https://github.com/suhanyujie" class="label label-primary">我的github</a>
				<a href="//blog.52fhy.com/" class="label label-primary">飞鸿影</a>
				<a href="https://github.com/52fhy/" class="label label-primary">飞鸿影的github</a>
				<a href="//www.cnblogs.com/52fhy/" class="label label-primary">飞鸿影的cnblog</a>
				<a href="//www.cnblogs.com/ishenghuo/" class="label label-primary">我的cnblog</a>
    		</div>
    	</div>
		
	<!-- start widget -->
	<div class="widget">
		<h4 class="title">联系我</h4>

		
		<p style="margin-top:10px;"><span style="color:red;">Email</span> : suhanyujie@qq.com</p>
	</div>
	<!-- end widget -->
</aside>
			</div>
		</div>
	</section>

	
<div class="copyright">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<span>Copyright &copy; <a href="//laravel.suhanyu.top">laravel.suhanyu.top 个人博客</a> </span> | <span><a href="//laravel.suhanyu.top/"
						target="_blank">爱生活-锲而不舍</a>
			</div>
		</div>
	</div>
</div>

<a href="javascript:void(0);" id="back-to-top" target="_self"><span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span></a>

<script src="//cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="//cdn.bootcss.com/fitvids/1.1.0/jquery.fitvids.min.js"></script>
<script src="//cdn.bootcss.com/highlight.js/8.5/highlight.min.js"></script>
<script type="text/javascript">
$(window).scroll(function(){
    var sT=$(this).scrollTop();
    if(sT >= 850) {
        $('#back-to-top').show();
    }
    if(sT < 850){
        $('#back-to-top').hide();
    }
   
});
$('#back-to-top').click(function(){
	$(window).scrollTop(0);
});

</script>
	<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1259999548'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/z_stat.php%3Fid%3D1259999548%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
</body>
</html>
