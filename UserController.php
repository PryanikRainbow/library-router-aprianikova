<?php

namespace App\Controllers;

require __DIR__ . '/../../vendor/autoload.php';

// перероблю на ООП
use function App\Models\getCountRowsBooks;
use function App\Models\getDataBook;
use function App\Models\getDataBooks;
use function App\Models\incrementCounter;
use function App\Models\getCounter;


require_once __DIR__ . '/../../includes/render.php';

use CounterType;

error_reporting(E_ALL);
ini_set('display_errors', 1);

const USER_TEMPLATE_PATH = __DIR__ . '/../../views/';
//дані має витягувати контролер (до моделей)

error_reporting(E_ALL);
ini_set('display_errors', 1);

class UserController extends Controller
{
    public function defineController($action, $params = null){
        return method_exists($this, $action)
        ? $this->$action($action)
        : render(USER_TEMPLATE_PATH . '/error.php');
    }

    private function printBooks($action, $offsetCurrent = 0)
    {
        // echo "printBooksMethod";

        $dataBooks = getDataBooks(LIMIT, $offsetCurrent);
        $pre = $offsetCurrent !== 0 ? $offsetCurrent - OFFSET_DEFAULT : 0;
        $next = $offsetCurrent + OFFSET_DEFAULT;
        // echo getCountRowsBooks();

        if ($dataBooks != false) {
            $dataTemplate = [
              'dataBooks' => $dataBooks,
              'pre' => $pre,
              'next' => $next,
              'isFirstPage' => isFirstBooksPage($pre, $next, $searchType = null, $param = null),
              'isLastPage' => isLastBooksPage(getCountRowsBooks(), $next, $searchType = null, $param = null)
            ];

            render(USER_TEMPLATE_PATH . '/header.php');
            render(USER_TEMPLATE_PATH . '/books-page.php', $dataTemplate);
            render(USER_TEMPLATE_PATH . '/footer.php');
        } else {
            render(USER_TEMPLATE_PATH . '/error.php');
        }

    }

    private function printBook($action, $id)
    {
        //спробувати витягнути з БД парам. Якщо не вийде, помилку
        echo "book";
        $dataBook = getDataBook($id);
        if ($dataBook != false) {
            render(USER_TEMPLATE_PATH . '/header.php');
            render(USER_TEMPLATE_PATH . $action . '.php', $dataBook);
            render(USER_TEMPLATE_PATH . '/footer.php');
        } else {
            // echo "not found!";
            render(USER_TEMPLATE_PATH . '/error.php');
        }
    }

    private function rewriteCounter($id, $counterType)
    {
        incrementCounter($id, $counterType);
        $newCounter = getCounter($id, $counterType);
        echo $newCounter;
    }

}

