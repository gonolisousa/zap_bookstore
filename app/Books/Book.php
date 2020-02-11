<?php

namespace app\Books;

/**
 * Book Class
 * sets and gets
 */

class Book {
	private $type;
	private $title;
	private $isbn;
	private $price;
	private $authors;

	public function __construct($type, $title, $isbn, $price, $authors)	{
		$this->type = $type;
		$this->title = $title;
		$this->isbn = $isbn;
		$this->price = $price;
		$this->authors = $authors;
	}

	//Sets
	public function setType($type) {	
		$this->type = $type;
	}

	public function setTitle($title) {	
		$this->title = $title;
	}

	public function setISBN($isbn) {	
		$this->isbn = $isbn;
	}

	public function setPrice($price) {	
		$this->price = $price;
	}

	public function setAuthors($authors) {	
		$this->authors = $authors;
	}

	//Gets
	public function getType() {	
		return $this->type;
	}

	public function getTitle() {	
		return $this->title;
	}

	public function getISBN() {	
		return $this->isbn;
	}

	//Return price depending on book type
	public function getPrice() {	
		switch($this->type) {
			case 1:
				$discount = 0.1;
				break;
			case 2:
				$discount = 0;
				break;
			case 3:
				$discount = 0.25;
				break;
		}
		return $this->price - ($this->price * $discount);
	}

	public function getAuthors() {
		$authors = "";
		foreach ($this->authors as $author) {
			$authors .= $author . ", ";
		}
		return rtrim($authors, ", ");
	}

}

?>