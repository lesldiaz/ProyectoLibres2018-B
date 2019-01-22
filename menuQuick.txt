include "QuickMenu.php";

$str = '[{"text":"Home", "href": "#home", "title": "Home"}, {"text":"About", "href": "#", "title": "About", "children": 
[{"text":"Action", "href": "#action", "title": "Action"}, {"text":"Another action", "href": "#another", "title": 
"Another action"}]}, {"text":"Something else here", "href": "#something", "title": "Something else here"}]';

$qMenu = new QuickMenu(array('data'=>$str));
