<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>test of wild dog</title>
    <script src="https://cdn.wilddog.com/sdk/js/2.3.8/wilddog.js"></script>
    <script src="https://www.gstatic.com/firebasejs/3.6.2/firebase.js"></script>
</head>
<body>






<script>
//    // 初始化
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


    // Initialize Firebase
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
}


</script>


</body>
</html>