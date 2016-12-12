<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>test of wild dog</title>
    {{--<script src="https://cdn.wilddog.com/sdk/js/2.3.8/wilddog.js"></script>--}}
    {{--<script src="https://www.gstatic.com/firebasejs/3.6.2/firebase.js"></script>--}}
    {{--<script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>--}}
    <script src="http://apps.bdimg.com/libs/jquery/1.6.0/jquery.js"></script>
</head>
<body>


<script>
//        $.ajax({
//            url: 'http://laravel.suhanyu.top/api/test/articles',
//            success: function(data){
//                console.log(data);
//            }
//        });

    var tmpObj = $.ajax({
        url: 'http://laravel.suhanyu.top/api/test/articles',
    });
    tmpObj.done(function(data){
        var one = data.data.pop();
        console.log(one);
    });
    tmpObj.done(function(data){
        var one = data.data.pop();
        one = data.data.pop();
        console.log(one);
    });

//    tmpObj.done(function(data){
//        var one = data.data.pop();
//        console.log(one);
//    });


//    console.log(tmpObj);

    //    $.ajax({
//        url: '/api/test/articles',
//        dataType: 'json',
//        success: function(data){
//            console.log(data);
//        }
//    });

//    var promise = $.ajax({
//        url: '/api/test/articles',
//        dataType: 'json',
//    });
//    promise.then(function(data){
//        throw new Error('ajax is failed!');
//    }).fail(function(err){
//        console.log(err);
//    });




//    // 初始化   野狗实时数据库
//    var config = {
//        authDomain: "suhy-2016.wilddog.com",
//        syncURL: "https://suhy-2016.wilddogio.com"
//    };
//    wilddog.initializeApp(config);
//    var ref = wilddog.sync().ref("/test1");
//    // child() 用来定位到某个节点。
//    ref.child("test").set({
//        "full_name": "Steve Jobs",
//        "gender": "male"
//    });

/*    // firebase 实时数据库
    var config = {
        apiKey: "AIzaSyCGM8D5A1cs-uiPpq7JR00WVlwzm5KVByM",
        authDomain: "laravel-blog-c4b4f.firebaseapp.com",
        databaseURL: "https://laravel-blog-c4b4f.firebaseio.com",
        storageBucket: "laravel-blog-c4b4f.appspot.com",
        messagingSenderId: "976917761218",
        "rules": {
            ".read": true,
            ".write": true
        }
    };
    firebase.initializeApp(config);
    var database = firebase.database();
    writeUserData(1, 'xujingzhong', 'xujingzhong@icar.com.cn', 'http://laravel.suhanyu.top');


function writeUserData(userId, name, email, imageUrl) {
    firebase.database().ref('/test1/' + userId).set({
        username: name,
        email: email,
        profile_picture : imageUrl
    });
}*/


</script>


</body>
</html>