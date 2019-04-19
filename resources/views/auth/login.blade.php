@extends('app')
@section('content')

    <div class="container">
        <h1> 登录 </h1>
        <div class="row" style="margin-top:50px;">
         	<div class="col-md-4 col-md-offset-4">
         		{!! Form::open(['url'=>'/auth/login/','class'=>'login-form']) !!}
                    <!--- Email Field --->
                    <div class="form-group">
                        <input type="hidden" name="renderKey" value="6LdaF58UAAAAAJgc35sXqm0jE8yHOKvbYKXpimo0">
                        <input type="hidden" name="token" value="">
                        {!! Form::label('email', 'Email:') !!}
                        {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    </div>
                    <!--- Password Field --->
                    <div class="form-group">
                        {!! Form::label('password', 'Password:') !!}
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
                    {!! Form::button('登录',['class'=>'btn btn-primary form-control submit-btn','disabled'=>true,]) !!}

                {!! Form::close() !!}

                @if($errors->any())
                    <ul class="list-group">
                        @foreach($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">{{$error}}</li>
                        @endforeach
                    </ul>
                @endif
         	</div>
        </div>
    </div>
    <script src="https://www.google.com/recaptcha/api.js?render=6LdaF58UAAAAAJgc35sXqm0jE8yHOKvbYKXpimo0"></script>
    <script>
        $('.submit-btn').click(function () {
            $('.login-form').submit();
        });
        grecaptcha.ready(function() {
            var renderKey = '6LdaF58UAAAAAJgc35sXqm0jE8yHOKvbYKXpimo0'
            grecaptcha.execute(renderKey, {action: '/'}).then(function(token) {
                $('input[name="token"]').val(token);
                $('.submit-btn').removeAttr('disabled');

                // var postData = {
                //     renderKey:renderKey,
                //     token:token,
                //     _token:_token
                // };
                // $.ajax({
                //     url:"/auth/resolveReCAPTCHAV3",
                //     type:"post",
                //     data:postData,
                //     success:function (response) {
                //         if (response.status == 1) {
                //             alert('用户检测正常。');
                //         } else if (response.status == 2) {
                //             alert('用户检测可疑。');
                //         } else {
                //             alert('用户检测异常，您可能是机器人。');
                //         }
                //     },
                //     error:function (response) {
                //
                //     }
                // });
            });
        });
    </script>
@stop