<?php
	header("CONTENT-type: text/html; charset=utf-8");
	
	$text = [
	"Пароль: 6282 Спишется 44,23р. Перевод на счет 410013834604285",
	"Перевод на счет 410013834804253 Спишется 344,23р. Пароль: 5434 ",
	"Сумма указана неверно.",
	"Кошелек Яндекс.Денег указан неверно."
	];
			
	function getData($text){
		$data = [];
		preg_match_all("/(пароль[:-]{0,2}[\s]{0,}(?P<password>[A-Za-z0-9]{1,}))?|(Спишется[:-]{0,1}[\s]{0,}(?P<writeoff>[0-9р,.\s]{1,}))?|(Перевод на счет[:-]{0,1}[\s]{0,}(?P<account>[0-9]{15}))?/ui",$text, $matches);
		foreach($matches as $key => $t){
			if(preg_match('/^[a-z]+$/i', $key)){
				foreach($matches[$key] as $k){
					if($k!=null){
						$data[$key] = $k;
					}
					
				}
			}
		}
		if($data==null){$data['error'] = $text;}
		return $data;
	}
	foreach($text as $t){
		echo "<pre>".print_r(getData($t),true)."</pre>";
	}
?>