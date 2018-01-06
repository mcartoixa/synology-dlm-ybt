<?php
require 'FakePlugin.php';
use PHPUnit\Framework\TestCase;

final class SynoDLMSearchYourBittorrentTest extends TestCase
{
    public function testCanParseValidResults()
    {
        $plugin = new FakePlugin;
        $search = new SynoDLMSearchYourBittorrent;
        $search->parse($plugin, SynoDLMSearchYourBittorrentTest::html);

        $this->assertEquals(3, count($plugin->results));

        $result = $plugin->results[0];
        $this->assertEquals('Football Manager 2016 [Test Game] - Update Version 1 2 3', $result->title);
        $this->assertEquals(SynoDLMSearchYourBittorrent::SITE_URL.'/down/11598899.torrent', $result->download);
        $this->assertEquals(11534336.0, $result->size);
        $this->assertEquals('2018-01-04 00:00:00', $result->datetime);
        $this->assertEquals(SynoDLMSearchYourBittorrent::SITE_URL.'/torrent-details/11598899/football-manager-test-game-update-version-1-2-3.html', $result->page);
        $this->assertEquals('', $result->hash);
        $this->assertEquals(446, $result->seeds);
        $this->assertEquals(295, $result->leechs);
        $this->assertEquals('Games', $result->category);

        $result = $plugin->results[1];
        $this->assertEquals('[DoctorAdventures] Adriana Chechik - Porn Preference Test (30 12 2017) tk (1k)', $result->title);
        $this->assertEquals(SynoDLMSearchYourBittorrent::SITE_URL.'/down/11571354.torrent', $result->download);
        $this->assertEquals(298844160.0, $result->size);
        $this->assertEquals('2017-12-30 00:00:00', $result->datetime);
        $this->assertEquals(SynoDLMSearchYourBittorrent::SITE_URL.'/torrent-details/11571354/doctoradventures-adriana-chechik-porn-preference-test-30-12-tk-1k.html', $result->page);
        $this->assertEquals('', $result->hash);
        $this->assertEquals(341, $result->seeds);
        $this->assertEquals(40, $result->leechs);
        $this->assertEquals('Porn', $result->category);

        $result = $plugin->results[2];
        $this->assertEquals('DoctorAdventures - Adriana Chechik - Porn Preference Test', $result->title);
        $this->assertEquals(SynoDLMSearchYourBittorrent::SITE_URL.'/down/11587272.torrent', $result->download);
        $this->assertEquals(298844160.0, $result->size);
        $this->assertEquals('2018-01-02 00:00:00', $result->datetime);
        $this->assertEquals(SynoDLMSearchYourBittorrent::SITE_URL.'/torrent-details/11587272/doctoradventures-adriana-chechik-porn-preference-test.html', $result->page);
        $this->assertEquals('', $result->hash);
        $this->assertEquals(115, $result->seeds);
        $this->assertEquals(23, $result->leechs);
        $this->assertEquals('E-Book', $result->category);
    }

