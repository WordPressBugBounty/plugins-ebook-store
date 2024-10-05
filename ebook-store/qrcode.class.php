<?php
global $ebook_store_page_counter;
$ebook_store_page_counter = 0;


class QRPDF extends FPDI_Protection {

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

			

			return 'http://chart.apis.google.com/chart?cht=qr&chs='.$size_w.'x'.$size_h.'&chl='.urlencode($text);
			//return 'https://api.qrserver.com/v1/create-qr-code/?size='.$size_w.'x'.$size_h.'&data='.urlencode($text);

			

		}

		

		/* E-mail addresses */

		

		function email($email, $size_h = 350, $size_w = 350) {

			

			return 'http://chart.apis.google.com/chart?cht=qr&chs='.$size_w.'x'.$size_h.'&chl=mailto%3A'.urlencode($email);
			//return 'https://api.qrserver.com/v1/create-qr-code/?size='.$size_w.'x'.$size_h.'&data='.urlencode($text);

			

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

			

				$img = imagecreatefrompng($image);

				imagepng($img, $destination);

				//file_put_contents($destination,file_get_contents($image));

				return TRUE;

			

			}

		

		}

		

	

	}

	

?>
