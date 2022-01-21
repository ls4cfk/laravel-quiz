<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Document</title>
<style>
h1,h2,h3,h4,h5,p{
    color:#ffffff;
}

</style>


</head>
<body>
<div class="container bg-light">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">QUIZ SYSTEM</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{url('/home')}}">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('/user/addquiz')}}">Add Quiz</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('/user/addquestion')}}">Add Question</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('/logout')}}">Logout</a>
      </li>
     
      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li> -->
    </ul>
    
  </div>
</nav>


@if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                </div>
                @endif

                @if(Session::has('error'))
                <div class="alert alert-danger" role="alert">
                {{Session::get('error')}}
                </div>
                @endif
  

    <div class="row pt-5">
        
        <div class="col-md-6 ">
               
               <form action="{{url('/user/submitquiz/')}}" method="POST" > <div class="row mb-5 pl-3" >
                   @csrf
                    <div class="col-md-8 p-0" style="background: #142B2A;">
                        <div class="d-block mt-3">
                            
                            <div class="d-block p-2 mb-2">
                                <h4 class="bg-light d-inline-block w-75 p-1 text-center" style="color:black">Quiz : {{$quiz->id}}</h4>
                            </div>
                           
                            
                        </div>
                        <div class=" w-80 p-2">
                            <h2>QUESTIONS</h2>
                            <input type="hidden" name="quizid" value="{{$quiz->id}}">
                            @foreach($question as $key=>$que)
                            <div class="d-block p-2">
                                <p class="bg-light d-inline-block text-center p-1 " style="color:black">Q{{++$key}} : {{ $que->q_name}}</hp>
                                <div class="form-group">
                                    <select name="answer[]" id="" class="form-control">
                                    <option value="1">{{$que->q_option1}}</option>
                                    <option value="2">{{$que->q_option2}}</option>
                                    <option value="3">{{$que->q_option3}}</option>
                                    <option value="4">{{$que->q_option4}}</option>
                                    </select>
                                </div>
                                
                            </div>
                            @endforeach

                            <div class="p-2">
                               <button type="submit" class="btn btn-primary">Submit Quiz</button>
                            </div>
                        </div>
                    </div>
                    
                </div></form>
                
            
        </div>


        <!-- image -->
        <div class="col-md-6 ">
               
               <a href="{{url('/user/quiz-detail/'.$quiz->id)}}" style="text-decoration:none; "> <div class="row mb-5 pl-3" >
                    <div class="col-md-12 p-0" style="">
                        <img src="{{asset('images/'.$quiz->quiz_image)}}" alt="" style="img img-fluid">
                    </div>
                    
                </div></a>
                
            
        </div>
        
    </div>

        
</div>
    </body>
</html>