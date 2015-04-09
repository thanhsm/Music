<?php
/**
 * Created by PhpStorm.
 * User: thanh
 * Date: 09/04/2015
 * Time: 14:16
 */

namespace Music;


class ZingMp3
{

    private $url = 'http://api.mp3.zing.vn/api/mobile/search/song';
    private $link = 'http://mp3.zing.vn';
    private $separator = ',';

    public function __construct($url = null)
    {
        if ($url) {
            $this->url = $url;
        }
    }

    public function search($song = null)
    {
        $data = [
            'requestdata' => json_encode(['q' => $song, 'sort' => 'hot'])
        ];
        $callAPI = call_api('get', $this->url, $data);
        $dataReceived = json_decode($callAPI);
        if ($dataReceived) {
            $result = $this->process($dataReceived->docs);
        }
        return isset($result) ? $result : array();
    }

    protected function process($data)
    {
        $songArray = array();
        foreach ($data as $songObject) {
            $songArray[] = (array)$songObject;
        }
        $songs = array();
        foreach ($songArray as $index => $song) {
            $songs[$index] = new Song([
                'origin_id' => $song['song_id'],
                'id' => pathinfo($song['link'], PATHINFO_FILENAME),
                'bitrate' => $song['bitrate'],
                'duration' => gmdate('i:s', $song['duration']),
                'total_play' => number_format($song['total_play'], 0, ',', $this->separator),
                'name' => $song['title'],
                'artist' => $song['artist'],
                'genre' => $song['genre'],
                'link' => $this->getLink() . $song['link'],
                'link_download' => array_reverse((array)$song['link_download']),
                'source' => (array)$song['source'],
                'lyrics_file' => $song['lyrics_file'],
            ]);
        }
        return $songs;
    }

    /**
     * @return null|string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param null|string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getSeparator()
    {
        return $this->separator;
    }

    /**
     * @param string $separator
     */
    public function setSeparator($separator)
    {
        $this->separator = $separator;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

}
