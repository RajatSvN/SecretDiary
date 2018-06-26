
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <script type="text/javascript">
  var Text2="Enter your username and password!";
  var Text1="Interested? Sign up now!";
  $("#link").click(function(){
    if($("#togglepara").html()==Text1){
	$("#togglepara").html(Text2);
	$("#butn").html("LOGIN");
	$("#link").html("Sign Up");
	$(".initial").hide();
	$(".hidden").show();
	document.getElementById("myForm").method = "get";
    $("#errorDiv").html("");
       $("#errorDiv").hide();
	}else if($("#togglepara").html()==Text2){
	$("#togglepara").html(Text1);
	$("#butn").html("Sign Up");
	$("#link").html("LOGIN");
	$(".hidden").hide();
	$(".initial").show();
	document.getElementById("myForm").method = "post";
        $("#errorDiv").html("");
           $("#errorDiv").hide();
	}
  });
      if($("#errorDiv").html()!=""){
        $("#errorDiv").show();}
        else{
          $("#errorDiv").hide();
        }
   $("#userInput").bind('input propertychange', function() {
$.ajax({
  type: "POST",
  url: "updatedatabase.php",
  data: {content : $("#userInput").val()}
  
});
     
});
      $("#userInput").height($(window).height()-$(".navbar").height());
 </script>
  </body>
</html>