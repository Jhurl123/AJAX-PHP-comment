<!DOCTYPE html>

<!--Comment section made with php
-->





<html>
<?php include('comment.php');

if(!isset($conn)) {
			
			$comment = new Comment();
			$conn = $comment->dbConnect();
}
 ?>

<head>
<title>PHP comment section</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href ="commentStyle.css"> 


</head>


<body> 

<header> 

<div id="headMess">
<h1 id ="headLine">Blog post with comment section</h1></div>



</header>

<!--generic text to simulate blog post-->
<p id ="post">
orem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. 
Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. 
Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. 
Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. 
In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.
 Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula,
 porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
 Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. 
 Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus,
 sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, 
 hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae 
sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. 
Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
</p>




<?php

   $rowPerPage = 3;
    
   $query="SELECT count(*) as allCount FROM comment";
   $query2= $conn->prepare($query);
   $query2->execute();
   $allCount = $comment->getAll();
   $allCount = $allCount['0'];
    $commentList=$comment->getComment($rowPerPage);
   
   ?>
   
   
   
   
 <?php foreach($commentList as $post): ?>
		 
		 
<div class="wrap">

<img src="http://davidrhysthomas.co.uk/img/dexter.png" />
    <div class="comment">
	    <h2 class="owner"><?php echo $post['authorName']; ?></h2>
		<p><?php echo $post['commentPost']; ?></p>
		
	<!--link list, reply to comment. Open new comment box
	 or scroll back to top-->
	
	<ol class="postscript">
	   <li><a href="javascript:void(0);" class="reply">Reply</a></li>
	   <li><a href="javascript:void(0);" class ="newComment">New Comment</a></li>
	   <li class="date"><?php echo $post['time']; ?></li>
	</ol>
	
    </div>
	
</div>

<?php endforeach; ?>


<div style="width: 100%; text-align: center">
<button class="load">Load More</button>

</div>


<!-- load more comment button will be here Comments will load under form 
with load more button appearing under field-->
<div id = "commentDiv">


<form method="post" action="" id="commForm">

<div>
<label for="authorName">Your Name:</label>

<input type="text" name="authorName" id="authorName" placeholder="Name">

</div>




<div>
<label for="commBox">Type here:</label>

<textarea rows="8" cols="50" id="commBox" placeholder="Keep it PG..." name="comment"></textArea>

<input type="submit" id ="submitButton" name="submit">
<input type="hidden" id="row" value="0">
<input type="hidden" id="allRows" value="<?php echo $allCount; ?>">

</div>
</form>



<?php

?>

</div>

	  






<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="loadComment.js"></script>
</body>


</html>



