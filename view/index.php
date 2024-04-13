<!DOCTYPE html>
<html lang="ja">
	<head>
		<title></title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/layout.css">
	</head>
	<body>
		<div id="form-area">
			<form action="index.php" method="post">
				<div>
					<input type="text" name="keyword" id="input-word"
					   placeholder="あなたの好きな言葉を入力してください">
					</input>
					<input type="submit" value="生成！" id="btn"></input><br />
				</div>
				<div class="password">
					<label for="pass-length">パスワードの長さ</label>
					<input type="number" name="pass-length" id="pass-length"
					value=8 min=2 max=30>
				</div>
			</form>
		</div>

			<hr>
			<?php
				require_once 'check.php';

				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					$keyword = $_POST["keyword"];
					$number  = $_POST["passLen"];

					$pass = isAlpha($keyword, $passLen);

					echo "<p>$pass</p>";
				}
			?>
	</body>
</html>
