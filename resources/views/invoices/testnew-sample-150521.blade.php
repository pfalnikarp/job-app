<!DOCTYPE HTML>
<html>

<head>


  @php
  $content='';
 
 
@endphp

<style type="text/css">
/*!
 * Generated using the Bootstrap Customizer (https://getbootstrap.com/docs/3.4/customize/)
 *//*!
 * Bootstrap v3.4.1 (https://getbootstrap.com/)
 * Copyright 2011-2019 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 *//*! normalize.css v3.0.3 | MIT License | github.com/necolas/normalize.css */html{font-family:sans-serif;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}body{margin:0}article,aside,details,figcaption,figure,footer,header,hgroup,main,menu,nav,section,summary{display:block}audio,canvas,progress,video{display:inline-block;vertical-align:baseline}audio:not([controls]){display:none;height:0}[hidden],template{display:none}a{background-color:transparent}a:active,a:hover{outline:0}abbr[title]{border-bottom:none;text-decoration:underline;text-decoration:underline dotted}b,strong{font-weight:bold}dfn{font-style:italic}h1{font-size:2em;margin:0.67em 0}mark{background:#ff0;color:#000}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sup{top:-0.5em}sub{bottom:-0.25em}img{border:0}svg:not(:root){overflow:hidden}figure{margin:1em 40px}hr{-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;height:0}pre{overflow:auto}code,kbd,pre,samp{font-family:monospace, monospace;font-size:1em}button,input,optgroup,select,textarea{color:inherit;font:inherit;margin:0}button{overflow:visible}button,select{text-transform:none}button,html input[type="button"],input[type="reset"],input[type="submit"]{-webkit-appearance:button;cursor:pointer}button[disabled],html input[disabled]{cursor:default}button::-moz-focus-inner,input::-moz-focus-inner{border:0;padding:0}input{line-height:normal}input[type="checkbox"],input[type="radio"]{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;padding:0}input[type="number"]::-webkit-inner-spin-button,input[type="number"]::-webkit-outer-spin-button{height:auto}input[type="search"]{-webkit-appearance:textfield;-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box}input[type="search"]::-webkit-search-cancel-button,input[type="search"]::-webkit-search-decoration{-webkit-appearance:none}fieldset{border:1px solid #c0c0c0;margin:0 2px;padding:0.35em 0.625em 0.75em}legend{border:0;padding:0}textarea{overflow:auto}optgroup{font-weight:bold}table{border-collapse:collapse;border-spacing:0}td,th{padding:0}*{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}*:before,*:after{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}html{font-size:10px;-webkit-tap-highlight-color:rgba(0,0,0,0)}body{font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:14px;line-height:1.42857143;color:#333;background-color:#fff}input,button,select,textarea{font-family:inherit;font-size:inherit;line-height:inherit}a{color:#337ab7;text-decoration:none}a:hover,a:focus{color:#23527c;text-decoration:underline}a:focus{outline:5px auto -webkit-focus-ring-color;outline-offset:-2px}figure{margin:0}img{vertical-align:middle}.img-responsive{display:block;max-width:100%;height:auto}.img-rounded{border-radius:6px}.img-thumbnail{padding:4px;line-height:1.42857143;background-color:#fff;border:1px solid #ddd;border-radius:4px;-webkit-transition:all .2s ease-in-out;-o-transition:all .2s ease-in-out;transition:all .2s ease-in-out;display:inline-block;max-width:100%;height:auto}.img-circle{border-radius:50%}hr{margin-top:20px;margin-bottom:20px;border:0;border-top:1px solid #eee}.sr-only{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0, 0, 0, 0);border:0}.sr-only-focusable:active,.sr-only-focusable:focus{position:static;width:auto;height:auto;margin:0;overflow:visible;clip:auto}[role="button"]{cursor:pointer}.container{padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}@media (min-width:768px){.container{width:750px}}@media (min-width:992px){.container{width:970px}}@media (min-width:1200px){.container{width:1170px}}.container-fluid{padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}.row{margin-right:-15px;margin-left:-15px}.row-no-gutters{margin-right:0;margin-left:0}.row-no-gutters [class*="col-"]{padding-right:0;padding-left:0}.col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12{position:relative;min-height:1px;padding-right:15px;padding-left:15px}.col-xs-1, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9, .col-xs-10, .col-xs-11, .col-xs-12{float:left}.col-xs-12{width:100%}.col-xs-11{width:91.66666667%}.col-xs-10{width:83.33333333%}.col-xs-9{width:75%}.col-xs-8{width:66.66666667%}.col-xs-7{width:58.33333333%}.col-xs-6{width:50%}.col-xs-5{width:41.66666667%}.col-xs-4{width:33.33333333%}.col-xs-3{width:25%}.col-xs-2{width:16.66666667%}.col-xs-1{width:8.33333333%}.col-xs-pull-12{right:100%}.col-xs-pull-11{right:91.66666667%}.col-xs-pull-10{right:83.33333333%}.col-xs-pull-9{right:75%}.col-xs-pull-8{right:66.66666667%}.col-xs-pull-7{right:58.33333333%}.col-xs-pull-6{right:50%}.col-xs-pull-5{right:41.66666667%}.col-xs-pull-4{right:33.33333333%}.col-xs-pull-3{right:25%}.col-xs-pull-2{right:16.66666667%}.col-xs-pull-1{right:8.33333333%}.col-xs-pull-0{right:auto}.col-xs-push-12{left:100%}.col-xs-push-11{left:91.66666667%}.col-xs-push-10{left:83.33333333%}.col-xs-push-9{left:75%}.col-xs-push-8{left:66.66666667%}.col-xs-push-7{left:58.33333333%}.col-xs-push-6{left:50%}.col-xs-push-5{left:41.66666667%}.col-xs-push-4{left:33.33333333%}.col-xs-push-3{left:25%}.col-xs-push-2{left:16.66666667%}.col-xs-push-1{left:8.33333333%}.col-xs-push-0{left:auto}.col-xs-offset-12{margin-left:100%}.col-xs-offset-11{margin-left:91.66666667%}.col-xs-offset-10{margin-left:83.33333333%}.col-xs-offset-9{margin-left:75%}.col-xs-offset-8{margin-left:66.66666667%}.col-xs-offset-7{margin-left:58.33333333%}.col-xs-offset-6{margin-left:50%}.col-xs-offset-5{margin-left:41.66666667%}.col-xs-offset-4{margin-left:33.33333333%}.col-xs-offset-3{margin-left:25%}.col-xs-offset-2{margin-left:16.66666667%}.col-xs-offset-1{margin-left:8.33333333%}.col-xs-offset-0{margin-left:0}@media (min-width:768px){.col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12{float:left}.col-sm-12{width:100%}.col-sm-11{width:91.66666667%}.col-sm-10{width:83.33333333%}.col-sm-9{width:75%}.col-sm-8{width:66.66666667%}.col-sm-7{width:58.33333333%}.col-sm-6{width:50%}.col-sm-5{width:41.66666667%}.col-sm-4{width:33.33333333%}.col-sm-3{width:25%}.col-sm-2{width:16.66666667%}.col-sm-1{width:8.33333333%}.col-sm-pull-12{right:100%}.col-sm-pull-11{right:91.66666667%}.col-sm-pull-10{right:83.33333333%}.col-sm-pull-9{right:75%}.col-sm-pull-8{right:66.66666667%}.col-sm-pull-7{right:58.33333333%}.col-sm-pull-6{right:50%}.col-sm-pull-5{right:41.66666667%}.col-sm-pull-4{right:33.33333333%}.col-sm-pull-3{right:25%}.col-sm-pull-2{right:16.66666667%}.col-sm-pull-1{right:8.33333333%}.col-sm-pull-0{right:auto}.col-sm-push-12{left:100%}.col-sm-push-11{left:91.66666667%}.col-sm-push-10{left:83.33333333%}.col-sm-push-9{left:75%}.col-sm-push-8{left:66.66666667%}.col-sm-push-7{left:58.33333333%}.col-sm-push-6{left:50%}.col-sm-push-5{left:41.66666667%}.col-sm-push-4{left:33.33333333%}.col-sm-push-3{left:25%}.col-sm-push-2{left:16.66666667%}.col-sm-push-1{left:8.33333333%}.col-sm-push-0{left:auto}.col-sm-offset-12{margin-left:100%}.col-sm-offset-11{margin-left:91.66666667%}.col-sm-offset-10{margin-left:83.33333333%}.col-sm-offset-9{margin-left:75%}.col-sm-offset-8{margin-left:66.66666667%}.col-sm-offset-7{margin-left:58.33333333%}.col-sm-offset-6{margin-left:50%}.col-sm-offset-5{margin-left:41.66666667%}.col-sm-offset-4{margin-left:33.33333333%}.col-sm-offset-3{margin-left:25%}.col-sm-offset-2{margin-left:16.66666667%}.col-sm-offset-1{margin-left:8.33333333%}.col-sm-offset-0{margin-left:0}}@media (min-width:992px){.col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12{float:left}.col-md-12{width:100%}.col-md-11{width:91.66666667%}.col-md-10{width:83.33333333%}.col-md-9{width:75%}.col-md-8{width:66.66666667%}.col-md-7{width:58.33333333%}.col-md-6{width:50%}.col-md-5{width:41.66666667%}.col-md-4{width:33.33333333%}.col-md-3{width:25%}.col-md-2{width:16.66666667%}.col-md-1{width:8.33333333%}.col-md-pull-12{right:100%}.col-md-pull-11{right:91.66666667%}.col-md-pull-10{right:83.33333333%}.col-md-pull-9{right:75%}.col-md-pull-8{right:66.66666667%}.col-md-pull-7{right:58.33333333%}.col-md-pull-6{right:50%}.col-md-pull-5{right:41.66666667%}.col-md-pull-4{right:33.33333333%}.col-md-pull-3{right:25%}.col-md-pull-2{right:16.66666667%}.col-md-pull-1{right:8.33333333%}.col-md-pull-0{right:auto}.col-md-push-12{left:100%}.col-md-push-11{left:91.66666667%}.col-md-push-10{left:83.33333333%}.col-md-push-9{left:75%}.col-md-push-8{left:66.66666667%}.col-md-push-7{left:58.33333333%}.col-md-push-6{left:50%}.col-md-push-5{left:41.66666667%}.col-md-push-4{left:33.33333333%}.col-md-push-3{left:25%}.col-md-push-2{left:16.66666667%}.col-md-push-1{left:8.33333333%}.col-md-push-0{left:auto}.col-md-offset-12{margin-left:100%}.col-md-offset-11{margin-left:91.66666667%}.col-md-offset-10{margin-left:83.33333333%}.col-md-offset-9{margin-left:75%}.col-md-offset-8{margin-left:66.66666667%}.col-md-offset-7{margin-left:58.33333333%}.col-md-offset-6{margin-left:50%}.col-md-offset-5{margin-left:41.66666667%}.col-md-offset-4{margin-left:33.33333333%}.col-md-offset-3{margin-left:25%}.col-md-offset-2{margin-left:16.66666667%}.col-md-offset-1{margin-left:8.33333333%}.col-md-offset-0{margin-left:0}}@media (min-width:1200px){.col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12{float:left}.col-lg-12{width:100%}.col-lg-11{width:91.66666667%}.col-lg-10{width:83.33333333%}.col-lg-9{width:75%}.col-lg-8{width:66.66666667%}.col-lg-7{width:58.33333333%}.col-lg-6{width:50%}.col-lg-5{width:41.66666667%}.col-lg-4{width:33.33333333%}.col-lg-3{width:25%}.col-lg-2{width:16.66666667%}.col-lg-1{width:8.33333333%}.col-lg-pull-12{right:100%}.col-lg-pull-11{right:91.66666667%}.col-lg-pull-10{right:83.33333333%}.col-lg-pull-9{right:75%}.col-lg-pull-8{right:66.66666667%}.col-lg-pull-7{right:58.33333333%}.col-lg-pull-6{right:50%}.col-lg-pull-5{right:41.66666667%}.col-lg-pull-4{right:33.33333333%}.col-lg-pull-3{right:25%}.col-lg-pull-2{right:16.66666667%}.col-lg-pull-1{right:8.33333333%}.col-lg-pull-0{right:auto}.col-lg-push-12{left:100%}.col-lg-push-11{left:91.66666667%}.col-lg-push-10{left:83.33333333%}.col-lg-push-9{left:75%}.col-lg-push-8{left:66.66666667%}.col-lg-push-7{left:58.33333333%}.col-lg-push-6{left:50%}.col-lg-push-5{left:41.66666667%}.col-lg-push-4{left:33.33333333%}.col-lg-push-3{left:25%}.col-lg-push-2{left:16.66666667%}.col-lg-push-1{left:8.33333333%}.col-lg-push-0{left:auto}.col-lg-offset-12{margin-left:100%}.col-lg-offset-11{margin-left:91.66666667%}.col-lg-offset-10{margin-left:83.33333333%}.col-lg-offset-9{margin-left:75%}.col-lg-offset-8{margin-left:66.66666667%}.col-lg-offset-7{margin-left:58.33333333%}.col-lg-offset-6{margin-left:50%}.col-lg-offset-5{margin-left:41.66666667%}.col-lg-offset-4{margin-left:33.33333333%}.col-lg-offset-3{margin-left:25%}.col-lg-offset-2{margin-left:16.66666667%}.col-lg-offset-1{margin-left:8.33333333%}.col-lg-offset-0{margin-left:0}}.pagination{display:inline-block;padding-left:0;margin:20px 0;border-radius:4px}.pagination>li{display:inline}.pagination>li>a,.pagination>li>span{position:relative;float:left;padding:6px 12px;margin-left:-1px;line-height:1.42857143;color:#337ab7;text-decoration:none;background-color:#fff;border:1px solid #ddd}.pagination>li>a:hover,.pagination>li>span:hover,.pagination>li>a:focus,.pagination>li>span:focus{z-index:2;color:#23527c;background-color:#eee;border-color:#ddd}.pagination>li:first-child>a,.pagination>li:first-child>span{margin-left:0;border-top-left-radius:4px;border-bottom-left-radius:4px}.pagination>li:last-child>a,.pagination>li:last-child>span{border-top-right-radius:4px;border-bottom-right-radius:4px}.pagination>.active>a,.pagination>.active>span,.pagination>.active>a:hover,.pagination>.active>span:hover,.pagination>.active>a:focus,.pagination>.active>span:focus{z-index:3;color:#fff;cursor:default;background-color:#337ab7;border-color:#337ab7}.pagination>.disabled>span,.pagination>.disabled>span:hover,.pagination>.disabled>span:focus,.pagination>.disabled>a,.pagination>.disabled>a:hover,.pagination>.disabled>a:focus{color:#777;cursor:not-allowed;background-color:#fff;border-color:#ddd}.pagination-lg>li>a,.pagination-lg>li>span{padding:10px 16px;font-size:18px;line-height:1.3333333}.pagination-lg>li:first-child>a,.pagination-lg>li:first-child>span{border-top-left-radius:6px;border-bottom-left-radius:6px}.pagination-lg>li:last-child>a,.pagination-lg>li:last-child>span{border-top-right-radius:6px;border-bottom-right-radius:6px}.pagination-sm>li>a,.pagination-sm>li>span{padding:5px 10px;font-size:12px;line-height:1.5}.pagination-sm>li:first-child>a,.pagination-sm>li:first-child>span{border-top-left-radius:3px;border-bottom-left-radius:3px}.pagination-sm>li:last-child>a,.pagination-sm>li:last-child>span{border-top-right-radius:3px;border-bottom-right-radius:3px}.pager{padding-left:0;margin:20px 0;text-align:center;list-style:none}.pager li{display:inline}.pager li>a,.pager li>span{display:inline-block;padding:5px 14px;background-color:#fff;border:1px solid #ddd;border-radius:15px}.pager li>a:hover,.pager li>a:focus{text-decoration:none;background-color:#eee}.pager .next>a,.pager .next>span{float:right}.pager .previous>a,.pager .previous>span{float:left}.pager .disabled>a,.pager .disabled>a:hover,.pager .disabled>a:focus,.pager .disabled>span{color:#777;cursor:not-allowed;background-color:#fff}.clearfix:before,.clearfix:after,.container:before,.container:after,.container-fluid:before,.container-fluid:after,.row:before,.row:after,.pager:before,.pager:after{display:table;content:" "}.clearfix:after,.container:after,.container-fluid:after,.row:after,.pager:after{clear:both}.center-block{display:block;margin-right:auto;margin-left:auto}.pull-right{float:right !important}.pull-left{float:left !important}.hide{display:none !important}.show{display:block !important}.invisible{visibility:hidden}.text-hide{font:0/0 a;color:transparent;text-shadow:none;background-color:transparent;border:0}.hidden{display:none !important}.affix{position:fixed}

</style>


<style>
    @page { margin: 100px 25px; }
    header { position: fixed; top: -60px; left: 0px; right: 0px; 
     height:50px; font-weight: bold;}

    footer { position: absolute; bottom: -60px; left: 0px; right: 0px;  
      height: 150px; }

    p { page-break-after: always; }
    p:last-child { page-break-after: never; }

    main {
       margin-top: 0px;
       top: -70px;
       left: 0px; right: 0px; 
      height: 200px; 
      position: relative;
    
    }

   .firstpage1 {
       margin-top: 0px;
       top: -70px;
       left: 0px; right: 0px; 
      
        
    }

    .rowhead 
    {
      top: -40px;
      position: fixed;
       margin-top: 0px;
       font-weight: bold;
    }


  </style>
<!-- */  footer  style */ -->

<style>
* {
  box-sizing: border-box;
}

/*html, body {
  height: 100%;
}*/

body {
 /* font-family:  Helvetica, Arial, sans-serif;
  font-size: 12px;*/
  font-family: Arial, Helvetica, sans-serif;
    -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  margin: auto;
  display: flex;
  flex-flow: column nowrap;
  justify-content: space-between;
}

ul {
  list-style: none;
}

a {
  text-decoration: none;
}




footer {
 /* background: #373737;*/
   background: #fffff;
  margin-top: auto;
  width: 100%;
}





.footer-bottom-section {
  width: 100%;
  padding: 10px;
  border-top: 1px solid #ccc;
  margin-top: 10px;
}

.footer-bottom-section > div:first-child {
  margin-right: auto;
}

.footer-bottom-wrapper {
  font-size: 1.5em;
  color: #fff;
}


/*  style added for first page */

.dueborder {
	border: 2px solid black;
	margin-right: 10px;
    color: blue;
    font-family: helvicta, arial;
    font-size: 18px;
}

.box {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
}

.box1 {
    width: 80%;
    height: 100px;

}

hr.lineb {

  background-color: black;

  border-top: 2px solid black

}

.minformation {
/*  margin-top: 20px;*/
  border-color: gray;
  border: 1px solid ;
  font-family: arial;
  font-size: 15px;
  font-weight: bold;
  text-align: center;
  padding: 5px;
 
}


.minformationh {
/*  margin-top: 20px;*/
  border-color: gray;
  border: 1px solid ;
  font-family: arial;
  font-size: 18px;
  font-weight: bold;
  text-align: center;
   padding: 15px;
  
}

.row.billcss {
  top:-20px;
}

div#rcorners3 {
  border-radius: 25px;
 /* background: url(paper.gif);*/
  background-position: left top;
  background-repeat: repeat;
  padding: 5px; 
  width: 140px;
  height: 65px;  
  border: 2px solid black;
  text-align: center;
}


