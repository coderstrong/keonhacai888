<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JobFixture extends MX_Controller {

    // */1 * * * * php /home/v2.keonhacai888.com/public_html/assets/index.php cronjobs JobFixture getfixtures
    public function getfixtures()
    {
        if(is_cli())
        // if(true)
        {            
            try 
            {
                $page = 1;

                $this->load->model('Fixture');
                do 
                {
                    $url = 'http://video.bongdahd.info/api/live/getlive/' . $page;

                    echo '#GET: '. $url . PHP_EOL;
                    $json_data = CallAPI_BASICAUTH($url);
                    $json_obj = json_decode($json_data);
                    if(isset($json_obj->status)) //Signature has expired
                    {
                        echo 'error: ' . $json_obj->status . ', message: ' . $json_obj->error . PHP_EOL;
                        break;
                    }

                    $page = $json_obj->page;

                    foreach ($json_obj->result as $item)
                    {
                        //insert club
                        $club_home = $this->Fixture->insertClub($item->TeamHome_name, $item->TeamHome_image);
                        $club_away = $this->Fixture->insertClub($item->TeamAway_name, $item->TeamAway_image);

                        //insert tuor
                        $tournament_id = $this->Fixture->insertTour($item->Tournament_name);
                        $referent_id = $item->Id;
                        $referent_id = $this->Fixture->Insert($referent_id, $club_home, $club_away, $tournament_id, $item->LiveMatchTypeId, $item->Slug, $item->StartDate, $item->server_0, $item->server_1, $item->server_2, $item->server_3, $item->server_4, $item->server_5, $item->server_6, $item->server_7, $item->server_8, $item->auto_sopcast, $item->auto_nowgoal, $item->auto_idsimulator);
                        echo $referent_id . PHP_EOL;
                    }

                } while ( $page != null && $page <= 10);

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