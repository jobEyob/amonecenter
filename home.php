<?php
// include($_SERVER['DOCUMENT_ROOT'] . 'master/header.php');
include_once ('master/header.php');
?>
<!--  -->
<body>
  <div class="container ">
    <div class="jumbotron">


      <div class="row">
        <div class="col-sm-4">

        </div>
        <div class="col-sm-6">
          <h3>ተመዝገብው የሚገኙ ኢንተርፕራይዞች </h3>

          <form class="form-inline" action="/action_page.php">
            <input class="form-control mr-sm-2" type="text" placeholder="Search..">
            <button class="btn btn-success" type="submit">Search</button>
          </form>
        </div>
        <div class="col-sm-2">

        </div>

      </div>
     </div>
    </div>


  <div class="container bg-secondary text-white text-center ">
  <h3>ምን ምን ሰራን</h3><br>
  <div class="row">
    <div class="col-sm-4">
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
      <p>Current Project</p>
    </div>
    <div class="col-sm-4">
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
      <p>Project 2</p>
    </div>
    <div class="col-sm-4">
      <div class="well">
       <p>Some text..</p>
      </div>
      <div class="well">
       <p>Some text..</p>
      </div>
    </div>
  </div>
  </div><br>
</body>

<?php include 'master/footer.php'; ?>
