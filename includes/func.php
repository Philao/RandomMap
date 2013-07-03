<?php

function dbConnect()
{
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'test';
	
	$conx = mysqli_connect($host, $user, $pass) 
	or die("Can't connect to MySQL server: " . mysqli_error($conx) );
	
	mysqli_select_db($conx, $db )
	or die("Can't select that database: " . mysqli_error($conx) );
	
	return $conx;
};

function recents() 
{
	$recent = 'SELECT id, title, date, author, content, picture, created
				FROM blog
				ORDER BY created DESC
				LIMIT 4';
	return $recent;
};

function modifiedQuery($query, $value)
{
			$cat = $query;
			$val = $value;
		
				
			$val = str_replace( '%20',' ', $val);
				
			$blog = 'SELECT id, title, date, author, content, picture, created
				FROM blog
				WHERE ' . $cat . ' = ' . "'". $val . "'" . ' 
				ORDER BY created DESC
				LIMIT 4;';
			
			return $blog;
}

function originalQuery()
{
			$blog = 'SELECT id, title, date, author, content, picture, created
				FROM blog
				ORDER BY created DESC
				LIMIT 4;' ;
			
			return $blog;
}

function commentQuery($postid)
{
	$qcomment = 'SELECT *
				FROM comments
				WHERE postid = ' . $postid .
			' ORDER BY ctime';
	return $qcomment;
}

function selectAuthor()
{
	$select = 'SELECT author
				FROM blog
				GROUP BY author
				ORDER BY author' ;
	return $select;
}

function selectTitle()
{
	$select = 'SELECT title
				FROM blog
				GROUP BY title
				ORDER BY title' ;
	return $select;
}

function selectDate()
{
	$select = 'SELECT created
				FROM blog
				GROUP BY created
				ORDER BY created' ;
	return $select;
}

function submitQuery($title, $author, $date)
{
	$tempArr = [];
	
	if ($title != 'NULL') 
	{
		$tempArr['title'] = $title;
	}
	
	if ($author != 'NULL') 
	{
		$tempArr['author'] = $author;
	}
	
	if ($date != 'NULL') 
	{
		$tempArr['created'] = $date;
	}
	
	$tempLen = count($tempArr);
	$tempItt = 0;
	
	$wherePart = "";
	$wherePart = " WHERE ";
	
	foreach($tempArr as $key => $value)
				{
					$wherePart .= "$key = '$value' ";
					
					if ($tempItt < ($tempLen - 1))
					{
						$wherePart .= " AND ";
					}
					$tempItt++;
				}
				
	$submit  = 'SELECT id, title, date, author, content, picture, created
				FROM blog' .
				$wherePart
				. 'ORDER BY created DESC';
	return $submit;
}
?>