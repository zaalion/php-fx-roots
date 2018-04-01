<?php
	class root_finder
	{
		function root_finder($function_x, $x_start, $x_end, $tolerance, $step)
			{
			$this->function_x=$function_x;
			$this->x_start=$x_start;
			$this->x_end=$x_end;
			$this->tolerance=$tolerance;
			$this->step=$step;
			$this->roots;
			}
		function validate()
			{
			if(substr_count('(',$this->function_x)!=substr_count(')',$this->function_x))
				die("Enter a valid function. ");
			}
		function draw()
			{
			$this->validate();
			$number=$this->find();
			$xmin=-200;
			$xmax=200;
			$ymin=-200;
			$ymax=200;
			$j=0;
			header("Content-type: image/jpeg");
			$image=imagecreate($xmax-$xmin+20,$ymax-$ymin+15*($number+2));
			$col=imagecolorallocate($image,0,0,0);
			$col1=imagecolorallocate($image,255,255,255);
			$col2=imagecolorallocate($image,200,50,50);
			imageline($image, ($xmax-$xmin)/2, 0, ($xmax-$xmin)/2, $ymax-$ymin, $col1);
			imageline($image, 0, ($ymax-$ymin)/2, $xmax-$xmin, ($ymax-$ymin)/2, $col1);			
			for($x=$xmin; $x<$xmax; $x+=.01)
				{
					$x_points[$j]=$x;
					eval('$y_points[$j]='.str_replace('x','$x',$this->function_x).';');
					imagesetpixel($image, $x_points[$j]+($xmax-$xmin)/2, -$y_points[$j++]+($ymax-$ymin)/2, $col1);
				}				
			imageline($image, $this->x_start+$xmax, 0, $this->x_start+$xmax, 400, $col2);			
			imageline($image, $this->x_end+$xmax, 0, $this->x_end+$xmax, 400, $col2);						
			imagestring($image, 2, 20, 400, "f(x)=".str_replace('$x','x',$this->function_x), $col1);
			imagestring($image, 2, 20, 415, "Root(s) ", $col1);
			for($i=0;$i<$number;$i++)	
				imagestring($image, 2, 20, 430+(15*$i), "x[".$i."] = ".$this->roots[$i], $col1);
			imagejpeg($image,"",100);
			}
			
		function find()
			{
			$index=0;
			$a=$this->x_start;
			do
				{
				$is=0;
				$b=$a+$this->step;
				while(abs($a-$b)>$this->tolerance)
					{
					eval('$ya='.str_replace('x','$a',$this->function_x).";");
					eval('$yb='.str_replace('x','$b',$this->function_x).";");
					if($ya*$yb<0)
						{
						$is=1;
						$xc=(real)($a+$b)/(real)2;
						eval('$yxc='.str_replace('x','$xc',$this->function_x).";");
						if($yxc*$ya<0)
							$b=$xc;
						else
							$a=$xc;
						continue;
						}
						else
							break;
					}
				if($is==1)
					$this->roots[$index++]=$a;
				$a=$b;
				}
			while($b<$this->x_end);
			return(count($this->roots));
			}
	}
?>