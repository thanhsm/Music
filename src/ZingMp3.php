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
    private $separator = ',';

    public function __construct($url = null)
    {
        if ($url) {
            $this->url = $url;
        }
    }

    public function get($song = null)
    {
        $data = [
            'requestdata' => json_encode(['q' => $song, 'sort' => 'hot'])
        ];
        $callAPI = call_api('get', $this->url, $data);
        $dataReceived = json_decode($callAPI);
        if ($dataReceived) {
            $result = $this->process($dataReceived);
        }
        return isset($result) ? $result : array();
    }

    protected function process($data)
    {
        $songArray = array();
        foreach ($data as $songObject) {
            $songArray[] = (array)$songObject;
        }
        $songData = array();
        foreach ($songArray as $index => $song) {
            if ($song['username'] != 'mp3') {
                continue;
            }
            $songData[$index] = new Song([
                'origin_id' => $song['song_id'],
                'id' => pathinfo($song['link'], PATHINFO_FILENAME),
                'bitrate' => $song['bitrate'],
                'duration' => gmdate('i:s', $song['duration']),
                'total_play' => number_format($song['total_play'], 0, ',', $this->separator),
                'name' => $song['title'],
                'artist' => $song['artist'],
                'genre' => $song['genre'],
                'link_download' => $song['link_download'],
                'source' => $song['source'],
                'lyrics_file' => $song['lyrics_file'],
            ]);
        }
        return $songData;
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

}
