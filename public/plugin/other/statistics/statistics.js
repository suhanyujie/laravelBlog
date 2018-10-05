$(function () {
    $.get('https://laravel.suhanyu.top/statistics/dig',{
        time:gettime(),  //js获取当前时间
        url:geturl(),
        refer:getrefer()
    })
    window.onload = function () {
        gettime();  //js获取当前时间
        geturl();    //js获取客户端当前url
        getrefer();    //js获取客户端当前页面的上级页面的url
        getuser_agent();       //js获取客户端类型
    }

    function gettime() {
        var nowDate = new Date();
        return nowDate.toLocaleString();
    }

    function geturl() {
        return window.location.href;
    }
    function getrefer() {
        return document.referrer;
    }

    function getcookie() {
        return document.cookie;
    }

    function getuser_agent() {
        return navigator.userAgent;
    }
})
