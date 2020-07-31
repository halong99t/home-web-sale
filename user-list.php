<!DOCTYPE html>
<html lang="en">
<head>
	<title>User List</title>
	<!-- Bootstrap CSS File -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<script language ="JavaScript" type="text/javascript">
		function checkDelete() {
			return confirm('Are you sure delete this user?')
		}
	</script>
</head>
<body>
	<div class="container">
		<h2 class="text-center">Registered Users</h2>
		<?php
		try {
			// connect to database
			require('./controllers/Service/connect_sql.php');
			// (1) set the number of rows per display page
			$page_rows = 3;
			// (2) get the total number of pagess already been calculated?
			if ((isset($_GET['p']) && is_numeric($_GET['p']))) {
				$pages = htmlspecialchars($_GET['p'], ENT_QUOTES);
			} else {
				// first, check for the total number of records
				$query = "SELECT COUNT(user_id) FROM users";
				$result = $conn->query($query);
				$row = $result->fetch_array(MYSQLI_NUM);
				$records = htmlspecialchars($row[0], ENT_QUOTES);
				// calculate the number of pages
				if ($records > $page_rows) { // if the number of records will fill more than one page
					// calculate the number of pages and round the result up to the nearest integer
					$pages = ceil($records / $page_rows);
				} else {
					$pages = 1;
				}
			}
			// (3) declare which record to start with                                                     
			if ((isset($_GET['s'])) && (is_numeric($_GET['s']))) {
				// make sure it is not executable XSS
				$start = htmlspecialchars($_GET['s'], ENT_QUOTES);
			} else {
				$start = 0;
			}
			// build the select user SQL
			$query = "SELECT * ";
			// $query .= "DATE_FORMAT(registration_date, '%M %d, %Y') AS reg_date";
			$query .= " FROM users ORDER BY user_id ASC";
			// (4) add LIMIT clause
			$query .= " LIMIT ?, ?";
			$stmt = $conn->stmt_init();
			$stmt->prepare($query);
			// (5) bind param to SQL Statement
			$stmt->bind_param("ii", $start, $page_rows);
			// execute query
			$stmt->execute();
			$result = $stmt->get_result();
			if ($result) {
				echo '<table class="table table-striped">
						<tr>
						<th scope="col">Delete</th>
						<th scope="col">User ID</th>
						<th scope="col">User Name</th>
						<th scope="col">Email</th>
						</tr>';
				// fetch and print all the records:							
				while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
					// remove special characters that might already be in table to reduce the chance of XSS exploits
					$user_id = htmlspecialchars($row['user_id'], ENT_QUOTES);
					$user_name = htmlspecialchars($row['user_name'], ENT_QUOTES);
					$user_mail = htmlspecialchars($row['user_mail'], ENT_QUOTES);
					// $email = htmlspecialchars($row['email'], ENT_QUOTES);
					// $registration_date = htmlspecialchars($row['reg_date'], ENT_QUOTES);
					echo '<tr>
			
							<td><a href="./controllers/delete_user.php?id=' . $user_id . '" onclick="return checkDelete()">Delete</a></td>
							<td>' . $user_id . '</td>
							<td>' . $user_name . '</td>
							<td>' . $user_mail . '</td>
							</tr>';
				}
				echo '</table>';
				// free up the resources                                                         
				$result->free_result(); 
			} else { 
				echo '<p class="text-center">The current users could not be retrieved.</p>';
				exit;
			}
			// (6) display the total number of records and paging button     
			$query = "SELECT COUNT(user_id) FROM users";
			$result = $conn->query($query);
			$row = $result->fetch_array(MYSQLI_NUM);
			$members = htmlspecialchars($row[0], ENT_QUOTES);
			$conn->close();   
			$nav_string = "<p class='text-center'>Total users: $members</p>";
			$nav_string .= "<p class='text-center'>";
			if ($pages > 1) {                                             
				// what number is the current page?
				$current_page = ($start / $page_rows) + 1;
				// if the page is not the first page then create a Previous link
				if ($current_page != 1) {
					$nav_string .= '<a href="user_list_p.php?s=' . ($start - $page_rows) .
						'&p=' . $pages . '">Previous</a> | ';
				}
				// create a Next link                                                  
				if ($current_page != $pages) {
					$nav_string .= ' <a href="user_list_p.php?s=' . ($start + $page_rows) .
						'&p=' . $pages . '">Next</a> ';
				}
				$nav_string .= '</p>';
				echo $nav_string;
			}
			$conn->close(); 
		} catch (Exception $e) {
			print "An Exception occurred. Message: " . $e->getMessage();
		}
		?>
	</div>
</body>

</html>