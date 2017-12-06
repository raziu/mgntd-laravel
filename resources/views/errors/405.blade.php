<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>405 Error</title>
<style type="text/css">
html {
  background: #050F2C;
}
body{
  font-family:Arial, Helvetica, sans-serif;
  color: #fff;
}
.wrap{
	width:1000px;
	margin:0 auto;
}
.logo{
	width:430px;
	position:absolute;
	top:25%;
	left:35%;
}
p a{
	color:#050F2C;
	font-size:13px;
	padding:5px;
	background:#fff;
	text-decoration:none;
	-webkit-border-radius:.3em;
	   -moz-border-radius:.3em;
	        border-radius:.3em;
}
.footer{
	position:absolute;
	bottom:10px;
	right:10px;
	font-size:12px;
	color:#aaa;
}
.footer a{
	color:#666;
	text-decoration:none;
}

</style>
</head>
<body>
<div class="wrap">
    <div class="logo">
        <img src="/img/magnetoid-logo-color-full.svg" alt=""  />
        <h1>{{ __('global.405') }}</h1>
        <p><a href="{{ route('home') }}">{{ __('global.btn_back_home') }}</a></p>
    </div>
</div>

<div class="footer">
	&copy 2017 Magnetoid.pl
</div>

</body>
</html>