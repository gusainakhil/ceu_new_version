<?php 
  require ("fpdf/fpdf.php");
  include "connect.php";

if(empty($_SESSION['username'])) {
    header("Location: login.php");
}
  $order_detail = $_GET['order_detail'];
//   echo"  $order_detail";

  //customer and invoice details
  
    $hash_id = $_GET['order_detail'];
                               
                                $a = 0;
                                $result = mysqli_query($con, "select user_info.*,order_details.*,course_detail.title  from user_info, order_details, course_detail where 1=1 and user_info.id = order_details.user_id and order_details.course_id = course_detail.id  and  order_details.hash_id = '$hash_id';");
                                while($row = mysqli_fetch_assoc($result)) { 
                                    
                                    
             
  $info=[
    "customer"=>"",
    "address"=>"4th cross,Car Street,",
    "city"=>"Salem 636204.",
    "invoice_no"=>"1000001",
    "invoice_date"=>"30-11-2021",
    "total_amt"=>"5200.00",
    "words"=>"Rupees Five Thousand Two Hundred Only",
  ];


      
                            
                                   
  //invoice Products
  $products_info=[
    [
      "name"=>"webinar",
      "price"=>"500.00",
      "qty"=>2,
      "total"=>"1000.00"
    ],
    [
      "name"=>"webinar2",
      "price"=>"400.00",
      "qty"=>3,
      "total"=>"1200.00"
    ],
    [
      "name"=>"webinar3",
      "price"=>"3000.00",
      "qty"=>1,
      "total"=>"3000.00"
    ],
  ];
                                }
  class PDF extends FPDF
  {
    function Header(){
      
      //Display Company Info  
      $this->SetFont('Arial','B',14);
      $this->Cell(50,10,"CEU Trainers",0,1);   
      $this->SetFont('Arial','',14);
      $this->Cell(50,7,"Las Vegas,",0,1);
      $this->Cell(50,7,"NV, 89107  United States",0,1);
      $this->Cell(50,7,"PH :  (702)-605-0095",0,1);
      
      //Display INVOICE text
      $this->SetY(15);
      $this->SetX(-40);
      $this->SetFont('Arial','B',18);
      $this->Cell(50,10,"INVOICE",0,1);
      
      //Display Horizontal line
      $this->Line(0,48,210,48);
    }
    
    function body($info,$products_info){
      
      //Billing Details
      $this->SetY(55);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(50,10,"Bill To: ",0,1);
      $this->SetFont('Arial','',12);
      $this->Cell(50,7,$info["customer"],0,1);
      $this->Cell(50,7,$info["address"],0,1);
      $this->Cell(50,7,$info["city"],0,1);
      
      //Display Invoice no
      $this->SetY(55);
      $this->SetX(-60);
      $this->Cell(50,7,"Invoice No : ".$info["invoice_no"]);
      
      //Display Invoice date
      $this->SetY(63);
      $this->SetX(-60);
      $this->Cell(50,7,"Invoice Date : ".$info["invoice_date"]);
      
      //Display Table headings
      $this->SetY(95);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(80,9,"DESCRIPTION",1,0);
      $this->Cell(40,9,"PRICE",1,0,"C");
      $this->Cell(30,9,"QTY",1,0,"C");
      $this->Cell(40,9,"TOTAL",1,1,"C");
      $this->SetFont('Arial','',12);
      
      //Display table product rows
      foreach($products_info as $row){
        $this->Cell(80,9,$row["name"],"LR",0);
        $this->Cell(40,9,$row["price"],"R",0,"R");
        $this->Cell(30,9,$row["qty"],"R",0,"C");
        $this->Cell(40,9,$row["total"],"R",1,"R");
      }
      //Display table empty rows
      for($i=0;$i<12-count($products_info);$i++)
      {
        $this->Cell(80,9,"","LR",0);
        $this->Cell(40,9,"","R",0,"R");
        $this->Cell(30,9,"","R",0,"C");
        $this->Cell(40,9,"","R",1,"R");
      }
      //Display table total row
      $this->SetFont('Arial','B',12);
      $this->Cell(150,9,"TOTAL",1,0,"R");
      $this->Cell(40,9,$info["total_amt"],1,1,"R");
      
      //Display amount in words
      $this->SetY(225);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(0,9,"Amount in Words ",0,1);
      $this->SetFont('Arial','',12);
      $this->Cell(0,9,$info["words"],0,1);
      
    }
    function Footer(){
      
      //set footer position
      $this->SetY(-50);
      $this->SetFont('Arial','B',12);
      $this->Cell(0,10,"for CEU Trainers",0,1,"R");
      $this->Ln(15);
      $this->SetFont('Arial','',12);
      $this->Cell(0,10,"Authorized Signature",0,1,"R");
      $this->SetFont('Arial','',10);
      
      //Display Footer Text
      $this->Cell(0,10,"This is a computer generated invoice",0,1,"C");
      
    }
    
  }
  //Create A4 Page with Portrait 
  $pdf=new PDF("P","mm","A4");
  $pdf->AddPage();
  $pdf->body($info,$products_info);
  $pdf->Output();
?>