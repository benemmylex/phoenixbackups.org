<?php

/**
 * Created by PhpStorm.
 * User: Mr. Winz
 * Date: 2/27/2018
 * Time: 3:08 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Base_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    private function get_following ($follower) {
        $s = $this->Db_model->selectGroup("*","connect","WHERE follower=$follower");
        $result = array();
        if ($s->num_rows() > 0) {
            foreach ($s->result_array() as $row) {
                $result[] = $row['following'];
            }
        }
        return $result;
    }

    public function view_base_header_count ($base_id) {
        $view ='
            <div class="col-sm-3 col-xs-3 border-right">
                <div class="description-block">
                    <div class="description-header">'.$this->Util_model->row_count("base_followers","WHERE baseID=$base_id").'</div>
                    <div class="description-text"><a href="'.base_url().'base/'.$this->Util_model->get_info("base_main","username","WHERE id=$base_id").'/connects/followers" style="">Followers</a></div>
                </div>
            </div>
            <div class="col-sm-3 col-xs-3 border-right">
                <div class="description-block">
                    <div class="description-header">'.$this->Util_model->row_count("stacks","WHERE baseID=$base_id AND status=1").'</div>
                    <div class="description-text"><a href="'.base_url().'base/'.$this->Util_model->get_info("base_main","username","WHERE id=$base_id").'/stack">Stacks</a></div>
                </div>
            </div>
            <div class="col-sm-3 col-xs-3 border-right">
                <div class="description-block">
                    <div class="description-header">'.$this->Util_model->row_count("ticket","WHERE baseID=$base_id").'</div>
                    <div class="description-text"><a href="'.base_url().'base/'.$this->Util_model->get_info("base_main","username","WHERE id=$base_id").'/ticket">Tickets</a></div>
                </div>
            </div>
            <div class="col-sm-3 col-xs-3 border-right">
                <div class="description-block">
                    <div class="description-header">'.$this->Util_model->row_count("user_subscription","WHERE baseID=$base_id").'</div>
                    <div class="description-text"><a href="'.base_url().'base/'.$this->Util_model->get_info("base_main","username","WHERE id=$base_id").'/subs">Subs</a></div>
                </div>
            </div>';

        echo $view;
    }

    private function get_suggested ($base_id, $top_suggestions=3, $total_suggestions=8) {
        $s = $this->Db_model->selectGroup("*","top_suggestions","WHERE uid<>$base_id ORDER BY RAND()");
        $sug = array();
        $sugs = array();
        if ($s->num_rows() > 0) {
            $count = 0;
            foreach ($s->result_array() as $row) {
                if ($this->Util_model->row_count("connect","WHERE follower=$base_id AND following=$row[uid]") == 0) {
                    $sug[] = $row['uid'];
                    $count++;
                }
                if ($count == $top_suggestions) {
                    break;
                }
            }
        }
        if (count($sug) > 0) {
            $my_f = $this->get_following($base_id); // People i'm following
            if (count($my_f) > 0) {
                foreach ($my_f as $my_f1) {
                    $my_ff = $this->get_following($my_f1); // People the person i'm following is following
                    if (count($my_ff) > 0) {
                        foreach ($my_ff as $my_ff1) {
                            $sugs[] = $my_ff1;
                            $my_fff = $this->get_following($my_ff1); // People the person following the person I'm following are following
                            if (count($my_fff) > 0) {
                                foreach ($my_fff as $my_fff1) {
                                    $sugs[] = $my_ff1;
                                }
                            }
                        }
                    }
                }
            }
            if (count($sugs) > 0) {
                $count = 0;
                shuffle($sugs);
                foreach ($sugs as $f_id) {
                    if ($this->Util_model->row_count("connect","WHERE follower=$base_id AND following=$f_id") == 0 && !in_array($f_id,$sug)) {
                        $sug[] = $f_id;
                        $count++;
                    }
                    if (($count + $top_suggestions) == $total_suggestions) {
                        break;
                    }
                }
            }
        }
        if (count($sug) < $total_suggestions) {
            if (!isset($count)) $count = 0;
            $s = $this->Db_model->selectGroup("uid","user_profile","WHERE uid<>$base_id AND code='".$this->Util_model->get_info('user_profile','code',"WHERE uid=$base_id")."' ORDER BY RAND()");
            if ($s->num_rows() > 0) {
                foreach ($s->result_array() as $row) {
                    if ($this->Util_model->row_count("connect","WHERE follower=$base_id AND following=$row[uid]") == 0 && !in_array($row['uid'],$sug)) {
                        $sug[] = $row['uid'];
                        $count++;
                    }
                    if (($count + count($sug)) == $total_suggestions) {
                        break;
                    }
                }
            }
        }
        if (count($sug) < $total_suggestions) {
            if (!isset($count)) $count = 0;
            $s = $this->Db_model->selectGroup("uid","user_profile","WHERE uid<>$base_id ORDER BY RAND()");
            if ($s->num_rows() > 0) {
                foreach ($s->result_array() as $row) {
                    if ($this->Util_model->row_count("connect","WHERE follower=$base_id AND following=$row[uid]") == 0 && !in_array($row['uid'],$sug)) {
                        $sug[] = $row['uid'];
                        $count++;
                    }
                    if (($count + count($sug)) == $total_suggestions) {
                        break;
                    }
                }
            }
        }

        return $sug;
    }

    public function view_suggested_mini ($base_id) {
        $top = 3; // Num of top suggested members
        $total = 8; // Total number of members to suggest
        $suggested = $this->get_suggested($base_id, $top, $total);
        $view = '<ul class="users-list clearfix">';
        foreach ($suggested as $s_id) { //$s_id: suggested id
            $view .= "<li>
                        <img src='".base_url().$this->Util_model->picture($s_id)."' alt='User Image'>";
                        $view .= $this->Main_model->get_user_link($s_id,"@".$this->Util_model->get_user_info($s_id,'username','profile'));
                        $view .= "<span  class='users-list-date'>".$this->General_model->view_star($s_id)."</span><br>";
                        $view .= ($this->Util_model->row_count("connect","WHERE follower=$base_id AND following=$s_id") == 0) ? "<a href='javascript:;' id='sug-mini-$s_id' onclick='follow_unfollow(\"$base_id\",\"$s_id\",\"follow\",\"mini\",_(\"sug-mini-$s_id\"))'>Follow</a>" : "";
                    $view .= "</li>";
        }
        $view .= '</ul>';
        return $view;
    }

    public function view_timeline ($base_id, $limit) {
        $q = $this->Db_model->selectGroup("*","posts","WHERE refID=$base_id ORDER BY DATE(date) DESC , date DESC");
        $view = "";
        if ($q->num_rows() > 0) {
            $view = '<ul class="timeline">
                <!-- timeline time label -->
                <li class="time-label">
                    <span class="bg-blue">What people are saying</span>
                </li>';
            $count = 1;
            foreach ($q->result_array() as $info) {
                $posted = get_time_ago($info['date']);
                $asked_user = $this->Main_model->get_user_link($info['uid'], $this->Util_model->get_user_info($info['uid']));
                $comment_input = (!is_sess(UID))?"placeholder='Please sign in to add comment' disabled='disabled'":"placeholder='Press enter to post comment'";
                $view .= '
                <li class="no-padding" style="margin-right: 0px;">
                    <i class="fa"><img src="'.base_url().$this->Util_model->picture($info['uid']).'" class="img-circle img-sm" /></i>
                    <div class="timeline-item no-padding" style="margin-right: 0px;">
                        <span class="time">
                            '.$posted.'
                        </span>
                        <h3 class="timeline-header">
                            '.$asked_user.' 
                            &nbsp;<span class="text-orange">'.$this->General_model->view_star($info['uid']).'</span>
                            
                        </h3>
                        <div class="timeline-body">
                            '.$info['content'].'
                        </div>
                        <div class="timeline-footer no-padding no-curve top-1x bottom-1x" id="comment-box-'.$info['id'].'">
                            '.$this->Main_model->view_comment($info['id'],2).'
                        </div>
                        <div class="timeline-footer">
                            <form action="#" method="post">
                                <img class="img-responsive img-circle img-sm" src="'.base_url().$this->Util_model->picture(get_sessdata(UID)).'" alt="USER">
                                <div class="img-push">
                                    <input type="text" class="form-control input-sm" '.$comment_input.' onkeydown="post_comment(event,$(this),\''.$info['id'].'\',2)">
                                </div>
                            </form>
                        </div>
                    </div> <!-- /.timeline-item -->
                </li>';
                $count++;
                if ($count > 5) {
                    break;
                }
            }
            if ($q->num_rows() > 5) {
                $view .= '
                        <li class="time-label">
                            <a class="bg-warning" href="'.base_url().'base/'.$this->Util_model->get_user_info($base_id,'username','profile').'/timeline/0">See all posts >>> </a>
                        </li>';
            }
            $view .= '</ul> <!-- /.timeline -->';
        } else {
            $view = '<div class="box box-solid">
                <div class="box-body">
                    No post as at now
                </div>
            </div>';
        }

        return $view;
    }

    public function view_connect ($base_id, $what='followers') {
        $where = ($what == 'followers') ? "WHERE following=$base_id" : "WHERE follower=$base_id";
        $s = $this->Db_model->selectGroup("*","connect","$where ORDER BY id DESC");
        $view = "";
        if ($s->num_rows() > 0) {
            $view .= "<div class='box box-solid'>
                <div class='box-body' id='follow_unfollow'> ";
            foreach ($s->result_array() as $row) {
                if ($what == 'followers') {
                    $btn = "<div class='btn-group pull-right'>";
                    if ($this->Util_model->row_count("connect","WHERE follower=".get_sessdata(UID)." AND following=$row[follower]") == 0 AND $row['follower'] != get_sessdata(UID)) {
                        $btn .= "<button class='btn btn-primary btn-sm' id='follow-unfollow-$row[follower]' onclick='follow_unfollow(\"".get_sessdata(UID)."\",\"$row[follower]\",\"follow\",\"list\",_(\"follow-unfollow-$row[follower]\"))' type='button'>Follow</button>";
                    }
                    if ($this->Util_model->row_count("connect","WHERE following=".get_sessdata(UID)." AND follower=$row[follower] AND status=1") == 1 AND $base_id==get_sessdata(UID)) {
                        $btn .= "<button class='btn btn-warning btn-sm' onclick='block_unblock_follower(\"$row[id]\",0,\"base_follower\")' type='button'>Block</button>";
                    }
                    else if ($this->Util_model->row_count("connect","WHERE following=".get_sessdata(UID)." AND follower=$row[follower] AND status=0") == 1 AND $base_id==get_sessdata(UID)) {
                        $btn .= "<button class='btn btn-danger btn-sm' onclick='block_unblock_follower(\"$row[id]\",1,\"base_follower\")' type='button'>Unblock</button>";
                    }
                    $btn .= "</div>";
                } else if ($what == 'following') {
                    if ($base_id==get_sessdata(UID)) {
                        $btn = "<button class='btn btn-danger btn-sm pull-right' id='follow-unfollow-$row[following]' onclick='follow_unfollow(\"".get_sessdata(UID)."\",\"$row[following]\",\"unfollow\",\"list\",_(\"follow-unfollow-$row[following]\"))' type='button'>Unfollow</button>";
                    } else {
                        if ($this->Util_model->row_count("connect","WHERE follower=".get_sessdata(UID)." AND following=$row[following]") == 0 AND $row['following'] != get_sessdata(UID)) {
                            $btn = "<button class='btn btn-primary btn-sm pull-right' id='follow-unfollow-$row[following]' onclick='follow_unfollow(\"".get_sessdata(UID)."\",\"$row[follower]\",\"follow\",\"list\",_(\"follow-unfollow-$row[following]\"))' type='button'>Follow</button>";
                        }
                    }
                }
                $link_id = ($what == 'followers') ? $row['follower'] : $row['following'];
                $view .= "<div class='row question'>
                    <div class='col-md-12 col-sm-12 col-xs-12'>
                        <img class='img-circle img-md img-bordered-sm' style='margin-right: 10px' src='".base_url().$this->Util_model->picture($row['follower'])."' alt='".$this->Util_model->get_user_info($row['follower'])."'>
                        <h4 class='top-pad-1x' style='margin-bottom:0px'>".$this->Main_model->get_user_link($link_id,$this->Util_model->get_user_info($link_id))." ".$this->General_model->view_star($row['follower'])."</h4>
                        <span class='pull-left text-default'>@".$this->Util_model->get_user_info($link_id,'username','profile')."</span>
                        $btn
                    </div>
                </div>";
            }
            $view .= "</div>
                </div>";
        } else {
            $view = "<div class='well'>Nothing found. <a href='#'>See suggestions</a></div>";
        }
        return $view;
    }

    public function follow_unfollow ($follower, $following, $type, $pack="user") {
        if ($type == 'follow') {
            if ($pack == "user") {
                if ($this->Util_model->row_count("connect", "WHERE follower=$follower AND following=$following") == 0) {
                    return $this->Db_model->insert("connect", array("follower" => $follower, "following" => $following));
                } else {
                    return true;
                }
            } else {
                if ($this->Util_model->row_count("base_followers", "WHERE follower=$follower AND baseID=$following") == 0) {
                    return $this->Db_model->insert("base_followers", array("follower" => $follower, "baseID" => $following));
                } else {
                    return true;
                }
            }

        }
        else if ($type == 'unfollow') {
            if ($pack == "user") {
                if ($this->Util_model->row_count("connect","WHERE follower=$follower AND following=$following") == 1) {
                    return $this->Db_model->delete("connect","WHERE follower=$follower AND following=$following");
                } else {
                    return true;
                }
            } else {
                if ($this->Util_model->row_count("base_followers","WHERE follower=$follower AND baseID=$following") == 1) {
                    return $this->Db_model->delete("base_followers","WHERE follower=$follower AND baseID=$following");
                } else {
                    return true;
                }
            }

        }


    }

    public function check_ticket ($ticket_id) {
        $s = $this->Util_model->get_info("ticket","games","WHERE id=$ticket_id");
    }

    public function get_base_percentage ($base_id) {
        $total = $this->Util_model->row_count("ticket","WHERE baseID=$base_id AND status=2");
        $wins = $this->Util_model->row_count("ticket","WHERE baseID=$base_id AND status=2 AND win_loss=1");
        $total = ($total == 0) ? 1 : $total;
        $percent = ($wins / $total) * 100;
        return round($percent);
    }

    public function get_stack_percentage ($stack_id) {
        $total = $this->Util_model->row_count("ticket","WHERE stack=$stack_id AND status=2");
        $wins = $this->Util_model->row_count("ticket","WHERE stack=$stack_id AND status=2 AND win_loss=1");
        $total = ($total == 0) ? 1 : $total;
        $percent = ($wins / $total) * 100;
        return round($percent);
    }

    public function stack_form ($base_id) {
        $point = $this->Util_model->get_info("user_profile","point","WHERE uid=".$this->Util_model->get_info("base_main","uid","WHERE id=$base_id"));
        $stacks = $this->Util_model->row_count("stacks","WHERE baseID=$base_id");
        $form = form_open(base_url()."base/stack/create-new/$base_id","role='form'");
        $form .= "<div class='modal-header'>
                    <h4 class='modal-title'>
                        Create Stack
                        <button class='close' type='button' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    </h4> 
                </div>
                <div class='modal-body'>";
        $form .= '
            
                <div class="form-group">
                    <label for="stackName">Stack Name <span class="required">*</span></label>
                    <input type="text" class="form-control" id="stackName" maxlength="15" required="required" name="stackName" placeholder="Maximum of 15 characters">
                </div>
                <div class="form-group">
                    <label for="stackDesc">Stack Description</label>
                    <textarea class="form-control" id="stackDesc" name="stackDesc" style="resize:none" placeholder="Write all about this stack"></textarea>
                </div>
                <div class="form-group">
                    <label for="stackSports">Stack Sports <span class="required">*</span></label>
                    <select class="form-control" id="stackSports" name="stackSports" required="required">';
        $form .= $this->Util_model->list_from_table("sports_main","keyword","title","WHERE status=1");
        $form .= '</select>
                </div>
            </div>
            <!-- /.modal-body -->
            <div class="modal-footer">
                <button type="submit" id="stackBtn" class="btn btn-primary">Create stack</button>
            </div>
            ';
        $form .= form_close();

        if ($stacks == 0) {
            echo $form;
        } else if ($point >= 500 && $stacks < 2) {
            echo $form;
        } else if ($point >= 1000 && $stacks <3) {
            echo $form;
        } else if ($point >= 1500 && $stacks <4) {
            echo $form;
        } else if ($point >= 2000 && $stacks <5) {
            echo $form;
        } else if ($point >= 2500 && $stacks <6) {
            echo $form;
        } else {
            echo "<div class='modal-header'>
                    <h4 class='modal-title'>
                        Create Stack
                        <button class='close' type='button' data-dismiss='modal' aria-hidden='true'>&times;</button>
                    </h4> 
                </div>
                <div class='modal-body'>
                    <div class='alert alert-info'><i class='fa fa-info-circle'></i> You need more stars to add more stacks</div>
                </div>";
        }
    }

    public function list_stacks ($base_id) {
        $s = $this->Db_model->selectGroup("*","stacks","WHERE baseID=$base_id");
        if ($s->num_rows() > 0) {
            $view = "";
            foreach ($s->result_array() as $row) {
                $percent = $this->get_stack_percentage($row['id']);
                $color = ($percent >= 50) ? 'text-green' : 'text-red';
                $active = ($row['status'] == 1) ? "<span class='badge bg-green pull-right'>Enabled</span>" : "<span class='badge bg-red pull-right'>Disabled</span>";
                $view .= "<div class='col-md-4 col-sm-4 col-xs-4' style='height: auto'>
                    <div class='panel panel-default'>
                        <div class='panel-body'>
                            <div class='text-gray font-1x' style='line-height: 7px'>$row[sports]</div>
                            <div class='text-blue' style='font-size: 1.3em'><a href='".base_url()."base/stack/$row[id]'>$row[name]</a></div>
                            <div class='$color font-2x'>$percent%</div>
                            $active
                        </div>
                    </div>
                </div>";
            }
            return $view;
        }
    }

}


















