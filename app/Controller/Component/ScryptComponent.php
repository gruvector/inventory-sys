<?php




App::uses('Component', 'Controller');
App::uses('ThemeView', 'View');
App::import('Vendor', 'scrypt', array('file' => 'scrypt/scrypt.php'));

class ScryptComponent extends Component {

   private $controller = null;
    
   const CPU_DIFF =128;
   
   const  MEM_DIFF=8;
   
   const  PAR_DIFF=1;

   public function initialize(Controller $controller) {
        $this->controller = $controller;
    }


 /**
     * for  password hash
     * values below will have to be put into the system as constants and 
     * also removed from the final password
     * @param string $password
     * @param string $hash     to be used to compare
     * @param int    $N        The CPU difficultly (must be a power of 2, > 1) --General work factor, iteration count.
     * @param int    $r        The memory difficultly --relative memory cost   --blocksize in use for underlying hash; fine-tunes the relative memory-cost.
     * @param int    $p        The parallel difficultly --parallelization cost --parallelization factor; fine-tunes the relative cpu-cost.
    */  
      public function create_hash($password,$salt=false,$N=self::CPU_DIFF,$r=self::MEM_DIFF,$p=SELF::PAR_DIFF){
		 
		  try {
		 $combined_hash=Password::hash($password,$salt,$N,$r,$p);
		 list ($N, $r, $p, $salt, $hash) = explode('$', $combined_hash);
		 return  $salt . '$' . $hash ;
		 }catch(Exception $e){
		 return false ;
	
		 
		  }
		  }
      
      
 /*
  *  this is for checking the password hash 
  *  for checking hashes
     *@param int    $N        The CPU difficultly (must be a power of 2, > 1) --General work factor, iteration count.
     *@param int    $r        The memory difficultly --relative memory cost   --blocksize in use for underlying hash; fine-tunes the relative memory-cost.
     *@param int    $p        The parallel difficultly --parallelization cost --parallelization factor; fine-tunes the relative cpu-cost.
  */
       public function check_hash($password,$hash,$N=self::CPU_DIFF,$r=self::MEM_DIFF,$p=SELF::PAR_DIFF){
		   
		   list($salt,$hash)=explode('$',$hash);
		  $check_hash = $N . '$' . $r . '$' . $p . '$' . $salt . '$' . $hash;	   
		  return Password::check($password,$check_hash);
		  
		  }
		  
    //this is for  generating salt 	
    //this is for the length of the salt	 		  
	   public function generateSalt($length=30){
			 
		return  Password::generateSalt($length);
		
			 } 
			 
		//easy pass for low security
		//high user convience	 
			 
     function generatePass() {
        $len = 10;
        $base = "abcdefghijklmnopqrstuvwxzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $max = strlen($base) - 1;
        $passcode = '';
        mt_srand((double) microtime() * 1000000);
        while (strlen($passcode) < $len + 2)
            $passcode.=$base{mt_rand(0, $max)};
        return $passcode;
    }
  

}

?>
