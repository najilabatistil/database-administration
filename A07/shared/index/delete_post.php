<div class="modal" tabindex="-1" id="deleteModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Post?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>This action will remove your post from your profile and cannot be undone.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form method="post">
          <input type="hidden" value="<?php echo $post['postID']?>" name="postID">
          <button class="btn btn-danger" type="submit" name="btnDelete">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>