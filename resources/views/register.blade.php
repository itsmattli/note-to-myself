<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
@include('includes.head')
</head>
<body>

<h1>Register</h1>

<form class="form-horizontal" role="form" method="POST" action="/registeruser">
    {{ csrf_field() }}
    <ul>
        <li>
            <h3>Email address
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </h3>
            <p>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            </p>
        </li>
        <li>
            <h3 title="6+ characters">Password
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </h3>
            <p>
                <input id="password" type="password" class="form-control" name="password" required>
            </p>
        </li>
        <li>
            <h3 title="same as above">Password confirmation<span id="validPassConf"></span></h3>
            <p>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </p>
        </li>
        <li> <h3 id="recapchalabel">Recaptcha</h3>
            <div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
        </li>
        <li class="last">
            <p>
                <input type="image" id="submit" src="images/button2.png" alt="register button" style="vertical-align:middle;" tabindex="5" />
                or <a href="index.php">log in</a>
        </li>
        <li id="errormessage" style="color:red;"></li>
    </ul>
</form>
</body>
</html>
