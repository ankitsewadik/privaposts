<div class="modal modal-sec modal-pop-edit-post fade" id="pop-edit-post" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"> <img src="/wp-content/themes/twentysixteen/assets/images/close-gal.png" alt="Shape-1" width="30px"> </button>
                <!-- <h4 class="modal-title" style="">Edit Post</h4> -->       
            </div>
            <div class="modal-body">
                <span id="error_msg"></span>
                <h3 class="text-center">Edit Post</h3>
                <div class="pop-form">
                    <form id="edit_post" name="edit_post" method="post" action="" onsubmit="return false;">
                        <div class="fl-text-bx form-group">
                            <textarea class="form-control" id="description2" name="description" class="required"></textarea>
                            <input type="hidden" name="postid" id="postid" value="">
                        </div>
                </div>
            </div>
            <div class="bottom-fot">
                <div class="btns clearfix">
                    <button type="button" class="btn btn-default cancel blue-btn-hover" data-dismiss="modal">Close</button>
                    <button type="submit" class=" btn btn-default save blue-btn-hover" id="update-post">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>