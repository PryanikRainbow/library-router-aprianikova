// так працювало
// if ("/" === $requestURI) {
//     $userController->defineController("printBooks", 0);
// }

if ($route::simpleRoute("/", $requestURI)) {
    $userController->defineController($route::getAction(), 0);
}
elseif ($route::simpleRoute("/book/", $requestURI)) {
    $userController->defineController($route::getAction(), 0);
}
else {
    echo 'else';
    $errorController->printErrorPage();
}
