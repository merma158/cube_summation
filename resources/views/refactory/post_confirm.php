<?


// In Driver Model
/**
* 
*/
class Driver extends Model{
  

  function __construct(argument){}
  // associations
  public function services() {
    has_many :services
  }

  public function setAvailable() {
    $this->available = "0"; // fixme 
  }

}

/**
* 
*/
class Service extends Model{
  // El key debe corresponder o describir cada status
  private $array_status = array(
    "status_1" => "1",
    "status_2" => "2",
    "status_6" => "6"
  );

  private $owner_error = new OwnerError();

  function __construct(argument){}

  // associations
  public function driver(){
    belongs_to :driver
  }

  public function confirmar_servicio($driver_id) {

    if ($this->status_id == $this->getStatusValue('status_6')){
      return array("error" => $owner_error->getErrorMessage("error_2"))
    }

    if (! $this->is_available()){
      return array("error" => $owner_error->getErrorMessage("error_1"))
    }

    

    // ==> fixme this block should be in database transaction
    $this->driver_id = $driver_id;
    $this->status_id = $this->getStatusValue("status_2");

    $driver = $this->driver();
    $driver->setAvailable();
    $driver->save();

    $this->car_id = $driver->car_id;
    $this->save();
    // <== fixme this block should be in database transaction

    // fixme si esta condicion indica que la transaccion no debe procesarse entonces esta condicion va en la linea: 53
    if ($this->user->uuid == ''){ 
      return array("error" => $owner_error->getErrorMessage("error_0"));
    }

    $notification = New Notification();
    $notification->send_for($this->user->type, $this->user->uuid, $this->id);
    return array("error" => $owner_error->getErrorMessage("error_0"));
  }

  public function is_available() {
    return ( is_null($this->driver_id) && 
             $this->status_id == $this->getStatusValue("status_1"))
  }

  public function getStatusValue($tag) {
    $this->array_status[$tag];
  }
}

/**
* 
*/
class OwnerError extends AnotherClass {
  // El key debe corresponder o describir cada error
  private $errors = array(
    "error_0" => "0",
    "error_1" => "1",
    "error_2" => "2",
    "error_3" => "3"
  );
  function __construct(argument){}

  public function getErrorMessage($tag) {
    return $this->errors[$tag];
  }
}

/**
* 
*/
class Notification extends AnotherClass{
  
  private $notification_messages = array(
    "service_success_confirm" => "Tu Servicio ha sido confirmado!"
  );

  private $receiver = array(
    "iphone"  => "1",
    "android" => "x"
  );

  private $push = Push::make();

  function __construct(argument){}

  public function send_for($type, $uuid, $id) {
    $result = null;

    switch ($type) {
      case $receiver["iphone"]:
        $result = $push->ios(
                              $uuid, 
                              $notification_messages["service_success_confirm"], 
                              1, 
                              'honk.wav', 
                              'Open', 
                              array("serviceId" => $id)
                            );
        break;
      
      default:
        $result = $push->android2(
                                    $uuid, 
                                    $pushMessage, 
                                    1, 
                                    'default', 
                                    'Open', 
                                    array("serviceId" => $id)
                                  );
        break;
    }
    
    return $result; 
    }
  }

}


public function post_confirm(){

  $owner_error = new OwnerError();

  $service_id = Input::get('service_id');
  $driver_id  = Input::get('driver_id');
  $servicio   = Service::find($service_id);

  if ($servicio) {
    return Response::json($servicio->confirmar_servicio($driver_id));    
  } else {
    return Response::json(array('error' => $owner_error->getErrorMessage("error_3")));
  }
}
