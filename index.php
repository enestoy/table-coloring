<?php
try{
    $db = new PDO("mysql:host=localhost;dbname=listcolor;charset=UTF8","root","");

}catch(PDOException $Hata){
    echo "Bağlantı Hatası";

}

function Filtrele($Deger){
    $Bir = trim($Deger);
    $iki = strip_tags($Bir);
    $Uc =  htmlspecialchars($iki, ENT_QUOTES);
    $Sonuc = $Uc;
    return $Sonuc;
  }

?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Renk Değişimi</title>
</head>
<body>
<div class="container">
<table width="1000" align="center" border="1" cellpadding="0" cellspacing="0">
		<tr height="30" bgcolor="#000000">
			<td align="left" style="color:white">&nbsp;Ürün Adı</td>
			<td align="right" style="color:white">Ürün Fiyatı&nbsp;</td>
		</tr>
		
	<?php
		$Sorgu 			= $db->prepare("SELECT * FROM urunler");
		$Sorgu->execute();
		$KayitSayisi 	= $Sorgu->rowCount();
		$Kayitlar 		= $Sorgu->fetchAll(PDO::FETCH_ASSOC);
		
		$BirinciRenk	= "#dfdfdf";
		$IkinciRenk		= "#FFFFFF";
		$RenkIcinSayi 	= 0;
		
		foreach($Kayitlar as $Kayit){
			if(($RenkIcinSayi % 2) == 0){
				$ArkaPlanRengi 	= $BirinciRenk;
			}else{
				$ArkaPlanRengi 	= $IkinciRenk;
			}
			$RenkIcinSayi++;
		
		?>	
		
		
		<tr height="30" bgcolor="<?php echo $ArkaPlanRengi ?>" onMouseOver="this.bgColor='#c2cedb'" onMouseOut="this.bgColor='<?php echo $ArkaPlanRengi ?>'" style="cursor: pointer">
			<td align="left">&nbsp; <?php echo $Kayit["urun_ad"]; ?></td>
			<td align="right"><?php echo $Kayit["urun_fiyat"]; ?> &nbsp;</td>
		</tr>
		<?php
		}
		?>
	</table>	
</div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

<?php
$db = null; 
?>