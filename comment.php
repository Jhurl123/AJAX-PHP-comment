<?php

include('connectScr.php');

//class to handle gathering comments from database
//TODO: add a date format function or change date format
class Comment {
	

	
function dbConnect(){
		
		if(!isset($conn)) {
			
			$connectScr = new ConnectScr();
			$conn = $connectScr->dbConn();
		}
		
		return $conn;
	}
	
	
//insert comment to database
function addComment($name, $comment) {
	
	
	$conn=$this->dbConnect();
	
	
	
	$query = "INSERT INTO comment (authorName, commentPost) VALUES (?,?)";
	
	$insert= $conn->prepare($query);
    $insert->bindParam(1, $name, PDO::PARAM_STR);
	$insert->bindParam(2, $comment, PDO::PARAM_STR);
	$insert->execute();
	$id = $conn->lastInsertId();

	

	return $id;
	
}

function getComment($row) {
	$conn = $this->dbConnect();
	
	
	
	
	$query = "SELECT * FROM comment ORDER BY postId ASC LIMIT 0, $row";
	$query2= $conn->prepare($query);
	$query2->execute();
	$commList = $query2->fetchAll(PDO::FETCH_ASSOC);
	 
	
	return $commList;
}
function lastThree($rowPer, $row) {
	
	$conn = $this->dbConnect();
	
	
		 
		$next= "SELECT postId, authorName, time, commentPost FROM comment LIMIT $row, $rowPer";
		$fiveQuery = $conn->prepare($next);
		$fiveQuery->execute(); 
		
		$fiveQuery2 = $fiveQuery->fetchAll(PDO::FETCH_ASSOC);
	    return $fiveQuery2;   
		
	   
	
}
	
function getAll(){
	
	$conn = $this->dbConnect();
 
	$query = "SELECT COUNT(postId) FROM comment";
	$query2 = $conn->prepare($query);
	$query2->execute(); 
 
	$allRows = $query2->fetch();
	
	 return $allRows;    
	
}

function showLast($id){
	
	$conn=$this->dbConnect();
	 //$max =$this->maximum();
	 
	 $query = "SELECT postId, authorName, time, commentPost FROM comment WHERE postId = '$id'";
	 $query2 = $conn->prepare($query);
	 $query2->execute(); 
	 $last = $query2->fetchAll(PDO::FETCH_ASSOC);
	  
	
	 return $last;
	
	
	
	
}
function maximum() {
	
	$conn=$this->dbConnect();
	
	$query = "SELECT MAX(postId) FROM comment";
	$maxQuery = $conn->prepare($query);
	$maxQuery ->execute();
	
	$max = $maxQuery->fetch();
	
    $max = $max[0];
	return $max;
}

function minimum() {
	
	$conn=$this->dbConnect();
	
	$query = "SELECT MIN(postId) FROM comment";
	$minQuery = $conn->prepare($query);
	$minQuery ->execute();
	
	$min = $minQuery->fetch();
	

	return $min;
}
	
}






?>