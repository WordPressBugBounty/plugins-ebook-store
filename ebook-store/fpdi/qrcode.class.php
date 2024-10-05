<?php
use setasign\FpdiProtection\FpdiProtection;


require_once dirname(__FILE__) . '/FPDI-master/src/autoload.php';
require_once dirname(__FILE__) . '/FPDF-master/fpdf.php';
require_once dirname(__FILE__) . '/fpdi-protection-master/src/autoload.php';


global $ebook_store_page_counter;
$ebook_store_page_counter = 0;


class QRPDF extends FpdiProtection {

	function Footer() {

		global $ebook_png_path, $pdfHeaderText, $ebook_store_page_counter;

		if (get_option('ebook_store_watermark_mode','every') == 'first' && $ebook_store_page_counter >= 1) {
			error_log("PAGE COUNTER $ebook_store_page_counter");
			return;
		}

		if (get_option('qr_code')) {

			$this->Image($ebook_png_path,$this->w - 20,$this->h - 20,20,20);
			//$this->Image($ebook_png_path,1,1,19.5,19.5);

		}
	if (get_option('buyer_info')) {
			//error_reporting(E_ALL);
			$this->SetFont('Helvetica');
			// $this->AddFont('FreeSerif');
			// $this->SetFont('FreeSerif');
			$this->SetTextColor(255, 0, 0);
			$hex = esc_attr(get_option('ebook_store_watermark_color_hex','#FF0000'));
			list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
			$this->SetTextColor($r, $g, $b);
			// $this->SetXY(3, 3);
			// $this->SetFontSize(10);
			// $this->Write(0, $pdfHeaderText);
			if (function_exists('inconv')) {
				$pdfHeaderText = iconv('UTF-8', 'windows-1251', $pdfHeaderText);
			}
			$ebook_store_buyer_info_position = esc_attr(get_option('ebook_store_buyer_info_position','top'));
			if ($ebook_store_buyer_info_position == 'top') {
				$this->Cell(0, 0, $pdfHeaderText, 0, 0, 'C');
			} else if ($ebook_store_buyer_info_position == 'middle') {
				$this->Cell($this->w, $this->h, $pdfHeaderText, 0, 0, 'C');
			} else if ($ebook_store_buyer_info_position == 'bottom') {
				$this->SetY(-15);
				$this->Cell(0, 10, $pdfHeaderText, 0, 0, 'C');
			}
		}

	$ebook_store_page_counter++;

	}

}

class QRClass{

	

		/* Plain text */

		

		public function text($text, $size_h = 350, $size_w = 350) {

			

//			return 'http://chart.apis.google.com/chart?cht=qr&chs='.$size_w.'x'.$size_h.'&chl='.urlencode($text);
			return 'https://api.qrserver.com/v1/create-qr-code/?size='.$size_w.'x'.$size_h.'&data='.urlencode($text);

			

		}

		

		/* E-mail addresses */

		

		function email($email, $size_h = 350, $size_w = 350) {

			

			//return 'http://chart.apis.google.com/chart?cht=qr&chs='.$size_w.'x'.$size_h.'&chl=mailto%3A'.urlencode($email);
			return 'https://api.qrserver.com/v1/create-qr-code/?size='.$size_w.'x'.$size_h.'&data='.urlencode($text);

			

		}

		

		/* Phone numbers */

		

		function phone_numbers($number, $size_h = 350, $size_w = 350) {

			

			return 'http://chart.apis.google.com/chart?cht=qr&chs='.$size_w.'x'.$size_h.'&chl=tel%3A'.urlencode($number);

			

		}

		

		/* URL */

		

		function url($url, $size_h = 350, $size_w = 350) {

			

			return 'http://chart.apis.google.com/chart?cht=qr&chs='.$size_w.'x'.$size_h.'&chl='.urlencode($url);

			

		}

		

		/* SMS */

		

		function sms($receiver, $message, $size_h = 350, $size_w = 350) {

			

			return 'http://chart.apis.google.com/chart?cht=qr&chs='.$size_w.'x'.$size_h.'&chl=smsto%3A'.urlencode($receiver).'%3A'.urlencode($message);

			

		}

		

		/* Wifi network */

		

		function wifi($ssid, $password, $type, $size_h = 350, $size_w = 350) {

			

			return 'http://chart.apis.google.com/chart?cht=qr&chs='.$size_w.'x'.$size_h.'&chl=WIFI%3AS%3A'.$ssid.'%3BT%3A'.$type.'%3BP%3A'.$password.'%3B%3B';

			

		}

		

		/* Save image */

		

		function save($image, $destination) {

		

			if(file_exists($destination)) {

			

				return FALSE;

		

			} else {

			
				//wp_die(' IMG PATH ' . $image);


    $fp = fopen ($destination, 'w+');              // open file handle

    $ch = curl_init($image);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // enable if you want
    curl_setopt($ch, CURLOPT_FILE, $fp);          // output to file
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 1000);      // some large value to allow curl to run for a long time
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.66 Safari/537.36');
    // curl_setopt($ch, CURLOPT_VERBOSE, true);   // Enable this line to see debug prints
    curl_exec($ch);

    curl_close($ch);                              // closing curl handle
    fclose($fp);


				//$img = imagecreatefrompng($image);

				//imagepng($img, $destination);

				//file_put_contents($destination,file_get_contents($image));

				return TRUE;

			

			}

		

		}

		

	

	}

	

?>