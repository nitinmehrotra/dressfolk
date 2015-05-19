<?php

    class Email_model extends CI_Model
    {

        public function __construct()
        {
            parent::__construct();
            // Load DB here
            $this->load->database();
        }

        public function sendMail($to_email, $subject, $message, $from_email = SITE_EMAIL, $from_name = SITE_NAME_DISPLAY)
        {
            if (USER_IP != '127.0.0.1' && !empty($to_email))
            {
                $this->load->library('email');

                $config['protocol'] = 'sendmail';
                $config['mailpath'] = '/usr/sbin/sendmail';
                $config['charset'] = 'iso-8859-1';
                $config['wordwrap'] = TRUE;
                $config['mailtype'] = 'html';

                $this->email->initialize($config);

                $this->email->from($from_email, $from_name);
                $this->email->to($to_email);

                $this->email->subject($subject);
                $this->email->message($message);

                if ($this->email->send())
                {
                    require_once APPPATH . '/models/common_model.php';
                    $model = new Common_model();
                    $data_array = array(
                        'es_to_email' => $to_email,
                        'es_subject' => addslashes($subject),
                        'es_body' => addslashes($message),
                        'es_from_email' => $from_email,
                        'es_from_name' => $from_name,
                        'es_ipaddress' => USER_IP,
                    );
                    $model->insertData(TABLE_EMAILS_SENT, $data_array);
                }
            }
        }

    }

?>
