

<link href="./css/signin.css" rel="stylesheet"/>

<style>
#back{
  position: absolute;
  top: 0;
  left: 0;
  min-width: 100%;
background-size: cover;



  height:500px; background-image:url(./img/back.png);
}
</style>
    <div id="back">

    <div class="container marketing">

<br><br><br><br>
<br />
<br />
	<h2 class="form-signin-heading"><img src="./img/single.png" width="411"></h2><br>
<div align="center">
    <div class="container">
      <form action="./upload.php?type=F" method="POST" enctype="multipart/form-data" class="form-signin">
	<div class="input-group">
	  <span class="input-group-btn">
	    <span class="btn btn-primary" onclick="$(this).parent().find('input[type=file]').click();">File Upload</span>
	    <input name="rec" onchange="$(this).parent().parent().find('.form-control').html($(this).val().split(/[\\|/]/).pop());" style="display: none;" type="file">
	  </span>
	  <span class="form-control"></span>
	</div>
	<br>
        <label for="inputPassword" class="sr-only">E-mail</label>
        <input type="text" size="25" name="email" class="form-control" placeholder="email" required autofocus><br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Upload</button>
      </form>
    </div>
</div>

</div>

