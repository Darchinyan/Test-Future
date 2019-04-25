<html>
	<head>
		<link rel="stylesheet" href="css/style.css" />
		<script src="js/jquery.js"></script>
		<script src="js/init.js"></script>
	</head>
	<body>
		<?php
			require_once "config.php";
			$user_name = $user_comment = $user_avatar = "";
			$user_nameErr = $user_commentErr = $user_avatarErr = "";
			if(isset($_POST['add_comment'])){
				if(empty($_POST['name'])){
					$user_nameErr=" Введите ваше имя ";
				}else{
					$user_name=$_POST['name'];
				}
				if(empty($_POST['comment_text'])){
					$user_commentErr="Введите коментарии ";
				}else{
					$user_comment=$_POST['comment_text'];
				}
				if(!empty($_FILES['file']['name'])){
					$array=['png','jpg','jpeg','gif'];
					$explode=explode('.',$_FILES['file']['name']);
					$extension=end($explode);
					if($_FILES['file']['size']<2000000000 && in_array($extension,$array)){
						move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/'.$_FILES['file']['name']);
						$user_avatar=$_FILES['file']['name'];
						mysql_query("insert into comments (name,avatar,text) values ('$user_name','$user_avatar','$user_comment')");
					}else{
						$user_avatarErr="Выберите файл меньше 2 mb";
					}
				}else{
						$user_avatarErr="Выберите аватар";
					}
			}
			$result=mysql_query("select * from comments ORDER BY id DESC");
			$row=mysql_fetch_array($result);
		?>
		<div class="for_header">
			<div id="header_cont">
				<div id="for_title">
					<p class="for_data">Телефон +7 495 409-01-79</p>
					<p class="for_data">Email: <a href="mailto:info@future-group.ru">info@future-group.ru</a></p>
					<h1> Комментарии </h1>
				</div>
				<div id="for_logo"></div>
			</div>
		</div>
		<section id="comments">
			<section id="contener">
				<section id="sec_comment">
					<table>
						<?php
							$result=mysql_query("select * from comments ORDER BY id DESC");
							while($row=mysql_fetch_array($result)){
								echo" 
									<tr>
										<td>
											<div class='tb_div_img'> <img src='uploads/".$row['avatar']."' class='img_tb' /> </div>
										</td>
										<td>
											<div class='tb_div_text'>
												<span class='span_name'>".$row['name']."</span>
												<span class='span_data'>".$row['data']."</span>
												<p class='comments_text'>".$row['text']."</p>
											</div>
										</td>
									</tr>
								
								";
							};
						?>
					</table>
				</section>
				<section>
					<form action="" method="post" enctype="multipart/form-data">
						<div id="for_comments">
							<h3> Оставить комментарий </h3>
							<p> Ваше имя <span class="for_err"> <?php echo $user_nameErr ?> </span> </p>
							<input type="text" name="name" id="insert_name" />
							<p> Ваш аватар <span class="for_err"> <?php echo $user_avatarErr ?> </span> </p>
							<input type="file" name="file" />
							<p> Ваш комментарий <span class="for_err"> <?php echo $user_commentErr ?> </span> </p>
							<textarea type="text" name="comment_text" rows="7" cols="50" style="background-color:#eeeeee; border:2px solid #2a2a2a; border-radius:5px;"></textarea>
							<span id="for_submit"> <input type="submit" name="add_comment" id="sub" /> </span>
						</div>
					</form>
				</section>
			</section>
			
		</section>
		<section id="for_footer">
			<div id="footer_conten">
				<div id="footer_img"></div>
				<div id="footer_text">
					<p class="for_data">Телефон +7 495 409-01-79</p>
					<p class="for_data">Email: <a href="mailto:info@future-group.ru">info@future-group.ru</a></p>
					<p class="for_data"> <a href="https://goo.gl/maps/CjHSx3vDEfT2">Каширский пр-д, 5, Москва, 115201</a></p><br>
					<p class="for_data">© 2010-2017 Future LLC. Любое копирование информации запрещено</p>
				</div>
			</div>
		</section>
	</body>
</html>