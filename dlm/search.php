<?php
require "vendor/autoload.php";

define('YBT_USER_AGENT', 'Mozilla/5.0 (Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko');

class SynoDLMSearchYourBittorrent
{
    const SITE_URL = 'https://yourbittorrent.com';
    private $qurl = SynoDLMSearchYourBittorrent::SITE_URL.'/?';

    public function __construct()
    {
        date_default_timezone_set('UTC');
    }

    public function prepare($curl, $query)
    {
        $url = $this->qurl.http_build_query(array(
            'q' => $query
        ));
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => YBT_USER_AGENT
        ));
    }

    public function parse($plugin, $response)
    {
        $internalErrors = libxml_use_internal_errors(true);

        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->loadHTML(mb_convert_encoding($response, 'HTML-ENTITIES', "UTF-8"));
        $xpath = new DOMXPath($dom);
        $resultNodes = $xpath->query('//section[@class="container-fluid main"]//table[2]/tr');
        foreach ($resultNodes as $resultNode)
        {
            $titleNodes = $xpath->query('./td[1]//a', $resultNode);
            if (empty($titleNodes))
                continue;

            $title = trim($titleNodes[0]->nodeValue);
            if ($title!='')
            {
                $categoryNodes = $xpath->query('./td[1]/div/i', $resultNode);
                $sizeNodes = $xpath->query('./td[2]', $resultNode);
                $dateNodes = $xpath->query('./td[3]', $resultNode);
                $seedsNodes = $xpath->query('./td[4]', $resultNode);
                $leechsNodes = $xpath->query('./td[5]', $resultNode);

                if (preg_match_all('/\/torrent-details\/(.*)\//siU', $titleNodes[0]->getAttribute('href'), $matches, PREG_SET_ORDER))
                {
                    $download = SynoDLMSearchYourBittorrent::SITE_URL.'/down/'.$matches[0][1].'.torrent';
                } else
                {
                    continue;
                }

                $size = floatval($sizeNodes[0]->nodeValue);
                switch (substr($sizeNodes[0]->nodeValue, -2))
                {
                    case 'KB':
                        $size = $size * 1024;
                        break;
                    case 'MB':
                        $size = $size * 1024 * 1024;
                        break;
                    case 'GB':
                        $size = $size * 1024 * 1024 * 1024;
                        break;
                }
                $size = floor($size);

                switch ($dateNodes[0]->nodeValue)
                {
                    case 'Today':
                        $datetime = date('Y-m-d', time()).'00:00:00';
                        break;
                    case 'Yesterday':
                        $datetime = date('Y-m-d', time() - 24 * 60 * 60).'00:00:00';
                        break;
                    default:
                        $datetime = DateTime::createFromFormat('j/m/y|', $dateNodes[0]->nodeValue, new DateTimeZone('UTC'))->format('Y-m-d H:i:s');
                        break;
                }

                $page = htmlspecialchars_decode(SynoDLMSearchYourBittorrent::SITE_URL.$titleNodes[0]->getAttribute('href'));
                $hash = '';
                $seeds = intval($seedsNodes[0]->nodeValue);
                $leechs = intval($leechsNodes[0]->nodeValue);
                switch (explode(' ', $categoryNodes[0]->getAttribute('class'))[1])
                {
                    case 'fa-book':
                        $category='E-Book';
                        break;
                    case 'fa-desktop':
                        $category='TV Shows';
                        break;
                    case 'fa-film':
                        $category='Movies';
                        break;
                    case 'fa-gamepad':
                        $category='Games';
                        break;
                    case 'fa-gear':
                        $category='Software';
                        break;
                    case 'fa-music':
                        $category='Music';
                        break;
                    case 'fa-unlock':
                        $category='Porn';
                        break;
                    default:
                        $category='Other';
                        break;
                }

                $plugin->addResult($title, $download, $size, $datetime, $page, $hash, $seeds, $leechs, $category);
            }
        }

        libxml_use_internal_errors($internalErrors);
    }
}
?>