<?php include_once '../master/header.php';

$user =new User();
if(!$user->isLoggendIn()){
    Redirect::to('../index.php');
}

?>
<?php
  if (Input::exists()) {
   $validate = new Validate();
  $validation = $validate->check($_POST, array(
    'entname' => array(
      //'required' => true,
    //  'min' => 2,
    // 'unique' => 'Enterprises'
    )
    // ,
    // 'zone' => array(
    //   'required' => true,
    //   'min' => 2
    // ),
    // 'woreda' => array(
    //   'required' => true,
    //   'min' => 2
    // ),
    // 'ketema' => array(
    //   'required' => true,
    //   'min' => 2
    // ),
    // 'kebele' => array(
    //   'required' => true,
    //   'min' => 2
    // ),
    // 'homeNo' => array(
    //   'required' => true,
    //   'min' => 2
    // ),
    // 'phoneNo' => array(
    //   'required' => true,
    //   'min' => 2
    // ),
    // 'Fyear' => array(
    //   'required' => true,
    //   'min' => 2
    // ),
    // 'zerif' => array(
    //   'required' => true,
    //   'min' => 2
    // ),
    // 'workarea' => array(
    //   'required' => true,
    //   'min' => 2
    // ),
    // 'worktype' => array(
    //   'required' => true,
    //   'min' => 2
    // ),
    // 'goruptype' => array(
    //   'required' => true,
    //   'min' => 2
    // ),
    // 'TINno' => array(
    //   'required' => true,
    //   'min' => 2
    // ),
    // 'Glevel' => array(
    //   'required' => true,
    //   'min' => 2
    // ),
    // 'initialcaptal' => array(
    //   'required' => true,
    //   'min' => 2
    // ),
    // 'manysource' => array(
    //   'required' => true,
    //   'min' => 2
    // ),
    // 'curentcaptal' => array(
    //   'required' => true,
    //   'min' => 2
    // )
  ));

  if ($validate->passed()) {
    ///echo "sucsse";
    $user = new User();
    $db = DB::getInstance();
    try {

      $user->create('Enterprises', array(
        'entname' =>Input::get('entname'),
        'ent_found_year' =>Input::get('Fyear'),
        'ent_tin' =>Input::get('TINno'),
        'ent_growth_level' =>Input::get('Glevel'),
        'ent_mesk' =>Input::get('workarea')
      ));

     $last = $user->lasteinsertedID();
    // print_r($last);
     $user->create('Ent_address', array(
       'zone' =>Input::get('zone'),
       'woreda' =>Input::get('woreda'),
       'kifle_ketema' =>Input::get('ketema'),
       'kebele' =>Input::get('kebele'),
       'home_no' =>Input::get('homeNo'),
       'phone_no' =>Input::get('phoneNo'),
       'ent_id' =>$last
     ));

     // Tabel name Ent_asset
     $user->create('Ent_asset', array(
       'insal_capetal' =>Input::get('initialcaptal'),
       'capetal_source' =>Input::get('manysource'),
       'curent_capetal' =>Input::get('curentcaptal'),
       'ent_id' =>$last
     ));
     // Tabel name Ent_organized_type
     $user->create('Ent_organized_type', array(
       'org_type_name' =>Input::get('goruptype'),
       'ent_id' =>$last
     ));
     // Tabel name-> Ent_type_meaning :: input->የኢንተርፕራይዙ ዓይነት ነትርጓሜ
     $user->create('Ent_type_meaning', array(
       'type_name' =>Input::get('worktype'),
       'ent_id' =>$last
     ));
     // Tabel name Ent_zerif :: input->የተሰማራበት ዘርፍ
     $user->create('Ent_zerif', array(
       'zerif_name' =>Input::get('zerif'),
       'ent_id' =>$last
     ));

      // የማህበሩ አባላት
      if(Input::getfile("submit_to"))
         {

            $photoArr =$_FILES['photos']['name'];
            $file_locArr = $_FILES['photos']['tmp_name'];
            //
            $photoArr2 =$_FILES['idcard']['name'];
            $file_locArr2 = $_FILES['idcard']['tmp_name'];

            if (!empty($photoArr)) {
              for ($i=0; $i < count($photoArr) ; $i++) {
                  if (!empty($photoArr[$i])) {

                     $file = rand(1000,100000)."-".$photoArr[$i];
                     $file_loc = $file_locArr[$i];
                     //
                     $file2 = rand(1000,100000)."-".$photoArr2[$i];
                     $file_loc2 = $file_locArr2[$i];

                     $folder=$_SERVER['DOCUMENT_ROOT']. '/amonecenter/File/uploads/';
                     $new_file_name = strtolower($file);
                     $new_file_name2 = strtolower($file2);
                     // make file name in lower case

                     $final_file=str_replace(' ','-',$new_file_name);
                     move_uploaded_file($file_loc,$folder.$final_file);
                     //
                     $final_file2=str_replace(' ','-',$new_file_name2);
                     move_uploaded_file($file_loc2,$folder.$final_file2);

                     $photo[]  = $new_file_name; //stor photo neame in array:: accessing it by for() loop
                     $photo2[] = $new_file_name2;
                    // echo "pho = :".$photo."<br>";

                  }
              }
            }

         }

       // print_r($photo); // echo "<br>"; // print_r($photo2);

      $FnameArr = Input::get('firstname');
      $MnameArr = Input::get('midlename');
      $LnameArr = Input::get('lastname');
      $genderArr = Input::get('gender');
      $ageArr = Input::get('age');
      $edulevelArr = Input::get('eduationlevel');
      //print_r($edulevelArr);

      if (!empty($FnameArr)) {
            for ($i=0; $i < count($FnameArr); $i++) {  // count by firstname
                    if(!empty($FnameArr[$i])){

                    // $firstname  = $FnameArr[$i];
                    // $midletname = $MnameArr[$i];
                    // $lastname   = $LnameArr[$i];
                    // $photo      = $photo[$i];
                    // $idcard     = $photo2[$i];

                    $user->create('Ent_owner', array(
                      'firstname' => $FnameArr[$i],
                      'midlename' =>  $MnameArr[$i],
                      'lastname'  => $LnameArr[$i],
                      'gender'  => $genderArr[$i],
                      'age'  => $ageArr[$i],
                     'education_level'  => $edulevelArr[$i],
                      'photo'  => $photo[$i],
                      'id_card'  => $photo2[$i],
                      'ent_id' =>$last
                    ));

                 }
          }
      }

      Session::flash('success', "registeration successfully");
      header('location: tests.php');

    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
  else {
    print_r($validate->errors());
  }
}
 ?>

              <style>
               /* #kits3 fieldset {
                 display: none;
               } */
               #second {
               display:none;
           }
              </style>

      <div class="container">
         <br>

         <div class="row">
            <div class="col">

            </div>
      <div class="col-11">
    <form id="kits3" action=" " method="post" enctype="multipart/form-data" >
        <div class="card">
          <fieldset id="first">
            <div class="card-header text-center"><h5>ኢንተርፕራይዞችን መመዝገብያ ቅጽ 003 </h5></div>
            <div class="card-body">

                <div class="form-group row">
                  <label for="name" class="col-sm-3 col-form-label">የኢንተርፕራይዙ ስም</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="entname" id="name" placeholder="የኢንተርፕራይዙ ስም" value="<?php echo escape(Input::get('entname')); ?>" >
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="inputzone">ዞን</label>
                    <input type="text" class="form-control" name="zone" id="inputzone" placeholder="ዞን" value="<?php echo escape(Input::get('zone')); ?>" >
                  </div>
                  <div class="form-group col-md-5">
                    <label for="inputworeda">ወረዳ</label>
                    <input type="text" class="form-control" name="woreda" id="inputworeda" placeholder="ወረዳ" value="<?php echo escape(Input::get('woreda')); ?>" >
                  </div>
                  <div class="form-group col-md-4">
                    <label for="inputketema">ከተማ/ክፍለ ከተማ</label>
                    <select class="custom-select mr-sm-2" id="inputketema" name="ketema" >
                      <option selected>.......ምረጥ.....</option>
                      <option value="ሲቀላ">ሲቀላ</option>
                      <option value="ሰቻ">ሰቻ</option>
                      <option value="አባያ">አባያ</option>
                      <option value="ኔጭ ሳር">ኔጭ ሳር </option>
                    </select>
                    <!--  <select id="inputState" class="form-control" placeholder="ከተማ/ክፍለ ከተማ">
                    <option selected>ምረጥ...</option>
                    <option>...</option>
                  </select>  -->
                </div>
              </div>
              <div class="form-row">
                <div class="col-4">
                  <label for="inputkebele">ቀበሌ</label>
                  <input type="text" class="form-control" name="kebele" placeholder="ቀበሌ" value="<?php echo escape(Input::get('kebele')); ?>" >
                </div>
                <div class="col">
                  <label for="inputhomeno">የቤት ቁጥር</label>
                  <input type="text" class="form-control" name="homeNo" placeholder="የቤት ቁጥር" value="<?php echo escape(Input::get('homeNo')); ?>" >
                </div>
                <div class="col">
                  <label for="inputphoneno">ስልክ ቁጥር</label>
                  <input type="text" class="form-control" name="phoneNo" placeholder="ስልክ ቁጥር" value="<?php echo escape(Input::get('phoneNo')); ?>" >
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputyear">የተመሠረተበት ዘመን (ዓ.ም)</label>
                  <input type="text" class="form-control" id="datepicker" name="Fyear" placeholder="የተመሠረተበት ዘመን (ዓ.ም)"
                  autocomplete="off" value="<?php echo escape(Input::get('Fyear')); ?>" >
                </div>
                <div class="form-group col-md-6">
                  <label for="inputzerif">የተሰማራበት ዘርፍ</label>
                  <select class="custom-select mr-sm-2" id="inputzerif" name="zerif" >
                    <option selected>......ምረጥ.....</option>
                    <option value="ማኑፋክቸሪንግ">ማኑፋክቸሪንግ</option>
                    <option value="ኮንስትራክሽን">ኮንስትራክሽን</option>
                    <option value="አገልግሎት">አገልግሎት</option>
                    <option value="ከተማ ግብርና">ከተማ ግብርና</option>
                    <option value="ንግድ">ንግድ</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputworkarea" class="col-sm-3 col-form-label">የተሰማራት የሥራ መስክ</label>
                <div class="col-sm-9">
                  <input type=" " class="form-control" id="inputworkarea" name="workarea" placeholder="የተሰማራት የሥራ መስክ" value="<?php echo escape(Input::get('workarea')); ?>" >
                </div>
              </div>
              <div class="form-group row">
                <label for="inputworktype" class="col-sm-3 col-form-label">የኢንተርፕራይዙ ዓይነት ነትርጓሜ </label>
                <div class="col-sm-9">
                  <select class="custom-select mr-sm-2" id="inputworktype" name="worktype" >
                    <option selected>.....ምረጥ.....</option>
                    <option value="ጥቃቅን">ጥቃቅን</option>
                    <option value="አነስተኛ">አነስተኛ</option>
                    <option value="ታ/መካከለኛ">ታ/መካከለኛ</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputgoruptype" class="col-sm-3 col-form-label">የአደረጃጀት ዓይነት</label>
                <div class="col-sm-9">
                  <select class="custom-select mr-sm-2" id="inputgoruptype" name="goruptype" >
                    <option selected>.....ምረጥ.....</option>
                    <option value="በግል">በግል</option>
                    <option value="በንግድ ማህበር/በህ/ሴ/ማ">በንግድ ማህበር/በህ/ሴ/ማ</option>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputTINno">የግብር ከፋይነት መለያ ቁጥር</label>
                  <input type=" " class="form-control" id="inputTINno" name="TINno" placeholder="የግብር ከፋይነት መለያ ቁጥር ..">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputlevel">የዕድገት ደረጃ</label>
                  <select class="custom-select mr-sm-2" id="inputketema" name="Glevel" >
                    <option selected>....ምረጥ....</option>
                    <option value="አነስ/ጀማሪ">አነስ/ጀማሪ</option>
                    <option value="አነስ/ታዳጊ">አነስ/ታዳጊ</option>
                    <option value="ጥ/ታዳጊ">ጥ/ታዳጊ</option>
                    <option value="ጥ/መብቃት">ጥ/መብቃት</option>

                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputcaptal">መነሻ ጠቅላላ የሃብት መጠን</label>
                  <input type="" class="form-control" id="inputcaptal" name="initialcaptal" placeholder="የመነሻ ጠቅላላ የሃብት መጠን .." value="<?php echo escape(Input::get('initialcaptal')); ?>" >
                </div>
                <div class="form-group col-md-6">
                  <label for="manysource">የገንዘብ ምንጭ</label>
                  <select class="custom-select mr-sm-2" id="manysource" name="manysource">
                    <option selected>.....ምረጥ....</option>
                    <option value="ከራስ ተቀማጭ">ከራስ ተቀማጭ</option>
                    <option value="ከቤተሰብ">ከቤተሰብ</option>
                    <option value="ብድር">ብድር</option>

                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="curentcaptal" class="col-sm-3 col-form-label">ወቅታዊ ጠቅላላ ሃብት መጠን</label>
                <div class="col-sm-9">
                  <input type="" class="form-control" id="curentcaptal" name="curentcaptal" placeholder="ወቅታዊ ጠቅላላ ሃብት መጠን .." value="<?php echo escape(Input::get('curentcaptal')); ?>" >
                </div>
              </div>


          </div><!-- card body end -->

          <div class="card-footer bg-secondary">

            <div class="form-row"> <!-- this for to  next form  -->
              <div class="col-8">

              </div>
              <div class="col">

              </div>
              <div class="col">
                <button type="button" class="btn btn-primary" onclick="next_step1()" >next</button>
              </div>
            </div>
          </div>
          <br>
        </fieldset>
        <!-- ********************
        this secondary form
      *****************************-->

      <fieldset id="second">
        <div class="card-header">የማህበሩ አባላት</div>
        <div class="card-body" >
          <!-- ******
          @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ 111111111
          **********  -->
          <div class="eyob-group fieldeyob" >

          <div class=" w-70" style="margin-left:30px" > <!-- Insid cared begin  -->
            <div class=" "> <!-- Insid cared body begin  -->

              <div class="form-row">
                <div class="col-4">
                  <label for="firstname">ስም</label>
                  <input type="text" class="form-control" name="firstname[]" placeholder="የግለሰቡ/ቡዋ ስም"  >
                </div>
                <div class="col">
                  <label for="midlename">የአባት ስም</label>
                  <input type="text" class="form-control" name="midlename[]" placeholder="የአባት ስም "  >
                </div>
                <div class="col">
                  <label for="lastname">የአያት ስም</label>
                  <input type="text" class="form-control" name="lastname[]" placeholder="የአያት ስም .."  >
                </div>
              </div>
              <!--  --><br>
              <div class="form-row">
                <div class="col-1">
                  <label for="gender" class="text-left" >ፆታ</label>
                </div>
                <div class="col-2">

                  <select class="custom-select mr-sm-2" id="gender" name="gender[]" >
                    <option selected>....ምረጥ....</option>
                    <option value="ሴት">ሴት</option>
                    <option value="ወንድ">ወንድ</option>

                  </select>
                </div>
                <div class="col-1">
                  <label for="age">ዕድመ</label>
                </div>
                <div class="col-2">
                  <input  class="form-control" placeholder="ዕድመ" name="age[]"  >
                </div>
              </div>
              <!-- end --> <br>
              <div class="form-row">
                <label for="eduationlevel" class="col-sm-2 col-form-label">የትም/ደረጃ</label>
                <div class="col-sm-6">
                  <select class="custom-select mr-sm-2" id="eduationlevel" name="eduationlevel[]" >
                    <option selected>....ምረጥ....</option>
                    <option value="ማንበብና መፃፍ የማይችሉ">ማንበብና መፃፍ የማይችሉ</option>
                    <option value="አንደኛ ደረጃ(1-8)">አንደኛ ደረጃ(1-8)</option>
                    <option value="ሁለተኛ ደረጃ(9-12)">ሁለተኛ ደረጃ(9-12)</option>
                    <option value="ኮሌጅ ወይም ዩኒቨርሲቲ ያጠናቀቀ">ኮሌጅ ወይም ዩኒቨርሲቲ ያጠናቀቀ</option>
                  </select>
                </div>
              </div>
              <br>
              <div class="form-row">
                <label for="photo" class="col-sm-2 col-form-label"> የግለሰቡ/ቡዋ ፎቶግራፍ </label>
                <div class="col-sm-6">
                  <input  class="form-control" name="photos[]" type="file" placeholder="" >
                </div>
              </div>
              <br>
              <div class="form-row">
                <label for="idcard" class="col-sm-2 col-form-label"> የግለሰቡ/ቡዋ ID card </label>
                <div class="col-sm-6">
                  <input  class="form-control" name="idcard[]" type="file" placeholder="" >
                </div>
              </div>
              <div class="form-row"> <!-- this for align button to right  -->
                <div class="col-8">        </div>
                <div class="col">           </div>
                <div class="col">
                  <button type="button" class="btn btn-success btn-sm addMore">Add</button>
                </div>
              </div>

            </div><!-- Insid cared body end  -->
          </div><!-- Insid cared end  -->
        </div>

        </div>
        <div class="card-footer bg-secondary">

          <div class="form-row"> <!-- this for to  next form  -->
            <div class="col">
         <button type="button" class="btn btn-primary" onclick="prev_step1()" >Previous</button>
            </div>
            <div class="col-8">

            </div>
            <div class="col">
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
         <input type="submit"  class="btn btn-info" value="Submit" name="submit_to" >
            </div>
          </div>
        </div>
      </fieldset>

     </div>  <!-- main card end -->
     </form>  <!-- form end -->
    </div> <!-- col end  -->
            <div class="col">
            </div>
         </div>
         <br>
      </div>

      <!--***********
      copy of uper form  class="eyob-group fieldeyob"
      @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
            የማህበሩ አባላት   this copy is for adding form automaticl:: js - /js
         ************  -->
         <div class="eyob-group fieldeyobcopy"  style="display: none;">
            <hr> <hr>
         <div class=" w-70" style="margin-left:30px" > <!-- Insid cared begin  -->
           <div class=" "> <!-- Insid cared body begin  -->

             <div class="form-row">
               <div class="col-4">
                 <label for="firstname">ስም</label>
                 <input type="text" class="form-control" name="firstname[]" placeholder="የግለሰቡ/ቡዋ ስም"  >
               </div>
               <div class="col">
                 <label for="midlename">የአባት ስም</label>
                 <input type="text" class="form-control" name="midlename[]" placeholder="የአባት ስም "  >
               </div>
               <div class="col">
                 <label for="lastname">የአያት ስም</label>
                 <input type="text" class="form-control" name="lastname[]" placeholder="የአያት ስም .."  >
               </div>
             </div>
             <!--  --><br>
             <div class="form-row">
               <div class="col-1">
                 <label for="gender" class="text-left" >ፆታ</label>
               </div>
               <div class="col-2">

                 <select class="custom-select mr-sm-2" id="gender" name="gender[]" >
                   <option selected>....ምረጥ....</option>
                   <option value="ሴት">ሴት</option>
                   <option value="ወንድ">ወንድ</option>

                 </select>
               </div>
               <div class="col-1">
                 <label for="age">ዕድመ</label>
               </div>
               <div class="col-2">
                 <input  class="form-control" placeholder="ዕድመ" name="age[]"  >
               </div>
             </div>
             <!-- end --> <br>
             <div class="form-row">
               <label for="eduationlevel" class="col-sm-2 col-form-label">የትም/ደረጃ</label>
               <div class="col-sm-6">
                 <select class="custom-select mr-sm-2" id="eduationlevel" name="eduationlevel[]" >
                   <option selected>....ምረጥ....</option>
                   <option value="ማንበብና መፃፍ የማይችሉ">ማንበብና መፃፍ የማይችሉ</option>
                   <option value="አንደኛ ደረጃ(1-8)">አንደኛ ደረጃ(1-8)</option>
                   <option value="ሁለተኛ ደረጃ(9-12)">ሁለተኛ ደረጃ(9-12)</option>
                   <option value="ኮሌጅ ወይም ዩኒቨርሲቲ ያጠናቀቀ">ኮሌጅ ወይም ዩኒቨርሲቲ ያጠናቀቀ</option>
                 </select>
               </div>
             </div>
             <br>
            <div class="form-row">
               <label for="photo" class="col-sm-2 col-form-label"> የግለሰቡ/ቡዋ ፎቶግራፍ </label>
               <div class="col-sm-6">
                 <input  class="form-control" name="photos[]" type="file" placeholder="" >
               </div>
             </div>
             <br>
             <div class="form-row">
               <label for="idcard" class="col-sm-2 col-form-label"> የግለሰቡ/ቡዋ ID card </label>
               <div class="col-sm-6">
                 <input  class="form-control" name="idcard[]" type="file" placeholder="" >
               </div>
             </div>
             <div class="form-row"> <!-- this for align button to right  -->
               <div class="col-8">        </div>
               <div class="col">           </div>
               <div class="col">
                 <button type="button" class="btn btn-danger btn-sm remove">remove</button>
               </div>
             </div>

           </div><!-- Insid cared body end  -->
         </div><!-- Insid cared end  -->
       </div>
      <!--**** the end of copy Form @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
     -->

   </body>
<?php include_once '../master/footer.php';  ?>
