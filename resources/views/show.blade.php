


 @extends('layout.app')
 @section('content')
         <!-- Masthead-->
         <header class="masthead font-roboto">
            
             <div class="container position-relative">
           
                {{-- Top profile bar  --}}
                <div class="row">
                    <div class="col-sm-3">
                        <img src="{{$icon_link['profileIconId']}}" class="img-thumbnail rounded main-icon mx-auto d-block" alt="Summoner icon">
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
                            champion info Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, obcaecati necessitatibus. Neque beatae alias necessitatibus accusantium, mollitia ipsa voluptatum ad ut, a natus sint dignissimos dolore eius nostrum, maiores facilis?
                         </div>
                         @foreach ($overviews as $overview)
                             {{$overview['cs']}}
                         @endforeach
                         <div class="text-white col-sm-9">
                             {{-- single match overview --}}
                            <div class="row border text-center " >
                                <div class="col-md-1 my-auto font-size-06em">

                                    <p>{{$overview['queueType']}}</p>
                                    <p>{{$overview['timestamp']}}</p>
                                    <p>{{$overview['outcome']}}</p>
                                    <p>{{$overview['game_length']}}</p>

                                </div>
                                <div class="col-md-2 my-auto ">

                                    <div class="row">

                                        <div class="col-md-6 ">
                                            <div>
                                                <img class="rounded-circle champ-played" src="{{$icon_link['championPlayedIcon']}}" alt="">
                                            </div>
                                        </div>

                                        <div class="col-md-6">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div>
                                                        <img class="rounded summoner-spell" src="{{$icon_link['summonerSpell1']}}" alt="">
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
                                                        <img class="rounded summoner-spell" src="{{$icon_link['summonerSpell2']}}" alt="">

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
                                                <img class="rounded summoner-spell" src="{{$icon_link['item0']}}" alt="">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div>
                                                <img class="rounded summoner-spell" src="{{$icon_link['item1']}}" alt="">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div>
                                                <img class="rounded summoner-spell" src="{{$icon_link['item2']}}" alt="">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div>
                                                <img class="rounded summoner-spell" src="{{$icon_link['item6']}}" alt="">
                                            </div>
                                        </div>

                                        
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div>
                                                <img class="rounded summoner-spell" src="{{$icon_link['item4']}}" alt="">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div>
                                                <img class="rounded summoner-spell" src="{{$icon_link['item3']}}" alt="">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div>
                                                <img class="rounded summoner-spell" src="{{$icon_link['item5']}}" alt="">
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
                                            <img class="participant"src="{{$icon_link['blueTop']}}" alt="">
                                        </div>
                                        <div class="col-md-8">
                                            {{$overview['playerInfo'][0]['summonerName']}}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <img class="participant"src="{{$icon_link['blueJungle']}}" alt="">
                                        </div>
                                        <div class="col-md-8">
                                            {{$overview['playerInfo'][1]['summonerName']}}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <img class="participant"src="{{$icon_link['blueMid']}}" alt="">
                                        </div>
                                        <div class="col-md-8">
                                            {{$overview['playerInfo'][2]['summonerName']}}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <img class="participant"src="{{$icon_link['blueAdc']}}" alt="">
                                        </div>
                                        <div class="col-md-8">
                                            {{$overview['playerInfo'][3]['summonerName']}}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <img class="participant"src="{{$icon_link['blueSupport']}}" alt="">
                                        </div>
                                        <div class="col-md-8">
                                            {{$overview['playerInfo'][4]['summonerName']}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 my-auto font-size-06em">

                                    <div class="row">
                                        <div class="col-md-3">
                                            <img class="participant"src="{{$icon_link['redTop']}}" alt="">
                                        </div>
                                        <div class="col-md-8">
                                            {{$overview['playerInfo'][5]['summonerName']}}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <img class="participant"src="{{$icon_link['redJungle']}}" alt="">
                                        </div>
                                        <div class="col-md-8">
                                            {{$overview['playerInfo'][6]['summonerName']}}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <img class="participant"src="{{$icon_link['redMid']}}" alt="">
                                        </div>
                                        <div class="col-md-8">
                                            {{$overview['playerInfo'][7]['summonerName']}}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <img class="participant"src="{{$icon_link['redAdc']}}" alt="">
                                        </div>
                                        <div class="col-md-8">
                                            {{$overview['playerInfo'][8]['summonerName']}}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <img class="participant"src="{{$icon_link['redSupport']}}" alt="">
                                        </div>
                                        <div class="col-md-8">
                                            {{$overview['playerInfo'][9]['summonerName']}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                         </div>
                     
                 </div>
             </div>
         </header>
        
 @endsection