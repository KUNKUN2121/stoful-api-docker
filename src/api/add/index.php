
<!doctype html>


<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>商品登録 Register</title>
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
		
		<div class="container">			
			<div class="jumbotron">
				<h1>
				商品登録 Register
				</h1>
				<hr>
				<p>既存に存在しているバーコードでは登録されず上書きされます。</p>
				<form method="post" action="send.php" enctype="multipart/form-data">
					<label>商品名</label>
						<input type="text" name="content">
					<label>バーコード</label>
						<input type="number" name="barcode" />
					<label>個数</label>
						<input type="number" name="quantity" value="1"/>
					<label>価格</label>
						<input type="number" name="price" value="100" />
					<select name="category">
						<option value="1">ドリンク</option>
						<option value="2">おにぎり</option>
						<option value="3">パン</option>
						<option value="4">筆記用具</option>
						<option value="5">その他</option>
					</select>
					<input type="file" name="up_file">
					<div class="text-right">
					<input name="" type="submit" class="btn btn-primary btn-lg">

					</div>
				</form>
			</div>
		</div>		
	</body>
</html>
