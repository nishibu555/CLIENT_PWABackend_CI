<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Api extends REST_Controller {
  
  public function __construct() {
     parent::__construct();
     $this->load->database();
  }

 //for cors error in crome browser
  private function cors() {
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
    }
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    }
  }

       
    
	public function index_get(){

        $this->cors();
        //frontend:  this.http.get(`${apiLink}?action=get-menu`);

        $action = $this->input->get('action');

        $portfolioId = $this->input->get('portfolioId');


        switch ($action) {

            case 'about-us':
                $data = $this->aboutUs();
                break; 

            case 'contact-us':
                $data = $this->contactus();
                break; 

            case 'all-portfolio-category':
                $data = $this->getAllPortfolioCategory();
                break; 

            case 'all-client':
                $data = $this->getAllClient();
                break; 

            case 'all-testimonial':
                $data = $this->getAllTestimonial();
                break; 

            case 'all-portfolio':
                $data = $this->getAllPortfolio();
                break;

            case 'all-portfolio-image':
            $data = $this->getAllPortfolioImage();
            break;

            case 'portfolio-image-byId':
            $data = $this->getPortfolioImageById($portfolioId);
            break;

            case 'portfolio-by-Id':
                $data = $this->getPortfolioById($portfolioId);
                break; 

            case 'delete-portfolio':
                $data = $this->getOnePortfolio($portfolioId);
                break; 

            case 'heading':
                $data = $this->getHeading();
                break; 

            case 'all-home-cover-image':
                $data = $this->HomeCover();
                break; 


            default:
                $data="";
                break;
        }

        $this->response($data, REST_Controller::HTTP_OK);
	}
      
 

  public function index_post() {

	    $this->cors();
      $input = file_get_contents("php://input");
      $result= json_decode($input);

      $action=$result->action;
     
      switch ($action) {

          case 'send-mail':
              $data = $this->sendMail($result);
              break;

          case 'add-portfolio':
              $data = $this->addPortfolio($result);
              break;
          
          case 'update-portfolio':
              $data = $this->updatePortfolio($result);
              break;   

          default:
              $data=["Not Found Any Action"];
              break;
      }

      $this->response($data, REST_Controller::HTTP_OK);
    
  } 


//Get 
  public function sendMail($result){

       $email = $result->email;
       $name= $result->name;
       $message = $result->message;


              $config['useragent'] = 'CodeIgniter';
              $config['protocol'] = 'smtp';
              $config['smtp_host'] = 'smtp.mailtrap.io';
              $config['smtp_user'] = 'f63df823fa2c18';
              $config['smtp_pass'] = '8bbcc4349be385';
              $config['smtp_port'] = 2525;
              $config['smtp_timeout'] = 5;
              $config['wordwrap'] = TRUE;
              $config['wrapchars'] = 76;
              $config['mailtype'] = 'html';
              $config['charset'] = 'utf-8';
              $config['validate'] = FALSE;
              $config['priority'] = 3;
              $config['crlf'] = "\r\n";
              $config['newline'] = "\r\n";
              $config['bcc_batch_mode'] = FALSE;
              $config['bcc_batch_size'] = 200;

              $this->email->initialize($config);

              $this->email->from($email, $name);
              $this->email->to('rakeshroyshuvo@gmail.com');
              $this->email->cc('another@another-example.com');
              $this->email->bcc('them@their-example.com');

              $this->email->message(' '.$message.' ');
              $this->email->send();

              return "send";

   }


  public function HomeCover(){
    return $this->db->get('homecoverimage')->result();
  }


  public function getHeading(){
    return $this->db->get('headings')->result();
  }

   public function getAllPortfolioCategory(){
      return $this->db->get('portfolio_category')->result();
  }

  

  public function aboutUs(){
      return $this->db->get('about_us')->result();
  } 

  public function getAllClient(){
    return $this->db->get('clients')->result();
  }

   public function getAllTestimonial(){
     return $this->db->get('testimonial')->result();
   }

    public function getAllPortfolio(){

      return $this->db->get('portfolio')->result();
    }

    public function getPortfolioById($id){

      return $this->db->where('id', $id)->from('portfolio')->get()->row();
    }


    public function deletePortfolio($portfolioId){
      $this->db->where('id', $portfolioId)->delete('portfolio');

      return "Portfolio Deleted";
    } 


    public function getAllPortfolioImage(){
      return $this->db->get_where( "portfolio_image", [ 'type'=>1 ] )->result();
    }   
    
    public function getPortfolioImageById($id){
        return $this->db->get("portfolio_image")->result();
    }

    public function contactus(){
      return $this->db->get('contact_us')->result();
    }

//post
    // public function addPortfolio($result){
    //   $data=array();
    //   $data['']=$result->;
    //   $this->db->insert('portfolio',$data);

    //   return "Portfolio Added";
    // }


    public function updatePortfolio($result){
      $data=array();
      $data['title']=$result->title;
      $this->db->where('id', $result->portfolioId)->update("portfolio", $data);

      $response=array();
      $response['message']="Data Updated Successfully";
      $response['updated_data']=$this->db->where('id', $result->portfolioId)->from('portfolio')->get()->row();

      return $response;
    }

  

}