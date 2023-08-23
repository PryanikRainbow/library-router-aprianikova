# library-router-aprianikova
router + index.php

Роутер. Мало б парсити:
основна ідея:
simple router without query string: example:  /books/2

if (filePath === /books/ && params != null ) 
action = printBooks
params = Array ( [0] => 2 ) 

/book/2 => printBook Array ( [0] => 2 ) 

проблема зі слешем. (/)
будь який запит розрізняв filePath як /.
Хоча в  simpleRoute враховувала кейс filePath===requestURI, а в determineAction враховувала filePath==="/".

знайшла два рішення, як це пофіксити(здається). 
1) 1 залишила не закоментованим (simpleRote). залишила коментар, як до цього НЕ працювало.
2) залишила закоментованим в index.php як працює.
