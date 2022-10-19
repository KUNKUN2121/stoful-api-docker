<?php

$youtube = $data = null;
if (isset($_REQUEST["text"]) == true)
{
	/** 入力内容を取得 */
	$data = $youtube_url = $_REQUEST["text"];

	/** ＨＴＭＬコードをエンティ */
	$data = htmlspecialchars($data, ENT_QUOTES);

	/** コード変換 */
	$youtube_url = substr($youtube_url, (strpos($youtube_url, "=")+1));

	$youtube = "<iframe width=\"100%\" height=\"400\" src=\"https://www.youtube-nocookie.com/embed/${youtube_url}?rel=0\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>";
	
	$moji = strlen($youtube);
	
	if($moji < 234){
		$youtube = null;
	}
}
?>
<!doctype html>


<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Google.com</title>
        <style>
			body {
				padding-top: 50px;
				background-color: lightgray;
			}

			.starter-template {
				padding: 40px 15px;
				background-color: white;
			}
			.sss{
				size: 50%;
			}
        </style>
    </head>

	
	
	<body>
			<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">YT-URL-GENERETER</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Home</a></li>
					<li><a href="help">使い方</a></li>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</nav>
		
		
		
		<div class="container">
			<div class="jumbotron">
				<h1>
					YouTube URL Genereter
				</h1>
				<p class="lead">iPadしか勝たん</p>
				<form action="" method="post">
					<p>YouTubeのリンクを入力してください</p>
					<input name="text" type="text" value="<?php echo $data; ?>" style="width:100%;">
					<br>
					<div class="text-right">
					<input name="" type="submit" class="btn btn-primary btn-lg">
					</div>
				</form>
				ChromeではなくSafariを使用することをおすすめします。
			</div>
			<?php
				if (is_null($youtube)){
			?>
			<p>正しく入力してください。</p>
			<?php
				}else {
				}
			?>
			<div class="text-center"><?php echo $youtube; ?></div>
		</div>

		
	</body>
</html>
