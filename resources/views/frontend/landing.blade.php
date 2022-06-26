@extends('frontend.frontend_master')

@section('content')


    <div class="b-example-divider"></div>
    <div class="container col-xxl-8 px-4 py-5">

          <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-lg-12" style="margin-top: 0px;">
                <center>
                    <h1 class="display-3 fw-bold lh-1 mb-3">Laravel Developer</h1> 
                    <h3 style="font-size:25px;position:relative;bottom:10px">(+ API + Blockchain)</h3>  
                </center>      
            </div>
            <div class="col-lg-4">
                <center>
                    <img src="/images/myface2.png" class="d-block mx-lg-auto img-fluid" style="max-width:200px;width:100%;border-radius: 10px" alt="Bootstrap Themes"  loading="lazy">
                    <br>
                    <i style="font-size:23px">
                        "Close enough is not<br> good enough"
                    </i> - Mark
                </center>
            </div>
            <div class="col-lg-8">
                <table style="width:100%;margin-bottom:5px">
                    <tr class="topalign">
                        <th><h4>Best at:</h4></th>
                        <th><h4>Dabble in:</h4></th>
                        <th><h4>Enjoy creating:</h4></th>
                    </tr>
                    <tr>
                        <td>
                            <i class="fa-solid fa-angles-right" style="color:#c6c0c0"></i> Laravel 9<br>
                            <i class="fa-solid fa-angles-right" style="color:#c6c0c0"></i> CSS / Bootstrap 5<br>
                            <i class="fa-solid fa-angles-right" style="color:#c6c0c0"></i> Javascript & JQuery<br>
                            <i class="fa-solid fa-angles-right" style="color:#c6c0c0"></i> MySQL<br>
                            <i class="fa-solid fa-angles-right" style="color:#c6c0c0"></i> Ethers.JS (Ethereum)<br>
                            <i class="fa-solid fa-angles-right" style="color:#c6c0c0"></i> Plutus (Cardano)
                        </td>
                        <td>
                            <i class="fa-solid fa-angles-right" style="color:#c6c0c0"></i> Node.JS<br>
                            <i class="fa-solid fa-angles-right" style="color:#c6c0c0"></i> React
                        </td>
                        <td>
                            <i class="fa-solid fa-angles-right" style="color:#c6c0c0"></i> API create (REST)<br>
                            <i class="fa-solid fa-angles-right" style="color:#c6c0c0"></i> API consume (REST & GraphQL)<br>
                            <i class="fa-solid fa-angles-right" style="color:#c6c0c0"></i> SAAS<br>
                            <i class="fa-solid fa-angles-right" style="color:#c6c0c0"></i> Payments, billing, invoicing.<br>
                            <i class="fa-solid fa-angles-right" style="color:#c6c0c0"></i> Blockchain integrations<br>
                            <i class="fa-solid fa-angles-right" style="color:#c6c0c0"></i> Email and SMS automation
                        </td>
                    </tr>

                </table>

                <p class="lead">
                    <i style="font-size:16px">
                        My sites have <strong>120,000 clicks</strong>, I scraped and imported <strong>25,000 NFTs</strong> for fun, made and sold an <strong>18,000</strong> page business directory, and accumulated 100's of users in various ventures.
                    </i>
                    <center>
                        <h4 style="padding-top:15px">
                            <i class="fa-solid fa-hand-point-down" style="color:green"></i>
                            <i class="fa-solid fa-hand-point-down" style="color:green"></i>
                            @if($tag)
                                <strong>{{$projects->count()}} <u>Live</u></strong> {{ucwords($tag)}} Sample{{$projects->count() == 1 ? '' : 's'}} below
                            @else 
                                <strong>{{$projects->count()}} <u>Live</u></strong> Project Samples below
                            @endif
                            <i class="fa-solid fa-hand-point-down" style="color:green"></i>
                            <i class="fa-solid fa-hand-point-down" style="color:green"></i>
                        </h4>
                    </center>
                </p>
            </div>
        </div>

        <div class="album py-2 bg-light" id="examples">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach($projects as $project)
                        <div class="col">
                            <div class="card shadow-sm" style="height:100%">
                                @if($project->external == 1)
                                    <a href="{{$project->external_url}}" target="_blank">
                                        <img width="100%" src="/images/{{$project->image}}" role="img" aria-label="Thumbnail" focusable="false">
                                    </a>
                                @else 
                                    <img width="100%" src="/images/{{$project->image}}" role="img" aria-label="Thumbnail" focusable="false">
                                @endif
                                
                                <div class="card-body">
                                    @php 
                                        $tags = explode(',',$project->category);
                                    @endphp
                                    @foreach($tags as $t)                                  
                                        <span class="badge rounded-pill bg-primary">
                                            <a href="/{{strtolower(str_replace(' ','-',$t))}}" style="color:white">
                                                {{ ucwords($t)}}
                                            </a>
                                        </span> 
                                    @endforeach
                                    <h4 style='margin-top:8px'>{{ ucwords($project->name)}}</h4>
                                    <p class="card-text">
                                        {{ ucfirst($project->description) }}
                                    </p>
                                    
                                </div>
                                <div class="card-footer bg-transparent border-success">
                                    @if($project->external == 1)
                                        <a href="{{$project->external_url}}" class="btn btn-primary" style="width:100%" target="_blank">Open in new tab</a>
                                    @else 
                                        @auth 
                                            <a href="/user/projects/{{ strtolower(str_replace(' ','-',$project->name))}}" class="btn btn-primary" style="width:100%">Open in Dashboard</a>
                                        @endauth 
                                        @guest 
                                        <button type="button" onclick="location.href='/remember-project/{{ strtolower(str_replace(' ','-',$project->name))}}/google';" class="btn btn-primary" style="background-color:#4285F4;width:49%"><i class="fa-brands fa-google"></i> Google</button>
                                        <button type="button" onclick="location.href='/remember-project/{{ strtolower(str_replace(' ','-',$project->name))}}/linkedin';" class="btn btn-primary" style="background-color:#0a66c2;padding-top: 3px;padding-bottom: 4px;width:49%"><span style="font-size:20px"><i class="fa-brands fa-linkedin"></i></span> Linkedin</button>
                                        @endguest
                                    @endif
                                </div>
                                @auth
                                    @if(Auth()->user()->isAdmin()) 
                                    <div class="card-footer bg-transparent border-success">
                                        <a href="/admin/project-position/up/{{$project->id}}" class="btn btn-primary" style="width:49%">UP</a>
                                        @if($loop->remaining > 0)
                                            <a href="/admin/project-position/down/{{$project->id}}" class="btn btn-info" style="width:49%">DOWN</a>
                                        @endif
                                    </div>
                                    @endif 
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
 
                @if($tag != null)
                    <center>
                        <br>
                        <a href="/" class="btn btn-success">
                            <i class="fa-solid fa-rotate-left"></i> Back to all results
                        </a>
                    </center>
                @endif
            </div>
        </div>
    </div>


@endsection


