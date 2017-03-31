<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class FrontendController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
        if($this->config->item('maintenance_mode') == TRUE) {
            $this->twig->display('_layouts/maintenance');
            die();
        }
        $this->load->model(['Settings','Banners','Sliders']);
        
        $this->twig->set('banners' , $this->Banners->getBanners() , TRUE);
        $this->twig->set('slider' , $this->Sliders->getSlider() , TRUE);
        $this->twig->set('menus' , $this->Menu->getMenus('main') , TRUE);
        
        $this->twig->set('season_result' ,  $this->Settings->GetSeting('season_result') , TRUE);

        // load seo
        $this->twig->set('meta', $this->Menu->getMenuByCode(current_menu(1)));
        // if($_metas!=null)
        // {
        //     $this->twig->title($_metas->MetaTitle);
        //     $this->twig->meta('keywords', $_metas->MetaKeywords);
        //     $this->twig->meta('description', $_metas->MetaDescription);
        //     $this->twig->set('description' , $_metas->MetaDescription , TRUE);
        // }
        // 
        // 
        // if($this->facebook->is_authenticated())
        // {
        //     $user = $this->session->userdata('is_logged_frontend');
        //     if($user==null)
        //     {
        //         $user = $this->facebook->request('get', '/me');
        //         $this->load->model('ModelCustomer');
        //         $user = $this->ModelCustomer->loginCustomer($user['id'],$user['name']);
        //         $this->session->set_userdata('is_logged_frontend', $user);
        //     }
        //     $this->twig->set('user', $user, TRUE);

        //     $this->twig->set('logout_url', site_url('/logout'), TRUE);
        // }
        // else
        // {
        //     $this->twig->set('login_url', $this->facebook->login_url(), TRUE);
        // }

        
        
        
    }
}
