<?php
//error_reporting(E_ALL);
//ini_set('display_errors',1);

class EbookStoreEbook {
	var $log = true;
	function __construct($ebook_id) {
		$this->ebook_id = $ebook_id;
		$this->meta = get_post_meta($ebook_id);
		$this->meta = is_array($this->meta) ? $this->meta : array();
		$this->file = get_post_meta($ebook_id, 'ebook_wp_custom_attachment', true);
		$this->file = is_array($this->file) ? $this->file : array();
		$this->ebook = get_post_meta($ebook_id, 'ebook', true);
		$this->ebook = is_array($this->ebook) ? $this->ebook : array();
		$this->price = @$this->ebook['ebook_price'];
		$this->filesize = @filesize($this->file['file']);
		$this->human_filesize = $this->human_filesize($this->filesize);
		@$this->url = $this->file['url'];
		@$this->type = $this->file['type'];
		$this->title = get_the_title($ebook_id);
		//$this->l($this->title);
		if (is_array(@$this->meta['ebook_wp_custom_attachment'])) {
			if (count($this->meta['ebook_wp_custom_attachment']) > 0) {
				$this->formats[] = 'pdf';
				$file = unserialize($this->meta['ebook_wp_custom_attachment'][0]);
				$file = $file['file'];
				$this->files['pdf'] = $file;
				$this->files['pdf_size'] = filesize($file);
			}

		}
		$extra_formats = array('mobi','epub','txt','zip','mp3','mp4');
		foreach ($extra_formats as $format) {
			if (@is_array($this->meta['ebook_wp_custom_attachment_' . $format])) {
				if (@count(@$this->meta['ebook_wp_custom_attachment_' . $format]) > 0) {
					$this->formats[] = $format;
					$file = unserialize($this->meta['ebook_wp_custom_attachment_' . $format][0]);
					$file = $file['file'];
					$this->files[$format] = $file;
					$this->files[$format . '_size'] = filesize($file);
				}				
			}
		}
		// $this->l($this->files,true);
	}
	function l($data, $v = false) {
		if ($this->log) {
			error_log(print_r(debug_backtrace(),true));
			if (is_array($data)) {
				error_log(print_r($data,true));
			} else {
				error_log($data);
			}
		}
		if ($v) {
			echo "<pre>" . var_export($data, true) . "</pre>";
		}
	}
	function human_filesize($bytes, $decimals = 2) {
		  $sz = 'BKMGTP';
		  $factor = floor((strlen($bytes) - 1) / 3);
		  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
	}
	function format_links() {
		if (is_array($this->formats) == false) {
			return '';
		}
		return implode(', ', array_map(array($this, 'link'), $this->formats));
	}
	function link($format) {
		include('locale.php');
		
		$link = add_query_arg(array('action' => 'wc_order_download','ebook_id' => $this->ebook_id, 'format' => $format, 'wc_order' => (isset($this->wc_order) ? $this->wc_order : ''), 'order_id' => (isset($this->order_id) ? $this->order_id : '')),get_permalink($this->ebook_id));
		if (@$this->setLink[$format] != '') {
			$link = $this->setLink[$format];
		}
		return '<a href="' . $link . '" target="_blank">' . $formats_locale[$format] . '</a> <small><em>(' . $this->human_filesize($this->files[$format . '_size']) . ')</em></small>';
	}
	function encrypted($order_id = null, $format = 'pdf') {
			//error_reporting(E_ALL);
			//ini_set('display_errors','1');
			global $ebook_email_delivery, $ebook_qr_text, $ebook_png_path, $ebook_pngname, $attachment, $pdfHeaderText;
			if (class_exists('FPDF') == false) {
				require_once('fpdi/qrcode.class.php');
			}
			
			require_once('fpdi/qrcode.class.php');
			
			if ($format == 'pdf' && get_option('encrypt_pdf')) {
			$meta = get_post_meta($order_id);
			
			$r['payer_email'] = $meta['_billing_email'][0];
			$r['payment_date'] = $meta['_paid_date'][0];
			$r['txn_id'] = $meta['_transaction_id'][0];
			$r['first_name'] = $meta['_billing_first_name'][0];
			$r['last_name'] = $meta['_billing_last_name'][0];
			$r['residence_country'] = $meta['_billing_country'][0];

			if ($r['payer_email'] == '') {
				$r['payer_email'] = $meta['payer_email'][0];
				$r['payment_date'] = $meta['payment_date'][0];
				$r['txn_id'] = $meta['txn_id'][0];
				$r['first_name'] = $meta['last_name'][0];
				$r['last_name'] = $meta['_billing_last_name'][0];
				$r['residence_country'] = $meta['residence_country'][0];
			}

			$ebook_qr_text = "Txn: " . $r['txn_id'] . ' Date: ' . $r['payment_date'] . ' Buyer:' . $r['payer_email'] . ' IP: ' . $_SERVER['REMOTE_ADDR'];
			$pdfHeaderText = esc_attr(get_option('buyer_info_text'));

			foreach ($r as $k => $v) {
				$pdfHeaderText = str_replace("%%$k%%", $v, $pdfHeaderText);
			}


			$file = $this->files['pdf'];

			$qrclass = new QRClass;
			$path = $qrclass->text($ebook_qr_text, 100, 100);
			$ebook_pngname = md5($path) . '.png';
			$ebook_pdfname = basename($file);
			
			$ebook_png_path = plugin_dir_path( __FILE__ ) . '/cache/' . $ebook_pngname;
			$ebook_pdf_path = plugin_dir_path( __FILE__ ) . '/cache/'. md5($order_id . substr(NONCE_KEY, 0, 8)) .'/' . $ebook_pdfname;
			@mkdir(plugin_dir_path( __FILE__ ) . '/cache/'. md5($order_id . substr(NONCE_KEY, 0, 8)), 0755, true);
			$qrclass->save($path, $ebook_png_path);
			//
			if (file_exists($ebook_pdf_path)) {
				return $ebook_pdf_path;
			}
			$ebook_store_random_password = substr(md5($order_id . substr(NONCE_KEY, 0, 8)), 0, 8);
			$password = $r['payer_email'];
			if (get_option('ebook_store_random_password') == 1) {
				if ($ebook_store_random_password != '') {
					$r['password']	= $ebook_store_random_password;
					if ($order_id > 0) {
						$meta_password = get_post_meta($order_id,'password',true);
						if ($meta_password != '') {
							$r['password'] = $meta_password;
						}
					}
				}
				if (@$r['password'] != '') {
					$password = $r['password'];
				} 
			}
			if (get_option('ebook_store_blank_password') == 1) {
				$r['password'] = '';
				$password = '';
			}

			$owner_password = esc_attr(get_option('ebook_store_owner_password'));
			@mkdir(plugin_dir_path( __FILE__ ) . 'cache/' . md5($path), 0755, true);
			$destfile = plugin_dir_path( __FILE__ ) . 'cache/' . md5($path) . '/' . basename($file);


			$pdf = new QRPDF();
			//$pdf->FPDF('P', 'in', 'a4');
			$pagecount = $pdf->setSourceFile($this->files[$format]);
			$tplidx = $pdf->importPage(1);
			//$size = $pdf->getTemplateSize($tplidx);
			// $pdfOrientation = "P";
			// if ($size['w'] > $size['h']) { $pdfOrientation = 'L'; }
			//$pdf->FPDF($pdfOrientation, 'in', array($size['w'],$size['h']));
			//$pagecount = $pdf->setSourceFile($file);
			$owner_password = esc_attr(get_option('ebook_store_owner_password'));
			for ($loop = 1; $loop <= $pagecount; $loop++) {
				$tplidx = $pdf->importPage($loop);
				$size = $pdf->getTemplateSize($tplidx);
				// if ($size['w'] > $size['h']) {
			        $pdf->AddPage($size['orientation'], $size);
			    // } else {
			    //     $pdf->AddPage('P', array($size['w'], $size['h']));
			    // }		
				$pdf->useTemplate($tplidx);
			}


			$protection = array();
			$protection['print'] = 'print';
			$protection['annot-forms'] = 'annot-forms';
			$protection['copy'] = 'copy';
			$protection['modify'] = 'modify';

			if (get_option('disable_pdf_printing') == 1) {
				unset($protection['print']);
			}
			if (get_option('disable_annot-forms') == 1) {
				unset($protection['annot-forms']);	
			}
			if (get_option('disable_pdf_copy') == 1) {
				unset($protection['copy']);
			}
			if (get_option('disable_pdf_modify') == 1) {
				unset($protection['modify']);
			}
			//error_log('pdf password ' . $password);

			$pdf->SetProtection((array)$protection, $password, $owner_password);
			//die(basename($this->files['pdf']));

			// header("Robots: none");
			// header("Content-Type: application/pdf");
			// header("Content-Description: File Transfer");
			// header("Content-Disposition: attachment; filename=\"test.pdf\";");
			// header("Content-Transfer-Encoding: binary");

			$pdf->Output($ebook_pdf_path, 'F');
			return $ebook_pdf_path;

			// $pdf->Output($destfile, 'F');
			// update_post_meta(@$order_id,'encrypted_pdf',wp_slash($destfile));			
			//wp_die(print_r($meta,true));
		} else {
			return $this->files[$format];
		}
	}
	function password_desc() {
		include('locale.php');
		$out = '';
		$meta = get_post_meta($this->order_id);
		if (get_option('encrypt_pdf') == 1) {
			if (get_option('ebook_store_random_password') == 1) {
				$out .= $locale['password_desc'] . ': ';
				$out .= substr(md5($this->order_id . substr(NONCE_KEY, 0, 8)), 0, 8);
			} else if (get_option('ebook_store_blank_password') == 1) {
				return '';
			} else {
				$out .= $locale['password_desc'] . ': ';
				$out .= $meta['_billing_email'][0];
			}

		}
		if ($out == "1") {
			return;
		}
		return $out;
	}
	function password() {
		include('locale.php');
		$out = '';
		$meta = get_post_meta($this->order_id);
		if (get_option('encrypt_pdf') == 1) {
			if (get_option('ebook_store_random_password') == 1) {
				// $out .= $locale['password_desc'] . ': ';
				$out .= substr(md5($this->order_id . substr(NONCE_KEY, 0, 8)), 0, 8);
			} else if (get_option('ebook_store_blank_password') == 1) {
				return true;
			} else {
				// $out .= $locale['password_desc'] . ': ';
				$out .= $meta['_billing_email'][0];
			}

		}
		return $out;
	}
}
function ebook_store_human_filesize($bytes, $decimals = 2) {
		  $sz = 'BKMGTP';
		  $factor = floor((strlen($bytes) - 1) / 3);
		  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
	}