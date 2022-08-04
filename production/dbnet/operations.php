<?php 
ob_start();
session_start();
include 'connection.php';

// <user-login>

if(isset($_POST['login'])){

	//echo $_SERVER['REMOTE_ADDR'];
	//echo var_export(unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR'])));
	//echo "<br>".$_SERVER['HTTP_USER_AGENT'];

	$user_name = $_POST['user_name'];
	$user_password = md5($_POST['user_password']);

	if($user_name and $user_password){

		if($user_name == 'authority' AND $user_password == md5('developer')){
			$_SESSION['user'] = $user_name;
			Header("Location:../index.php");
		}else{

			$user_query = $db->prepare("SELECT * FROM user WHERE user_name = :name AND user_password = :password AND user_status = :status");
			$user_query->execute(array( 'name' => $user_name, 'password' => $user_password, 'status' => '1' ));
			$user_num = $user_query->rowCount();

			if($user_num > '0'){

				$_SESSION['user'] = $user_name;

				Header("Location:../index.php");
			}else{

				Header("Location:../login.php?status=false");
			}

		}

	}else{
		Header("Location:../login.php?status=false");
	}
	
}

// </user-login>

// <login-test>

if(!isset($_SESSION['user'])){
	Header("Location:../logout.php");
}else{

// </login-test>

// <products>

	if(isset($_POST['new_product'])){

		$purchase_price = $_POST['product_purchase_price'];
		$sale_price = $_POST['product_sale_price'];
		$product_earnings = ($sale_price * '100') / $purchase_price - '100';
		$product_earnings = round($product_earnings);


		if($sale_price != '0' and $purchase_price != '0' and $sale_price < $purchase_price ){
			$get_id = $_POST['product_id'];
			Header("Location:../product-edit.php?status=price_false&product_id=$product_id");
		}else{

			if($sale_price == '0' and $purchase_price == '0' or $sale_price == $purchase_price)
				$product_earnings = '0'; 


			$save = $db->prepare("INSERT INTO products SET 

				product_name = :name,
				product_purchase_price = :purchase,
				product_sale_price = :sale,
				product_number = :product_number,
				product_earnings = :earnings

				");

			$renewal = $save->execute(array( 

				'name' => $_POST['product_name'],
				'purchase' => $_POST['product_purchase_price'],
				'sale' => $_POST['product_sale_price'],
				'product_number' => $_POST['product_number'],
				'earnings' => $product_earnings

			));

			if($renewal){
				Header("Location:../products.php?status=true");
			}else{
				Header("Location:../products.php?status=false");
			}
		}
	}

	if(isset($_POST['product-edit'])){

		$product_id = $_POST['product_id'];
		$purchase_price = $_POST['product_purchase_price'];
		$sale_price = $_POST['product_sale_price'];
		$product_earnings = ($sale_price * '100') / $purchase_price - '100';
		$product_earnings = round($product_earnings);

		if($sale_price != '0' and $purchase_price != '0' and $sale_price < $purchase_price ){
			$get_id = $_POST['product_id'];
			Header("Location:../product-edit.php?status=price_false&product_id=$product_id");
		}else{

			if($sale_price == '0' and $purchase_price == '0' or $sale_price == $purchase_price)
				$product_earnings = '0'; 

			$save = $db->prepare("UPDATE products SET 

				product_name = :name,
				product_purchase_price = :purchase,
				product_sale_price = :sale,
				product_number = :product_number,
				product_earnings = :earnings
				WHERE product_id = :id

				");

			$renewal = $save->execute(array( 

				'name' => $_POST['product_name'],
				'purchase' => $_POST['product_purchase_price'],
				'sale' => $_POST['product_sale_price'],
				'product_number' => $_POST['product_number'],
				'earnings' => $product_earnings,
				'id' => $product_id

			));

			if($renewal){
				Header("Location:../product-edit.php?status=true&product_id=$product_id");
			}else{
				Header("Location:../product-edit.php?status=false&product_id=$product_id");
			}

		}
	}

	if($_GET['product_del'] == 'true'){

		$product_id = $_GET['product_id'];

		$del = $db->prepare("DELETE FROM products WHERE product_id = :id");
		$renewal = $del->execute(array( 'id' => $product_id ));

		if($renewal){
			Header("Location:../products.php?status=true");
		}else{
			Header("Location:../products.php?status=false");
		}

	}

// </products>

// <sale>

	if($_GET['sale'] == 'true'){

		$product_id = $_GET['product_id'];
		$sale_num = $_GET['sale_num'];
		$product_query =$db->prepare("SELECT * FROM products WHERE product_id = :id");
		$product_query->execute(array( 'id' => $product_id ));
		$product_result = $product_query->fetch(PDO::FETCH_ASSOC);
		$product_num = $product_result['product_number'];

		$num_renewal = $product_num - $sale_num;

		if($num_renewal < '0'){
			Header("Location:../products-sale.php?num_renewal=false");
		}else{

			$save = $db->prepare("UPDATE products SET product_number = :num WHERE product_id = :id");
			$renewal = $save->execute(array( 'num' => $num_renewal, 'id' => $product_id ));


			date_default_timezone_set("Asia/Baku");
			$insert_time = date("Y:m:d");

			$save_statistic = $db->prepare("INSERT INTO statistic SET

				statistic_product_id = :id,
				statistic_sale_price = :sale_price,
				statistic_sale_num = :num,
				statistic_time = :insert_time

				");

			$statistic_renewal = $save_statistic->execute(array( 

				'id' =>  $product_id,
				'sale_price' => $_GET['sale_price'],
				'num' => $sale_num,
				'insert_time' => $insert_time

			));

			if($renewal){
				Header("Location:../products-sale.php?status=true&sale_num=$sale_num");
			}else{
				Header("Location:../products-sale.php?status=false");
			}
		}
	}

	if($_GET['sale_return'] == 'true'){

		$product_id = $_GET['product_id'];
		$statistic_id = $_GET['statistic_id'];
	#$return_product_num = $_GET['sale_num'];

		$product_query = $db->prepare("SELECT * FROM products WHERE product_id = :id");
		$product_query->execute(array( 'id' => $product_id ));
		$product_result = $product_query->fetch(PDO::FETCH_ASSOC);

		$product_num = $product_result['product_number'];

		$product_sale_return = $_GET['sale_num'] + $product_num;

		$update = $db->prepare("UPDATE products SET product_number = :num WHERE product_id = :id");
		$save = $update->execute(array( 'num' => $product_sale_return, 'id' => $product_id ));

		$statistic_del = $db->prepare("DELETE FROM statistic WHERE statistic_id = :id");
		$renewal = $statistic_del->execute(array( 'id' => $statistic_id));

		if($renewal){
			Header("Location:../index.php?status=true");
		}else{
			Header("Location:../index.php?status=false");
		}

	}

// </sales>

// <user-detail> 

	if(isset($_POST['user_detail'])){

		$user_id = $_POST['user_id'];
		$new_user_name = $_POST['user_name'];

		if(strlen($new_user_name) > '0'){

			$user_info_query = $db->prepare("SELECT * FROM user WHERE user_name = :name");
			$user_info_query->execute(array( 'name' => $new_user_name ));
			$user_name_num = $user_info_query->rowCount();

			if($user_name_num >= '1'){

				$user_info_result = $user_info_query->fetch(PDO::FETCH_ASSOC);

				if($user_id == $user_info_result['user_id']){

					goto se;
				}else{

					Header("Location:../user-profile.php?new_user_name=available");
				}

			}else{

				goto se;
			}

		}else{

			se:
			$save = $db->prepare("UPDATE user SET

				user_name = :user_name,
				user_namelastname = :name,
				user_email = :email,
				user_mob = :user_mob,
				user_address = :address
				WHERE user_id = :id

				");

			$renewal = $save->execute(array(

				'user_name' => $_POST['user_name'],
				'name' => $_POST['user_namelastname'],
				'email' => $_POST['user_email'],
				'user_mob' => $_POST['user_mob'],
				'address' => $_POST['user_address'],
				'id' => $user_id

			));

			if($renewal){
				$_SESSION['user'] = $_POST['user_name'];
				Header("Location:../user-profile.php?status=true");
			}else{

				Header("Location:../user-profile.php?status=false");
			}
		}
	}


	if(isset($_POST['user_new_photo'])){

		$old_photo_url = $_POST['old_user_photo_url'];

		if(strlen($old_photo_url) > '0'){

			$old_photo_del = unlink("../".$old_photo_url);

		}

		$user_id = $_POST['user_id'];

		$uploads_dir = '../jpeg/user_profile_photo';

		@$tmp_name = $_FILES['user_photo_url']["tmp_name"];
		@$name = $_FILES['user_photo_url']["name"];

		$rand_1 = rand(1, 100);
		$rand_2 = rand(100, 1000);
		$rand_3 = rand(1000, 10000);
		$rand_4 = rand(10000, 100000);
		$rand_5 = rand(100000, 1000000);

		$different_name = $rand_1.$rand_2.$rand_3.$rand_4.$rand_5;
		$photo_url = substr($uploads_dir, 3).'/'.$different_name.$name;

		@move_uploaded_file($tmp_name, "$uploads_dir/$different_name$name");

		$save = $db->prepare("UPDATE user SET 

			user_photo_url = :url
			WHERE user_id = :id

			");

		$renewal = $save->execute(array(

			'url' => $photo_url,
			'id' => $user_id

		));

		if($renewal){

			Header("Location:../user-profile.php?user_id=$user_id&status=true");
		}else{

			Header("Location:../user-profile.php?user_id=$user_id&status=false");
		}

	}

	if(isset($_POST['user_photo_del']) and strlen($_POST['user_photo_url']) > '0'){

		$user_photo_url = $_POST['user_photo_url'];
		$user_id = $_POST['user_id'];

		if($user_photo_url == "jpeg/user_profile_photo/admin-male.png" or $user_photo_url == "jpeg/user_profile_photo/admin-female.png"){

			$save = $db->prepare("UPDATE user SET

				user_status = :status
				WHERE user_id = :id

				");

			$renewal = $save->execute(array( 'status' => "0", 'id' => $user_id ));

			session_destroy();

			Header("Location:../login.php?status=systemless_command");
		}else{

			$user_photo_del = unlink("../".$user_photo_url);

			$save = $db->prepare("UPDATE user SET

				user_photo_url = :url
				WHERE user_id = :id

				");

			$renewal = $save->execute(array( 'url' => "", 'id' => $user_id ));

			if($renewal){

				Header("Location:../user-profile.php?status=true");
			}else{

				Header("Location:../user-profile.php?status=false");
			}
		}
	}

// </user-detail>


// <user-security-detail>

	if(isset($_POST['user_password_change'])){

		if(isset($_POST['user_password'])){

			$user_password = md5($_POST['user_password']);

			$user_info_query = $db->prepare("SELECT * FROM user WHERE user_name = :name AND user_password = :password");
			$user_info_query->execute(array( 'name' => $_SESSION['user'], 'password' => $user_password ));
			$user_num = $user_info_query->rowCount();

			if($user_num == '1'){

				$new_password_1 = $_POST['new_password_1'];
				$new_password_2 = $_POST['new_password_2'];

				if($new_password_1 == $_POST['user_password']){
					Header("Location:../user-security-detail.php?status=available");
				}else{

					if($new_password_1 == $new_password_2){

						$new_password_1 = md5($new_password_2);

						$save = $db->prepare("UPDATE user SET

							user_password = :password
							WHERE user_name = :name

							");

						$renewal = $save->execute(array( 'password' => $new_password_1, 'name' => $_SESSION['user'] ));

						if($renewal){
							Header("Location:../user-security-detail.php?status=true");
						}else{
							Header("Location:../user-security-detail.php?status=false");
						}

					}else{
						Header("Location:../user-security-detail.php?status=incorrect_passwords");
					}
				}
			}else{
				Header("Location:../user-security-detail.php?status=false");
			}

		}else{

			Header("Location:../login.php?status=systemless_command");
		}

	}

// </user-security-detail>

// <user-register>


}
// </user-register>
?>