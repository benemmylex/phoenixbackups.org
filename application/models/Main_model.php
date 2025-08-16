<?php
/**
 * Created by PhpStorm.
 * User: Mr. Winz
 * Date: 5/24/2017
 * Time: 10:21 AM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function tracking_status_form ($id) {
        if (!is_numeric($id)) {
            $view = '
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">New Status</h4>
                    </div>
                    <div class="modal-body col-md-12 col-sm-12 col-xs-12">
                        <form class="form-horizontal form-material">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="col-md-12">Heading</label>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Enter the status heading" id="txt-heading" class="form-control form-control-line">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="col-md-12">Content</label>
                                    <div class="col-md-12">
                                        <textarea placeholder="Enter the status content" id="txt-content" class="form-control form-control-line"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="col-md-12">Date & Time</label>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <input type="date" placeholder="YYYY-MM-DD" id="txt-date" class="form-control form-control-line">
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-xs-5">
                                        <input type="time" placeholder="HH:MM:SS" id="txt-time" class="form-control form-control-line">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12" id="form-msg"></div>
                        </form>
        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal" onclick="reloadPage()">Close</button>
                        <button type="button" class="btn btn-primary" onclick="save_status(\''.$id.'\',\''.base_url().'ajax/save-status\',$(this))">Save</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            ';
        } else {
            $row = $this->Db_model->select("*","package_track","WHERE id=$id");
            $view = "
                <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span></button>
                        <h4 class='modal-title'>Update Status</h4>
                    </div>
                    <div class='modal-body col-md-12 col-sm-12 col-xs-12'>
                        <form class='form-horizontal form-material'>
                            <div class='col-md-12 col-sm-12 col-xs-12'>
                                <div class='form-group'>
                                    <label class='col-md-12'>Heading</label>
                                    <div class='col-md-12'>
                                        <input type='text' placeholder='Enter the status heading' id='txt-heading' class='form-control form-control-line' value='$row[heading]'>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-12 col-sm-12 col-xs-12'>
                                <div class='form-group'>
                                    <label class='col-md-12'>Content</label>
                                    <div class='col-md-12'>
                                        <textarea placeholder='Enter the status content' id='txt-content' class='form-control form-control-line'>$row[content]</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-12 col-sm-12 col-xs-12'>
                                <div class='form-group'>
                                    <label class='col-md-12'>Date & Time</label>
                                    <div class='col-md-7 col-sm-7 col-xs-7'>
                                        <input type='date' placeholder='YYYY-MM-DD' id='txt-date' class='form-control form-control-line' value='".new_date_format($row['date'],'Y-m-d H:i:s','Y-m-d')."'>
                                    </div>
                                    <div class='col-md-5 col-sm-5 col-xs-5'>
                                        <input type='time' placeholder='HH:MM:SS' id='txt-time' class='form-control form-control-line' value='".new_date_format($row['date'],'Y-m-d H:i:s','H:i:s')."'>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-12 col-sm-12 col-xs-12' id='form-msg'></div>
                        </form>
        
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-default pull-left' data-dismiss='modal' onclick='reloadPage()'>Close</button>
                        <button type='button' class='btn btn-primary' onclick='save_status(\"".$id."\",\"".base_url()."ajax/save-status\",$(this))'>Save</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            ";
        }

        return $view;
    }

    public function save_status ($id, $heading, $content, $date=NULL, $time=NULL) {
        $date = ($date == NULL) ? date_time('d') : $date;
        $time = ($time == NULL) ? date_time('t') : $time;

        if (!is_numeric($id)) {
            $input = array(
                "order_no"          =>  $id,
                "heading"           =>  ucwords($heading),
                "content"           =>  ucfirst($content),
                "date"              =>  $date." ".$time,
                "agent"             =>  userdata(UID)
            );
            return $this->Db_model->insert("package_track",$input);
        } else {
            $input = array(
                "heading"           =>  ucwords($heading),
                "content"           =>  ucfirst($content),
                "date"              =>  $date." ".$time,
                "agent"             =>  userdata(UID)
            );
            return $this->Db_model->update("package_track",$input,"WHERE id=$id");
        }
    }

    public function list_tracking_status ($order_no) {
        $s = $this->Db_model->selectGroup("*","package_track","WHERE order_no='$order_no'");
        if ($s->num_rows() > 0) {
            $date = "";
            $view = "";
            $color = array('bg-red','bg-blue','bg-green','bg-yellow');
            foreach ($s->result_array() as $row) {
                shuffle($color);
                $date_time = explode(" ",$row['date']);
                $row_date = $date_time[0];
                if ($date != $row_date) {
                    $view .= '
                    <li class="time-label">
                        <span class="'.$color[0].'">
                        '.new_date_format($row['date'],'Y-m-d H:i:s', 'd M. Y').'
                        </span>
                    </li>
                    ';
                    $date = $row_date;
                }
                $view .= "
                <!-- timeline item -->
                    <li>
                        <i class='fa fa-envelope $color[1]'></i>

                        <div class='timeline-item'>
                            <span class='time'><i class='fa fa-clock-o'></i> $date_time[1]</span>

                            <h3 class='timeline-header'><a href='#'>$row[heading]</a></h3>

                            <div class='timeline-body'>
                                $row[content]
                            </div>
                        </div>
                    </li>
                    <!-- END timeline item -->
                ";
            }
            if ($this->Util_model->row_count("package_delivered","WHERE order_no='$order_no'") > 0) {
                $view .= '
                    <li class="time-label">
                        <span class="'.$color[0].'">
                        Delivered
                        </span>
                    </li>
                    ';
            }
        }

        return $view;
    }

    public function print_receipt ($order_no) {
        $row = $this->Db_model->select("*","package_main","WHERE order_no='$order_no'");
        $addr = ($row['address'] == null) ? $this->Util_model->get_option("address") : $row['address'];
        $this->load->library("Fpdf/Fpdf");
        $pdf = new Fpdf();
        $pdf->AddPage();
        //$pdf->Image(FCPATH."/assets/img/watermark.jpg",0,0,330,165);
        $pdf->SetMargins(0, 0, 0);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(100, 7, "TRACKING ACTIVE ($row[order_no])");
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(90, 7, "Receipt No: ".id_format($row['id']), 0,1,"R");
        $pdf->SetFont('Arial','B',26);
        $pdf->SetTextColor(48,118,118);
        $pdf->Cell(0, 10, "DELIVERY SERVICE",0,1,"C");
        $pdf->SetFont('Arial','B',18);
        $pdf->SetTextColor(77,77,173);
        $pdf->Cell(0, 5, strtoupper($this->Util_model->get_option('site_title')),0,1,"C");
        $pdf->SetFont('Arial','',12);
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(0, 7, $addr,0,1,"C");
        $pdf->SetTextColor(113,16,35);
        $pdf->Cell(0, 2, $this->Util_model->get_option("site_address"),0,1,"C");
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('times','',12);
        $pdf->Cell(15, 10, "Date: ");
        $pdf->Cell(40, 10, new_date_format($row['date'], 'Y-m-d H:i:s', 'd-m-Y'), "B", 1, "C");
        $pdf->SetFont('times','BU',14);
        $pdf->Cell(0, 10, "PAYMENT RECEIPT", 0, 1, "C");
        $pdf->SetFont('times','',12);
        $pdf->Cell(30, 10, "Sender Name: ");
        $pdf->Cell(175, 10, strtoupper($row['sender_name']), "B",1);
        $pdf->Cell(30, 10, "Sender Address: ");
        $pdf->Cell(175, 10, strtoupper($row['sender_address']), "B", 1);
        $pdf->Cell(30, 10, "Receiver Name: ");
        $pdf->Cell(175, 10, strtoupper($row['receiver_name']), "B",1);
        $pdf->Cell(35, 10, "Receiver Address: ");
        $pdf->Cell(175, 10, strtoupper($row['receiver_address']), "B", 1);
        $pdf->Cell(20, 10, "Route: ");
        $pdf->Cell(185, 10, $this->Util_model->get_info("countries","name","WHERE id=$row[route1]")." - ".$this->Util_model->get_info("countries","name","WHERE id=$row[route2]")." - ".$this->Util_model->get_info("countries","name","WHERE id=$row[route3]"), "B", 1);
        $pdf->Cell(30, 10, "Being paid for: ");
        $pdf->Cell(175, 10, strtoupper("PACKAGE DELIVERY ".$this->Util_model->get_info("countries","name","WHERE id=$row[origin]")." TO ".$this->Util_model->get_info("countries","name","WHERE id=$row[destination]")), "B", 1);
        $pdf->Cell(20, 10, "Amount: ");
        $pdf->Cell(185, 10, strtoupper(@number_to_words($row['receipt_amount']))." US DOLLAR", "B", 1);
        $pdf->Cell(30, 10, "Departure date: ");
        $pdf->Cell(50, 10, strtoupper($row['departure_date']." ".$row['departure_time']), "B");
        $pdf->Cell(30, 10, "Delivery date: ");
        $pdf->Cell(95, 10, strtoupper($row['delivery_date']." ".$row['delivery_time']), "B", 1);
        $pdf->Cell(0, 5, " ", 0, 1); // Spacer
        $pdf->Cell(5, 10, " ", 0); // Spacer
        $pdf->SetFont('times','B',14);
        $pdf->Cell(75, 10, "$".number_format($row['receipt_amount']), 1, 1, "C");
        $pdf->Image(FCPATH."/assets/img/signs.png",80,130,120,30);
        $pdf->Output();
    }

    public function print_invoice ($order_no) {
        $row = $this->Db_model->select("*","package_main","WHERE order_no='$order_no'");
        $addr = ($row['address'] == null) ? $this->Util_model->get_option("address") : $row['address'];
        $this->load->library("Fpdf/Fpdf");
        //$this->load->library("ean13");
        $pdf = new Fpdf();
        //$barcode = new EAN13();
        $pdf->AddPage();
        $pdf->Image(FCPATH."/assets/img/watermark.jpg",0,0); // watermark
        $pdf->Image(FCPATH."/assets/img/heading.jpg",10,15,190,20); // header
        $pdf->Cell(0, 20, "", "", 1); // Top margin
        $pdf->SetFont('times','I',6); // Font style
        $pdf->Cell(75, 5, "", 0);
        $pdf->SetTextColor(216,87,35); // Font color
        $pdf->Cell(30, 5, "ORIGIN", "TL",0, "C");
        $pdf->Cell(30, 5, "DESTINATION", "TR",0, "C");
        $pdf->SetTextColor(0,0,0);
        $pdf->Cell(65, 5, "", 0, 1);
        //first row done
        $pdf->SetFillColor(87, 158, 63); //fill color (dark green)
        $pdf->Cell(5, 5, "1", "TLR", 0, "C", true);
        $pdf->Cell(25, 5, "TRACKING NO", "TR", 0, "C");
        $pdf->SetFont('times','B',8); // Font style
        $pdf->Cell(45, 5, $row["order_no"], "TR", 0, "C");
        $pdf->Cell(30, 5, $this->Util_model->get_info("countries","name","WHERE id=$row[origin]"), "TR", 0, "C");
        $pdf->Cell(30, 5, $this->Util_model->get_info("countries","name","WHERE id=$row[destination]"), "TR", 0, "C");
        $pdf->SetFont('times','I',6); // Font style
        $pdf->Cell(55, 5, "SERVICE TYPE", "TR", 1, "C");
        //second row done
        $pdf->SetFillColor(87, 158, 63); //fill color (dark green)
        $pdf->Cell(5, 5, "2", "TLR", 0, "C", true);
        $pdf->SetFillColor(217, 230, 198); //fill color (light green)
        $pdf->Cell(25, 5, "COMPANY ADDRESS", "TR", 0, "C", true);
        $pdf->SetFont('times','B',8); // Font style
        $pdf->SetFillColor(227, 239, 246); //fill color (light blue)
        $pdf->Cell(100, 5, $addr, "TR", 0, "C", true);
        $pdf->Cell(5, 5, "", "T", 0, "C", true);
        $pdf->SetFont('times','I',6); // Font style
        $pdf->Cell(55, 5, "", "TR", 1, "C");
        //third row done
        $pdf->SetFillColor(87, 158, 63); //fill color (dark green)
        $pdf->Cell(5, 5, "", "TLR", 0, "C", true);
        $pdf->SetFillColor(217, 230, 198); //fill color (light green)
        $pdf->Cell(70, 5, "SENDER'S REFERENCE", "TR", 0, "C", true);
        $pdf->Cell(5, 5, "", "TR", 0, "C", true);
        $pdf->Cell(50, 5, "RECEIVER'S REFERENCE", "TR", 0, "C", true);
        $pdf->SetFillColor(87, 158, 63); //fill color (dark green)
        $pdf->Cell(5, 5, "7", "T", 0, "C", true);
        $pdf->Cell(55, 5, "", "R", 1, "C");
        //fourth row done
        $pdf->SetFillColor(217, 230, 198); //fill color (light green)
        $pdf->SetFont('times','B',8); // Font style
        $pdf->SetTextColor(0,0,0); // Font color
        $pdf->Cell(5, 7, "", "TLR", 0, "C", true);
        $pdf->Cell(70, 7, "NAME: $row[sender_name]", "TR", 0);
        $pdf->Cell(5, 7, "", "TR", 0, "C", true);
        $pdf->Cell(55, 7, "NAME: $row[receiver_name]", "T", 0);
        $pdf->Cell(55, 7, "", "R", 1, "C");
        //fifth row done
        $pdf->SetFillColor(217, 230, 198); //fill color (light green)
        $pdf->SetFont('times','I',6); // Font style
        $pdf->SetTextColor(0,0,0); // Font color
        $pdf->Cell(5, 5, "", "LR", 0, "C", true);
        $pdf->Cell(25, 5, "ADDRESS", "TBR", 0, "C", true);
        $pdf->Cell(45, 5, "", "R", 0, "C");
        $pdf->Cell(5, 5, "", "R", 0, "C", true);
        $pdf->Cell(20, 5, "ADDRESS", "TBR", 0, "C",true);
        $pdf->Cell(35, 5, "", 0, 0);
        $pdf->Cell(55, 5, "", "R", 1, "C");
        //sixth row done
        $pdf->SetFont('times','B',8); // Font style
        $pdf->SetTextColor(0,0,0); // Font color
        $pdf->Cell(5, 10, "", "LR", 0, "C", true);
        $pdf->Cell(70, 10, "$row[sender_address]");
        $pdf->Cell(5, 10, "", "LR", 0, "C", true);
        $pdf->Cell(55, 10, "$row[receiver_address]");
        $pdf->Cell(55, 10, "", "R", 1, "C");
        //seventh row done
        $pdf->SetFillColor(217, 230, 198); //fill color (light green)
        $pdf->SetFont('times','I',6); // Font style
        $pdf->SetTextColor(0,0,0); // Font color
        $pdf->Cell(5, 5, "", "LR", 0, "C", true);
        $pdf->Cell(25, 5, "COUNTRY", "TR", 0, "C", true);
        $pdf->Cell(45, 5, $this->Util_model->get_info("countries","name","WHERE id=$row[sender_country]"), "R", 0);
        $pdf->Cell(5, 5, "", "R", 0, "C", true);
        $pdf->Cell(20, 5, "COUNTRY", "B", 0, "C",true);
        $pdf->Cell(35, 5, $this->Util_model->get_info("countries","name","WHERE id=$row[receiver_country]"), 0, 0);
        $pdf->Cell(55, 5, "", "R", 1, "C");
        //eighth row done
        $pdf->SetFillColor(217, 230, 198); //fill color (light green)
        $pdf->SetFont('times','I',6); // Font style
        $pdf->SetTextColor(0,0,0); // Font color
        $pdf->Cell(5, 5, "", "LR", 0, "C", true);
        $pdf->Cell(25, 5, "PHONE & EMAIL", "TR", 0, "C", true);
        $pdf->Cell(45, 5, $row['sender_phone'], "R", 0);
        $pdf->Cell(5, 5, "", "R", 0, "C", true);
        $pdf->Cell(20, 5, "PHONE & EMAIL:", 0, 0, "C",true);
        $pdf->Cell(35, 5, $row['receiver_phone'], 0, 0);
        $pdf->Cell(55, 5, "", "R", 1, "C");
        //ninth row done
        $pdf->SetFillColor(217, 230, 198); //fill color (light green)
        $pdf->SetFont('times','I',6); // Font style
        $pdf->SetTextColor(0,0,0); // Font color
        $pdf->Cell(5, 5, "", "LR", 0, "C", true);
        $pdf->Cell(25, 5, "", "R", 0, "C", true);
        $pdf->Cell(45, 5, $row['sender_email'], "R", 0);
        $pdf->Cell(5, 5, "", "R", 0, "C", true);
        $pdf->Cell(20, 5, "", 0, 0, "C",true);
        $pdf->Cell(35, 5, $row['receiver_email'], 0, 0);
        $pdf->Cell(55, 5, "", "R", 1, "C");
        //tenth row done
        $pdf->SetFillColor(87, 158, 63); //fill color (dark green)
        $pdf->SetFont('times','I',6); // Font style
        $pdf->SetTextColor(0,0,0); // Font color
        $pdf->Cell(5, 5, "3", "TR", 0, "C", true);
        $pdf->SetFillColor(227, 239, 246); //fill color (light blue)
        $pdf->Cell(70, 5, strtoupper($this->Util_model->get_option("site_title"))." EXTRA SERVICE", "TR", 0, "C", true);
        $pdf->SetFillColor(87, 158, 63); //fill color (dark green)
        $pdf->Cell(5, 5, "5", "TR", 0, "C", true);
        $pdf->SetFillColor(227, 239, 246); //fill color (light blue)
        $pdf->Cell(50, 5, "SPECIAL INSTRUCTION", "TR", 0, "C", true);
        $pdf->Cell(5, 5, "", "T", 0, "C", true);
        $pdf->Cell(55, 5, "", "R", 1, "C");
        //11th row done
        $pdf->SetFillColor(87, 158, 63); //fill color (dark green)
        $pdf->SetFont('times','I',6); // Font style
        $pdf->SetTextColor(0,0,0); // Font color
        $pdf->Cell(5, 5, "", 0, 0, "C", true);
        $pdf->SetFillColor(227, 239, 246); //fill color (light blue)
        $pdf->Cell(45, 5, "DECLARED VALUE OF GOODS", "TR", 0, "C");
        $pdf->Cell(25, 5, "$".number_format($row['est_amount'])." USD", "TR", 0, "C");
        $pdf->Cell(5, 5, "", "T", 0, "C", true);
        $pdf->Cell(50, 5, "", "T", 0, "C");
        $pdf->SetFillColor(87, 158, 63); //fill color (dark green)
        $pdf->Cell(5, 5, "8", 0, 0, "C", true);
        $pdf->Cell(5, 5, "", 0, 0, "C");
        $pdf->SetFillColor(227, 239, 246); //fill color (light blue)
        $pdf->SetFont('times','B',6); // Font style
        $pdf->Cell(50, 5, "DIMENSION WEIGHT", 1, 1, "C", true);
        //12th row done
        $pdf->SetFillColor(87, 158, 63); //fill color (dark green)
        $pdf->SetFont('times','I',6); // Font style
        $pdf->SetTextColor(0,0,0); // Font color
        $pdf->Cell(5, 5, "4", "TR", 0, "C", true);
        $pdf->SetFillColor(227, 239, 246); //fill color (light blue)
        $pdf->Cell(70, 5, "CONSIGNOR AGREEMENT", "TR", 0, "C", true);
        $pdf->SetFillColor(87, 158, 63); //fill color (dark green)
        $pdf->Cell(5, 5, "6", "TR", 0, "C", true);
        $pdf->SetFillColor(227, 239, 246); //fill color (light blue)
        $pdf->Cell(50, 5, "DUTIABLE SHIPMENT INFORMATION", "TR", 0, "C", true);
        $pdf->Cell(5, 5, "", "T", 0, "C", true);
        $pdf->Cell(5, 5, "", 0, 0, "C");
        $pdf->SetFillColor(227, 239, 246); //fill color (light blue)
        $pdf->SetFont('times','B',6); // Font style
        $pdf->Cell(30, 5, "DIMENSION WEIGHT", 0, 0, "C");
        $pdf->Cell(20, 5, "$row[weight]KG", "TLR", 1, "C");
        //13th row done
        $pdf->SetFillColor(87, 158, 63); //fill color (dark green)
        $pdf->SetFont('times','B',6); // Font style
        $pdf->SetTextColor(0,0,0); // Font color
        $pdf->SetFillColor(227, 239, 246); //fill color (light blue)
        $pdf->Cell(80, 5, "", "TLR", 0, "C");
        $pdf->Cell(30, 5, "CONSIGNOR'S VAT/GST NBR", "TR", 0, "C");
        $pdf->SetFillColor(217, 230, 198); //fill color (light green)
        $pdf->Cell(20, 5, "CUSTOM     DUTIES", "TR", 0, "C", true);
        $pdf->Cell(5, 5, "", 0, 0, "C", true);
        $pdf->Cell(5, 5, "", 0, 0, "C");
        $pdf->Cell(30, 5, "DIMENSION WEIGHT", 0, 0, "C");
        $pdf->Cell(20, 5, "$row[weight]KG", "TLR", 1, "C");
        //14th row done
        $pdf->SetFillColor(87, 158, 63); //fill color (dark green)
        $pdf->SetFont('times','B',6); // Font style
        $pdf->SetTextColor(0,0,0); // Font color
        $pdf->SetFillColor(227, 239, 246); //fill color (light blue)
        $pdf->Cell(80, 5, "", "LR", 0, "C");
        $pdf->Cell(30, 5, "4453168623", "TR", 0, "C");
        $pdf->SetFillColor(217, 230, 198); //fill color (light green)
        $pdf->Cell(20, 5, "/TAXES", "R", 0, "L", true);
        $pdf->Cell(5, 5, "", 0, 0, "C", true);
        $pdf->Cell(5, 5, "", 0, 0, "C");
        $pdf->Cell(30, 5, "DIMENSION IN INC", 0, 0, "C");
        $pdf->Cell(20, 5, "19 X 7 X 7", "TLR", 1, "C");
        //15th row done
        $pdf->SetFillColor(87, 158, 63); //fill color (dark green)
        $pdf->SetFont('times','B',5); // Font style
        $pdf->SetTextColor(0,0,0); // Font color
        $pdf->SetFillColor(227, 239, 246); //fill color (light blue)
        $pdf->Cell(80, 3, "", "TR", 0, "C");
        $pdf->Cell(30, 3, "CLEARANCE", "TR", 0, "C");
        $pdf->Cell(20, 3, "CHARGE", "TR", 0, "C", true);
        $pdf->Cell(5, 3, "", 0, 0, "C", true);
        $pdf->Cell(5, 3, "", 0, 0, "C");
        $pdf->Cell(50, 3, "", "TRL", 1, "C", true);
        //16th row done
        $pdf->SetFillColor(87, 158, 63); //fill color (dark green)
        $pdf->SetFont('times','B',5); // Font style
        $pdf->SetTextColor(0,0,0); // Font color
        $pdf->SetFillColor(227, 239, 246); //fill color (light blue)
        $pdf->Cell(80, 3, "", "R", 0, "C");
        $pdf->Cell(30, 3, "", "TR", 0, "C");
        $pdf->Cell(20, 3, "RECEIVER", "TR", 0, "C");
        $pdf->Cell(5, 3, "", 0, 0, "C");
        $pdf->Cell(5, 3, "", 0, 0, "C");
        $pdf->Cell(50, 3, "TRANSPORT COLLECT STICKER", "RL", 1, "C", true);
        //17th row done
        $pdf->SetFillColor(87, 158, 63); //fill color (dark green)
        $pdf->SetFont('times','B',5); // Font style
        $pdf->SetTextColor(0,0,0); // Font color
        $pdf->SetFillColor(227, 239, 246); //fill color (light blue)
        $pdf->Cell(80, 3, "ID CARD", "R", 0, "C");
        $pdf->Cell(30, 3, "", "R", 0, "C");
        $pdf->SetFont('times','B',7); // Font style
        $pdf->Cell(20, 3, "$".number_format($row['receipt_amount'])." USD", "TR", 0, "C");
        $pdf->Cell(5, 3, "", 0, 0, "C");
        $pdf->Cell(5, 3, "", 0, 0, "C");
        $pdf->Cell(50, 3, "", "RL", 1, "C");
        //18th row done
        $pdf->SetFillColor(87, 158, 63); //fill color (dark green)
        $pdf->SetFont('times','B',7); // Font style
        $pdf->SetTextColor(0,0,0); // Font color
        $pdf->SetFillColor(227, 239, 246); //fill color (light blue)
        $pdf->Cell(80, 5, "PROOF OF DELIVERY (POD)", "TLRB", 0, "C");
        $pdf->Cell(30, 5, "", "RB", 0, "C");
        $pdf->Cell(20, 5, "", "RB", 0, "C");
        $pdf->Cell(5, 5, "", 0, 0, "C");
        $pdf->Cell(5, 5, "", 0, 0, "C");
        $pdf->Cell(50, 5, "DIP/09.VOL..104", "RLB", 1, "C");
        //19th row done
        $pdf->SetFillColor(87, 158, 63); //fill color (dark green)
        $pdf->SetFont('times','I',6); // Font style
        $pdf->SetTextColor(0,0,0); // Font color
        $pdf->SetFillColor(227, 239, 246); //fill color (light blue)
        $pdf->Cell(45, 5, "RECEIVER'S SIGNATURE", 0, 0, "C");
        $pdf->Cell(10, 5, "", 0, 0, "C");
        $pdf->Cell(35, 5, "DATE", 0, 0, "C");
        $pdf->Cell(100, 5, "", 0, 1, "C");
        //20th row done
        $pdf->SetFillColor(87, 158, 63); //fill color (dark green)
        $pdf->SetFont('times','B',6); // Font style
        $pdf->SetTextColor(0,0,0); // Font color
        $pdf->SetFillColor(227, 239, 246); //fill color (light blue)
        $pdf->Cell(150, 5, "", 0, 0, "C");
        $pdf->Cell(20, 5, "PAYMENT DETAILS", 0, 0, "C");
        $pdf->Cell(20, 5, "CASH", 0, 1, "C");
        //21st row done
        $pdf->SetFillColor(87, 158, 63); //fill color (dark green)
        $pdf->SetFont('times','B',6); // Font style
        $pdf->SetTextColor(0,0,0); // Font color
        $pdf->SetFillColor(227, 239, 246); //fill color (light blue)
        $pdf->Cell(45, 5, "", "B", 0, "C");
        $pdf->Cell(10, 5, "", 0, 0, "C");
        $pdf->Cell(35, 5, "", "B", 0, "C");
        $pdf->Cell(60, 5, "", 0, 0, "C");
        $pdf->Cell(20, 5, "PACKAGE BY", 0, 0, "C");
        $pdf->Cell(20, 5, "LARRY", 0, 1, "C");
        //23rd row done
        $pdf->SetFillColor(87, 158, 63); //fill color (dark green)
        $pdf->SetFont('times','B',6); // Font style
        $pdf->SetTextColor(0,0,0); // Font color
        $pdf->SetFillColor(227, 239, 246); //fill color (light blue)
        $pdf->Cell(150, 5, "", 0, 0, "C");
        $pdf->Cell(20, 5, "ROUTE", 0, 0, "C");
        $pdf->Cell(20, 5, "FERT 80V143", 0, 1, "C");
        //21st row done
        $pdf->SetFillColor(87, 158, 63); //fill color (dark green)
        $pdf->SetFont('times','B',6); // Font style
        $pdf->SetTextColor(0,0,0); // Font color
        $pdf->SetFillColor(227, 239, 246); //fill color (light blue)
        $pdf->Cell(45, 5, "", 0, 0, "C");
        $pdf->Cell(10, 5, "", 0, 0, "C");
        $pdf->Cell(35, 5, "", 0, 0, "C");
        $pdf->Cell(60, 5, "", 0, 0, "C");
        $pdf->Cell(20, 5, "TERM", 0, 0, "C");
        $pdf->Cell(20, 5, "APPROVED", 0, 1, "C");
        //23rd row done
        $pdf->SetFillColor(87, 158, 63); //fill color (dark green)
        $pdf->SetFont('times','B',12); // Font style
        $pdf->SetTextColor(0,0,0); // Font color
        $pdf->SetFillColor(227, 239, 246); //fill color (light blue)
        $pdf->Cell(45, 8, "", "B", 0, "C");
        $pdf->Cell(10, 8, "", 0, 0, "C");
        $pdf->Cell(35, 8, explode(" ", $row["date"])[0], "B", 0, "C");
        $pdf->Cell(50, 8, "", 0, 0, "C");
        $pdf->SetDrawColor(235, 24, 18);
        $pdf->SetFont('times','B',6); // Font style
        $pdf->Cell(50, 8, "DATE OF ARRIVAL: $row[delivery_date] $row[delivery_time]", 1, 1, "", true);
        $pdf->SetDrawColor(0, 0, 0);
        //23rd row done
        $pdf->SetFillColor(87, 158, 63); //fill color (dark green)
        $pdf->SetFont('times','B',6); // Font style
        $pdf->SetTextColor(0,0,0); // Font color
        $pdf->SetFillColor(227, 239, 246); //fill color (light blue)
        $pdf->Cell(45, 5, "SENDER'S SIGNATURE", 0, 0, "C");
        $pdf->Cell(10, 5, "", 0, 0, "C");
        $pdf->Cell(35, 5, "DATE", 0, 0, "C");
        $pdf->Cell(100, 5, "", 0, 1, "C");
        //23rd row done
        $pdf->SetFont('times','B',10); // Font style
        $pdf->Cell(0, 5, "Email: ".$this->Util_model->get_option("site_email"), 0, 1, "C");
        $pdf->Image(FCPATH."/assets/img/consignor.png",11,52,3,32); // consignor 1st
        $pdf->Image(FCPATH."/assets/img/consignor.png",86,52,3,32); // consignor 2nd
        $pdf->Image(FCPATH."/assets/img/original.png",76,60,22,22); // original
        $pdf->Image(FCPATH."/assets/img/paid.png",66,90,10,10); // paid
        $pdf->Image(FCPATH."/assets/img/consignor agreement.png",11,104,77,8); // paid
        $pdf->Image(FCPATH."/assets/img/info.png",146,43,48,43); // information
        $pdf->Image(FCPATH."/assets/img/stamp.png",151,96,32,32); // stamp
        $pdf->Image(FCPATH."/assets/img/Barcode.jpg",105,130,42,22); // barcode
        $pdf->Image(FCPATH."/assets/img/signature.png",19,145,32,18); // senders signature

        $pdf->Output();
    }

}

?>