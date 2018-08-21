 <?php
/**
 *
 */
class User{
   private $_db,
            $_data,
            $_sessionName,
            $_isLoggendIn,
            $_CookieName,
            $_Permission;

  //protected $hashCheck = " ";

  function __construct($user = null )
  {
    $this->_db = DB::getInstance();
    $this->_sessionName = Config::get('session/session_name');
    $this->_CookieName= Config::get('remember/cookie_name');

    if (!$user) {
      // code... if not username aplay chake if session exists
      if(Session::exists($this->_sessionName)){

        $user = Session::get($this->_sessionName); // $this return id store in session
        if ($this->find($user)) {             // id is send to find() and chaked is_numeric()
           $this->_isLoggendIn = true;
        }else {
           //logout ...
        }
      }
    }else {
      $this->find($user);
    }

  }

  public function find($user = null){
    if ($user) {
      $field = is_numeric($user)? 'id' : 'username';
      $data = $this->_db->get('users',array($field, '=', $user));
      if ($this->_db->count()) {
        $this->_data = $this->_db->first();
        return true;
      }
    }
    return false;
  }

  public function login($username = null, $password = null, $remember =false )  {

  if (!$username && !$password && $this->exists()) { //for if remember me cliked in last login
        Session::put($this->_sessionName, $this->data()->id);
  }else{

     $user = $this->find($username);
     //print_r($this->_data);
      if ($user) {
        if ($this->data()->password === Hash::make($password, $this->data()->salt)) {
          Session::put($this->_sessionName, $this->data()->id);

          if ($remember) {
            $hash= Hash::unique();
            $hashCheck = $this->_db->get('users_session', array('user_id', '=', $this->data()->id));

                        if (!$this->_db->count()) {
                            // $hash= Hash::unique();
                            $this->_db->insert('users_session', array(
                                'user_id' => $this->data()->id,
                                'hash' => $hash
                            ));
                        } else {
                            $hash = $this->_db->first()->hash;
                        }
                    Cookie::put($this->_CookieName, $hash, Config::get('remember/cookie_expiry'));
          }
          return true;
        }
      }
    }

     return false;
  }

  public function data(){
    return $this->_data;
  }

  public function exists(){
      return (!empty($this->_data)? true: false);
  }

  public function isLoggendIn(){
    return $this->_isLoggendIn;
    return true;
  }

  public function Logout(){
    Session::delete($this->_sessionName);
    $this->_db->delete('users_session', array('user_id', "=", $this->data()->id)); // delete from users_session tabel by user id
   Cookie::delete($this->_CookieName); // for chack remember me // user in login time // for delete cookie from user computer
  }

  public function create($tabel,$fields = array()){
    if (!$this->_db->insert($tabel, $fields)) {
      throw new Exception("Error Processing Request ", 1);

    }
  }

public function update($tabel, $fields =array(), $id=null){
          if(!$id && $this->isLoggedIn()){
              $id= $this->data()->id;
          }
          if (!$this->_db->update($tabel,'id', $id, $fields)){
              throw new Exception("there problem in updating.");
          }
    }

    public function hasPermission(){
          $group= $this->_db->get('groups', array('id', '=', $this->data()->groups));
          //print_r($this->_db->first());
          if($this->_db->count()){
            //$parmisstion= json_decode( $this->_db->first()->permisstion, true);
          //  print_r($parmisstion);
            // if($parmisstion[$key] == true){
            //     return true;
            // }
              $this->_Permission = $this->_db->first();
              return true;
          }
              return false;
      }

      public function Permission(){
        return $this->_Permission;
      }

}
  ?>
