<?php
include_once '../connect.php';


?>

<!DOCTYPE html>
<html>
  <head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Голосование</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="../style.css" />
 
 <!-- Latest compiled and minified JavaScript -->
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script src="../js/scripts3.js"></script>
  <script type="text/javascript">
	function showTime()
	{
	  var dat = new Date();
	  var H = '' + dat.getHours();
	  H = H.length<2 ? '0' + H:H;
	  var M = '' + dat.getMinutes();
	  M = M.length<2 ? '0' + M:M;
	  var S = '' + dat.getSeconds();
	  S =S.length<2 ? '0' + S:S;
	  var clock = H + ':' + M + ':' + S;
	  document
		.getElementById('time_div')
		  .innerHTML=clock;
	  setTimeout(showTime,1000);  // перерисовать 1 раз в сек.
	}
</script>
  </head>
  <body>
		<div class="logo">
			<img src="../img/logo_fc_dnepr.png" alt="">
		</div>
	<div class ="wrapper">
		
		<div class ="container-fluid">		
			<div class="row" style = "background-color:yellow">
				<div class="col-md-6">
					<div style ="text-align: center; font-size: 30px; border-right:1px dotted #7f7f6a">Поддерживаю (+3805005050): Иванов И.И.</div>
				</div>
				<div class="col-md-6">
					<div style ="text-align: center; font-size: 30px;">Поддерживаю (+3805005051): Петров П.П.</div>
				</div>
			</div>
				
			<div class="row">
				<div class="progress" style ="height: 54px">
					<div class="progress-bar progress-bar-success progress-yes" style="width: 35%; font-size: 36px; line-height: 54px">
						<span>35%</span>
					</div>
					
					<div class="progress-bar progress-bar-danger progress-no" style="width: 65%; font-size: 36px; line-height: 54px">
						<span>65%</span>
					</div>
				</div>
			</div>
		
			<div class="row">
				<div class="str">
					<div class="col-md-2">
					<div id="time_div" style="font-size:40px; font-weight:200; width:85px; margin-left: 10px;"></div><script type="text/javascript"> showTime();</script>
						<!--<img src="../img/zastavka.png" width="214" height="54" alt=""> -->
					</div>	
					<div class="col-md-10">
					
					<?php
					if(isset($_SESSION['optionsRadios']) && $_SESSION['optionsRadios'] == 'option3') {
						
						//извлечение новостей из базы
						$news = mysqli_query($link, "
							SELECT *
							FROM `news`
							ORDER BY `id` DESC
							") or exit(mysqli_error());
						
						$beg_stroka = "";
						while($row = mysqli_fetch_assoc($news))
						$beg_stroka .= $row['title']. '***';	
						//вывод бегущей строки
						echo '<marquee behavior="scroll" direction="left"><span style="color:white; font-size: 36px;">' .$beg_stroka.'</marquee>';
												
						
					} elseif(isset($_SESSION['optionsRadios'], $_SESSION['urlRss']) && $_SESSION['optionsRadios'] == 'option2') {
						
						$url = $_SESSION['urlRss']; //адрес RSS ленты, для примера я взял новостную ленту укрправды
 
						$rss = simplexml_load_file($url); //Функция интерпретирует XML-файл в объект

						$news = "";
						//цикл для считывания всей RSS ленты
						foreach ($rss->channel->item as $item) {
						 $news .= $item->title. '***';
						}
						//вывод бегущей строки
						echo '<marquee behavior="scroll" direction="left"><span style="color:white; font-size: 36px;">' .$news. '</marquee>';
						
					} elseif(isset($_SESSION['optionsRadios']) && $_SESSION['optionsRadios'] == 'option1')  {
					
						echo '<marquee behavior="scroll" direction="left"><span style="color:white; font-size: 36px;">';
						
							
								header('Content-Type: text/html; charset=utf-8');
								$f = fopen("news.txt", "r");
								
								while(!feof($f)) { 
									echo fgets($f);
								}
								fclose($f);
							
							echo '</span></marquee>';
						
					} elseif(empty($_SESSION['optionsRadios']))  {
					
						echo '<marquee behavior="scroll" direction="left"><span style="color:white; font-size: 36px;">';
						
							
								header('Content-Type: text/html; charset=utf-8');
								$f = fopen("news.txt", "r");
								
								while(!feof($f)) { 
									echo fgets($f);
								}
								fclose($f);
							
							echo '</span></marquee>';
						
					} elseif(empty($_SESSION['urlRss']))  {
						
						$url = 'http://www.pravda.com.ua/rss/view_news/'; //адрес RSS ленты, для примера я взял новостную ленту укрправды
 
						$rss = simplexml_load_file($url); //Функция интерпретирует XML-файл в объект

						$news = "";
						//цикл для считывания всей RSS ленты
						foreach ($rss->channel->item as $item) {
						 $news .= $item->title. '***';
						}
						//вывод бегущей строки
						echo '<marquee behavior="scroll" direction="left"><span style="color:white; font-size: 36px;">' .$news. '</marquee>';
					
					}
					
					?>
					
					</div>	
				</div>
			</div>	
		</div>
	</div>	
	
	
  </body>
</html>


