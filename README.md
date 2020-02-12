# zap_bookstore

Zap_Bookstore is a software to read csv files with book informations and render them on a webpage, calculating how many books, their final price and total price for them.

## Usage

<?php

use app\Controller\BooksController;

$booksController = new BooksController(); 
//returns BooksController class

$bookinfo = $booksController->addBooks(); 
//return book information in an array
//(
//    [0] => number of books,
//    [1] => total price with discounts,
//    [2] => array of book objects, //containing type, title, isbn, original price and authors
//)
//Can also return a array with file error
//(
//    [0] => error code,
//    [1] => error message,
//)

use app\Books\Book;

$book = new Book($type, $title, $isbn, $price, $authors);
//returns book object with get and set for every property

$book->getPriceWithDiscount()
//returns price with discount

$book->getAuthorsString()
//returns authors formatted in a string with comma-separated values

?>
