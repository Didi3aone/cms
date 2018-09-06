<?php
    
    //greeting
    function greeting()
    {
        date_default_timezone_set("Asia/Jakarta");

        $time = time();
        $hour = date("G",$time); //Fungsi untuk waktu 24 jam

        if ($hour >= 0 && $hour <= 11)
        {
            echo "Selamat Pagi";
        }
            elseif ($hour >= 12 && $hour <= 14)
        {
            echo "Selamat Siang";
        }
            elseif ($hour >=15 && $hour<=17)
        {
            echo "Selamat Sore";
        }
            elseif ($hour >=17 && $hour<=18)
        {
            echo "Selamat Petang";
        }
            elseif ($hour >=19 && $hour<=23)
        {
            echo "Selamat Malam";
        }
    }

    /**
     * PRINT_R HELPER FUNCTION TO PRINT QUERY BEFORE EXECUTING.
     * PASS $THIS->DB to the PARAM.
     */
    function pq($db) {
        echo "<pre>";print_r($db->get_compiled_select());echo "</pre>";
    }
    
    /**
     * PRINT_R HELPER FUNCTION.
     */
    function pr($something) {
        echo "<pre>";print_r($something);echo "</pre>";
    }
    /**
     * [limit_words description]
     */
    function limit_words($string, $word_limit)
    {
      $words = explode(" ", $string);
      return implode(" ", array_splice($words,0,$word_limit));
    }
    
    function limit_word($text, $limit) {
        if(str_word_count($text, 0) > $limit){
            $words = str_word_count($text, 0);
            $post  = array_keys($words);
            $text  = substr($text, 0, $post['limit']) . '...';
        }

        return $text;
    }
    //date view
    function format_date($date)
    {
        // $var = date('Y/m/d');

        $string = str_replace('/','-', $date);
        return $string;
    }

    function am($array1, $array2, $should_merge = true) {
        if ($should_merge) {
            return array_merge($array1, $array2);
        } else {
            return $array1 + $array2;
        }
    }
    
    //for seo url
    function slug($text)
    {
        //replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-',$text);
        // trim
        $text = trim($text, '-');
        //translate
        $text = iconv('utf-8','us-ascii//TRANSLIT', $text);
        //lowercase
        $text = strtolower($text);
        //remove unknown characters
        $text = preg_replace('~[^-\w]+~', '',$text);

        if(empty($text)) 
        {
            return 'n-a';
        }

        return $text;
    }

    function sendmail($params,$html = false) {
        $ci = & get_instance();
        $ci->load->library('email');

        if ($html == true) {
            $config['mailtype'] = 'html';
            $ci->email->initialize($config);
        }

        if (!isset($params['from']['email'])) $params['from']['email'] = DEFAULT_EMAIL_FROM;
        if (!isset($params['from']['name'])) $params['from']['name'] = DEFAULT_EMAIL_FROM_NAME;
        if (!isset($params['from']['return_path'])) $params['from']['return_path'] = DEFAULT_EMAIL_RETURN_PATH;

        if (isset($params['from'])) {
            $ci->email->from($params['from']['email'], $params['from']['name'], $params['from']['return_path']);
        }

        if (isset($params['reply_to'])) {
            $ci->email->reply_to($params['reply_to']['email'], $params['reply_to']['name']);
        }

        if (isset($params['to'])) {
            $ci->email->to($params['to']);
        }

        if (isset($params['cc'])) {
            $ci->email->cc($params['cc']);
        }

        if (isset($params['bcc'])) {
            $ci->email->bcc($params['bcc']);
        }

        if (isset($params['subject'])) {
            $ci->email->subject($params['subject']);
        }

        if (isset($params['message'])) {
            $ci->email->message($params['message']);
        }

        if (isset($params['attachment'])) {
            $ci->email->attach($params['attachment']);
        }

        if ( ! $ci->email->send()) {
            // Generate error
            return [
                "is_error" => true,
                "error_message" => "Email not send."
            ];
        } else {
            return [
                "is_error" => false,
                "error_message" => "Email sent."
            ];
        }
    }


