<?php

/**
 * Created by PhpStorm.
 * User: Mr. Winz
 * Date: 6/28/2017
 * Time: 8:41 AM
 */
class General_model extends CI_Model
{


    public function award_point ($uid, $action='like') {
        switch ($action) {
            case 'ask': $point = 20; break;
            case 'answer': $point = 50; break;
            case 'like': $point = 10; break;
            case 'unlike': $point = -10; break;
            case 'fav': $point = 20; break;
            case 'unfav': $point = -20; break;
            case 'correct': $point = 50; break;
            case 'referral': $point = 50; break;
        }
        $cur_point = $this->Util_model->get_info("user_profile","point","WHERE uid=$uid");
        return $this->Db_model->update("user_profile",array("point" => ($cur_point + $point)),"WHERE uid=$uid");
    }

    public function list_categories () {
        $q = $this->Db_model->selectGroup("*","categories","ORDER BY name");
        $cats = '';
        foreach ($q->result_array() as $row) {
            $cats .= "<li><a href='".base_url()."questions/category/$row[name]/$row[id]'>$row[name]</a></li>";
        }
        $cats .= "<li><a href='".base_url()."questions/category/uncategorised/0'>Uncategorised</a></li>";
        return $cats;
    }

    public function list_tags () {
        $q = $this->Db_model->selectGroup("*","tags","ORDER BY title");
        $tags = '';
        foreach ($q->result_array() as $row) {
            $tags .= "<li><a href='".base_url()."questions/tags/$row[title]/$row[id]'>$row[title]</a></li>";
        }
        return $tags;
    }

    public function get_balance ($uid) {
        $deposit = $this->Util_model->sum_field("user_wallet","amount","WHERE receiver=$uid AND type='01' AND status='01'");
        $withdraw = $this->Util_model->sum_field("user_wallet","amount","WHERE sender=$uid AND type='02' AND status='01'");
        $balance = $deposit - $withdraw;
        return number_format($balance);
    }

    public function view_star ($uid) {
        $point = $this->Util_model->get_user_info($uid,"point","profile");
        $star = "<span class='text-orange'>";
        if ($point >= 2500) {
            $star .= '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
        } else if ($point >= 2250) {
            $star .= '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>';
        } else if ($point >= 2000) {
            $star .= '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>';
        } else if ($point >= 1500) {
            $star .= '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
        } else if ($point >= 1250) {
            $star .= '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
        } else if ($point >= 1000) {
            $star .= '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
        } else if ($point >= 750) {
            $star .= '<i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
        } else if ($point >= 500) {
            $star .= '<i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
        } else if ($point >= 251) {
            $star .= '<i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
        } else {
            $star .= '<i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
        }

        $star .= "</span>";
        return $star;
    }

    public function slides () {
        $s = $this->Db_model->selectGroup("*","code_param_desc","WHERE tab_index=64");
        $num = $s->num_rows();
        $slides = '<ol class="carousel-indicators">';
        for ($i=0; $i<$num; $i++) {
            $active = ($i == 0 ? "class='active'" : "");
            $slides .= "<li data-target='#carousel-example-generic' data-slide-to='$i' $active></li>";
        }
        $slides .= '</ol>';
        $slides .= '<div class="carousel-inner">';
        $count = 0;
        foreach ($s->result_array() as $row) {
            $active = ($count == 0 ? "active" : "");
            $slides .= "
            <div class='item $active'>
                <img src='".base_url()."$row[item_desc]' alt='$row[item_xdesc]'>

                <div class='carousel-caption'>
                    $row[item_xdesc]
                </div>
            </div>
            ";
            $count++;
        }
        $slides .= '</div>';
        return $slides;
    }

