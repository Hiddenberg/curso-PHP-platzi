<?php
/* Te enseño que son los métodos mágicos en PHP y sus diferentes usos  */
 /* Los llamados metodos magicos en PHP no son mas que un conjunto de funciones especificas (piezas de código) que se ejecutan al realizar ciertas acciones con un objeto, por ejemplo al momento de crear un nuevo objeto, modificarlo, */

class ObjetoDeEjemplo {

   public function __construct($parametro){
      /* codigo a ejecutar */
   }

}

class Persona {

  public function __construct($nombreCompleto, $años){

    $this->nombre = $nombreCompleto;
    $this->edad = $años;

    /* esta funcion se ejecuta al crear una nueva persona, automaticamente comprueba si es mayor y guarda el resultado en una variable
    para poder usarla despues si es necesario*/
    if ($años >= 18){
      $this->esMayorDeEdad = true;
    } else {
      $this->esMayorDeEdad = false;
    }

  }
}

/* ahora al momento de crear el objeto "Persona" debemos darle el nombre y la edad como parametros */
$victor = new Persona('Victor Pazaran',24);

/* si queremos saber el nombre completo o si es mayor de edad lo podemos hacer de esta forma */

if ($victor->esMayorDeEdad){
  echo "$victor->nombre tiene $victor->edad años, por lo que es mayor de edad";
} else {
  echo "$victor->nombre tiene $victor->edad años, por lo que es menor de edad";
}

echo "<br>";
echo "<br>";



class Automovil {

  private $marca; /* LAS PROPIEDADES ESTAN ESTABLECIDAS COMO PRIVADAS ESTA VEZ */
  private $color;

  public function __get($atributo){

    /* confirmaremos si un atributo existe al momento de querer acceder al mismo */
    if(property_exists($this, $atributo)) {
      return $this->$atributo; /* si existe regresara el valor que tenga guardado en dicho atributo/propiedad */
    } else {
      echo "El atributo <strong>$atributo</strong> no existe dentro de este objeto "; /* y si no existe solo regresara un mensaje indicandolo */
    }
  }

  /* para la funcion __set() es necesario darle 2 parametros, el atributo que queremos modificar o crear,
  y el valor que va a recibir dicho atributo */
  public function __set($atributo,$valor){
    $this->$atributo = $valor;
  }

}

/* Veamos como y cuando se ejecutan dichas funciones */

$auto1 = new Automovil(); //creamos el objeto de tipo "Automovil" vacio (sin propiedades aun)

/* El metodo __set() se ejecutara automaticamente al momento que nosotros asignemos una
propiedad a este objeto, ya sea para crearla o modificarla, como en este caso*/

$auto1->marca = 'ferrari';
$auto1->color = 'rojo'; //solo modificamos la propiedad "color" y "marca" que ya existian (aunque estas sean privadas)

$auto1->modelo = '1990'; //aqui creamos una nueva propiedad que no existia anteriormente en el objeto


/* El metodo __get() se ejecutara al momento que queramos acceder al valor de una de las propiedades
de los objetos */

echo "Su auto registrado es un $auto1->marca de color $auto1->color";

echo "el dueño es: $auto1->dueño"; 
//como no regitramos la propiedad dueño anteriormente lo que obtendremos aqui sera un mensaje indicando
//que esta propiedad "dueño" no existe (ya que esto lo programamos en el __get())

echo "<br>";
echo "<br>";

class DiscoDuro {
  private $marca = 'kingston';
  private $contraseña = 'fgmrde<z';
  private $capacidadMaxima;

  /* supongamos que por alguna razon si nos preguntan por el atributo "contraseña" en especifico
  con un isset(), queremos que el programa les devuelva siempre un valor "false" y cambie la contraseña a la palabra "confidencial" aun si existe o no, pero si es
  cualquier otro atributo les devolvera true o false solamente dependiendo si existen o no */
  public function __isset($atributo){
    if ($atributo == 'contraseña'){
      echo 'confidencial ';
      return false;
    } else {
      return isset($this->$atributo);
    }
  }

  /* supongamos que por ningun motivo queremos que se elimine el atributo "contraseña", asi que comprobaremos si nos piden esto con unset(),
  y de ser asi, mandaremos un mensaje diciendo que no esta permitido e impediremos que sea borrada dicha propiedad */
  public function __unset($atributo){
    if ($atributo == 'contraseña'){
      echo 'NO SE PUEDE ELIMINAR ESTE ATRIBUTO ';
      return;
    } else {
      unset($this->$atributo);
    }
  }
}

$HDD1 = new DiscoDuro(); //creamos un nuevo objeto del tipo DiscoDuro



