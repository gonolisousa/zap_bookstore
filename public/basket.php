<?php

require '../autoload.php';

use app\Controller\BooksController;

if(isset($_POST['submit'])) {
	$booksController = new BooksController();
	$bookinfo = $booksController->addBooks();
} else {
	header("location:index.php");
}

?>
<html>
<head>
	<meta charset="UTF-8"/>
</head>
<body>
	<h1>Basket</h1>
	<?php
		if($bookinfo[0] == 1) {
			echo "<div>Error: " . $bookinfo[1];
			header("location:index.php:5");
		} else {
			echo "<div># of Books: " . $bookinfo[0] . "</div>";
		foreach ($bookinfo[2] as $book) {
			switch ($book->getType()) {
	 			case 1:
	 				$type = "Novo";
	 				break;
	 			case 2:
	 				$type = "Exclusivo";
					break;
				case 3:
					$type = "Usado";
					break;
			}
			echo "<div>
				" . sprintf('€ %6.2f [%s] %s: %s - %s', $book->getPrice(), $type, $book->getIsbn(), $book->getTitle(), $book->getAuthors()). "
				</div>";
		}
			echo "<div>
				" . sprintf('€ %6.2f - Total', $bookinfo[1]) . "
				</div>";
		}
	?>
</body>
</html>