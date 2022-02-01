@extends('layouts.maintemplate')
@section('content')
<div class="col-12 mb-2 text-end">
    <a href="/groups" class="btn btn-primary">Back</a>
</div>
<div class="card">
    <div class="card-header">
        <h4>Group Edit</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-2 mb-2">
                <div class="form-group">
                    
                    {!! Form::label('group_name', 'Name', []) !!}
                    {!! Form::text('group_name', $groupmaster[0]->groupname ,['class' => 'form-control',
                    'required'=>'required',  'autofocus' =>'autofocus','id'=>'grp_name']) !!}
                    <input type="hidden" name="groupid" value="{{ $groupmaster[0]->groupid }}">
                </div>
            </div>
            <div class="col-2 mb-2">
                <div class="form-group">
                    
                    {!! Form::label('names', 'User Names', []) !!}
                    @php
                    $usernames = array();
                    $names =  explode(',', $groupmaster[0]->names);
                    $userids = explode(',',  $groupmaster[0]->userids);
                    @endphp
                    @for ($i = 0; $i < count($names); $i++)
                    
                    <input type="hidden" name="names[]" value="{{ $userids[$i] }}">{{ $names[$i] }}<a class="deluser" href="#">x</a><br>

                        {{  $usernames[$userids[$i]] = $names[$i] }}
 
                    @endfor
                    
                    
                </div>
            </div>
            <div class="col-2 mb-2">
                <div class="form-group">
                    
                    {!! Form::label('names', 'Select User Names', []) !!}
                    @php
                    $names =  explode(',', $groupmaster[0]->names);
                    $userids = explode(',',  $groupmaster[0]->userids);
                    @endphp


                    {!! Form::select('user1[]', $usernames, null, [ 'multiple'=>'multiple' ,'class'=>'form-control']) !!}
                    
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">

$(document).ready(function () {
//alert(1);
$(document).on( "click", "a.deluser", function(e) {
//debugger;

        console.log(this.value);
        Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                //footer: '<a href="">Why do I have this issue?</a>'
                })
            });
});
</script>
@endsection