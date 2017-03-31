<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobnews extends MX_Controller {

    // */10 * * * * php /home/v2.keonhacai888.com/public_html/assets/index.php cronjobs Jobnews getnews
    public function getnews()
    {
        if(is_cli())
        // if(true)
        {
            try 
            {
                $page = 1;
                $break = FALSE;
                $this->load->model('News');
                do 
                {
                    $url = 'http://video.bongdahd.info/api/tintuc/news/' . $page;
                    echo '#GET: '. $url . PHP_EOL;
                    $json_data = CallAPI_BASICAUTH($url);
                    $json_obj = json_decode($json_data);
                    if(isset($json_obj->status)) //Signature has expired
                    {
                        echo 'error: ' . $json_obj->status . ', message: ' . $json_obj->error . PHP_EOL;
                        break;
                    }

                    if(isset($json_obj->page))
                    {
                        $page = $json_obj->page;
                    }
                    else
                    {
                        $page = 6;
                    }

                    foreach ($json_obj->result as $item) 
                    {
                        if($this->News->isExist($item->VendorId))
                        {
                            echo 'complete news!'. PHP_EOL;
                            $break = TRUE;
                            break;
                        }

                        $referent_id = $this->News->insertNews($item->VendorId, $item->NewsCategoryId, $item->Title, $item->Slug, $item->Image, $item->Description, filterLink($item->Content));
                        echo $referent_id . PHP_EOL;
                    }

                    if($break)
                        break;

                } while ( $page != null && $page <= 5);

                //load nhận định
                $page = 1;
                $break = FALSE;
                do
                {
                    $url = 'http://video.bongdahd.info/api/tintuc/nhandinhs/' . $page;
                    echo '#GET: '. $url . PHP_EOL;
                    $json_data = CallAPI_BASICAUTH($url);
                    $json_obj = json_decode($json_data);
                    if(isset($json_obj->status)) //Signature has expired
                    {
                        echo 'error: ' . $json_obj->status . ', message: ' . $json_obj->error . PHP_EOL;
                        break;
                    }

                    if(isset($json_obj->page))
                    {
                        $page = $json_obj->page;
                    }
                    else
                    {
                        $page = 6;
                    }

                    foreach ($json_obj->result as $item)
                    {
                        $vendor_id = 'n'.$item->VendorId;
                        if($this->News->isExist($vendor_id))
                        {
                            echo 'complete nhandinhs!'. PHP_EOL;
                            $break = TRUE;
                            break;
                        }
                        $_description = getDescription($item->Content);
                        $referent_id = $this->News->insertNews($vendor_id, $item->NewsCategoryId, $item->Title, $item->Slug, $item->Image, $_description, filterLink($item->Content));
                        echo $referent_id . PHP_EOL;
                    }

                    if($break)
                        break;

                } while ( $page != null && $page <= 5);
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