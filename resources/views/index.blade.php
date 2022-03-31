@extends('layout.app')
@section('content')
        <!-- Masthead-->
        <header class="masthead">
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <div class="text-center text-white">
                            <!-- Page heading-->
                            <h1 class="mb-5">This page is using official riotgames API</h1>

                            <form action="/search" method="post">
                                @csrf
                                
                                <div class="input-group">
                                    <input type="search" name="input" class="form-control rounded" placeholder="Enter summoners name" aria-label="Search" aria-describedby="search-addon" />
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                                <div>
                                    <input type="radio" id="eune" name="server" value="eun1"
                                           checked>
                                    <label for="eune">EUNE</label>
                                 
                                    <input type="radio" id="euw" name="server" value="euw1">
                                    <label for="euw">EUW</label>

                                    <input type="radio" id="lan" name="server" value="la1">
                                    <label for="lan">LAN</label>

                                    <input type="radio" id="japan" name="server" value="jp1">
                                    <label for="japan">JP</label>

                                    <input type="radio" id="oceania" name="server" value="oc1">
                                    <label for="oceania">OCE</label>

                                    <input type="radio" id="russia" name="server" value="ru">
                                    <label for="russia">RU</label>

                                    <input type="radio" id="northamerica" name="server" value="na1">
                                    <label for="northamerica">NA</label>

                                    <input type="radio" id="brazil" name="server" value="br1">
                                    <label for="brazil">BR</label>

                                    <input type="radio" id="turkey" name="server" value="tr1">
                                    <label for="turkey">TR</label>

                                    <input type="radio" id="las" name="server" value="la2">
                                    <label for="las">LAS</label>

                                    <input type="radio" id="korea" name="server" value="KR">
                                    <label for="korea">KR</label>

                                  </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>
       
@endsection