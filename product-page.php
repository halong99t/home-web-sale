<!DOCTYPE html>
<html lang="en">
<head>
	<title>User List</title>
	<!-- Bootstrap CSS File -->
  <link rel="stylesheet" href="public/theme.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="pos-f-t">
  			<div class="collapse" id="navbarToggleExternalContent">
    			<div class="bg-dark p-4">
      				<h4 class="text-white">Collapsed content</h4>
      			<span class="text-muted">Toggleable via the navbar brand.</span>
    		</div>
  		</div>
  		<nav class="navbar navbar-dark bg-dark">
    		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
     	 <span class="navbar-toggler-icon"></span>
    	</button>
  		</nav>
	</div>

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
				$query = "SELECT COUNT(product_id) FROM products";
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
			$query .= " FROM products ORDER BY product_id ASC";
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
				// fetch and print all the records:							
				while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
					// remove special characters that might already be in table to reduce the chance of XSS exploits
					$product_name = htmlspecialchars($row['product_name'], ENT_QUOTES);
					$product_image = htmlspecialchars($row['product_image'], ENT_QUOTES);
          $product_description = htmlspecialchars($row['product_description'], ENT_QUOTES);
          $product_price = htmlspecialchars($row['product_price'], ENT_QUOTES);
					// $email = htmlspecialchars($row['email'], ENT_QUOTES);
					// $registration_date = htmlspecialchars($row['reg_date'], ENT_QUOTES);
					echo '
          <div id="page-products">
  
              <div class="pdt">
                <img class="pdt-img" src="./controllers/'.$product_image.'" alt="">
                <h3 class="pdt-name">'.$product_name.'</h3>
                <div class="pdt-price">'.$product_description.'</div>
                <div class="pdt-desc">'.$product_price.'</div>
              </div>
          </div>
    ';
				}
				echo '</table>';
				// free up the resources                                                         
				$result->free_result(); 
			} else { 
				echo '<p class="text-center">The current users could not be retrieved.</p>';
				exit;
			}
			// (6) display the total number of records and paging button     
			$query = "SELECT COUNT(product_id) FROM products";
			$result = $conn->query($query);
			$row = $result->fetch_array(MYSQLI_NUM);
			$members = htmlspecialchars($row[0], ENT_QUOTES);
			$conn->close();   
			$nav_string = "<p class='text-center'>Total Product: $members</p>";
			$nav_string .= "<p class='text-center'>";
			if ($pages > 1) {                                             
				// what number is the current page?
				$current_page = ($start / $page_rows) + 1;
				// if the page is not the first page then create a Previous link
				if ($current_page != 1) {
					$nav_string .= '<a href="product-page.php?s=' . ($start - $page_rows) .
						'&p=' . $pages . '">Previous</a> | ';
				}
				// create a Next link                                                  
				if ($current_page != $pages) {
					$nav_string .= ' <a href="product-page.php?s=' . ($start + $page_rows) .
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