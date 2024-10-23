<!DOCTYPE html>
<html>

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width,initial-scale=1.0" />
     <link rel="stylesheet" href="{{asset('CSS/activate_account.css')}}" />
     <title>Account Activation</title>
</head>

<body>
     @if (Session::has('error'))
          <div class="error" id="error">{{Session::get('error')}}</div>
     @endif

     <img class="page-image" src="{{asset('IMAGES/register.png')}}" alt="error" />
     <form method="POST" action="{{url('/register/activation/'.$email)}}">
          @csrf
          @error('code')
               <div class="error" id="error">{{$message}}</div>
          @enderror
          <div class="form-2">
               <h1 class="form-title">We Sent Verification Code To Your Email</h1>
               <div class="input-title">Verification Code</div>
               <input type="number" name="code" />
               <button id="checkBtn" type="submit">Check</button>
          </div>
     </form>

     <script src="{{asset('JS/error_message.js')}}"></script>
</body>

</html>