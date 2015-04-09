# Music
Music API

Usage
```php
$song = 'My everything';
$api = Music::getAPI('zing');
$songs = $api->search($song);
```
Get song data in view simple by
```php
foreach ($songs as $song) {
  echo $song->id;
  echo $song->name;
  echo $song->duration;
  echo $song->artist;
  echo $song->total_play;
  echo $song->genre;
  echo $song->link;
  echo $song->lyrics_file;
}
```
Get link download 128/320 kbps and Lossless
```php
$song->link_download
