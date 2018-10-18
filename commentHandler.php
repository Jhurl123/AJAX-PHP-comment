<?php
include('comment.php');
//include('connectScr.php');

$comment = new Comment();



if(isset($_POST['row'])){
$row = $_POST['row'];

$rowPerPage = 3;

$commList=$comment->lastThree($rowPerPage, $row);

$html = "";

 
foreach($commList as $post){
	
	
	$authorName=$post['authorName'];
	$comment=$post['commentPost'];
	$date=$post['time'];
	
	$html .='<div class="wrap">';
	$html .='<img src="http://davidrhysthomas.co.uk/img/dexter.png" />';
	$html .='<div class="comment">';
	$html .='<h2 class="owner">'.$authorName.'</h2>';
	$html .='<p>'.$comment.'</p>';
	$html .='<ol class="postscript">';
	$html .='<li><a href ="javascript:void(0);" class="reply">' . "Reply" . '</a></li>';
	$html .='<li><a href="javascript:void(0);" class="scroll">' . "New Comment" . '</a></li>';
	$html .='<li class = "date">' . $date . '</li>';
	$html .='</ol>';
	$html .='</div>';
	$html .='</div>';
	
}
		 
    echo $html;
}

	
elseif(isset($_POST['add'])) {
	

	$data = $_POST["data"];

    $name= htmlentities($data["name"], ENT_NOQUOTES);
	$post = htmlentities($data["comment"], ENT_NOQUOTES);

	
    $id= $comment->addComment($name, $post);
  


	$output= $comment->showLast($id);
	$last="";
	
	foreach($output as $new){
	
	$authorName=$new['authorName'];
	$comment=$new['commentPost'];
	$date=$new['time'];
	
	$last .='<div class="wrap">';
	$last .='<img src="http://davidrhysthomas.co.uk/img/dexter.png" />';
	$last .='<div class="comment">';
	$last .='<h2 class="owner">'.$authorName.'</h2>';
	$last .='<p>'.$comment.'</p>';
	$last .='<ol class="postscript">';
	$last .='<li><a href ="javascript:void(0);"class="reply">' . "Reply" . '</a></li>';
	$last .='<li><a href="javascript:void(0);" class="scroll">' . "New Comment" . '</a></li>';
	$last .='<li class = "date">' . $date . '</li>';
	$last .='</ol>';
	$last .='</div>';
	$last .='</div>';
		
	echo $last;
	}
	}


?>