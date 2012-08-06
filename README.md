search-by-image
===============

Using Google Search By Image feature, get the "Best Guess" for an image

This function will fetch google search by image search, get the result page source and parse the best guess with reguar expressyions.

It's simple by you have to get the CURL Options right to be able to get the result page, otherwise google does this weird protection thing where you will get 302 error (Page moved), but that url will just take you bak to google homepage



OPTIONS:
========

$url: the url of the image you want to search for.
$row: default to false, if true you will just get the source code of result page, no parsing will be done.

EXAMPLE:
========

call this url
http://yoursite.com/search-by-image.php?url=http://www.images.com/myimage.jpg

This will return a string of guess that google display, 
or the whole page source code if $raw is true:

http://yoursite.com/search-by-image.php?url=http://www.images.com/myimage.jpg?raw=true


you could also use that as a form:

<form action="http://yoursite.com/search-by-image.php" method="POST">
  <input type="text" name="url"/>
  <input type="submit" />
</form>


ADDITIONAL USEFUL INFO:
=======================
Yahoo offeres a "Term Extractor" API that will take a text or a phrase and return the keywords in that text. for example if you give it a text like "picture of a car", Yahoo term extractor will return "car" as a keyword.
This can be very useful if you are trying to get a short meaningful keyword about your image.

The API is free but required an app key go here for more info
http://developer.yahoo.com/search/content/V1/termExtraction.html
