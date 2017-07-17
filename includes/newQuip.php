  <!-- Modal Structure -->
  <div id="modal1" class="modal bottom-sheet" style="height:100%;">
      <nav>
        <div class="nav-wrapper bknd-blue container-fluid">
          <h1 class="brand-logo center" style="padding-top: 15px; font-size:20px;">New Quip</h1>
          <a id="closeNewQuip" class="right text-blue-light modal-close" style="padding-right:15px;"><i class="material-icons">clear</i></a>
        </div>
      </nav>  
     <div class="row">
      <form id="createNewQuip" class="col s12" method="POST" action="index.php"  enctype="multipart/form-data">
        <div class="row">
          <div class="input-field col s12">
            <input name="title" id="quipTitle" type="text" maxlength="75">
            <label for="quipTitle">Quip Title</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s6">
            <input type="date" class="datepicker" name="date">
            <label for="date">Date</label>
          </div>
           <div class="input-field col s2">
    <select  id="timeHour" onchange="checkTime()" name="timeHour">
      <option value="Any Time">Any Time</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7" selected>7</option>
      <option value="8">8</option>
      <option value="9">9</option>
      <option value="10">10</option>
      <option value="11">11</option>
      <option value="12">12</option>
    </select>
    <label>Time</label>
  </div>
  <div class="input-field col s4">
    <select name="time12Hour" id="time12Hour">
      <option value="AM">AM</option>
      <option value="PM" selected>PM</option>
      <option value="" >N/A</option>

    </select>
    
  </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <textarea name="desc" id="textarea1" class="materialize-textarea no-padding" maxlength="300" length="300"></textarea>
            <label for="textarea1">Description</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12 no-margin">
            <p class="no-margin">Use Custom Location?</p>
            <p style="font-size: 14px; ">Quobol will automatically create this event at your current location.  If you would like this event to be visible somewhere else, check the box and supply a different location. </p>
             <p>
                <input type="checkbox" id="customLocation" name="useCustomLocation" />
                <label for="customLocation">Use Different Location</label>
                
             </p>
          </div>
        </div>
        <!-- only visible if #customLocation is checked -->
        <div class="row" id="customLocationHiddenField">
          <div class="input-field col s12">
            <input name="electingToUseCustomLocation" id="customLocationInput" type="text" >
            <label for="customLocationInput">Location</label>
          </div>
        </div>

        <div class="row">

          <div class="file-field input-field" style="padding: 20px 10px 10px 10px;">
            <div class="waves-effect waves-light waves-ripple btn-flat bknd-blue white-text col s3 l1">
              <span>Image</span>
              <input type="file" style="text-align:center;" name="addImage">
            </div>
          

          <div class="file-path-wrapper left col s9 l11">
            <input class="file-path validate"  type="text">
          </div>
        </div>

        </div><!-- end file picker-->


        <br>
        <div class="modal-footer">
    <button name="createNewQuip" class="waves-effect waves-light waves-ripple btn-flat bknd-blue white-text" onclick="submitQuip()">Submit</button>
  </div>
      </form>

    </div>

</div>
<script type="text/javascript">
  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });

     $(document).ready(function() {
        $('select').material_select();

        function submitQuip(){
          $('#createNewQuip').submit();
        }
        
  });
         
</script>
<?php
     //execute on submit new post
  if (isset($_POST['createNewQuip'])) {
    EventManage::addEvent($link, $lat, $lng, $user);
  }
?>

