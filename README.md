# snippget
[![Code Climate](https://codeclimate.com/github/ezylot/RESTful-API-Server/badges/gpa.svg)](https://codeclimate.com/github/ezylot/RESTful-API-Server) [![Build Status](https://travis-ci.org/ezylot/snippget.svg?branch=master)](https://travis-ci.org/ezylot/snippget)


When using nginx configure the location to something like that (i use the subdirectory "snippets"):
```
location /snippets/ {
  rewrite "snippets/tests.*" /snippets/index.php last;
  rewrite "snippets/api/([a-zA-Z0-9]{18})/(.+)" /snippets/api/index.php?key=$1&request=$2 last;
  rewrite "snippets/api/([a-zA-Z0-9]{18})/?" /snippets/api/index.php?key=$1&request= last;
  rewrite "snippets/api/?" /snippets/api/index.php last;
  #rewrite (.*) /snippets/index.php last;

}
```
