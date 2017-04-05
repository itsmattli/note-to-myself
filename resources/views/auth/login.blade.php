<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="shortcut icon" href="pencil.ico" />


    <title>Note to Myself - Log in</title>
    <link type="text/css" href="css/register2.css" rel="stylesheet" media="screen"></link>
    <script src="js/jquery-3.2.0.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/login2.js"></script>

</head>
<body>

<h1>Log in</h1>
<form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
<ul>
    <li>
        <h3>Email Address</h3>
        <p>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </p>
    </li>
</ul>
<ul>
    <li>
        <h3 title="6+ characters">Password<span id="validPass"></span></h3>
        <p>
            <input id="password" type="password" class="form-control" name="password" required>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </p>
    </li>
</ul>
<ul>
    <li>
        <h3> Remember Me</h3>
        <p>
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
        </p>
    </li>
    <li class="last">
        <p>
            <input type="image" id="submit" src="images/login2.png" alt="register button" style="vertical-align:middle;" tabindex="5" />
        </p>
    </li>
    <li>
        <p>
            <a href="#">Register</a> | <a href="{{ route('password.request') }}">Forgot password</a>
        </p>
    </li>
    <li id="errormessage" style="color:red;"></li>
    <li><a href="http://twitter.com/#!/notes_myself">Twitter</a></li>
</ul>
</form>
</body>
</html>

