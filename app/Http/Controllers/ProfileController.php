<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use \Datetime;


class ProfileController extends Controller
{
    
    private function get_api_key()
    {
        return 'RGAPI-cf5478f2-e28e-4328-804b-50dcbd4dc554';
    }

    private function get_summoner_info($server,$summoner)
    {
        //taking data from riot API
       return json_decode(Http::get("https://".$server.".api.riotgames.com/lol/summoner/v4/summoners/by-name/{$summoner}?api_key=".$this->get_api_key()), true);
    }

    private function get_match_list($server,$summoner_info,$count)
    {
        if($server === 'eun1' || $server === 'euw1') $global_server='europe';
        return json_decode(Http::get("https://{$global_server}.api.riotgames.com/lol/match/v5/matches/by-puuid/{$summoner_info['puuid']}/ids?type=ranked&start=0&count={$count}&api_key=".$this->get_api_key()), true);
    }
    private function get_latest_ddragon_icon_api_version()
    {
        return json_decode(Http::get('https://ddragon.leagueoflegends.com/api/versions.json'), true)['0'];
    }

    private function get_icon_link($summoner_info,$overview,$latestVersion)
    {

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
            '14'=> 'SummonerDot'
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
    private function get_match_overview($match,$summonerInfo,$latestVersion)
    {
        $global_server = 'europe';
        $match_info = json_decode(Http::get("https://{$global_server}.api.riotgames.com/lol/match/v5/matches/{$match}?api_key=".$this->get_api_key()),true);
        
        date_default_timezone_set('Europe/Warsaw');
        $timestamp = $match_info['info']['gameEndTimestamp'];

        $overview = [
            'queueType'=>$match_info['info']['gameMode'],
            'timestamp'=>$timestamp,
            'game_length'=>$match_info['info']['gameDuration'],

        ];
        
        //all participants foreach
        $playerId = 0;
        foreach($match_info['info']['participants'] as $participant)
        {  
            //desired player foreach
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
        $overview['iconLinks'] = $this->get_icon_link($summonerInfo,$overview,$latestVersion);
        
        
        return $overview;
    }

    private function getLeagueEntries($summoner_info)
    {
        
        return json_decode(Http::get("https://eun1.api.riotgames.com/lol/league/v4/entries/by-summoner/{$summoner_info['id']}?api_key={$this->get_api_key()}"), true);
    }


    public function show($server,$summoner)
    {
        $latestVersion = $this->get_latest_ddragon_icon_api_version();
        $summoner_info = $this->get_summoner_info($server,$summoner);
        $league_entries = $this->getLeagueEntries($summoner_info);
        $matchList = $this->get_match_list($server,$summoner_info,4);

        
        
        $overviews = array();
        foreach($matchList as $match)
        {
            $overviews[] = $this->get_match_overview($match,$summoner_info,$latestVersion);
        }
        $summoner_info['league_entries'] = $league_entries;
        
        $summoner_info['league_entries'][0]['soloq_winrate'] = ($summoner_info['league_entries'][0]['wins'] / ($summoner_info['league_entries'][0]['wins'] + $summoner_info['league_entries'][0]['losses']) )*100;
        if(isset($summoner_info['league_entries'][1]))
        {
        $summoner_info['league_entries'][1]['flexq_winrate'] = ($summoner_info['league_entries'][1]['wins'] / ($summoner_info['league_entries'][1]['wins'] + $summoner_info['league_entries'][1]['losses']) )*100;

        }
        else
        {
            $summoner_info['league_entries'][1]['flexq_winrate'] = 0;
            $summoner_info['league_entries'][1]['rank'] = 'Unranked';
            $summoner_info['league_entries'][1]['leaguePoints'] = 0;
            $summoner_info['league_entries'][1]['wins'] = 0;
            $summoner_info['league_entries'][1]['losses'] = 0;
            $summoner_info['league_entries'][1]['tier'] = 'Unranked';
        }
        

        return view("show",compact('summoner_info','overviews'));

    }
}
