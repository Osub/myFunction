# myFunction
//我的函数库
//生成excel表头索引
//生成excel索引  $i==0
	public function indexXY($i){
		if($i>25){
			$num = ceil($i/25);
			$index = '';
			for($j=1;$j<$num;$j++){
				$index .= chr($j-1+65);
			}
			$index .= chr(($i-($num-1)*26)+65);
		}else{
			$index = chr($i+65);
		}
		return $index;
	}
