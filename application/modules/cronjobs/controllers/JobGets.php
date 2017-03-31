<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JobGets extends MX_Controller {

    // */30 * * * * php /home/v2.keonhacai888.com/public_html/assets/index.php cronjobs JobGets getresultbong24
    public function getresultbong24()
    {
        if(is_cli())
        // if(true)
        {
            try 
            {
                $type = 'static';
                $item_setting = 'season_result';

                $this->load->model('Settings');
                
                $url = 'http://bongda24h.vn';

                echo '#GET: '. $url . PHP_EOL;
                $html_data = CallAPI_BASICAUTH($url);
                
                $doc = new DOMDocument();
                // We don't want to bother with white spaces
                $doc->preserveWhiteSpace = true;
                $doc->resolveExternals = true;

                libxml_use_internal_errors(true);
                $doc->loadHTML($html_data);
                libxml_clear_errors();

                $xpath = new DOMXPath($doc);

                //We starts from the root element
                $q_result = "//div[@class='conten_nd_right']/div[@class='ltd_kq']";

                $_result_season = $xpath->query($q_result);
                foreach ($_result_season as  $season) {
                    $html_result = DOMinnerHTML($season);
                    break;
                }
                
                $id = $this->Settings->Insert($type, $item_setting, $html_result);
                echo $id . PHP_EOL;

                echo 'done!'. PHP_EOL;
            }
            catch (Exception $e) {
                echo "Caught exception: ".$e->getMessage().PHP_EOL;
            }
        }
        else
        {
            show_404($page = '', $log_error = TRUE);
        }
    }
}