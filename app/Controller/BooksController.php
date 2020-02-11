<?php

namespace app\Controller;

use app\Books\Book;

/**
 * Handle CSV file with book info
 */

class BooksController
{
	//Add Books to Object
	public function addBooks()
	{
		$fileStatus = $this->checkFile();
		
		if($fileStatus === 1) {
			$csv = array_map('str_getcsv', file('tmp/tmp.csv'));
			$books = array();
			$sum = 0;
			for($i = 1; $i < sizeof($csv); $i++) {

				switch ($csv[$i][0]) {
					case 'NewBook':
						$type = 1;
						break;
					case 'ExclusiveBook':
						$type = 2;
						break;
					case 'UsedBook':
						$type = 3;
						break;
				}

				$title = $csv[$i][1];
				$isbn = $csv[$i][2];
				$price = $csv[$i][3];
				$authors = explode('|', $csv[$i][4]);

				$book = new Book($type, $title, $isbn, $price, $authors);

				$sum += $book->getPrice();

				array_push($books, $book);
			}
			return array(sizeof($csv)-1 , $sum, $books);
		} else {
			return array(1, $fileStatus);
		}
	}

	//Check Anomalies
	private function checkFile() {
		header('Content-Type: text/plain; charset=utf-8');

		try {
		   	//Check file errors
		    if (!isset($_FILES['books']['error']) || is_array($_FILES['books']['error'])) {
		        return 'Invalid parameters.';
		    }

		    switch ($_FILES['books']['error']) {
		        case UPLOAD_ERR_OK:
		            break;
		        case UPLOAD_ERR_NO_FILE:
		            return'No file sent.';
		        case UPLOAD_ERR_INI_SIZE:
		        case UPLOAD_ERR_FORM_SIZE:
		            return 'Exceeded filesize limit.';
		        default:
		            return 'Unknown errors.';
		    }

		    //Check filesize here.
		    if ($_FILES['books']['size'] > 1000000) {
		        return 'Exceeded filesize limit.';
		    }

		    //Check Type
		    if ($_FILES['books']['type'] != 'application/octet-stream') {
		        return 'Invalid file format.';
		    }

		    //Store file
			$file_name = "tmp/" . "tmp.csv";
		    if (!move_uploaded_file($_FILES['books']['tmp_name'], $file_name)) {
		        return 'Failed to move uploaded file.';
		    }

		    return 1;

		} catch (RuntimeException $e) {

		    return $e->getMessage();
		}
	}

}

?>