    const html = '<!DOCTYPE html>
<html lang="en"><head></head><body>
<section class="container-fluid main">
<table class="table table-sm table-striped">
    <thead>
        <tr class="bg-danger">
            <th class="text-white">Name</th>
            <th class="text-white">Size</th>
            <th class="text-white">Added</th>
            <th class="text-white">Provider</th>
        </tr>
    </thead>
    <tr>
        <td class=n>
            <div style=float:left><i class="fa fa-gamepad fa-fw" style=color:green></i>&nbsp;<a href="http://tih4o1p.t0r.download/torrent/2334850/test.7z2.html"><b>Test</b> - Full Version</a></div>
            <div style=float:right><i class="fa fa-check" style=color:green data-toggle="tooltip" title="Torrent Verified"></i></div>
        </td>
        <td class=s><a href="http://tih1o7p.t0r.download/torrent/2573465/test.3z7.html">883.8 MB</a></td>
        <td class=t><a href="http://tih3o3p.t0r.download/torrent/1184799/test.6z5.html">Today</a></td>
        <td class=t><a href="http://tih7o8p.t0r.download/torrent/1255954/test.1z8.html">ETRG</a></td>
    </tr>
    <tr>
        <td class=n>
            <div style=float:left><i class="fa fa-gamepad fa-fw" style=color:green></i>&nbsp;<a href="http://cwve44i.t0r.download/torrent/3732346/test.2y2.html"><b>Test</b> - High-Definition</a></div>
            <div style=float:right><i class="fa fa-check" style=color:green data-toggle="tooltip" title="Torrent Verified"></i></div>
        </td>
        <td class=s><a href="http://cwve31i.t0r.download/torrent/3533884/test.8y8.html">344.7 MB</a></td>
        <td class=t><a href="http://cwve58i.t0r.download/torrent/3870155/test.8y4.html">Today</a></td>
        <td class=t><a href="http://cwve97i.t0r.download/torrent/4587011/test.3y9.html">Uploaded.to</a></td>
    </tr>
    <tr>
        <td class=n>
            <div style=float:left><i class="fa fa-gamepad fa-fw" style=color:green></i>&nbsp;<a href="http://t7ihop.t0r.download/torrent/4145262/test.5z5.html">Complete Game <b>TEST</b></a></div>
            <div style=float:right><i class="fa fa-check" style=color:green data-toggle="tooltip" title="Torrent Verified"></i></div>
        </td>
        <td class=s><a href="http://t6ihop.t0r.download/torrent/4434437/test.1z2.html">703.4 MB</a></td>
        <td class=t><a href="http://t1ihop.t0r.download/torrent/2883633/test.2z4.html">Yesterday</a></td>
        <td class=t><a href="http://t5ihop.t0r.download/torrent/2042281/test.6z2.html">ExtraTorrent</a></td>
    </tr>
    <tr>
        <td class=n>
            <div style=float:left><i class="fa fa-gamepad fa-fw" style=color:green></i>&nbsp;<a href="http://ti42hop5.t0r.download/torrent/2297312/test.7y3.html"><b>Test</b> - Latest Game Release</a></div>
            <div style=float:right><i class="fa fa-check" style=color:green data-toggle="tooltip" title="Torrent Verified"></i></div>
        </td>
        <td class=s><a href="http://ti63hop9.t0r.download/torrent/3570048/test.1y4.html">1.3 GB</a></td>
        <td class=t><a href="http://ti66hop3.t0r.download/torrent/3087320/test.3y6.html">Yesterday</a></td>
        <td class=t><a href="http://ti24hop9.t0r.download/torrent/3808292/test.9y7.html">ThePirateBay</a></td>
    </tr>
</table>
<table class="table table-sm table-striped">
    <thead>
        <tr class="bg-danger">
            <th class="text-white"><a href=//name/desc.html>TORRENT NAME</a></th>
            <th class="text-white"><a href=//size/desc.html>SIZE</a></th>
            <th class="text-white"><a href=//added/desc.html>AGE</a></th>
            <th class="text-white"><a href=/.html>SEEDS</a></th>
            <th class="text-white"><a href=//peers/desc.html>PEERS</a></th>
        </tr>
    </thead>
    <tr>
        <td class=n>
            <div style=float:left><i class="fa fa-gamepad fa-fw" style=color:green></i>&nbsp;<a href="/torrent-details/11598899/football-manager-test-game-update-version-1-2-3.html">Football Manager 2016 [<b>Test</b> Game] - Update Version 1 2 3</a></div>
            <div style=float:right></div>
        </td>
        <td class=s>11 MB</td>
        <td class=t>04/01/18</td>
        <td class=u>446</td>
        <td class=d>295</td>
    </tr>
    <tr class=alt>
        <td class=v>
            <div style=float:left><i class="fa fa-unlock fa-fw" style=color:pink></i>&nbsp;<a href="/torrent-details/11571354/doctoradventures-adriana-chechik-porn-preference-test-30-12-tk-1k.html">[DoctorAdventures] Adriana Chechik - Porn Preference <b>Test</b> (30 12 2017) tk (1k)</a></div>
            <div style=float:right><i class="fa fa-check" style=color:green data-toggle="tooltip" title="Torrent Verified"></i></div>
        </td>
        <td class=s>285 MB</td>
        <td class=t>30/12/17</td>
        <td class=u>341</td>
        <td class=d>40</td>
    </tr>
    <tr>
        <td class=v>
            <div style=float:left><i class="fa fa-book fa-fw" style=color:#97694F></i>&nbsp;<a href="/torrent-details/11587272/doctoradventures-adriana-chechik-porn-preference-test.html">DoctorAdventures - Adriana Chechik - Porn Preference <b>Test</b></a></div>
            <div style=float:right><i class="fa fa-check" style=color:green data-toggle="tooltip" title="Torrent Verified"></i></div>
        </td>
        <td class=s>285 MB</td>
        <td class=t>02/01/18</td>
        <td class=u>115</td>
        <td class=d>23</td>
    </tr>
</table>
</section>
</body></html>';
}
?>