// Function to get the client IP address.
function get_client_ip() {
    $ipaddress = null;
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = null;
    return $ipaddress;
}

// function to validate response token from google recaptcha v2.
function validate_google_recaptcha($responseToken = null) {
    if ($responseToken == null) return false;

    $clientIP = get_client_ip();
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=".GOOGLE_RECAPTCHA_SECRET_KEY."&response=".$responseToken."&remoteip=".$clientIP;
    $res = json_decode(file_get_contents($url), true);

    if ($res) {
        if (!$res['success']) {
            //failed.
            return false;
        } else {
            //success.
            return true;
        }
    } else {
        return false;
    }
}

//convert Bytes to KB or MB
function convert_bytes_to_kb_or_mb ($totalByte) {
    $bytes = $totalByte;
    $kb = $bytes / 1024;
    $mb = $kb / 1024;

    if ($mb < 1) {
        return round($kb,2) . " KB";
    } else {
        return round($mb,2) . " MB";
    }
}

/**
 * check special char
 */
function have_special_char ($string) {
    if (preg_match(SPECIAL_CHARACTER, $string)) {
        // one or more of the 'special characters' found in $string
        return TRUE;
    }

    return FALSE;
}

/**
 * check null, space
 */
function check_null_space ($string) {
    if (trim($string) == null || trim($string) == "") {
        return TRUE;
    }

    return FALSE;
}
/**
 * FUNCTION TO CONVERT STRTOTIME value to DATETIME using PHP DATE FORMAT.
 */
function dateformat($datetime) {
    return ($datetime) ? date('d F Y H:i:s',strtotime($datetime)) : "-";
}

/**
 * FUNCTION TO CONVERT date value to DATE using PHP DATE FORMAT.
 */
function dateformatonly($date) {
    return (strtotime($date) != "" && strtotime($date) != -62170010400) ? date('F d,Y',$date) : "-";
}

/**
 * helper function to change date format from database output into something else.
 * the default "date" format from database is Y-m-d.
 * ONLY FOR DATE, not DATETIME.
 * reff: http://php.net/manual/en/function.date.php
 */
function dateformatforview($date, $format = "d/m/Y") {

    if ($date == "0000-00-00" || $date == null) return null;

    $date1 = DateTime::createFromFormat('Y-m-d H:i:s', $date);
    $date2 = DateTime::createFromFormat('Y-m-d', $date);

    if ($date1 && is_a($date1, "Datetime")) {
        return $date1->format($format);
    }
    if ($date2 && is_a($date2, "Datetime")) {
        return $date2->format($format);
    }

    return date("d/m/Y");   //jadi hari ini kalau dr sumbernya null / error.
}

/**
 * FUNCTION TO VALIDATE DATE FORMAT TO INSERT or UPDATE to database.
 */
function validate_date_input($date) {
    //do some conversion from d/m/Y format to strtotime compatible.
    $date = DateTime::createFromFormat('d/m/Y', $date);
    if ($date) {
        $date = $date->format("d-m-Y");
        return (strtotime($date) != "" && date('Y-m-d',strtotime($date)) != "1900-01-01") ? date("Y-m-d", strtotime($date)) : null;
    } else {
        return null;
    }
}

function formats ( $date_format ) {
    $today = new DateTime();
    $dt = $today->format($date_format);
    return $dt;
}

/**
 * FUNCTION TO VALIDATE Null
 */
function validate_null($string) {
    return ($string != "") ? $string : "";
}

/**
 * FUNCTION TO PARSE A DATE RANGE FROM A SINGLE STRING.
 * format is must like this: dd/mm/yyyy ~ dd/mm/yyyy
 * will return null if not valid.
 * and will return array [start] and [end] in yyyy-mm-dd format (used in mysql).
 */
