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
	<h2 class="form-signin-heading"><img src="./img/multi.png" width="400"></h2><br>
<div align="center">
    <div class="container">
      <form action="./file_rec.php" method="post" enctype="multipart/form-data" class="form-signin">
	<div class="input-group">
	  <span class="input-group-btn">
	    <span class="btn btn-primary" onclick="$(this).parent().find('input[type=file]').click();">Rec List</span>
	    <input name="rec_list" onchange="$(this).parent().parent().find('.form-control').html($(this).val().split(/[\\|/]/).pop());" accept=".xls" style="display: none;" type="file">
	  </span>
	  <span class="form-control"></span>
	</div>
	<div class="input-group">
	  <span class="input-group-btn">
	    <span class="btn btn-primary" onclick="$(this).parent().find('input[type=file]').click();">Rec File(zip)</span>
	    <input name="rec_file" onchange="$(this).parent().parent().find('.form-control').html($(this).val().split(/[\\|/]/).pop());" accept=".zip" style="display: none;" type="file">
	  </span>
	  <span class="form-control"></span>
	</div>
	<br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Upload</button>
      </form>
    </div>
</div>

</div>