    public function top_prediction () {
        $s = $this->Db_model->selectGroup("*","code_param_desc","WHERE tab_index=65");
        if ($s->num_rows() > 0) {
            $view = "";
            foreach ($s->result_array() as $row) {
                $ticket = $this->Util_model->get_info("ticket","*","WHERE id=$row[item_desc]");
                $view .= "
                    <div class='box box-widget widget-user-2'>
                        <div class='widget-user-header bg-warning'>
                            <div class='widget-user-image'>
                                <img class='img-circle img-bordered-sm' src='".base_url().$this->Util_model->picture($ticket['baseID'],'base_main')."'/>
                            </div>
                            <h4 class='widget-user-username'>".$this->Main_model->get_base_link($ticket['baseID'],$this->Util_model->get_info("base_main","name","WHERE id=$ticket[baseID]"))."</h4>
                            <h5 class='widget-user-desc'>@".$this->Util_model->get_info("base_main","username","WHERE id=$ticket[baseID]")."</h5>
                        </div>
                        <div class='box-footer no-padding'>
                            <ul class='nav nav-stacked'>";
                            $games = explode(",",$ticket['games']);
                            for ($i=0; $i<count($games); $i++) {
                                $game = $this->Util_model->get_info("games","*","WHERE id=$games[$i]");
                                $country = $this->Util_model->fetch_item_desc(67,$game['country']);
                                $country = ($country == NULL ? $game['country'] : $country);
                                $league = $this->Util_model->fetch_item_desc(68,$game['league']);
                                $home = $this->Util_model->fetch_item_desc(69,$game['home']);
                                $away = $this->Util_model->fetch_item_desc(69,$game['away']);
                                $view .= "<li>
                                    <a href='javascript:;'>
                                       <b>$country</b> <i class='fa fa-angle-right'></i> $league - <small>$game[kickoff]</small> <br>
                                       ".$this->Main_model->game_status($game['id'])." $home  <span class='badge'>VS</span>  $away
                                       <span class='pull-right badge bg-green text-bold'>".$this->Util_model->fetch_item_desc(66,$game['prediction'])."</span>
                                       ".$this->Main_model->win_loss_marker($game['id'])."
                                </li>";
                            }
                        $view .="    
                        </div>
                    </div>
                    ";
            }
        }
        return $view;
    }

    public function top_users () {
        $s = $this->Db_model->selectGroup("*","top_suggestions","ORDER BY RAND() LIMIT 4");
        $view = "";
        $color = array("green","aqua","yellow","red");
        $count = 0;
        if ($s->num_rows() > 0) {
            foreach ($s->result_array() as $row) {
                $view .= '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box bg-'.$color[$count].'">
                    <span class="info-box-icon"><i class="fa"><img src="'.base_url().$this->Util_model->picture($row['uid']).'" class="img-circle img-md"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">'.$this->Main_model->get_user_link($row['uid'],$this->Util_model->get_user_info($row['uid'])).'</span>
                      <span class="info-box-number" style="font-size:14px">@'.$this->Util_model->get_user_info($row['uid'],"username","profile").'</span>

                      <div class="progress">
                        <div class="progress-bar" style="width: '.$this->Main_model->get_user_percentage($row['uid']).'%"></div>
                      </div>
                          <div class="progress-description">
                            <span class="pull-left text-bold">'.$this->view_star($row['uid']).'</span>
                            <span class="pull-right text-bold">'.$this->Main_model->get_user_percentage($row['uid']).'%</span>
                          </div>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->';
                $count++;
            }
        }

        if ($count < 4) {
            $s = $this->Db_model->selectGroup("*","user_profile","WHERE role<>3 ORDER BY point DESC LIMIT 4");
            if ($s->num_rows() > 0) {
                foreach ($s->result_array() as $row) {
                    if ($this->Util_model->row_count("top_suggestions","WHERE uid=$row[uid]") == 0) {
                        $view .= '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                          <div class="info-box bg-'.$color[$count].'">
                            <span class="info-box-icon"><i class="fa"><img src="'.base_url().$this->Util_model->picture($row['uid']).'" class="img-circle img-md"></i></span>
        
                            <div class="info-box-content">
                              <span class="info-box-text">'.$this->Main_model->get_user_link($row['uid'],$this->Util_model->get_user_info($row['uid'])).'</span>
                              <span class="info-box-number" style="font-size:14px">@'.$this->Util_model->get_user_info($row['uid'],"username","profile").'</span>
        
                              <div class="progress">
                                <div class="progress-bar" style="width: '.$this->Main_model->get_user_percentage($row['uid']).'%"></div>
                              </div>
                                  <div class="progress-description">
                                    <span class="pull-left text-bold">'.$this->view_star($row['uid']).'</span>
                                    <span class="pull-right text-bold">'.$this->Main_model->get_user_percentage($row['uid']).'%</span>
                                  </div>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                        <!-- /.col -->';
                                if ($count == 3) break;
                                $count++;
                    }

                }
            }
        }
        return $view;
    }

