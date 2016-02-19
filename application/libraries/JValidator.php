<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;
use Illuminate\Container\Container;
use Illuminate\Database\Connectors\ConnectionFactory;
use Illuminate\Database\ConnectionResolver;
use Illuminate\Validation\DatabasePresenceVerifier;
class JValidator {

    private $fileloader;
    private $translator;
    private $ci;
    public  $validator;

    public function __construct($params = ["lang" => "en"]) {
        $this->ci = & get_instance();
        $this->ci->load->library("jeloquent");
        $file_system = new Filesystem();
        $this->fileloader = new FileLoader($file_system, ROOT . "application" . DS . "lang");
        $this->translator = new Translator($this->fileloader, $params["lang"]);
        $this->translator->setFallback($params["lang"]);
        $this->validator = new Factory($this->translator);
        $container = new Container();
        $connFactory = new ConnectionFactory($container);
        $connection = $connFactory->make($this->ci->config->item($this->ci->config->item("default"),"conecctions"));
        $resolver = new ConnectionResolver();
        $resolver->addConnection('default', $connection);
        $resolver->setDefaultConnection('default');
//        $presence_verifier = new DatabasePresenceVerifier($this->ci->jeloquent->db);
        $presence_verifier = new DatabasePresenceVerifier($resolver);
        $this->validator->setPresenceVerifier($presence_verifier);
    }
    
    /**
     * Establece el idioma para mostrar los mensajes de error
     * @param type $lang Idioma
     */
    public function setLang($lang = "en") {
        $this->translator->setLocale($lang);
    }

}
