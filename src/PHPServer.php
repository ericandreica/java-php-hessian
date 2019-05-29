<?php
class MyFile{
  private $name;        
  private $content;    
  private $myhash;    

  //constructor
  public function __construct($n,$c,$mh)
  {
    $this->name=$n;
    $this->content=$c;
    $this->myhash=$mh;
  }
  //Getter
  public function getName()
  {
    return $this->name;
  }
  public function getContent()
  {
    return $this->content;
  }

  public function getMyHash()
  {
    return $this->myhash;
  }
  public function __toString() 
  {
    return "MyFile{name= {$this->name}, content={$this->content}, hash={$this->myhash}}";
  }
}

class PHPServer {
    private $db;
	private $lst;	
	public function __construct()
	{	
		$this->db = array();
		$mf = fopen("myfile.txt", "r") or die("Unable to open file!");
		while(!feof($mf)) {
			 $line = fgets($mf);
			 if(trim($line) != '') {
				$this->lst.=$line;
				$arr = explode(",",$line);
				array_push($this->db, new MyFile($arr[0],$arr[1],$arr[2]));
			 }
		}
		fclose($mf);
	}
	
    function getByName ($name) { 
		$res="";
		foreach($this->db as $file){
			if($name == $file->getName()){
				$res.=$file;
				$res.="\n";
			}
		}
		return $res; 
	}
    function getByContentString ($content) { 
		$res="";
		foreach($this->db as $file){
			if(strpos($file->getContent(),$content) !== false){
				$res.=$file;
				$res.="\n";
			}
		}
		return $res; 
	}
	function getByHash ($has) { 
		$res="";
		foreach($this->db as $file){
			if(strcmp($has, $file->getMyHash()) == 0){
				$res.=$file;
				$res.="\n";
			}
		}
		return $res; 
	}
	function listAll () {
		return "".$this->lst;	
	}
	function getByContentBytes($bytes){
		try {
			$content="";
			$arr = explode(" ",$bytes);
			foreach($arr as $nr){
				$hex = intval($nr, 16); 
				$content.=chr($hex);
			}
			$res = $this->getByContentString($content);
		}catch (Exception $e) {
			$res= "Caught exception.\n";
		}
		return $res;
	}
}

include_once("hessianPHP/HessianService.php");
$service = new HessianService(new PHPServer());
$service->handle();
?>