function parse_date_range($date_range = null) {
    //validate.
    if ($date_range == null) return null;

    //split the range.
    $splitted = explode(' ~ ', $date_range);

    //if not start ~ end.
    if (count($splitted) != 2) return null;

    //parse it.
    $a = DateTime::createFromFormat('d/m/Y', $splitted[0]);
    $b = DateTime::createFromFormat('d/m/Y', $splitted[1]);

    //if failed to parse.
    if ($a === FALSE || $b === FALSE) return null;

    //revalidate and re-format.
    $return['start'] = validate_date_input($a->format('d/m/Y'));
    $return['end'] = validate_date_input($b->format('d/m/Y'));

    return $return;
}

/**
 * Function to sanitize form input, ajax input, or else.
 * used mainly for string input, at default will replace anything except:
 * a-z A-Z 0-9 - _ . , space / ~ : @ ? ( )'
 * become empty string ""
 * TYPE :
 * numeric, string, date, daterange, array, [1 => val, 2 => val, 3 => val], "1,2",
 */
function sanitize_str_input($str = NULL, $type = "string", $regex = "/[^a-zA-Z0-9\/~\-_.():@,?\'\s]+/") {
    switch ($type) {
        case 'string':
            $str = trim($str);
            return preg_replace($regex, "", $str);
            break;

        case 'numeric':
            if (is_numeric($str) === FALSE) return null;
            return $str;
            break;

        case 'date':
            return validate_date_input($str);
            break;

        case 'daterange':
            return parse_date_range($str);
            break;

        case 'array':
            if (is_array($str) === FALSE) return null;
            return $str;
            break;

        default:
            if (is_array($type)) {
                if (array_key_exists($str, $type)) {
                    return $str;
                } else {
                    return null;
                }
            } else if (count(explode(",",$type)) > 0) {
                $data = explode(",",$type);
                if (array_search($str, $data) === FALSE) {
                    return null;
                } else {
                    return $str;
                }
            }
            break;
    }

    return preg_replace($regex, "", $str);
}


/**
 * Check API KEY if it is valid (exists in DB) or not.
 */
function check_api_key($api_key) {
    $ci = & get_instance();
    $ci->load->model('user/User_model');
    $check_apikey = $ci->User_model->get_all_data(array("conditions" => array("api_key" => $api_key), "row_array" => true));

    if ($check_apikey):
        return $check_apikey;
    else :
        return false;
    endif;
}

function select_role ($name, $selected = FALSE, $html_attr = '', $add_options = array("" => " -- Choose --")) {
        $ci = & get_instance();

        $ci->load->helper('form');
        $ci->load->model('Dynamic_model');

        $datas = $ci->Dynamic_model->set_model("tbl_user_role", "tur", "role_id")->get_all_data (array(
            "select" => "role_id, role_name",
            // "conditions" => array("role_id" => NULL ),
            "status" => -1 
        ))['datas'];

        if (!$datas) :
            return FALSE;
        endif;

        $datas = array_column($datas,"role_name", "role_id");

        return form_dropdown($name, $add_options + $datas, $selected, $html_attr);
    }

    function select_type ($name, $selected = FALSE, $html_attr = '', $add_options = array("" => " -- Choose --")) {
        $ci = & get_instance();

        $ci->load->helper('form');
        $ci->load->model('Dynamic_model');

        $datas = $ci->Dynamic_model->set_model("tbl_artikel_type", "tur", "type_id")->get_all_data (array(
            "select" => "type_id, type_nam",
            // "conditions" => array("role_id" => NULL ),
            "status" => -1 
        ))['datas'];

        if (!$datas) :
            return FALSE;
        endif;

        $datas = array_column($datas,"type_nam", "type_id");

        return form_dropdown($name, $add_options + $datas, $selected, $html_attr);
    }
?>
