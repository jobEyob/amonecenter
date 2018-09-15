
/**************************
kits3.php to add and remove Form ********************************************
****************************/

$(document).ready(function(){
    //group add limit
    var maxGroup = 6;

    //add more fields group
    $(".addMore").click(function(){
        // $('form').find("#me").css( "color", "red" );
        if($('fieldset').find(".eyob-group").length < maxGroup){
            var fieldHTML = '<div class="eyob-group fieldeyob" >'+$(".fieldeyobcopy").html()+'</div>';
            $('fieldset').find('.eyob-group:last').after(fieldHTML);
        }else{
            alert('Maximum '+maxGroup+' groups are allowed.');
        }
    });

    //remove fields group
    $("body").on("click",".remove",function(){
        $(this).parents(".eyob-group").remove();
    });
});
/************************
\ This for next and previous
*************************/
// for next
function next_step1() {
        document.getElementById("first").style.display = "none";
        document.getElementById("second").style.display = "block";

    }
    //Function that executes on click of first previous button
 function prev_step1() {
     document.getElementById("first").style.display = "block";
     document.getElementById("second").style.display = "none";

 }

 /**********************************
  login.php  is for forgot password   *******************************************
  **********************************/
  $(document).ready(function () {
      $('.forgot-pass').click(function(event) {
        $(".pr-wrap").toggleClass("show-pass-reset");
      });

      $('.pass-reset-submit').click(function(event) {
        $(".pr-wrap").removeClass("show-pass-reset");
      });
  });


/*************************
     this js for admin sidebar to toggle sidebar  *********************************
*************************/

// $(document).ready(function () {
//     $('#sidebarCollapse').on('click', function () {   movide to footer.php
//         $('#sidebar').toggleClass('active');
//     });
// });
