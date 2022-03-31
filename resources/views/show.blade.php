


 @extends('layout.app')
 @section('content')
         <!-- Masthead-->
         <header class="masthead font-roboto">
            
             <div class="container position-relative">
           
                {{-- Top profile bar  --}}
                <div class="row">
                    <div class="col-sm-3">
                        <img src="{{$overviews[0]['iconLinks']['profileIconId']}}" class="img-thumbnail rounded main-icon mx-auto d-block" alt="Summoner icon">
                    </div>
                    <div class="col-sm-3 ">

                        <div class="row ">
                            <div class="text-white font-size-1em">
                                <b>{{  $summoner_info['name'];}}</b>
                                <br> Ladder Rank 92,278
                            </div>
                            
                        </div>
                        <br>
                        <br>
                        <div class="row d-flex flex-row">
                            <div>
                                <button class="btn btn-primary btn-sm">Update</button>
                                <button class="btn btn-secondary btn-sm">Tier Graph</button>
                            </div>
                            
                        </div>
                    </div>
                </div>

                {{-- divider --}}
                <hr class="solid">

                 <div class="row">

                     
                         <div class="text-white col-sm-3">
                             <div class="row border">
                                <div class="col-sm-4">
                                    <img class="soloq-rank-icon" src="https://opgg-static.akamaized.net/images/medals/gold_4.png?image=q_auto&amp;image=q_auto,f_webp,w_auto&amp;v=1648729914784" alt="GOLD">
                                </div>

                                <div class="col-sm-8">
                                    <div>
                                        Ranked Solo
                                    </div>
                                    <div>
                                        {{$summoner_info['league_entries'][0]['tier'].' '.$summoner_info['league_entries'][0]['rank'];}}
                                    </div>
                                    <div>
                                        {{$summoner_info['league_entries'][0]['leaguePoints']}} LP / {{$summoner_info['league_entries'][0]['wins']}}W {{$summoner_info['league_entries'][0]['losses']}}L
                                    </div>
                                    <div>
                                        Win Rate {{round($summoner_info['league_entries'][0]['soloq_winrate'])}}%
                                    </div>
                                    <div>
                                        Penisy Barmistrzyka
                                    </div>
                                </div>
                             </div>

                             <div class="row border">
                                <div class="col-sm-4">
                                    <img class="soloq-rank-icon" src="https://opgg-static.akamaized.net/images/medals/gold_4.png?image=q_auto&amp;image=q_auto,f_webp,w_auto&amp;v=1648729914784" alt="GOLD">
                                </div>

                                <div class="col-sm-8">
                                    <div>
                                        Ranked Flex
                                    </div>
                                    <div>
                                        {{$summoner_info['league_entries'][1]['tier'].' '.$summoner_info['league_entries'][1]['rank'];}}
                                    </div>
                                    <div>
                                        {{$summoner_info['league_entries'][1]['leaguePoints']}} LP / {{$summoner_info['league_entries'][1]['wins']}}W {{$summoner_info['league_entries'][1]['losses']}}L
                                    </div>
                                    <div>
                                        Win Rate {{round($summoner_info['league_entries'][1]['flexq_winrate'])}}%
                                    </div>
                                    <div>
                                        Penisy Barmistrzyka
                                    </div>
                                </div>
                            </div>

                            <div class="row border">
                                 played champs
                            </div>

                            <div class="row border">
                                 winrate past 7 days
                            </div>

                            <div class="row border">
                                 duoq'ss
                            </div>
                         </div>

                         
                         <div class="text-black col-sm-9">
                            {{-- single match overview --}}
                            @foreach ($overviews as $overview)
                           <div class="row border text-center {{ strtolower($overview['outcome']) }}" >
                               <div class="col-md-1 my-auto font-size-06em">

                                   <p>{{$overview['queueType']}}</p>

                                   <p>{{gmdate('d/m/Y',$overview['timestamp'])}}</p>
                                   <hr>
                                   <p><b>{{$overview['outcome']}}</b></p>
                                   <p>{{gmdate('i:s',$overview['game_length'])}}</p>


                               </div>
                               <div class="col-md-2 my-auto ">

                                   <div class="row">

                                       <div class="col-md-6 ">
                                           <div>
                                               <img class="rounded-circle champ-played" src="{{$overview['iconLinks']['championPlayedIcon']}}" alt="">
                                           </div>
                                       </div>

                                       <div class="col-md-6">

                                           <div class="row">
                                               <div class="col-md-6">
                                                   <div>
                                                       <img class="rounded summoner-spell" src="{{$overview['iconLinks']['summonerSpell1']}}" alt="">
                                                   </div>
                                               </div>

                                               <div class="col-md-6">
                                                   <div>
                                                       <img class="rounded rune" src="https://opgg-static.akamaized.net/images/lol/perk/8010.png?image=q_auto,f_webp,w_auto&v=1648102888115" alt="">
                                                   </div>
                                               </div>
                                           </div>

                                           <div class="row">
                                               <div class="col-md-6">
                                                   <div>
                                                       <img class="rounded summoner-spell" src="{{$overview['iconLinks']['summonerSpell2']}}" alt="">

                                                   </div>
                                               </div>

                                               <div class="col-md-6">
                                                   <div>
                                                       <img class="rounded rune" src="https://opgg-static.akamaized.net/images/lol/perkStyle/8300.png?image=q_auto,f_webp,w_auto&v=1648102888115" alt="">
                                                   </div>
                                               </div>
                                           </div>

                                       </div>
                                   </div>

                               </div>
                               <div class="col-md-1 my-auto">
                                   <div class="font-size-07em">
                                       <p>{{$overview['kills']}}/{{$overview['deaths']}}/{{$overview['assists']}}</p>

                                   </div>
                                   <div class="font-size-05em">
                                       <p>{{$overview['kda']}} KDA</p>
                                       
                                   </div>
                               </div>
                               <div class="col-md-2 my-auto font-size-06em">
                                   <p>LEVEL {{$overview['champLevel']}}</p>
                                   <p>{{$overview['cs']}} CS</p>
                                   <p>{{$overview['killParticipation']}}% KP</p>
                                   <p> average tier</p>
                               </div>
                               <div class="col-md-2 my-auto font-size-06em">
                                   <div class="row">
                                       <div class="col-md-3">
                                           <div>
                                               <img class="rounded summoner-spell" src="{{$overview['iconLinks']['item0']}}" alt="">
                                           </div>
                                       </div>

                                       <div class="col-md-3">
                                           <div>
                                               <img class="rounded summoner-spell" src="{{$overview['iconLinks']['item1']}}" alt="">
                                           </div>
                                       </div>

                                       <div class="col-md-3">
                                           <div>
                                               <img class="rounded summoner-spell" src="{{$overview['iconLinks']['item2']}}" alt="">
                                           </div>
                                       </div>

                                       <div class="col-md-3">
                                           <div>
                                               <img class="rounded summoner-spell" src="{{$overview['iconLinks']['item6']}}" alt="">
                                           </div>
                                       </div>

                                       
                                   </div>

                                   <div class="row">
                                       <div class="col-md-3">
                                           <div>
                                               <img class="rounded summoner-spell" src="{{$overview['iconLinks']['item4']}}" alt="">
                                           </div>
                                       </div>

                                       <div class="col-md-3">
                                           <div>
                                               <img class="rounded summoner-spell" src="{{$overview['iconLinks']['item3']}}" alt="">
                                           </div>
                                       </div>

                                       <div class="col-md-3">
                                           <div>
                                               <img class="rounded summoner-spell" src="{{$overview['iconLinks']['item5']}}" alt="">
                                           </div>
                                       </div>

                                       <div class="col-md-3">
                                           <div>
                                               <img class="rounded summoner-spell" src="https://s-lol-web.op.gg/static/images/icon/common/icon-buildred-p.png?v=1648630753917" alt="">
                                           </div>
                                       </div>

                                       
                                   </div>
                                   <div>
                                       <p>Control wards placed: {{$overview['controlWardsPlaced']}}</p>
                                   </div>
                               </div>
                               <div class="col-md-2 my-auto font-size-06em">

                                   <div class="row">
                                       <div class="col-md-3">
                                           <img class="participant"src="{{$overview['iconLinks']['blueTop']}}" alt="">
                                       </div>
                                       <div class="col-md-8">
                                           {{$overview['playerInfo'][0]['summonerName']}}
                                       </div>
                                   </div>

                                   <div class="row">
                                       <div class="col-md-3">
                                           <img class="participant"src="{{$overview['iconLinks']['blueJungle']}}" alt="">
                                       </div>
                                       <div class="col-md-8">
                                           {{$overview['playerInfo'][1]['summonerName']}}
                                       </div>
                                   </div>

                                   <div class="row">
                                       <div class="col-md-3">
                                           <img class="participant"src="{{$overview['iconLinks']['blueMid']}}" alt="">
                                       </div>
                                       <div class="col-md-8">
                                           {{$overview['playerInfo'][2]['summonerName']}}
                                       </div>
                                   </div>

                                   <div class="row">
                                       <div class="col-md-3">
                                           <img class="participant"src="{{$overview['iconLinks']['blueAdc']}}" alt="">
                                       </div>
                                       <div class="col-md-8">
                                           {{$overview['playerInfo'][3]['summonerName']}}
                                       </div>
                                   </div>

                                   <div class="row">
                                       <div class="col-md-3">
                                           <img class="participant"src="{{$overview['iconLinks']['blueSupport']}}" alt="">
                                       </div>
                                       <div class="col-md-8">
                                           {{$overview['playerInfo'][4]['summonerName']}}
                                       </div>
                                   </div>
                               </div>
                               <div class="col-md-2 my-auto font-size-06em">

                                   <div class="row">
                                       <div class="col-md-3">
                                           <img class="participant"src="{{$overview['iconLinks']['redTop']}}" alt="">
                                       </div>
                                       <div class="col-md-8">
                                           {{$overview['playerInfo'][5]['summonerName']}}
                                       </div>
                                   </div>

                                   <div class="row">
                                       <div class="col-md-3">
                                           <img class="participant"src="{{$overview['iconLinks']['redJungle']}}" alt="">
                                       </div>
                                       <div class="col-md-8">
                                           {{$overview['playerInfo'][6]['summonerName']}}
                                       </div>
                                   </div>

                                   <div class="row">
                                       <div class="col-md-3">
                                           <img class="participant"src="{{$overview['iconLinks']['redMid']}}" alt="">
                                       </div>
                                       <div class="col-md-8">
                                           {{$overview['playerInfo'][7]['summonerName']}}
                                       </div>
                                   </div>

                                   <div class="row">
                                       <div class="col-md-3">
                                           <img class="participant"src="{{$overview['iconLinks']['redAdc']}}" alt="">
                                       </div>
                                       <div class="col-md-8">
                                           {{$overview['playerInfo'][8]['summonerName']}}
                                       </div>
                                   </div>

                                   <div class="row">
                                       <div class="col-md-3">
                                           <img class="participant"src="{{$overview['iconLinks']['redSupport']}}" alt="">
                                       </div>
                                       <div class="col-md-8">
                                           {{$overview['playerInfo'][9]['summonerName']}}
                                       </div>
                                   </div>
                               </div>
                           </div>
                           @endforeach
                        </div>
                        
                     
                 </div>
             </div>
         </header>
        
 @endsection