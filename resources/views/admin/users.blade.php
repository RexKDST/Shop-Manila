@extends('admin.master')

@section('content')
<script type="text/javascript">
function handleSelect(elm)
{
window.location = "{{url('')}}/admin/"+elm.value;
}
</script>


<script>
$(document).ready(function(){
  <?php for($i=1;$i<15;$i++){?>
      $('#successMsg<?php echo $i;?>').hide();
  $('#role<?php echo $i;?>').change(function(){
    var role_val<?php echo $i;?> = $('#role<?php echo $i;?>').val();
      var userId<?php echo $i;?> = $('#userId<?php echo $i;?>').val();
    $.ajax({
      type: 'get',
      data: 'userID='+userId<?php echo $i;?> + '&role_val=' + role_val<?php echo $i;?>,
      url: '<?php echo url('/admin/updateRole');?>',
      success: function(response){
        console.log(response);
        $('#successMsg<?php echo $i;?>').show();
        $('#successMsg<?php echo $i;?>').html(response);
      }
    });
  });
	$('#banUser<?php echo $i;?>').click(function(){
		if(document.getElementById('banUser<?php echo $i;?>').checked){
			alert('Checked');
		}else{
			alert('Unchecked');
		}
	});
<?php }?>
});
</script>
<section id="container" class="">
      @include('admin.sidebar')
      <section id="main-content">
          <section class="wrapper">
            <div class="col-md-10">
              <div class="content-box-large">
                  <h1>Total Users: {{$usersData->total()}}</h1>
                   <select name="formal" class="btn btn-default dropdown-toggle" onchange="javascript:handleSelect(this)">
                        <option value=" ">Select</option>
                         <option value="adminName">Admins Only</option>
                        <option value="ascUsers">User ID (Ascending)</option>
                        <option value="descUsers">User ID (Descending)</option>
                        <option value="ascName">A-Z Names</option>
                        <option value="descName">Z-A Names</option>
                       
                        
                        </select>
                        <div class="search_box pull-right" style="margin-right: 40px;">
                            <form action="{{url('/admin/searchUser')}}" method="post">

                            <input type="text" placeholder="Search User"  name="search_data"/>
                            <input type="hidden" name="_token" value= "{{ csrf_token() }}" >
                          
                            </form>
                        </div>
                  <table class="table table-striped table-advance table-hover">
                      <thead>
                        <tr>
                              <th><i class="icon_profile"></i> User ID</th>
                              <th><i class="icon_profile"></i> Name</th>
                              <th><i class="icon_mail_alt"></i> Email</th>
                              <th><i class="icon_calendar"></i> Role</th>
														
                          </tr>
                      </thead>


                      <tbody>
                          <?php $countRole =1;?>
                        @foreach($usersData as $userData)
                        <input type="hidden" value="{{$userData->id}}" id="userId<?php echo $countRole;?>">

                        <tr>
                          <td>{{$userData->id}}</td>
                          <td>{{$userData->name}}</td>
                         <td>{{$userData->email}}</td>
                         <td><select name="role" class="form-control" id="role<?php echo $countRole;?>">
                           <option value="1" @if($userData->admin=='1')
                             selected="selected" @endif>Admin</option>
                           <option value="0"  @if($userData->admin=='' || $userData->admin=='0')
                             selected="selected" @endif>User</<option>
                           </select>
                           <p id="successMsg<?php echo $countRole;?>"
														  class="alert alert-success"></p>
                          </td>
                        
													<td>
														
													</td>
                        </tr>
                          <?php $countRole++;?>
                        @endforeach

                      </tbody>
                    </table>
                     {{$usersData->links()}}
                  </div>
                  </div>
                </section>
              </section>


@endsection