    public function list_base ($uid=NULL) {
        $uid = ($uid == NULL) ? get_sessdata(UID) : $uid;
        $s = $this->Db_model->selectGroup("*","base_main","WHERE uid=$uid");
        $view = "";
        if ($s->num_rows() > 0) {
            foreach ($s->result_array() as $row) {
                $view .= "<li><a href='".base_url()."base/$row[username]'>$row[name]</a></li>";
            }
        }
        $view .= "<li><a href='javascript:;' onclick='dialog(\"".base_url()."ajax/own-base\",\"create=new\",\"gen-modal\",\"sm\")'>Own a base</a></li>";
        echo $view;
    }

    public function own_base () {
        $view = "<div class='modal-header'>
            <h4 class='modal-title'>
                <i class='fa fa-home'></i> Own a base
                <button class='close' type='button' data-dismiss='modal' aria-hidden='true'>&times;</button>
            </h4> 
        </div>
        <div class='modal-body'>
            <div class='callout callout-info'>
                <p>Own a base by any of these means</p> 
            </div>
            <ul class='nav nav-stacked'>";
                if ($this->Util_model->row_count("base_main","WHERE uid=".get_sessdata(UID)) == 0) :
                $view .= "
                <li>
                    <a href='".base_url()."base/create-new'>Create new base <span class='label label-success pull-right'>free</span></a>
                </li>
                ";
                endif;
                $view .= "
                <li>
                    <a href='".base_url()."trade/buy-base'>Purchase base <span class='label label-warning pull-right'>paid</span></a>
                </li>
                <li>
                    <a href='".base_url()."trade/lease-base'>Lease base <span class='label label-warning pull-right'>paid</span></a>
                </li>
                <li>
                    <a href='".base_url()."base/rent-base'>Rent base <span class='label label-warning pull-right'>paid</span></a>
                </li>
            </ul>
        </div> ";
        return $view;
    }

    public function add_stack () {
        $view = "<div class='modal-header'>
            <h4 class='modal-title'>
                Add stack
                <button class='close' type='button' data-dismiss='modal' aria-hidden='true'>&times;</button>
            </h4> 
        </div>
        <div class='modal-body'>
            <div class='callout callout-info'>
                <p>Own more stacks</p> 
            </div>
            <ul class='nav nav-stacked'>";
                $view .= "
                <li>
                    <a href='javascript:;' onclick='processAjax(\"".base_url()."ajax/stack_form\",\"base_id=".get_sessdata('base_id')."\",_(\"gen-modal-content\"))'>Create new stack <span class='label label-success pull-right'>free</span></a>
                </li>
                <li>
                    <a href='".base_url()."trade/buy-stack'>Purchase a stack <span class='label label-warning pull-right'>paid</span></a>
                </li>
            </ul>
        </div> ";
        return $view;
    }

    public function check_base_username ($username) {
        /*if (strstr($username,array("_",",",".","*","#","&","!","~","$","%","^","(",")","+","=","{","}","[","]",":",":","'","<",">","?","/"))) {
            $arr[0] = false;
            $arr[1] = "<span class='text-red'>Invalid characters contained</span>";
        } else {*/
            if ($this->Util_model->row_count("base_main","WHERE username='$username'") > 0) {
                $arr[0] = false;
                $arr[1] = "<span class='text-red'>Unavailable</span>";
            } else {
                $arr[0] = true;
                $arr[1] = "<span class='text-green'>Available</span>";
            }
        //}
        return $arr;
    }

}