<?php

require '../autoload.php';

use app\Controller\BooksController;

?>
<html>
<head>
	<meta charset="UTF-8"/>
</head>
<body>
	<h1>Bookstore</h1>
		<form method='post' action='basket.php' enctype='multipart/form-data'>
			<label for='books'>Import Books</label>
			<input id='books' name='books' type='file' accept='.csv' size='1000000'>
			<input id='submit' name='submit' type='submit'>
		</form>
</body>
</html>