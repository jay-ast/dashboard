<?php include_once 'header.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div id="content">
    <h1 class="bg-white content-heading border-bottom">Clients</h1>
    <div class="innerAll spacing-x2">
        <!-- Widget -->
        <div class="extraCustomMessage">
            <?php if ($this->session->flashdata('message') != '') { ?>
                <div class="alert alert-<?php echo $this->session->flashdata('message')['classname']; ?>">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $this->session->flashdata('message')['data']; ?> 
                </div> 
            <?php } ?>
        </div>
        <div class="alert alert-info displaymessage hidden">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <p></p>
        </div>
        <div class="widget widget-inverse">
            <div class="widget-body padding-bottom-none">
                <!-- Table -->
                <div class="row">                    
                    <?php echo form_open(base_url('admin/patients')); ?>                   
                    <div class="col-md-5"><input id="nameSearch" type="text" class="form-control" placeholder="<?php
                        if (isset($fullname)) {
                            echo $fullname;
                        } else {
                            echo 'Name';
                        }
                        ?>" name="fullname"/>
                    </div>

                    <div class="col-md-5">
                        <input id="emailSearch" type="text" class="form-control"  placeholder="<?php
                        if (isset($email)) {
                            echo $email;
                        } else {
                            echo 'Login Information';
                        }
                        ?>" name="email"/>
                    </div>


                    <div class="col-md-2">
                            <a class="btn btn-success btnAddUser col-sm-12" data-toggle="modal" href="#responsiveUserdetails"> <i class="fa fa-plus"></i> Add</a>
                    </div>

                    <?php echo form_close(); ?>
                    <table class="dynamicTable tableTools table table-striped checkboxs">
                        <!-- Table heading -->
                        <thead>
                            <tr class=" text-center">                              
                                <th>Name</th>
                                <th>Login Information</th>
                                <th>Phone</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <!-- // Table heading END -->
                        <!-- Table body -->
                        <tbody id="myTable"> 
                            <?php
                            if (isset($patientlist)) {
                                foreach ($patientlist as $userdatalist) {
                                    $patient_name = $userdatalist['firstname'] . " " . $userdatalist['lastname'];
                                    ?>
                                    <tr class="gradeX " data-id="333333" id="patient-<?php echo $userdatalist['id']; ?>">      

                                        <td><a data-toggle="modal" href="#responsiveUserdetails"                                               
                                               data-patientid="<?php echo $userdatalist['id']; ?>"                                                           
                                               class="btnPatientDetails">
                                                   <?php echo $patient_name; ?>
                                            </a>  
                                        </td>
                                        <td><?php echo $userdatalist['email'] . " (" . $userdatalist['password'] . ")"; ?></td>
                                        <td><?php echo $userdatalist['phone']; ?></td>                                       
                                        <td class="center">
                                         
	                                            
	                                             <a href="mailto:<?php echo $userdatalist['email']; ?>?Subject=Your%20Video%20Routine%20From%20Perfect%20Forms&body=To%20view%20your%20videos%3A%0A%0A1-%20Download%20our%20Perfect%20Forms%20app%20from%20App%20Store(IOS)%3A%20<?php echo APP_ITUNES_LINK ?>%20or%0A2-%20Download%20our%20Perfect%20Forms%20app%20from%20Google%20Play%20Store(Android)%3A%20<?php echo APP_PLAYSTORE_LINK ?>%20%0A3-%20Log%20into%20<?php echo APP_WEBAPP_LINK ?>%20from%20any%20device%20or%20computer.%0A%0AYour%20username%20and%20password%20are%3A%0AUsername%3A%20<?php echo urlencode($userdatalist['email']) ?>%0APassword%3A%20<?php echo urlencode($userdatalist['password']) ?>" target="_top">
		                                             
	                                            
	                                            
	                                            
	                                            
                                                <i class="fa fa-envelope" data-toggle="tooltip" title="Send Mail"></i></a>  
                                            <a class="deleteBtn" data-patientid="<?php echo $userdatalist['id']; ?>" 
                                               data-patientname="<?php echo $patient_name; ?>"
                                               data-action="delete" data-toggle="modal" href="#deleteWarning" >
                                                <i class="glyphicon glyphicon-trash " data-toggle="tooltip" title="Delete User"></i></a></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo '<tr class="gradeX"><td colspan="5" class="text-center">No Clients available.</td></tr>';
                            }
                            ?>
                        </tbody>
                        <!-- // Table body END -->
                    </table>
                    <!-- // Table END -->
                    <div class="jquery-bootpag-pagination pull-right">
                        <ul id="myLinks" class="bootpag pagination">

                            <!-- Show pagination links -->
                            <?php
                            foreach ($links as $link) {
                                echo "<li>" . $link . "</li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>                
            </div>
        </div>       

    </div>
    <!--Model user details-->
    <div id="responsiveUserdetails" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content ">
                <?php echo form_open(base_url('admin/patients/updatePatient'), array("class" => "patientForm")); ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                    <h3 class="modal-title">Client Details</h3>
                    <a  type="submit" class="btn btn-success btnupdateclientuser" href="">Create New Routines</a>
                </div>
                <div class="modal-body modelform ">
                    <div class="form-body clearfix col-md-12">
                        <div class="row margin-top-10">
                            <div class="form-group col-md-6">
                                <input type="hidden" class="form-control patientid" name="patientid" value="">
                            </div>
                        </div>
                        <div class="col-md-6 userdetail">
                            <div class="row margin-top-10 ">
                                <div class="form-group col-md-3">
                                    <label>First Name</label>
                                </div>
                                <div class="form-group col-md-9">                                            
                                    <input type="text" class="firstname form-control firstname" name="firstname" placeholder="First Name"/>
                                </div>
                            </div>
                            <div class="row margin-top-10">
                                <div class="form-group col-md-3">
                                    <label>Last Name</label>
                                </div>
                                <div class="form-group col-md-9">                                          
                                    <input type="text" class="lastname form-control lastname" name="lastname" placeholder="Last Name"/>
                                </div>
                            </div>
                            <div class="row margin-top-10">
                                <div class="form-group col-md-3">
                                    <label>Email</label>
                                </div>
                                <div class="form-group col-md-9">                                            
                                    <input id="email" type="text" class="form-control email" name="email" placeholder="Email"/>
                                </div>
                            </div>
                            <div class="row margin-top-10 hidden">
                                <div class="form-group col-md-3">
                                    <label>Password</label>
                                </div>
                                <div class="form-group col-md-9">                                            
                                    <input type="password" id="patientpassword" class="form-control  password" name="password" placeholder="Password"/>
                                </div>
                            </div>
                            
                            <div class="row margin-top-10 hidden">
                                <div class="form-group col-md-3">
                                    <label>Password</label>
                                </div>
                                <div class="form-group col-md-9">                                            
                                    <input type="password" class="form-control confirmpassword " name="confirmpassword" placeholder="Confirm Password"/>
                                </div>
                            </div>
                            
                            <div class="row margin-top-10">
                                <div class="form-group col-md-3">
                                    <label>Phone</label>
                                </div>
                                <div class="form-group col-md-9">                                            
                                    <input type="text" class="form-control phone client-phone" name="phone" maxlength="15" value="" placeholder="Phone"/>
                                </div>
                            </div>

                            <div class="row margin-top-10">
                                <div class="form-group col-md-3">
                                    <label>Date Of Birth</label>
                                </div>
                                <div class="form-group col-md-9">                                            
                                    <input type="date" class="form-control dateofbirth" name="date_of_birth" maxlength="15" value="" placeholder="DOB"/>
                                </div>
                            </div>

                            <div class="row margin-top-10">
                                <div class="form-group col-md-3">
                                    <label>Physical Address</label>
                                </div>
                                <div class="form-group col-md-9">                                            
                                    <input type="text" class="form-control physicaladdress" name="physical_address" maxlength="15" value="" placeholder="Physical Address"/>
                                </div>
                            </div>

                            <div class="row margin-top-10">
                                <div class="form-group col-md-3">
                                    <label>Emergency Contact</label>
                                </div>
                                <div class="form-group col-md-9">                                            
                                    <input type="text" class="form-control emergencycontact" name="emergency_contact" maxlength="15" value="" placeholder="Emergency Contact"/>
                                </div>
                            </div>
                        </div>
                       
                    
                        <div v-if="activeItem.fullname" class="routinelist">
                        <div class="col-md-3">
                            <div class="row margin-top-10">
                                <div class="form-group col-md-12">
                                    <label>Saved General Routines</label> 
                                    <!-- <input type="text" id="generalvideosearch" v-model="generalvideosearch" placeholder="Search Routines" autocomplete="off" maxlength="100" class="form-control"> -->
                                    <select multiple class="form-control ex_list_to" id="exgeneral_list_to" multiple="multiple">         
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row margin-top-10">
                                <div class="form-group col-md-12">
                                <label>Saved Client Routines</label> 
                                    <!-- <input type="text" id="clientvideosearch" placeholder="Search Routines" autocomplete="off" maxlength="100" class="form-control"> -->
                                    <select multiple class="form-control ex_list_to" id="exclient_list_to" multiple="multiple">                                      

                                    </select>

                                </div>
                            
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row margin-top-10">
                                <div class="col-md-12">
                                <button type="button" class="btn btn-success btnaddselectex" data-toggle="tooltip" data-title="Assign selected Exercise"><i class="fa fa-arrow-circle-o-down"></i></button>                                                      
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <label>Assigned Routines</label>
                                <div class="assignes_ex_div">

                                </div>

                            </div>
                        </div>   
                        </div>
                    </div>
                    <a class="pull-right" id="mailto" href="#" target="_top"><i class="fa fa-envelope" data-toggle="tooltip" title="" data-original-title="Send Mail"></i></a>
                    <div class="modal-footer">                    
                        <button  type="submit" class="btn btn-success btnsaveuser create-new-client" name="btnsaveuser" formaction="/admin/patients/addNewPatient">Add Client</button>

                    </div>
                    
                    <!-- <div class="modal-footer">                    
                        <a  type="submit" class="btn btn-success btnupdateclientuser" href="">Create New Routinesssss</a>
                    </div> -->
                    
                    <div class="clearfix"></div>
                    <div class="modal-footer">                    
                        <button  type="submit" class="btn btn-success btnsaveclientuser create-new-client" name="btnsaveclientuser" formaction="<?php echo base_url('admin/patients/addNewPatient'); ?>">Add and create new routine</button>
                        <button  type="submit" class="btn btn-success btnupdateuser" formaction="<?php echo base_url('admin/patients/updatePatient'); ?>">Update</button>                                                            
                        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
                    </div>
                    
                  
                    <?php echo form_close(); ?>
                </div>
                <!-- /.modal-content --> 
            </div>                   

        </div>
    </div>
    <!-- /.modal-dialog --> 
    <div id="deleteWarning"  class="modal fade">
        <div class="modal-dialog new-modal-dialog">
            <div class="modal-content">
                <!-- dialog body -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Alert!!</h4>
                </div>
                <div class="modal-body alert-message">
                    <p></p>
                </div>
                <!-- dialog buttons -->
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-danger modeldeleteyes" data-action="" data-patientid data-dismiss="modal">Yes</button>
                    <button type="button" class="btn btn-success no" data-dismiss="modal">No</button>
                </div>                  
            </div>
        </div>
    </div>
    
    
    <div id="ExerciseWarning"  class="modal fade">
        <div class="modal-dialog new-modal-dialog">
            <div class="modal-content">
                <!-- dialog body -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Alert!!</h4>
                </div>
                <div class="modal-body alert-message">
                    <p></p>
                </div>
                <!-- dialog buttons -->
                <div class="modal-footer"> 
                    
                    
                    <button type="button" class="btn btn-danger deleteroutine" data-action="" data-patientid>Delete?</button>
                    
                    <a href="#" class="btn btn-success no editroutine" role="button">Edit</a>
                   
                </div>                  
            </div>
        </div>
    </div>
</div>
<?php include_once 'footer.php'; ?>
<script>

function phonenumberValidate(clintPhone)
{
  var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
    if (clintPhone.length>9) {
        if(clintPhone.match(filter)){
            return true;
        }else{
            alert("Please enter valid phone number.");
            return false;
        }
    }else{
            alert("Please enter minimum ten digit.");
            return false;
    }
}

var base_url = '<?php echo base_url(); ?>';
  var clientexercies=[];
  var generalexercies=[];
  $('#exgeneral_list_to').html('')   
createClientUser = function(me)
{
	var formaction = $(me).attr("formaction")
/*
	
	$.ajax({ 
    type: 'POST', 
    url: formaction, 
    data: { action: "getNewReQuest", medtype: "1"}, 
    dataType: 'json',
    success: function (data) { 
       console.info(data)
	});

	alert(formaction)
	}
*/
}

$("#email").keyup(function(){
	$("#email").removeClass("error")
})
 <?php foreach($generalexercies as $exdata)
 { ?>
     var id = <?php echo $exdata['id']; ?>;
     var text = "<?php echo $exdata['name']; ?>";
     var folderid = "<?php echo $exdata['folderid']; ?>";
     generalexercies.push({'id':id, 'name': text,'folderid':folderid});
   $('#exgeneral_list_to').append("<option value='" + id + "' title='" + text + "' data-folderid=" + folderid + "'>" + text +"</option>");
 <?php } ?>


 $("#generalvideosearch").on('input',function(e){
    var value = this.value.toLowerCase().trim();
    var assignedexe = new Array();                
    $('.assignes_ex_div').find('input').each(function(){
            assignedexe.push($(this).val()); 
        });

            $('#exgeneral_list_to').html('')
                for (var key in generalexercies) {
                        var id = generalexercies[key]['id'];
                        var text = generalexercies[key]['name'];
                        var folderid = generalexercies[key]['folderid'];
                    
                    if (jQuery.inArray(id.toString(), assignedexe)=='-1' && folderid!='') {
                        if(value==''){
                            $('#exgeneral_list_to').append('<option value="' + id + '"  title="' + text + '" data-test="111111111" data-folderid="' + folderid + '">' + text + '</option>');
                        }else{
                            $val=text.toLowerCase().trim();
                            var not_found = ($val.indexOf(value) == -1);
                            if(!not_found){
                                $('#exgeneral_list_to').html('');
                                $('#exgeneral_list_to').append('<option value="' + id + '" title="' + text + '">' + text + '</option>');
                            }
                        
                        }
                    }
                    
                
                }
         
});


//      $("#generalvideosearch").on('input',function(e){
//     var value = this.value.toLowerCase().trim();
//     var assignedexe = new Array();
    
//    $('.assignes_ex_div').find('input').each(function(){
//         assignedexe.push($(this).val()); 
//     });
//     $('#exgeneral_list_to').html('')
//          for (var key in generalexercies) {
//             var id = generalexercies[key]['id'];
//             var text = generalexercies[key]['name'];
//             var folderid = generalexercies[key]['folderid'];
//           //console.log($.inArray(id, assignedexe) == -1)
           
//          if (jQuery.inArray(id.toString(), assignedexe)=='-1') {
//             if(value==''){
//                 $('#exgeneral_list_to').append('<option value="' + id + '"  title="' + text + '" data-folderid="' + folderid + '">' + text + '</option>');
//             }else{
                
            
//                 $val=text.toLowerCase().trim();
//                 var not_found = ($val.indexOf(value) == -1);
           
//                 if(!not_found){
//                      $('#exgeneral_list_to').append('<option value="' + id + '" title="' + text + '">' + text + '</option>');
//                 }
               
//           }
//          }
            
           
//         }
         
// });

$("#emailSearch").keyup(function(){
	$("#nameSearch").keyup()
	})
$("#nameSearch").keyup(function(){
	$.ajax({ 
    type: 'POST', 
    url: '/admin/patients/index_search', 
    data: { fullname: $("#nameSearch").val(), email: $("#emailSearch").val()}, 
    dataType: 'json',
    success: function (data) { 
	       console.info(data)
	       $("#myTable").html("");
	       var patients = data.patientlist;
	       var links = data.links;
	       console.info(patients)
	       $("#myLinks").html('')
	       links.forEach(function(link){
		       $("#myLinks").append("<li>"+link+"</li>");
	       })

	       
		   patients.forEach(function(patient){
			   $("#myTable").append(`<tr class="gradeX testing" id="patient-`+patient.id+`">      

                                        <td><a data-toggle="modal" href="#responsiveUserdetails"                                               
                                               data-patientid="`+patient.id+`"                                                           
                                               class="btnPatientDetails">
                                                   `+patient.myfullname+`
                                            </a>  
                                        </td>
                                        <td>`+patient.logininformation +`</td>
                                        <td>`+patient.phone+`</td>                                       
                                        <td class="center">
                                         
	                                            
	                                             <a href="mailto:`+patient.email+`?Subject=Your%20Video%20Routine%20From%20Perfect%20Forms&body=To%20view%20your%20videos%3A%0A%0A1-%20Download%20our%20Perfect%20Forms%20app%20from%20App%20Store(IOS)%3A%20<?php echo APP_ITUNES_LINK ?>%20or%0A2-%20Download%20our%20Perfect%20Forms%20app%20from%20Google%20Play%20Store(Android)%3A%20<?php echo APP_PLAYSTORE_LINK ?>%20%0A3-%20Log%20into%20<?php echo APP_WEBAPP_LINK ?>%20from%20any%20device%20or%20computer.%0A%0AYour%20username%20and%20password%20are%3A%0AUsername%3A%20`+patient.email+`%0APassword%3A%20`+patient.password+`" target="_top">
		                                             
	                                            
	                                            
	                                            
	                                            
                                                <i class="fa fa-envelope" data-toggle="tooltip" title="Send Mail"></i></a>  
                                            <a class="deleteBtn" data-patientid="`+patient.id+`" 
                                               data-patientname="`+patient.myfullname+`"
                                               data-action="delete" data-toggle="modal" href="#deleteWarning" >
                                                <i class="glyphicon glyphicon-trash " data-toggle="tooltip" title="Delete User"></i></a></td>
                                    </tr>`)
		   });
	       
	    }
	});
})


$("#clientvideosearch").on('input',function(e){
    var value = this.value.toLowerCase().trim();
    var assignedexe = new Array();
    
   $('.assignes_ex_div').find('input').each(function(){
        assignedexe.push($(this).val()); 
    });
    $('#exclient_list_to').html('')
         for (var key in clientexercies) {
            var id = clientexercies[key]['id'];
            var text = clientexercies[key]['name'];
            var folderid = clientexercies[key]['folderid'];
          //console.log($.inArray(id, assignedexe) == -1)
           
         if (jQuery.inArray(id.toString(), assignedexe)=='-1') {
            if(value==''){
                $('#exclient_list_to').append('<option value="' + id + '" title="' + text + '" data-folderid="' + folderid + '">' + text + '</option>');
            }else{
                
            
                $val=text.toLowerCase().trim();
                var not_found = ($val.indexOf(value) == -1);
           
                if(!not_found){
                     $('#exclient_list_to').append('<option value="' + id + '" title="' + text + '">' + text + '</option>');
                }
               
          }
         }
            
           
        }
         
});

    // delete warning model
    $(document).on('click', '.deleteBtn', function () {
        var patientid = $(this).attr('data-patientid');
        var patient_name = $(this).attr('data-patientname');
        var action = $(this).data('action');
        $(".modeldeleteyes").attr('data-patientid', patientid);
        $(".modeldeleteyes").attr('data-patientname', patient_name);
        $(".modeldeleteyes").attr('data-action', action);
        $("#deleteWarning p").html("Do you realy want to delete this Client <strong>" + patient_name + "</strong>?");
        $("#deleteWarning").modal('show');
        return false;
    });
    
     

    //if user accept to delete park from model then process request
    $(document).on('click', '.modeldeleteyes', function () {
        var patientid = $('.modeldeleteyes').attr('data-patientid');
        var patient_name = $('.modeldeleteyes').attr('data-patientname');
        var action = $('.modeldeleteyes').attr('data-action');

        $.ajax({
            type: 'POST',
            url: base_url + 'admin/patients/deletePatient/' + patientid,
            success: function (deleteAction) {
                var deleteuserdata = JSON.parse(deleteAction);
                var extraMessageHtml = "";
                if (deleteuserdata['status'] == true) {
                    extraMessageHtml = '<div class="alert alert-success">User <strong>' + patient_name + '</strong> deleted successfully<button type="button" class="close" data-dismiss="alert">&times;</button></div>';
                } else {
                    extraMessageHtml = '<div class="alert alert-danger">Error while deleting Client <strong>' + patient_name + '</strong> <button type="button" class="close" data-dismiss="alert">&times;</button></div>';
                }
                $('.extraCustomMessage').html(extraMessageHtml);
                $('#patient-' + patientid).fadeOut(1500);
                return false;
            },
            error: function (data) {
                console.log(data);
            }
        });
    });

$(document).on('click', '.btnsaveclientuser', function () {

    var clintPhone=$('.client-phone').val();
    if (clintPhone) { 
        var phonecheck=phonenumberValidate(clintPhone);
            if (phonecheck==false) {
                return false;
            }else{
                $(this).val('save');
	            $('.patientForm').attr('action',$(this).attr('formaction'));
                return true; 
            } 
    }else{
                
        $(this).val('save');
	    $('.patientForm').attr('action',$(this).attr('formaction'));
        return true;
        }

	
});
$(document).on('click', '.btnsaveuser', function (e) {
    var clintPhone=$('.client-phone').val();
    if (clintPhone) { 
        var phonecheck=phonenumberValidate(clintPhone);
            if (phonecheck==false) {
                return false;
            }else{
                $(this).val('save');
                return true; 
            } 
    }else{
                
        $(this).val('save');
        return true;
        }
})

$(document).on('click', '.btnupdateuser', function (e) {
$('.btnsaveclientuser').val('save');
$('.patientForm').attr('action',$(this).attr('formaction'))
//return false;
})


    $(document).on('click', '.btnAddUser', function () {
        $('#responsiveUserdetails').find('.modal-dialog').css('width','50%');
        $('#responsiveUserdetails').find('.userdetail').removeClass('col-md-6');
        $('#responsiveUserdetails').find('.userdetail').addClass('col-md-12');
        $('.btnsaveuser').removeClass('hidden');
        $('.btnsaveclientuser').removeClass('hidden');
        $('.btnupdateuser').addClass('hidden');
        $('.btnupdateclientuser').addClass('hidden');
        $('.userdetail').removeClass('hidden');
        $('.routinelist').addClass('hidden');
        $('.fa-envelope').addClass('hidden');

        //reset field values
        $('.patientid').val("");
        $('.firstname').val("");
        $('.lastname').val("");
        $('.email').val("");
        $('.phone').val("");
        $('.password').val("");
        $('.confirmpassword').val("");
        $('.dateofbirth').val("");
        $('.physicaladdress').val("");
        $('.emergencycontact').val("");
          
        $('.assignes_ex_div').html("");        
        $('#exgeneral_list_to').find('option').remove();
       
         //generalexercies.push({'id':optionValue, 'name': optionText,'folderid':Folderid});
        for (var key in generalexercies) {
            var id = generalexercies[key]['id'];
            var text = generalexercies[key]['name'];
             var Folderid = generalexercies[key]['folderid'];
            $('#exgeneral_list_to').append('<option value="'+id+'" data-folderid="'+Folderid+'" title="' + text + '" >'+text+'</option>');
        }
    });
    
    

    //btn get patient details
    $(document).on('click', '.btnPatientDetails', function () {
        $('#responsiveUserdetails').find('.modal-dialog').css('width','70%');        
        $('#responsiveUserdetails').find('.userdetail').removeClass('col-md-12');
        $('#responsiveUserdetails').find('.userdetail').addClass('col-md-6');
        var patientid = $(this).attr('data-patientid');
        $('.btnsaveuser').addClass('hidden');
        $('.btnsaveclientuser').addClass('hidden');
        $('.btnupdateuser').removeClass('hidden');
        $('.btnupdateclientuser').removeClass('hidden');
        $('.btnupdateclientuser').attr('href',base_url + 'admin/exercises/addclientexercise/' + patientid)
        //reset assigned exercise
        $('.assignes_ex_div').html("");
        $('#ex_list_to').find('option').remove();
        
        
        $.ajax({
            type: 'POST',
            url: base_url + 'admin/patients/getPatientDetails/' + patientid,
            success: function (actionResponse) {
                var patientData = JSON.parse(actionResponse);
                $('.patientid').val(patientid);
                $('.firstname').val(patientData['data']['firstname']);
                $('.lastname').val(patientData['data']['lastname']);
                $('.email').val(patientData['data']['email']);
                $('.phone').val(patientData['data']['phone']);
                $('.password').val(patientData['data']['password']);
                $('.confirmpassword').val(patientData['data']['password']);
                $('.dateofbirth').val(patientData['data']['date_of_birth']);
                $('.physicaladdress').val(patientData['data']['physical_address']);
                $('.emergencycontact ').val(patientData['data']['emergency_contact']);                
                $('#mailto').attr('href','mailto:'+patientData['data']['email']+'?'+encodeURI('Subject=Your Video Routine From Perfect Forms')+'&body='+'To%20view%20your%20videos%3A%0D%0A%0D%0A1-%20Download%20our%20Perfect%20Forms%20app%20from%20App%20Store(IOS)%3A%20'+encodeURI('<?php echo APP_ITUNES_LINK ?>')+'%0A2-%20Download%20our%20Perfect%20Forms%20app%20from%20Google%20Play%20Store(Android)%3A%20' + encodeURI('<?PHP echo APP_PLAYSTORE_LINK ?>')+'%20-%20or%20%0D%0A3-%20Log%20into%20'+encodeURI('<?php echo APP_WEBAPP_LINK ?>')+'%20from%20any%20device%20or%20computer.%0D%0A%0D%0AYour%20username%20and%20password%20are%3A%0D%0AUsername%3A%20'+patientData['data']['email']+'%0D%0APassword%3A%20'+patientData['data']['password']);
                $('#exclient_list_to').html('')
                $('.routinelist').removeClass('hidden');
                //append exercies and remove from list
                var exerc = patientData['data']['clientexercies'];
                var exerclength = exerc.length;
                for (var i = 0; i < exerclength; i++) {
                    var optionValue = exerc[i]['id'];
                    var optionText = exerc[i]['name'];var Folderid = exerc[i]['folderid'];
                   
                    $('#exclient_list_to').append('<option value="'+optionValue+'" data-folderid="'+Folderid+'" title="' + optionText + '" >'+optionText+'</option>');
                    clientexercies.push({'id':optionValue, 'name': optionText,'folderid':Folderid});
                }
                   
                    //append exercies and remove from list
                    
                    $('#exgeneral_list_to').html('')
                var generalexerc = patientData['data']['generalexercies'];
                var gexerclength = generalexerc.length;
                for (var i = 0; i < gexerclength; i++) {
                    var optionValue = generalexerc[i]['id'];
                    var optionText = generalexerc[i]['name'];
                    var Folderid = generalexerc[i]['folderid'];
                   
                    $('#exgeneral_list_to').append('<option value="'+optionValue+'" data-folderid="'+Folderid+'" title="' + optionText + '" >'+optionText+'</option>');
                    generalexercies.push({'id':optionValue, 'name': optionText,'folderid':Folderid});
                            
                            //remove from list
                            //$('#ex_list_to option[value=' + optionValue + ']').remove();
                }
                
                var assigned = patientData['data']['assingedexercies'];
                console.log('assigned', assigned);
                var assignedlength = assigned.length;
                for (var i = 0; i < assignedlength; i++) {
                    var optionValue = assigned[i]['id'];
                    var optionText = assigned[i]['name'];
                    var Folderid = assigned[i]['folderid'];
                    var Type = assigned[i]['type'];
                   
                   var appen_html = '<label class="label label-info" style=" margin-right:5px">' +
                            '<button type="button" style="padding-left:5px;" class="close btnRemoveExc" data-id="' + optionValue + '" data-folderid="' + Folderid + '" data-text="' + optionText + '" data-type="'+Type+'">&times;</button>' +
                            '<span style="line-height: 30px;">' + optionText + '</span>' +
                            '<input type="hidden" name="exercises[]" class="exercises" value="' + optionValue + '"/>' +
                            '</label>'; 
                    $('.assignes_ex_div').append(appen_html);
                    
                    //remove from list
                    //$('#ex_list_to option[value=' + optionValue + ']').remove();
                }
                console.log('Model open');  
                setTimeout(function () {
                        $('#exgeneral_list_to').select2({
                        dropdownParent: $('#responsiveUserdetails')
                    }); 
                    
                }, 300);
                setTimeout(function () {
                        $('#exclient_list_to').select2({
                        dropdownParent: $('#responsiveUserdetails')
                    }); 
                    
                }, 300); 
                
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
    $('#responsiveUserdetails').on('hidden.bs.modal', function () {
        $('.has-error').children('p').remove('p');
        $('.has-error').removeClass('has-error');
    });
    $(document).on('click', '.btnaddselectex', function () {
        //get selected items
        $(".ex_list_to option:selected").each(function () {
            var optionValue = $(this).val();
            var optionText = $(this).text();
           
            console.log("optionText", optionText);
            //alert($(this).parent().attr('id'))
            if($(this).parent().attr('id')=='exclient_list_to')
            {
                $type='client';
            }else{$type='general';}
            // collect all values
            var appen_html = '<label class="label label-info" style=" margin-right:5px">' +
                    '<button type="button" style="padding-left:5px;" class="close btnRemoveExc" data-type="'+$type+'" data-id="' + optionValue + '" data-folderid="' + Folderid + '" data-text="' + optionText + '">&times;</button>' +
                    '<span style="line-height: 30px;">' + optionText + '</span>' +
                    '<input type="hidden" name="exercises[]" class="exercises" value="' + optionValue + '"/>' +
                    '</label></div>';
            $('.assignes_ex_div').append(appen_html);
             var Folderid = $(this).attr('data-folderid');
            //remove this option
            $(this).remove();
        });

    });
    $(document).on('click', '.btnRemoveExc', function () {
    $patientid=$('.patientid').val();
    $this=$(this);
    var id = $(this).attr('data-id');
    var text = $(this).attr('data-text');
     var type = $(this).attr('data-type');
    //$patientid= $(this).attr('data-folderid');
    $("#ExerciseWarning p").html("Which action you want to perform for <strong>" + text + "</strong>?");
    $('#ExerciseWarning').find('.deleteroutine').attr('data-folderid',$patientid)
    $('#ExerciseWarning').find('.deleteroutine').attr('data-exerciseid',id)
    $('#ExerciseWarning').find('.deleteroutine').attr('data-type',type)
    $('#ExerciseWarning').find('.deleteroutine').attr('data-text',text)
    $('#ExerciseWarning').find('.editroutine').attr('href',base_url+'admin/exercises/detail/'+id+'?origin=client&patient_id='+$patientid)
    $('#ExerciseWarning').modal('show');

    }); 
    
  $(document).on('click', '.deleteroutine', function () {
      
    $this=$(this);
    var objectid = $this.attr('data-exerciseid');
    var folderid = $this.attr('data-folderid');
    var optionText = $this.attr('data-text');
     $.ajax({
            type: 'POST',
            url: base_url + 'admin/patients/deleteassignedExrecise/' + objectid,
            data:{'clientid':folderid},
            success: function (deleteAction) {
                $('.btnRemoveExc').each(function () {
                if($(this).attr('data-id')==objectid)
                    $(this).parent('.label').remove()
              });
              
             
             if($this.attr('data-type')=='client')
             {
                 $('#exclient_list_to').append('<option value="'+objectid+'" data-folderid="'+folderid+'" title="' + optionText + '" >'+optionText+'</option>');
             }else{$('#exgeneral_list_to').append('<option value="'+objectid+'" data-folderid="'+folderid+'"  title="' + optionText + '" >'+optionText+'</option>');}
           
              $('#ExerciseWarning').modal('hide');
            },
            error: function (data) {
                console.log(data);
            }
        });

    }); 
    
    
$('#myModal').on('hidden.bs.modal', function (e) {
  // do something...
})
// $(".toggle-sidebar").click()

<?php
  if($userid!='')
  { ?>
    $userid='#<?php echo "patient-".$userid ?>';
    $($userid).find('.btnPatientDetails').trigger('click');
  <?php
    }
  ?> 

</script>
<style type="text/css">
    .modal-dialog{
        overflow-y: initial !important
    }
    .imagestyle{
        width: 100px; 
        height: 100px; 
        margin-right: 20px;
    }
    .ml10{
        margin-left: 10px;
    }
    #mailto {
    font-size: 250%;
    }

</style>