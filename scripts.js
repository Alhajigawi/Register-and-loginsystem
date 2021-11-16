function triggerClick(e) {
    document.querySelector('#profileImage').click();
  }
  function displayImage(e) {
    if (e.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e){
        document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
      }
      reader.readAsDataURL(e.files[0]);
    }
  }
  
  $(document).ready(function (e) {

    $("#reg-form").submit(function (event) {
        let $password = $("#password");
        let $confirm = $("#cpassword");
        let $error = $("#confirm_error");
        if($password.val() === $confirm.val()){
            return true;
        }else{
            $error.text("Password not Match");
            event.preventDefault();
        }
    });
  });