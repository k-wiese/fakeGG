<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ProfileController extends Controller
{
    
    private function get_api_key()
    {
        return 'RGAPI-7a2f8eef-8ae5-45ed-991b-34b1bec63aa5';
    }

    private function get_summoner_info($server,$summoner)
    {
        //taking data from riot API
       return json_decode(Http::get("https://".$server.".api.riotgames.com/lol/summoner/v4/summoners/by-name/{$summoner}?api_key=".$this->get_api_key()), true);
    }

    private function get_match_list($server,$summoner_info)
    {
        if($server === 'eun1' || $server === 'euw1') $global_server='europe';
        return json_decode(Http::get("https://{$global_server}.api.riotgames.com/lol/match/v5/matches/by-puuid/{$summoner_info['puuid']}/ids?type=ranked&start=0&count=20&api_key=".$this->get_api_key()), true);
    }

    private function get_icon_link($summoner_info,$overview)
    {
        //index[0] means latest version
        $dd_icon_api_version = json_decode(Http::get('https://ddragon.leagueoflegends.com/api/versions.json'), true);
        $latestVersion = $dd_icon_api_version['0'];

        $profileIconId = $summoner_info['profileIconId'];
        $championPlayed = $overview['championName'];
        //3-summonerexhaust 4-summonerflash;6-summonerdot 7-summonerheal 11-summonersmite 12-summonerteleport
        $summonerSpellArray = [
            '3' => 'SummonerExhaust',
            '4' => 'SummonerFlash',
            '6' => 'SummonerDot',
            '7' => 'SummonerHeal',
            '11' => 'SummonerSmite',
            '12' => 'SummonerTeleport',
        ];
        $summonerSpell1 = $summonerSpellArray[$overview['summonerSpell1']];
        $summonerSpell2 = $summonerSpellArray[$overview['summonerSpell2']];

        $runesArray = [];

        $items = $overview['items'];

        $playerInfo = $overview["playerInfo"];

        
        return [
            'profileIconId' =>"https://ddragon.leagueoflegends.com/cdn/{$latestVersion}/img/profileicon/{$profileIconId}.png",
            'championPlayedIcon' => "http://ddragon.leagueoflegends.com/cdn/{$latestVersion}/img/champion/{$championPlayed}.png",
            'summonerSpell1'=>"http://ddragon.leagueoflegends.com/cdn/{$latestVersion}/img/spell/{$summonerSpell1}.png",
            'summonerSpell2'=>"http://ddragon.leagueoflegends.com/cdn/{$latestVersion}/img/spell/{$summonerSpell2}.png",
            'item0'=>"http://ddragon.leagueoflegends.com/cdn/{$latestVersion}/img/item/{$items['item0']}.png",
            'item1'=>"http://ddragon.leagueoflegends.com/cdn/{$latestVersion}/img/item/{$items['item1']}.png",
            'item2'=>"http://ddragon.leagueoflegends.com/cdn/{$latestVersion}/img/item/{$items['item2']}.png",
            'item3'=>"http://ddragon.leagueoflegends.com/cdn/{$latestVersion}/img/item/{$items['item3']}.png",
            'item4'=>"http://ddragon.leagueoflegends.com/cdn/{$latestVersion}/img/item/{$items['item4']}.png",
            'item5'=>"http://ddragon.leagueoflegends.com/cdn/{$latestVersion}/img/item/{$items['item5']}.png",
            'item6'=>"http://ddragon.leagueoflegends.com/cdn/{$latestVersion}/img/item/{$items['item6']}.png",
            'blueTop' =>"http://ddragon.leagueoflegends.com/cdn/{$latestVersion}/img/champion/{$playerInfo[0]["championName"]}.png",
            'blueJungle' =>"http://ddragon.leagueoflegends.com/cdn/{$latestVersion}/img/champion/{$playerInfo[1]["championName"]}.png",
            'blueMid' =>"http://ddragon.leagueoflegends.com/cdn/{$latestVersion}/img/champion/{$playerInfo[2]["championName"]}.png",
            'blueAdc' =>"http://ddragon.leagueoflegends.com/cdn/{$latestVersion}/img/champion/{$playerInfo[3]["championName"]}.png",
            'blueSupport' =>"http://ddragon.leagueoflegends.com/cdn/{$latestVersion}/img/champion/{$playerInfo[4]["championName"]}.png",
            'redTop' =>"http://ddragon.leagueoflegends.com/cdn/{$latestVersion}/img/champion/{$playerInfo[5]["championName"]}.png",
            'redJungle' =>"http://ddragon.leagueoflegends.com/cdn/{$latestVersion}/img/champion/{$playerInfo[6]["championName"]}.png",
            'redMid' =>"http://ddragon.leagueoflegends.com/cdn/{$latestVersion}/img/champion/{$playerInfo[7]["championName"]}.png",
            'redAdc' =>"http://ddragon.leagueoflegends.com/cdn/{$latestVersion}/img/champion/{$playerInfo[8]["championName"]}.png",
            'redSupport' =>"http://ddragon.leagueoflegends.com/cdn/{$latestVersion}/img/champion/{$playerInfo[9]["championName"]}.png",
           
            ];
    }

    //array of most useful info from match
    private function get_match_overview($match,$summonerInfo)
    {
        $global_server = 'europe';
        $match_info = json_decode(Http::get("https://{$global_server}.api.riotgames.com/lol/match/v5/matches/{$match}?api_key=".$this->get_api_key()),true);
        $overview = [
            'queueType'=>$match_info['info']['gameMode'],
            'timestamp'=>$match_info['info']['gameCreation'],
            'game_length'=>$match_info['info']['gameDuration'],

        ];
        

        $playerId = 0;
        foreach($match_info['info']['participants'] as $participant)
        {
            if($participant['puuid'] === ($summonerInfo['puuid']))
            {
                if($participant['win'])
                    $overview['outcome'] = 'Victory';
                        else $overview['outcome'] = 'Defeat';

                $overview['championName'] = $participant['championName'];
                $overview['summonerSpell1'] = $participant['summoner1Id'];
                $overview['summonerSpell2'] = $participant['summoner2Id'];
                $overview['kills'] = $participant['kills'];
                $overview['deaths'] = $participant['deaths'];
                $overview['assists'] = $participant['assists'];
                $overview['kda'] = round($participant['challenges']['kda'],2);
                $overview['champLevel'] = $participant['champLevel'];
                $overview['cs'] = $participant['neutralMinionsKilled'] + $participant['totalMinionsKilled'];
                $overview['killParticipation'] = round($participant['challenges']['killParticipation'],2)*100;
                $overview['champLevel'] = $participant['champLevel'];
                $overview['controlWardsPlaced'] = $participant['challenges']['controlWardsPlaced'];
                $overview['items'] = [
                    'item0' => $participant['item0'],
                    'item1' => $participant['item1'],
                    'item2' => $participant['item2'],
                    'item3' => $participant['item3'],
                    'item4' => $participant['item4'],
                    'item5' => $participant['item5'],
                    'item6' => $participant['item6']
                ];
 
            }
            $playerInfo = [
                'championName'=> $participant['championName'],
                'teamId' =>$participant['teamId'],
                'summonerName'=>$participant['summonerName']
            ];
            $overview['playerInfo']["$playerId"] = $playerInfo;
            $playerId++;
        }
        return $overview;
    }


    public function show($server,$summoner)
    {
        $summoner_info = $this->get_summoner_info($server,$summoner);

        $match_list = $this->get_match_list($server,$summoner_info);

        

        $icon_link = $this->get_icon_link($summoner_info,$overview);

        $overviews = array();
        for ($i=0;$i<5;$i++)
        {
            $overview = $this->get_match_overview($match_list["$i"],$summoner_info);
            array_push($overviews,$overview);
        }

        return view("show",compact('summoner_info','icon_link','overviews'));

    }

}
