<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel Broadcast Redis Socket io Tutorial </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
       
    </head>
    <body>
        <div class="container">
            <h1>Laravel Broadcast - Patterns  {{ auth()->user()->name }}</h1>
            
            <div id="notification"></div>
        </div>

        <template>
                 <div class="container mt-5">
                    <div class="col-12 text-center">
                  
                      <a href="#" target="_blank">Home</a>
                    </div>
                 </div>
        </template>


    </body>
  
    <script>
            window.laravel_echo_port='{{env("LARAVEL_ECHO_PORT")}}';
    </script>
    <script src="//{{ Request::getHost() }}:{{env('LARAVEL_ECHO_PORT')}}/socket.io/socket.io.js"></script>
    <script src="{{ url('/js/laravel-echo-setup.js') }}" type="text/javascript"></script>

    <script src ="{{ asset('js/bootstrap-notify.min.js') }}" type="text/javascript"></script>
      
    <script type="text/javascript">
        var i = 0;
        // window.Echo.channel('user-channel')
        //  .listen('.UserEvent', (data) => {
        //     i++;
        //     $("#notification").append('<div class="alert alert-success">'+i+'.'+data.title+'</div>');
        //     var mess1 =  data.title;
        //     // $.notify({
        //     //            icon: 'glyphicon glyphicon-star',
        //     //            message: mess1
        //     //     }); 

        //          Notification.requestPermission( permission => {
        //       let notification = new Notification('New post alert!', {
        //         body: mess1, // content for the alert
        //         icon: "http://localhost/img/invoicepng.png" // // optional image url
        //       });



        // });
        //      });
    </script>

    <script>
    window.Laravel = {!! json_encode([
        'user' => auth()->check() ? auth()->user()->id : null,
          'username' => auth()->check() ? auth()->user()->name : null,
    ]) !!};

    alert(window.Laravel.user);
</script>

    <script type="text/javascript">
        //var userId = 1;
    

    //  Echo.private('App.User.1')
    window.Echo.private('App.Models.User.' + window.Laravel.user)
    .notification((notification) => {
        console.log('hello');
        console.log(notification.detail);
    });

    // Echo.private('groups.' + window.Laravel.user)
    // .notification((notification) => {
    //     console.log('hello');
    //     console.log(notification.order_id);
    // });

    //  Echo.channel('private-users.' +  window.Laravel.user)
    //   // Echo.channel('private-groups.' + this.group.id)
    //   //  Echo.channel('groups.' + window.Laravel.user)
    // .notification((notification) => {
    //     console.log('hello');
    //     console.log(notification.order_id);
    //      var mess1 = notification.order_id + window.Laravel.username;
    //         $.notify({
    //                    icon: 'https://randomuser.me/api/portraits/med/men/77.jpg',
    //                    message: mess1
    //             });
    // });



  //test 2  delete it afterwards below code
    window.Echo.private('App.Models.User.' + window.Laravel.user)
         .notification((notification) => {
        console.log('hello');
        console.log(notification.order_id);
        
         var mess1 = notification.order_id + window.Laravel.username;
         dangerClick();
        
    });

            var dangerClick = function(){
  $.notify({
    // options
    title: '<strong>Order Created</strong>',
    message: "<br>Lorem ipsum Reference site about Lorem Ipsum, giving information on its origins, as well as a random Lipsum.",
  icon: 'glyphicon glyphicon-remove-sign',
},{
    // settings
    element: 'body',
    position: null,
    type: "danger",
    allow_dismiss: true,
    newest_on_top: false,
    showProgressbar: false,
    placement: {
        from: "top",
        align: "right"
    },
    offset: 20,
    spacing: 10,
    z_index: 1031,
    delay: 3300,
    timer: 1000,
    url_target: '_blank',
    mouse_over: null,
    animate: {
        enter: 'animated flipInY',
        exit: 'animated flipOutX'
    },
    onShow: null,
    onShown: null,
    onClose: null,
    onClosed: null,
    icon_type: 'class',
});
}


  // test 2 delete above after testing or comment
 

    // Echo.channel('private-users.' +   window.Laravel.user) temporary commented 
  //   window.Echo.private('App.Models.User.' + window.Laravel.user)
  //        .notification((notification) => {
  //       console.log('hello');
  //       console.log(notification.order_id);
  //        var successOptions = {
  //     autoHideDelay: 50000,
  //     showAnimation: "fadeIn",
  //     hideAnimation: "fadeOut",
  //     hideDuration: 1000,
  //     arrowShow: false,
  //    elementPosition: 'bottom right',
  //   globalPosition: 'bottom right',
  //     className: "success"
  // };
  //        var mess1 = notification.order_id + window.Laravel.username;
  //           $.notify({
  //                      icon: 'https://randomuser.me/api/portraits/med/men/77.jpg',
  //                      message: mess1,
  //                     successOptions
                              
  //               });
  //   });


    


   


   
    </script>
</html>