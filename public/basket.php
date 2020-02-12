<?php

require '../autoload.php';

use app\Controller\BooksController;

//Handle csv upload
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
		//File error, redirect to Index
		if($bookinfo[0] == 1) {
			echo "<div>Error: " . $bookinfo[1];
			header("location:index.php:5");
		} else {
			//Book list with number of books and total price
			echo "<div># of Books: " . $bookinfo[0] . "</div>";
			foreach ($bookinfo[2] as $book) {
				echo "<tr>";
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
				$format_books = sprintf("€ %7.2f [%s] %s: %s - %s", $book->getPriceWithDiscount(), $type, $book->getIsbn(), $book->getTitle(), $book->getAuthorsString());
				echo "<div style='white-space: pre-wrap;'>" . $format_books . "</div>";
			}
			$format_total = sprintf('€ %7.2f - Total', $bookinfo[1]);
			echo "<div style='white-space: pre-wrap;'>" . $format_total . "</div>";
		}
	?>
</body>
</html>