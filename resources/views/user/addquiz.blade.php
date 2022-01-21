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
    
    

    <div class="row pt-5 p-4">
        <div class=" w-100 d-block col-md-12">
        <h2>ADD QUIZ</h2>
        </div>

        <form action="{{url('/user/useraddquiz')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3 my-2">


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="" style="font-size:20px;font-weight:bold;">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class="label" style="font-size:20px;font-weight:bold;">Picture</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="" class="label" style="font-size:20px;font-weight:bold;">Description</label>
                            <textarea name="description" class="form-control" id="" ></textarea>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="" class="label" style="font-size:20px;font-weight:bold;">Author</label>
                            <input type="text" name="author" class="form-control">
                        </div>
                    </div>

                    
                    
                    <div class="col-md-4">
                        <div class="form-group">
                        
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                    
                </div>
            </form>
        </div>
    </div>

        
</div>
    </body>
</html>