var_dump(isset($HDD1->marca)); //Devuelve "bool(true)" ya que declaramos/configuramos la marca al crear la clase del objeto
var_dump(isset($HDD1->capacidadMaxima)); //Devuelve "bool(false)" ya que aunque la variable fue declarada al crear la clase no tiene ningun valor asignado
var_dump(isset($HDD1->RPM)); //Devuelve "bool(false)" ya que esta propiedad no fue declarada en ninguna parte del codigo

var_dump(isset($HDD1->contraseña)); //Esto nos devolvera siempre "false" aunque esta propiedad SI tiene un valor asignado
/* esta comprobacion ↑ aparte nos imprimira la palabra confidencial, ya que asi lo programamos en el __isset() */


/* Finalmente con unset() se ejecutara lo que esté dentro del metodo magico del mismo nombre __unset()*/

unset($HDD1->marca); //Elmimnamos la propiedad "marca"
var_dump(isset($HDD1->marca)); //Por lo que ahora si comrpobamos nuevamente si existe esta propiedad nos devolvera bool(false)


/* pero si tratamos de hacer lo mismo con la propiedad "contraseña",
nos mostrara un error diciendo 'NO SE PUEDE ELIMINAR ESTE ATRIBUTO ' como lo programamos anteriormente*/

unset($HDD1->contraseña); //Esto nos imprimira el mensaje que configuramos anteriormente, pero no eliminara la propiedad,
// ya que no le especificamos que hiciera esto si la propiedad era "contraseña"


echo "<br>";
echo "<br>";


/* Supongamos que necesitamos crear una clase "Email", la cual va a contener el destinatario, titulo y el contenido del correo, 
y queremos que tenga formato automaticamente cuando accedamos al objeto "Email" como un string/cadena de texto ya sea mediante la funcion echo, print, etc.*/

class Email {
  private $destinatario = 'fulanito@coreo.com';
  private $titulo = "Apoyo para compras en linea";
  private $contenido = "Buenos dias estimado señor Fulanito
                        le solicito su apoyo para poder realizar mis compras en linea ya que la plataforma
                        no responde cuando trato de finalizar mi compra, de antemano gracias
                        Saludos. ";
/* aqui ↑ inventamos un correo para este ejemplo rapido, pero tomen en cuenta que esto se podria sacar de una base de datos*/


  /* ahora con el metodo magico __toString() podemos hacer que este correo tenga un formato basico para poder mostrarlo en pantalla*/

  public function __toString(){
    $emailFormateado = "<strong>$this->titulo</strong> </br> <i style='display: block; width: 500px;'>$this->contenido</i>"; 
    //con esto ↑ hacemos que muestre el titulo en negritas y el contenido en letra italica en un bloque de 500pixeles de ancho
    
    return $emailFormateado; // finalmente hacemos que cuando se consulte regrese la variable que creamos
  }
}

$email1 = new Email();

echo $email1; //directamente nos mostrara el email formateado tal como lo establecimos en el metodo magico __toString()

echo "<br>";
echo "<br>";

class Tabla {
  public $nombreTabla;
  public $entradas;
  public $DBconexion;


  /* de esta forma establecemos que solo estos 2 atributos seran serializados,
  ya que para este ejemplo no nos intereza serializar la informacion sobre la conexion a la base de datos */
  public function __sleep() {
      return ['nombreTabla', 'entradas'];
      //esto automaticamente detectara los atributos como $this->nombreTabla y $this->entradas
  }

  /* en este caso supongamos que la base de datos no fue serializada asi que cuando se des-serialice el objeto haremos que se
  reconecte automaticameente a la base de datos */
  public function __wakeup() {

    $this->DBconexion = DB::connect();
  }
}

echo "<br>";
echo "<br>";



/* supongamos que tenemos una aplicacion para manejar restaurantes, y queremos que cuando se registre una nueva reservacion 
la agregue al contador de ese mismo restaurante (dentro del mismo objeto) pero aparte que ejecute una conexion a la base de datos
donde estan todos los otros restaurantes y registre todos lo que se hace como una especie de Log*/
class Restaurante {
  private $reservacionesTotales = 0;
  public $meseros;
  public $clientes;

  protected function agregarReservacion () {
    $this->reservacionesTotales ++;
  }

  public function __call($metodo, $parametros){

    /* verificamos primero si el metodo que estan tratando de ejecutar en este objeto existe con la funcion "method_exists()"
    y si existe nos lo permitia ejecutarlo aun cuando este metodos fue definido como "protected"*/
    if (method_exists($this,$metodo)){
      call_user_func([$this,$metodo]);
      registrarEjecucion("Se ejecuto el metodo $metodo exitosamente con los parametros <i>" .implode(' ',$parametros)."</i>");
      /* esta funcion ↑ lo que hace es guardar un string especificando que fue lo que se ejecuto y con que parametros
      para poder llevar un registro de todos los movimientos de este programa */
    } else {
      registrarEjecucion("Se intentó ejecutar el metodo $metodo con los parametros <i>" .implode(' ',$parametros)."</i> pero no fue posible");
    }
  }
}

