


 @extends('layout.app')
 @section('content')
         <!-- Masthead-->
         <header class="masthead font-roboto">
            
             <div class="container-fluid position-relative">
           
                {{-- Top profile bar  --}}
                <div class="row">

                    <div class="col-sm-3 d-flex justify-content-end">
                        <img src="{{$overviews[0]['iconLinks']['profileIconId']}}" class="img-thumbnail rounded main-icon  " alt="Summoner icon">
                    </div>

                    <div class="col-sm-3 align-items-end d-flex">

                        <div class="text-black ">
                            <div class="font-size-2em">
                                {{  $summoner_info['name'];}}
                            </div>
                            Rank <i>92,278 </i>
 
                        </div> 

                    </div>

                </div>

                {{-- divider --}}
                <hr class="solid">

                 <div class="row d-flex justify-content-center">

                     
                         <div class="text-black col-sm-3 ">

                             <div class="row border border-right-0 border-dark align-items-center bg-normal p-1">

                                <div class="col-sm-4">
                                    <img class="soloq-rank-icon mx-auto d-block" src="{{ asset("assets/emblems/Emblem_{$summoner_info['league_entries'][0]['tier']}.png") }}" alt="GOLD">
                                </div>

                                <div class="col-sm-6 justify-content-center">
                                    <div class="font-size-08em">
                                        Ranked Solo
                                    </div>
                                    <div class="font-size-11em">
                                        {{$summoner_info['league_entries'][0]['tier'].' '.$summoner_info['league_entries'][0]['rank'];}}
                                    </div>
                                    <div class="font-size-08em">
                                        {{$summoner_info['league_entries'][0]['leaguePoints']}} LP / {{$summoner_info['league_entries'][0]['wins']}}W {{$summoner_info['league_entries'][0]['losses']}}L
                                    </div>
                                    <div class="font-size-08em">
                                        Win Rate {{round($summoner_info['league_entries'][0]['winrate'])}}%
                                    </div>
                                    <div class="font-size-08em">
                                        Pasterze Barmistrzyka
                                    </div>
                                </div>
                             </div>

                             

                             <div class="row border border-top-0 border-left-0 border-dark align-items-center p-2 bg-normal ">
                                <div class="col-sm-4 ">
                                    <img class="flexq-rank-icon mx-auto d-block" src="{{ asset("assets/emblems/Emblem_{$summoner_info['league_entries'][1]['tier']}.png") }}" alt="GOLD">
                                </div>

                                <div class="col-sm-8">
                                    <div class="font-size-06em">
                                        Ranked Flex
                                    </div>
                                    <div class="font-size-08em">
                                        {{$summoner_info['league_entries'][1]['tier'].' '.$summoner_info['league_entries'][1]['rank'];}}
                                    </div>
                                    <div class="font-size-06em">
                                        {{$summoner_info['league_entries'][1]['leaguePoints']}} LP / {{$summoner_info['league_entries'][1]['wins']}}W {{$summoner_info['league_entries'][1]['losses']}}L
                                    </div>
                                    <div class="font-size-06em">
                                        Win Rate {{round($summoner_info['league_entries'][1]['winrate'])}}%
                                    </div>
                                    <div class="font-size-06em">
                                        Pasterze Barmistrzyka
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row border border-top-0 border-left-0 border-dark align-items-center p-2 bg-normal">
                                <div id="basicTabs"></div>

                            </div>
                            

                            {{-- <div class="row border border-dark">
                                 played champs
                            </div>

                            <div class="row border border-dark">
                                 winrate past 7 days
                            </div>

                            <div class="row border">
                                 duoq'ss
                            </div> --}}
                         </div>

                         
                         <div class="text-black col-sm-8 mx-2 ">
                            {{-- single match overview --}}
                            @foreach ($overviews as $overview)
                           <div class="row border border-bottom-0 border-dark text-center p-2 align-items-center {{ strtolower($overview['outcome']) }} " >
                               <div class="col-md-1 my-auto font-size-06em">

                                   {{$overview['queueType']}}

                                   {{gmdate('d/m/Y',$overview['timestamp'])}}
                                   <hr>
                                   <b>{{$overview['outcome']}}</b>
                                   {{gmdate('i:s',$overview['game_length'])}}


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
                                               <div class="col-md-4">
                                                   <div>
                                                       <img class="rounded summoner-spell" src="{{$overview['iconLinks']['summonerSpell1']}}" alt="">
                                                   </div>
                                               </div>

                                               <div class="col-md-4">
                                                   <div>
                                                       <img class="rounded rune" src="https://opgg-static.akamaized.net/images/lol/perk/8010.png?image=q_auto,f_webp,w_auto&v=1648102888115" alt="">
                                                   </div>
                                               </div>
                                           </div>

                                           <div class="row">
                                               <div class="col-md-4">
                                                   <div>
                                                       <img class="rounded summoner-spell" src="{{$overview['iconLinks']['summonerSpell2']}}" alt="">

                                                   </div>
                                               </div>

                                               <div class="col-md-4">
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
                                       {{$overview['kills']}}/{{$overview['deaths']}}/{{$overview['assists']}}

                                   </div>
                                   <div class="font-size-05em">
                                       {{$overview['kda']}} KDA
                                       
                                   </div>
                               </div>
                               <div class="col-md-2 my-auto font-size-06em">
                                   <div class="p-1">
                                    LEVEL {{$overview['champLevel']}}
                                   </div>
                                   <div class="">
                                    {{$overview['cs']}} CS 
                                   </div>
                                   <div class="">
                                    {{$overview['killParticipation']}}% KP 
                                   </div>
                                   <div class="p-1">
                                    average tier
                                   </div>
   
                               </div>
                               <div class="col-md-2 font-size-06em">
                                   <div class="row">
                                       <div class="col-md-2 ">
                                           <div>
                                               <img class="border border-secondary rounded summoner-spell" src="{{$overview['iconLinks']['item0']}}" alt="">
                                           </div>
                                       </div>

                                       <div class="col-md-2 ">
                                           <div>
                                               <img class="border border-secondary rounded summoner-spell" src="{{$overview['iconLinks']['item1']}}" alt="">
                                           </div>
                                       </div>

                                       <div class="col-md-2 ">
                                           <div>
                                               <img class="border border-secondary rounded summoner-spell" src="{{$overview['iconLinks']['item2']}}" alt="">
                                           </div>
                                       </div>

                                       <div class="col-md-2 ">
                                           <div>
                                               <img class="border border-secondary rounded summoner-spell" src="{{$overview['iconLinks']['item6']}}" alt="">
                                           </div>
                                       </div>

                                       
                                   </div>

                                   <div class="row">
                                       <div class="col-md-2">
                                           <div>
                                               <img class="rounded summoner-spell" src="{{$overview['iconLinks']['item4']}}" alt="">
                                           </div>
                                       </div>

                                       <div class="col-md-2">
                                           <div>
                                               <img class="rounded summoner-spell" src="{{$overview['iconLinks']['item3']}}" alt="">
                                           </div>
                                       </div>

                                       <div class="col-md-2">
                                           <div>
                                               <img class="rounded summoner-spell" src="{{$overview['iconLinks']['item5']}}" alt="">
                                           </div>
                                       </div>

                                       <div class="col-md-2">
                                           <div>
                                               <img class="rounded summoner-spell" src="https://s-lol-web.op.gg/static/images/icon/common/icon-buildred-p.png?v=1648630753917" alt="">
                                           </div>
                                       </div>
                                    
                                       
                                   </div>
                                  
                               </div>
                               <div class="col-md-2 my-auto font-size-06em">

                                   <div class="row  ">
                                       <div class="col-md-3">
                                           <img class="participant"src="{{$overview['iconLinks']['blueTop']}}" alt="">
                                       </div>
                                       <div class="col-md-8">
                                           {{$overview['playerInfo'][0]['summonerName']}}
                                       </div>
                                   </div>

                                   <div class="row ">
                                       <div class="col-md-3">
                                           <img class="participant"src="{{$overview['iconLinks']['blueJungle']}}" alt="">
                                       </div>
                                       <div class="col-md-8">
                                           {{$overview['playerInfo'][1]['summonerName']}}
                                       </div>
                                   </div>

                                   <div class="row ">
                                       <div class="col-md-3">
                                           <img class="participant"src="{{$overview['iconLinks']['blueMid']}}" alt="">
                                       </div>
                                       <div class="col-md-8">
                                           {{$overview['playerInfo'][2]['summonerName']}}
                                       </div>
                                   </div>

                                   <div class="row ">
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
             </div>
         </header>
        
 @endsection