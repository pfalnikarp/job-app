@extends('layouts.app')

<style type="text/css">
.multiselect {
    width:20em;
    height:15em;
    border:solid 1px #c0c0c0;
    overflow:auto;
}
 
.multiselect label {
    display:block;
}
 
.multiselect-on {
    color:#ffffff;
    background-color:#000099;
}

label>span {
    padding-left: 10px;
}

</style>
   

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <center>

                <button id="btn-nft-enable" onclick="initFirebaseMessagingRegistration()" class="btn btn-danger btn-xs btn-flat">Allow for Notification</button>

            </center>

            <div class="card">

                <div class="card-header">{{ __('Dashboard') }}</div>

  

                <div class="card-body">

                    @if (session('status'))

                        <div class="alert alert-success" role="alert">

                            {{ session('status') }}

                        </div>

                    @endif

  

                    <form action="{{ route('send.notification') }}" method="POST">

                        @csrf

                        <div class="form-group">

                            <label>Title</label>

                            <input type="text" class="form-control" name="title">

                        </div>

                        <div class="form-group">

                            <label>Body</label>

                            <textarea class="form-control" name="body"></textarea>

                          </div>

                           <div class="form-group">

                            <label>To User[Optional]</label>

                            <div class="multiselect">
                                @foreach($user as $u)
                                <label>
                                <input type="checkbox" name="touser[]"
                                 value="{{ $u->id }}"><span>{{ $u->name}}</span>
                                 </label>

                                 @endforeach


                            </div>

                            

                          </div>  

                        <button type="submit" class="btn btn-primary">Send Notification</button>

                    </form>

  

                </div>

            </div>

        </div>

    </div>

</div>

  

<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>

<script>

  

    var firebaseConfig = {

      apiKey: "AIzaSyA17o9xFX4VwrVkt4A6Vl87990fi4oxUaM",
      authDomain: "omsv4-5c2e3.firebaseapp.com",
      projectId: "omsv4-5c2e3",
      storageBucket: "omsv4-5c2e3.appspot.com",
      messagingSenderId: "602099601177",
      appId: "1:602099601177:web:79c8a4d0cd90ab6d687f88",
      measurementId: "G-9V804BYYHZ"




    };

      

    firebase.initializeApp(firebaseConfig);

    const messaging = firebase.messaging();

  

    function initFirebaseMessagingRegistration() {

            messaging

            .requestPermission()

            .then(function () {

                return messaging.getToken()

            })

            .then(function(token) {

                console.log(token);

   

                $.ajaxSetup({

                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    }

                });

  

                $.ajax({

                    url: '{{ route("save-token") }}',

                    type: 'POST',

                    data: {

                        token: token

                    },

                    dataType: 'JSON',

                    success: function (response) {

                        alert('Token saved successfully.');

                    },

                    error: function (err) {

                        console.log('User Chat Token Error'+ err);

                    },

                });

  

            }).catch(function (err) {

                console.log('User Chat Token Error'+ err);

            });

     }  

      

    messaging.onMessage(function(payload) {

        const noteTitle = payload.notification.title;

        const noteOptions = {

            body: payload.notification.body,

            icon: payload.notification.icon,

        };

        new Notification(noteTitle, noteOptions);

    });

   

</script>

@endsection