/* para este ejemplo practico solo mostraremos el Log en pantalla pero esto bien podria conectarse
a una base de datos para tener un registro de todo lo que se intento ejecutar */
function registrarEjecucion(string $log){
  echo $log;
}

/* creamos el nuevo objeto de tipo Restaurante y asignamos las propiedades publicas*/
$pizzaPlatza = new Restaurante();
$pizzaPlatza->meseros = 8;
$pizzaPlatza->clientes = 43;


$pizzaPlatza->agregarReservacion(); // nos devolvera "Se ejecuto el metodo agregarReservacion exitosamente con los parametros" en pantalla

$pizzaPlatza->noExiste('parametro de ejemplo'); // nos devolvera "Se intentó ejecutar el metodo noExiste con los parametros parametro de ejemplo pero no fue posible" en pantalla


echo "<br>";
echo "<br>";

/* creamos la clase niño */
class Niño {

  public $nombre;

  /* a esta clase le podemos asignar el nombre directamente al momento que creemos el objeto
  gracias al metodo __construct() (usamos la variable $n solo para almacenar temporalmente el nombre y poder asignarlo correctamente) */
  public function __construct($n){
    $this->nombre = $n;
  }
}

/* aqui creamos el objeto niño1 asignandole directamente el nombre 'Juan',
y despues a la variable $niño2 le asignamos el mismo objeto ($niño1)*/
$niño1 = new Niño('Juan');
$niño2 = $niño1;

/* por lo que ahora si hacemos cualquier cambo a la variable de $niño2, en realidad los cambios
los estaremos haciendo directamente a la primera que creamos ($niño1) */
$niño2->nombre = 'Gabriel';

/* podemos confirmar esto al mostrar cual es el nombre que contiene cada una de los niños */
echo "$niño1->nombre"; //Nos devuelve 'Gabriel'
echo "$niño2->nombre"; //Tambien devolvera 'Gabriel'

echo "<br>";
echo "<br>";

/* para este ejemplo creamos la clase Oveja */
class Oveja {

  public $nombre;

  public function __construct($n) {
    $this->nombre = $n;
  }

  /* supongamos que queremos que se nos indique siempre que se cree un nuevo clon de este objeto
  para esto vamos a mandar una notificacion, y vamos a agregar 'clon' al inicio del nombre de todos los clones cuando se creen */
  public function __clone(){
    enviarNotificacion($this->nombre);

    $this->nombre = "Clon de " . $this->nombre;
  }
}

/* para este ejemplo la funcion enviarNotificacion solo mostrara un aviso en pantalla,
pero nuevamente esto podria ser una conexion a base de datos o tal vez un mensaje enviado por SMS */
function enviarNotificacion($nombreDeOveja){
  echo "<b><i>la oveja $nombreDeOveja ha sido clonada exitosamente</i></b>";
}

/* creamos una nueva oveja y procedemos a clonarla */
$oveja1 = new Oveja('Dolly');
$oveja2 = clone $oveja1;

/* ahora esta vez si mostramos los nombres de ambas ovejas veremos que son distintos */
echo $oveja1->nombre; //nos devuelve 'Dolly'
echo $oveja2->nombre; //nos devuelve 'Clon de Dolly'

echo "<br>";
echo "<br>";

/* crearemos la clase Operacion que nos permitira realizar diferentes operaciones matematicas, pero haremos que
si nosotros usamos el objeto como una funcion por defecto devolvera la suma entre 2 numeros*/
class Operacion {

  /* estas funciones tomaran 2 numeros como parametro, con los cuales haran las operaciones */
  public function suma($numero1, $numero2) {
    return $numero1 + $numero2;
  }
  public function resta($numero1, $numero2) {
    return $numero1 - $numero2;
  }
  public function multiplicacion($numero1, $numero2) {
    return $numero1 * $numero2;
  }
  public function division($numero1, $numero2) {
    return $numero1 / $numero2;
  }

  /* con el metodo magico __invoke() haremos que como un atajo podamos usar un objeto para hacer una suma directamente */
  public function __invoke($numero1, $numero2){
    return $this->suma($numero1, $numero2);
  }
}

/* creamos el objeto en una variable */
$sum = new Operacion();

/* y ahora podemos usar dicha variable para sumar, como si se tratara de una funcion */
echo $sum(40,30); //esto nos devolvera el numero '70' en pantalla