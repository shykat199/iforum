<div class="modal fade" id="loginmodal" tabindex="-1" aria-labelledby="loginmodalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginmodalLabel">LogIn</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
<!--  <?php #$_SERVER['REQUEST_URI'] ?>-->    
  
      <div class="modal-body">
        <form action="logprocess.php" method="POST">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" name="loginEmail" id="loginEmail" aria-describedby="emailHelp">

          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="loginPass" id="loginPass">
          </div>
          <button name="login" id="login" type="submit" class="btn btn-primary">Login</button>
        </form>
      </div>
    </div>
  </div>
</div>