</style>

</head>
<body>
   @php  $n= 0; $total=0; $subtotal=0; $files=array(); $pagecount=0; @endphp

  
 <!--  <header> 
  
       
        <div class="row">
                  @php $n++; @endphp
                  <div class="col-xs-2">Order ID</div>
                   <div class="col-xs-5">File Name</div>
                    <div class="col-xs-2">Order Date</div>
                     <div class="col-xs-2">File Price</div>
              
       </div>   
     
  </header> -->

  
 @if($pagecount == 0)
    @include('invoices/footer')
 @endif

  <!-- <footer>footer on each page</footer> -->

  <main>
  
   @if($pagecount == 0)

      
    <div  class="row ">

      <div class="col-xs-4"  style="float:left;">
            <img src="img/patternspng.png" alt="Logo" width="50%" height="50%" class="logo"/>
            <br>
           <span>
        Patterns LLC  <br>
        info@patternsindia.com  <br>
        Toll free 8002591090   <br>
        www.patterns247.com
      </span>

      </div>
    
       <div class="col-xs-2">
         
       </div>
    
      
     
         <div class="col-xs-4" style="float:right;">
             <img src="img/invoicepng.png" alt="Logo" width="60%" height="30%" class="logo"/>
               <br>
            <span>
            Invoice no:  <br>
            Invoice date:  <br>
                Due date:   <br>
      Invoices from 01-03-2021 to 31-03-2021  
            </span>
         </div>
    
      
    
    
    </div>

    <div class="row">
       
          <div class="col-xs-5">
              <br><br>
               <h3>Bill To</h3>
         </div> 
         <div id="rcorners3" class="col-xs-3"   >
           
            <h3> Amount Due <br>  $ 995.00  USD
            </h3>
         </div>

        

          <div class="col-xs-3"  style="text-align:center;">
                 <img src="img/tomupicode.jpg" alt="Logo" width="60%" height="60%" class="logo"/>
         </div>
         
  </div>
 <div class="row">
     <hr class="lineb">
 </div>

  

  <div class="row">
        <div class="col-xs-3" style="text-align: top;" >
              @foreach($invoiceInfo  as $key)
              <span>
                {{ $key->client_company}} <br>
                {{ $key->website  }}   <br>
                {{ $key->phone  }}    <br>
            </span>

            @endforeach
        </div>
  </div>

 
 <br>
  <br>

 <br>



      <div class="row minformationh">
        <div class="col-xs-6 ">
              <b> Description  </b>
        </div>
        <div class="col-xs-4 ">
            <b> Amount  </b>
        </div>
         
   </div>  
       <div class="row minformation">
        <div class="col-xs-6 ">
               Vector
        </div>
        <div class="col-xs-4 ">
               $ 900.00
        </div>
         
   </div>
   <div class="row minformation">
       
         <div class="col-xs-6 ">
               Digitizing
        </div>
        <div class="col-xs-4 ">
               $ 99.00
        </div>
   </div>

    <div class="row minformationh">
       
         <div class="col-xs-6 ">
               Total
        </div>
        <div class="col-xs-4 ">
               $ 999.00
        </div>
   </div>

   <div class="row">
        <h4>Notes</h4>

   </div>
    <div class="row box1">
      

   </div>
    <div class="row">
      

   </div>
   
    <div class="row">
      

   </div>
    <div class="row">
       <h4>Terms and Condition</h4>

   </div>

     <div class="row box1">
      

   </div>

   
   @endif
       @php $n==1; $client_name = ''; $order_id =1;  $fileno=1; $pagecount++; @endphp 

        
            
      
        <p>
    @foreach($orderlist as $key)
                
         @if ($n<3)     
             <!--  <span>HELLO  N  s less than 33</span>   -->
        <div class="row rowhead">
                  @php $n++; @endphp
                  <div class="col-xs-2">Order ID</div>
                   <div class="col-xs-5">File Name</div>
                    <div class="col-xs-2">Order Date</div>
                     <div class="col-xs-2">File Price</div>
              
       </div>
       @endif
    
      
  
                @if($n < 3  &&  isset($client_name))
                   <!--  <span>group header</span>  -->
                <div class="row">
                   
                    <div  style="color: blue;"><h4>{{  $client_name }}</h4></div>
                                      
                        @php $n++; @endphp                                     
                                  
                </div>
                @endif
    
       
                      @if($client_name != $key->client_name )
                            
                        <!--  <span>HELLO</span> -->
                              <div class="row">
                                 <!--   <span>HELLO1</span> -->
                                    <h4>{{  $key->client_name }}</h4>
                                          @php $n++; @endphp                                     
                                  
                                </div>

                            @if ($subtotal >0 )
                                <div class="row">
                                    <div class="col-xs-6"></div>
                                     
                                          <div class="col-xs-2"> SubTotal</div>
                                          <div class="col-xs-2" style="text-align: right;font-weight: bold;"> {{  number_format($subtotal,2) }}</div>
                                          @php $n++; @endphp
                                  
                                </div>

                          
                            @endif

                           
                         @php $subtotal = 0 ; $client_name  =  $key->client_name;  @endphp  

                         
                          

                      @endif

                         @php      
                         $n++;

                         $order_id  =  $key->order_id;
                         $files1    =  explode(',', $key->file_name);
                                                 
                         $filetype = $key->file_type;
                         $doctype = '';
                         $filecount = $key->file_count;
                         $stiches = $key->stiches_count;
                         $fileprice = $key->file_price;
                         $orderdate =$key->order_us_date;
                         $discount = 0 ;
                         $total =    number_format($total ,2)+ number_format($fileprice,2); 
                         $subtotal =  number_format($subtotal,2) + number_format($fileprice,2); 
                @endphp
                
              
                       @php  $fileno=1; @endphp
                       <div class="row">
                           <div class="col-xs-2">
                                {{   $order_id  }} 
                           </div>
                           <div  class="col-xs-4">

                            
                      @foreach($files1 as $file1)   

                            @php  $length1 = strlen($file1);  @endphp
                             
                               @if( count($files1) > 1)
                             {{  $fileno .". " . $file1 }}    <br />

                               @else
                                       {{  $file1  }} 

                               @endif
                           

                            
                              
                           

                           @php

                             for ($x = 0; $x <= $length1; $x++)
                             {

                                
                                $x= $x+100;  
                             }

                              $fileno++; $n= $n+ 1;

                          @endphp
                             
                           

                      @endforeach
                           </div>

                         <div  class="col-xs-3">
                                {{   $orderdate  }}  
                           </div>
                             <div  class="col-xs-3 float-right" >
                              {{   $fileprice  }}  
                           </div>
                       </div>                           
                 
             
                 
       


      </div>

      <div class="row"> <hr>  @php $n++; @endphp </div>


    @if($n % 40 == 0 || $n % 41 == 0 || $n % 42 == 0 || $n % 43 == 0)
           
         
          <div class="row">   @php $n=0;  $n++; @endphp  </div>

      <!--  page1  -->
           </p>

             
             
           <p>
         <!--    page 3 start -->
            
             
          
    @endif
   
    @endforeach

      @if ($subtotal >0 )

                                <div class="row">
                                    <div class="col-xs-6"></div>
                                     
                                          <div class="col-xs-2"> SubTotal</div>
                                          <div class="col-xs-2" style="text-align: right;font-weight: bold;"> {{  number_format($subtotal,2) }}</div>
                                        
                                  
                                </div>

                          
                            @endif


  </p>

     @if ($total >0 )

                                <div class="row">
                                    <div class="col-xs-6"></div>
                                     
                                          <div class="col-xs-2"> <b>Total </b></div>
                                          <div class="col-xs-2" style="text-align: right;font-weight: bold;"> {{  number_format($total,2) }}</div>
                                       
                                </div>

                          
                            @endif

    
    <p>page2></p>
  </main>

</body>
</html>