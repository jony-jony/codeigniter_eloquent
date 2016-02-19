<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    public $validator;
    public $db;
        public function __construct() {
            parent::__construct();
            $this->load->library('jeloquent');
            $this->load->library('jvalidator', ['lang' => 'es']);
            $this->validator = $this->jvalidator->validator;
            $this->db = $this->jeloquent->db;
        }
	public function index()
	{
//                $x = $this->db->table('proveedores')->get();
//                $x = Providers::get();
//                var_dump($x);exit;
                $data = array("nombre" => "Logitech");
                $rules = array(
                    "nombre" => "required|unique:proveedores,nombre,2,id_proveedor",
                );
                $validator = $this->validator->make($data, $rules);
                if($validator->passes()) {
                    echo "ok";
                }else {
                    var_dump($validator->messages()->all());
                }
//		$this->load->view('welcome_message');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */