
<form id="frmSendMsg" name="frmSendMsg" method="post" >
  <div class="modal-body ">
        <div class="form-group">
           <label for="inputEmail3" class="col-md-3 col-lg-3 col-xs-12 col-sm-12 control-label ">Subject</label>
           <div class="col-md-8 col-lg-8  col-xs-12 col-sm-12">  
             
            <input type="text" class="form-control" name="txtMsgTitle" id="txtMsgTitle" value="" >
        </div></div></div>

     <div class="modal-body ">
        <div class="form-group">
           <label for="inputEmail3" class="col-md-3 col-lg-3 col-xs-12 col-sm-12 control-label " > Message</label>
           <div class="col-md-8 col-lg-8  col-xs-12 col-sm-12">  
             
            <textarea class="form-control" name="txtMsgText" id="txtMsgText" rows="8" ></textarea>
        </div></div>
      </div>

        <input type="hidden" name="action" value="send-message" >
<div class="modal-footer" style="border:none;">
  <div class="row">
    <div class="col-lg-12 text-center" style="margin-top: 40px;">
        <button type="submit" align = "center" id="btnSendMsg" class="btn btn-default">Submit</button>
         <button type="reset" align = "center" class="btn btn-default">Reset</button>
   </div>
  </div>
 </div>        