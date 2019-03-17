<?php

namespace App\Service;

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Response;

class CoreService {

    const MAIN_URL = 'https://lexani.com/videos';
    const FILENAME = 'result.csv';
    private $_data = [];

    public function initCURL()
    {
        $ch = curl_init(self::MAIN_URL);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false);
        $CURLData = curl_exec($ch);
        curl_close($ch);
        return $CURLData;
    }
    
    public function initParse()
    {
        $crawler = new Crawler($this->initCURL());
        $crawler->filter("div.media")->reduce(function(Crawler $node, $i) {
            $videoSource = $node->attr("data-src");
            $videoPreview = $node->filter("div.thumbnail")->attr("data-src");
            $videoTitle = $node->filter("div.thumbnail > p")->text();
            $videoDescription = $node->filter("div.thumbnail > p")->text();
            $this->_data[] = [
                'video_source'         => $videoSource,
                'video_title'          => $videoTitle,
                'video_preview'        => $videoPreview,
                'video_description'    => $videoDescription
            ];
        });
        return $this->_data;
    }

    public function initCSV($items)
    {
        $file = fopen(self::FILENAME, "w");
        foreach ($items as $value)
        {
            $export = [
                'id'            =>  $value->getId(),
                'status'        =>  $value->getStatus(),
                'title'         =>  $value->getVideoTitle(),
                'source'        =>  $value->getVideoSource(),
                'description'   =>  $value->getVideoDescription(),
                'preview'       =>  $value->getVideoPreview(),
            ];
            fputcsv($file, $export, '|');
        }
        fclose($file);
        (new Response())->headers->set('Content-Type', 'text/csv; charset=utf-8');
        (new Response())->headers->set('Content-Disposition', 'attachment; filename="' . self::FILENAME . '"');
    }
}

/**
 * Инициализировать курл
 * Инициализировать парсер по данным из курла
 * Инициализация метода для работы с CSV
 */