<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobvideos extends MX_Controller {

    // */10 * * * * php /home/v2.keonhacai888.com/public_html/assets/index.php cronjobs Jobvideos getvideos
    public function getvideos()
    {
        if(is_cli())
        // if(true)
        {
            try 
            {
                $page = 1;
                $break = FALSE;
                $this->load->model('Video');
                do 
                {
                    $url = 'http://video.bongdahd.info/api/Highlights/videos/' . $page;
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
                        $referent_id = 'a' . $item->Id;
                        if($this->Video->isExist($referent_id))
                        {
                            echo 'complete videos!'. PHP_EOL;
                            $break = TRUE;
                            break;
                        }
                        $slug = slugify(trim( $item->title));
                        $referent_id = $this->Video->insertVideos($referent_id, $item->title, $slug, $item->thumb, $item->videourl);
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