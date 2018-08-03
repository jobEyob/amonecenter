<?php include_once '../master/header.php';  ?>
<?php
  if (Input::exists()) {
   $validate = new Validate();
  $validation = $validate->check($_POST, array(
    'entname' => array(
      'required' => true,
      'min' => 2
    )
  ));

  if ($validate->passed()) {
    echo "sucsse";
  }else {
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
            <div class="col-sm-2">
              <h1>review

            </div>
      <div class="col-sm-9">
    <form id="kits3" action=" " method="post" >
        <div class="card">
          <fieldset id="first">
            <div class="card-header text-center"><h5>ኢንተርፕራይዞችን መመዝገብያ ቅጽ 003 </h5></div>
            <div class="card-body">

                <div class="form-group row">
                  <label for="name" class="col-sm-3 col-form-label">የኢንተርፕራይዙ ስም</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="entname" id="name" placeholder="የኢንተርፕራይዙ ስም" value="">
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label for="inputzone">ዞን</label>
                    <input type="text" class="form-control" id="inputzone" placeholder="ዞን">
                  </div>
                  <div class="form-group col-md-5">
                    <label for="inputworeda">ወረዳ</label>
                    <input type="text" class="form-control" id="inputworeda" placeholder="ወረዳ">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="inputketema">ከተማ/ክፍለ ከተማ</label>
                    <select class="custom-select mr-sm-2" id="inputketema">
                      <option selected>ምረጥ...</option>
                      <option value="1">ሲቀላ</option>
                      <option value="2">ሰቻ</option>
                      <option value="3">አባያ</option>
                      <option value="3">ኔጭ ሳር </option>
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
                  <input type="text" class="form-control" placeholder="ቀበሌ">
                </div>
                <div class="col">
                  <label for="inputhomeno">የቤት ቁጥር</label>
                  <input type="text" class="form-control" placeholder="የቤት ቁጥር">
                </div>
                <div class="col">
                  <label for="inputphoneno">ስልክ ቁጥር</label>
                  <input type="text" class="form-control" placeholder="ስልክ ቁጥር">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputyear">የተመሠረተበት ዘመን (ዓ.ም)</label>
                  <input type="text" class="form-control" id="inputzone" placeholder="የተመሠረተበት ዘመን (ዓ.ም)">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputketema">የተሰማራበት ዘርፍ</label>
                  <select class="custom-select mr-sm-2" id="inputketema">
                    <option selected>ምረጥ...</option>
                    <option value="1">ማኑፋክቸሪንግ</option>
                    <option value="2">ኮንስትራክሽን</option>
                    <option value="3">አገልግሎት</option>
                    <option value="3">ከተማ ግብርና</option>
                    <option value="3">ንግድ</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputworkarea" class="col-sm-3 col-form-label">የተሰማራት የሥራ መስክ</label>
                <div class="col-sm-9">
                  <input type=" " class="form-control" id="inputworkarea" placeholder="የተሰማራት የሥራ መስክ">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputworktype" class="col-sm-3 col-form-label">የኢንተርፕራይዙ ዓይነት ነትርጓሜ </label>
                <div class="col-sm-9">
                  <select class="custom-select mr-sm-2" id="inputworktype">
                    <option selected>ምረጥ...</option>
                    <option value="1">ጥቃቅን</option>
                    <option value="2">አነስተኛ</option>
                    <option value="3">ታ/መካከለኛ</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputgoruptype" class="col-sm-3 col-form-label">የአደረጃጀት ዓይነት</label>
                <div class="col-sm-9">
                  <select class="custom-select mr-sm-2" id="inputworktype">
                    <option selected>ምረጥ...</option>
                    <option value="1">በግል</option>
                    <option value="2">በንግድ ማህበር/በህ/ሴ/ማ</option>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputtaxno">የግብር ከፋይነት መለያ ቁጥር</label>
                  <input type=" " class="form-control" id="inputtaxno" placeholder="የግብር ከፋይነት መለያ ቁጥር ..">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputketema">የዕድገት ደረጃ</label>
                  <select class="custom-select mr-sm-2" id="inputketema">
                    <option selected>ምረጥ...</option>
                    <option value="1">አነስ/ጀማሪ</option>
                    <option value="3">አነስ/ታዳጊ</option>
                    <option value="2">ጥ/ታዳጊ</option>
                    <option value="3">ጥ/መብቃት</option>

                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputcaptal">መነሻ ጠቅላላ የሃብት መጠን</label>
                  <input type="" class="form-control" id="inputcaptal" placeholder="የመነሻ ጠቅላላ የሃብት መጠን ..">
                </div>
                <div class="form-group col-md-6">
                  <label for="manysours">የገንዘብ ምንጭ</label>
                  <select class="custom-select mr-sm-2" id="manysours">
                    <option selected>ምረጥ...</option>
                    <option value="1">ከራስ ተቀማጭ</option>
                    <option value="3">ከቤተሰብ</option>
                    <option value="2">ብድር</option>

                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputcurentcaptal" class="col-sm-3 col-form-label">ወቅታዊ ጠቅላላ ሃብት መጠን</label>
                <div class="col-sm-9">
                  <input type="" class="form-control" id="inputcurentcaptal" placeholder="ወቅታዊ ጠቅላላ ሃብት መጠን ..">
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
          **********  -->
          <div class="eyob-group fieldeyob" >

          <div class="card w-70" style="margin-left:30px" > <!-- Insid cared begin  -->
            <div class="card-body"> <!-- Insid cared body begin  -->

              <div class="form-row">
                <div class="col-4">
                  <label for="firstname">ስም</label>
                  <input type="text" class="form-control" placeholder="የግለሰቡ/ቡዋ ስም">
                </div>
                <div class="col">
                  <label for="midlename">የአባት ስም</label>
                  <input type="text" class="form-control" placeholder="የአባት ስም ">
                </div>
                <div class="col">
                  <label for="lastname">የአያት ስም</label>
                  <input type="text" class="form-control" placeholder="የአያት ስም ..">
                </div>
              </div>
              <!--  --><br>
              <div class="form-row">
                <div class="col-1">
                  <label for="gender" class="text-left" >ፆታ</label>
                </div>
                <div class="col-2">

                  <select class="custom-select mr-sm-2" id="gender">
                    <option selected>ምረጥ...</option>
                    <option value="1">ሴት</option>
                    <option value="3">ወንድ</option>
                    <option value="2">አይታወቅም</option>
                  </select>
                </div>
                <div class="col-1">
                  <label for="age">ዕድመ</label>
                </div>
                <div class="col-2">
                  <input  class="form-control" placeholder="ዕድመ" >
                </div>
              </div>
              <!-- end --> <br>
              <div class="form-row">
                <label for="eduationlevel" class="col-sm-2 col-form-label">የትም/ደረጃ</label>
                <div class="col-sm-6">
                  <select class="custom-select mr-sm-2" id="eduationlevel">
                    <option selected>ምረጥ...</option>
                    <option value="1">ማንበብና መፃፍ የማይችሉ</option>
                    <option value="2">አንደኛ ደረጃ(1-8)</option>
                    <option value="3">ሁለተኛ ደረጃ(9-12)</option>
                    <option value="4">ኮሌጅ ወይም ዩኒቨርሲቲ ያጠናቀቀ</option>
                  </select>
                </div>
              </div>
              <br>
              <div class="form-row">
                <label for="eduationlevel" class="col-sm-2 col-form-label"> የግለሰቡ/ቡዋ ፎቶግራፍ </label>
                <div class="col-sm-6">
                  <input  class="form-control" type="file" placeholder="" >
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
        <!--***********
        copy of uper form bigen
           ************  -->
           <div class="eyob-group fieldeyobcopy"  style="display: none;">

           <div class="card w-70" style="margin-left:30px" > <!-- Insid cared begin  -->
             <div class="card-body"> <!-- Insid cared body begin  -->

               <div class="form-row">
                 <div class="col-4">
                   <label for="firstname">ስም</label>
                   <input type="text" class="form-control" placeholder="የግለሰቡ/ቡዋ ስም">
                 </div>
                 <div class="col">
                   <label for="midlename">የአባት ስም</label>
                   <input type="text" class="form-control" placeholder="የአባት ስም ">
                 </div>
                 <div class="col">
                   <label for="lastname">የአያት ስም</label>
                   <input type="text" class="form-control" placeholder="የአያት ስም ..">
                 </div>
               </div>
               <!--  --><br>
               <div class="form-row">
                 <div class="col-1">
                   <label for="gender" class="text-left" >ፆታ</label>
                 </div>
                 <div class="col-2">

                   <select class="custom-select mr-sm-2" id="gender">
                     <option selected>ምረጥ...</option>
                     <option value="1">ሴት</option>
                     <option value="3">ወንድ</option>
                     <option value="2">አይታወቅም</option>
                   </select>
                 </div>
                 <div class="col-1">
                   <label for="age">ዕድመ</label>
                 </div>
                 <div class="col-2">
                   <input  class="form-control" placeholder="ዕድመ" >
                 </div>
               </div>
               <!-- end --> <br>
               <div class="form-row">
                 <label for="eduationlevel" class="col-sm-2 col-form-label">የትም/ደረጃ</label>
                 <div class="col-sm-6">
                   <select class="custom-select mr-sm-2" id="eduationlevel">
                     <option selected>ምረጥ...</option>
                     <option value="1">ማንበብና መፃፍ የማይችሉ</option>
                     <option value="2">አንደኛ ደረጃ(1-8)</option>
                     <option value="3">ሁለተኛ ደረጃ(9-12)</option>
                     <option value="4">ኮሌጅ ወይም ዩኒቨርሲቲ ያጠናቀቀ</option>
                   </select>
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
        <!--**** the end of copy Form  -->
        </div>
        <div class="card-footer bg-secondary">

          <div class="form-row"> <!-- this for to  next form  -->
            <div class="col">
         <button type="button" class="btn btn-primary" onclick="prev_step1()" >Previous</button>
            </div>
            <div class="col-8">

            </div>
            <div class="col">
         <button type="submit" class="btn btn-info" > submit</button>
            </div>
          </div>
        </div>
      </fieldset>

     </div>  <!-- main card end -->
     </form>  <!-- form end -->
    </div> <!-- col end  -->
            <div class="col-sm-1">
            </div>
         </div>
         <br>
      </div>
   </body>
<?php include_once '../master/footer.php';  ?>
