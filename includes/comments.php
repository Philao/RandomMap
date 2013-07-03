<?php
// Connects to database
include 'connection.php';
$link = connectDB();


// Prints error number is there is a problem with db connection.
if (mysqli_connect_errno()) {
    die(mysqli_connect_errno());
}

// Declares arrays for form fields which are clean and those that have errors.
$output = '';
$clean = array();
$errors = array();

// Checks if a form post has been made and then checks each field for valid entries or errors.
if (isset($_POST['addComment'])) {
    //print_r($_POST);
    
    //Trims name and records length
    if (isset($_POST['name'])) {
    	$_POST['name'] = trim($_POST['name']);
	    $namelength  = strlen($_POST['name']);
	    
        // Checks to see if name is too long
	    if ($namelength > 30) {
	        $errors['name'] = "A name must be no more than 30 characters.";
	    } else {
	        $clean['name'] = $_POST['name'];
	    }
	
	
	    if (isset($_POST['email'])) {
            // trims email and checks length
            $_POST['email'] = trim($_POST['email']);
	        $emaillength = strlen($_POST['email']);
	        if ($emaillength > 50) {
		        $errors['email'] = "Please select an email with less than 50 characters.";
	        } else {
		        $clean['email'] = $_POST['email'];
	        }
	        
            // Does same checks for comment field (e.g. length)
	        if (isset($_POST['comment'])) {
		        $commentlength = strlen($_POST['comment']);
		        
                if ($commentlength > 250) {
		            $errors['comment'] = "Your comment is too long";
		        } else {
		            $clean['comment'] = $_POST['comment'];
		        }
	    
            } else {
            // if comment field is blank
		    $error['comment'] = "Please leave a comment";
	        }
        }
        
    } else {
	    // if name field is blank
        $errors['name'] = "Please leave your name";
    }
}
    
//If there are no errors, escape the strings    
if (isset($_POST['addComment']) && count($errors) == 0) {
    
    $db_safe_name = mysqli_real_escape_string($link, $clean['name']);
    $db_safe_email = mysqli_real_escape_string($link, $clean['email']);
    $db_safe_comment = mysqli_real_escape_string($link, $clean['comment']);
    echo $db_safe_comment . $db_safe_email . $db_safe_name;
    $sqlin = "INSERT INTO comments (name, email, comment)
		    VALUES ('$db_safe_name', '$db_safe_email', '$db_safe_comment')";
	
    // Sends form to database
	if (mysqli_query($link, $sqlin) === FALSE) {
	    $output .= '<p>Sorry, there seems to be a problem with the connection to the database<p>';
	} else {
	    $output .= '<p>Thank you for your comment<p>';
	    $clean['name'] = '';
	    $clean['email'] = '';
	    $clean['comment'] = '';
	}

} else {
	// If there are errors stored in the error array, it will print them out.
	if (count($errors) > 0) {
	    $output .= '<p> Sorry but there is a problem.<br />';
	    foreach ($errors as $message) {
		$output .= $message . '<br />';
	    }
	    $output .= '<p>';
	} 
	    
	if (!isset($clean['name'])) {
	    $clean['name'] = '';
	}
	
	if (!isset($clean['email'])) {
	    $clean['email'] = '';
	}
	
	if (!isset($clean['name'])) {
	    $clean['comment'] = '';
	}
    }
?>

<?php
    // Prints out all comments in the database relevant to that page.
    
    $sqlout = "SELECT *
		FROM comments
		ORDER BY id ASC";
    
    $result = mysqli_query($link, $sqlout);
    	
    if (mysqli_error($link) === FALSE) {
	echo "Error connecting to database";
    } 

    While ($row = mysqli_fetch_assoc($result)) {
	echo "<div class='comment'>";
	echo 	'Name: ' . "<span class='name'>" . $row['name'] . '</span>' . '<br />';
	echo '<p>' .$row['comment'] . '<p>';
	echo '<span class="time">' . date("jS F Y", strtotime($row['stamp'])) . '</span>' . '<br />';
	echo "</div>";
    }
?>

// Form for leavin a comment
<div id="comments">
		<h3>Please feel free to leave a comment.</h3>
		<?php
			echo '<p>' . $output . '<p>';
			echo '
				<form action=" ' . $_SERVER['SCRIPT_NAME'] . '" method="POST">
					<label for="name">Name</label><br />
					<input type="text" name="name" id="name" value="'.$clean['name'].'" /><br />
					
					<label for="email">Email (Optional)</label><br />
					<input type="text" name="email" id="email" value="'.$clean['email'].'" /><br />
					
					<label for="comment">Comment</label><br />
					<textarea name="comment" rows="5" id="comment">' . $clean['comment'] . '</textarea><br />
					
					<input type="submit" name="addComment" value="Add Comment" /><br />
				</form>';
		?>
</div>