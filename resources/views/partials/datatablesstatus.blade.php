{!! Form::open(array('method'=>'POST',  'action'=>['OrderController@update', $id])) !!}

                     
@include("partials.forms.edit.status", ["SubmitTextButton"=>"Edit" ,"id"=>$id, "oldprice"=>$fileprice , "filecount" => $filecount ])


{!! Form::close() !!}
                    
