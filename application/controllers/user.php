<?php

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->myAccount();
    }

    public function myAccount()
    {
        $model = new Common_model();
        $user_id = $this->session->userdata['user_id'];
        if ($this->input->post())
        {
            $arr = $this->input->post();
            $data_array = array(
                'user_fullname' => addslashes($arr['fullname']),
                'user_contact' => substr($arr['contact'], -10, 10),
                'user_gender' => strtolower($arr['gender']),
                'user_dob' => empty($arr['dob']) == TRUE ? NULL : (date('Y-m-d', strtotime($arr['dob']))),
                'user_ipaddress' => USER_IP,
                'user_useragent' => USER_AGENT,
            );
            $model->updateData(TABLE_USERS, $data_array, array('user_id' => $user_id));
            $this->session->userdata['user_fullname'] = $arr['fullname'];
            $this->session->set_flashdata("success", "Account details updated");
            redirect(base_url('my-account'));
        }
        else
        {
            $data = array();
            $fields = 'user_fullname, user_gender, user_contact, user_dob';
            $record = $model->fetchSelectedData($fields, TABLE_USERS, array('user_id' => $user_id));

            $breadcrumbArray = array(
                'My Account' => base_url('my-account')
            );
            $data["breadcrumbArray"] = $breadcrumbArray;
            $data['record'] = $record[0];
            $data['meta_title'] = 'My account | ' . SITE_NAME;
            $this->template->write_view("content", "pages/user/my-account", $data);
            $this->template->render();
        }
    }

    public function updatePassword()
    {
        if ($this->input->post())
        {
            $model = new Common_model();
            $user_id = $this->session->userdata['user_id'];
            $arr = $this->input->post();
            $new_password = $arr['new_password'];
            $confirm_password = $arr['confirm_password'];

            if (strcmp($new_password, $confirm_password) == 0)
            {
                $data_array = array(
                    'user_password' => md5($confirm_password),
                    'user_ipaddress' => USER_IP,
                    'user_useragent' => USER_AGENT,
                );
                $model->updateData(TABLE_USERS, $data_array, array('user_id' => $user_id));

                $this->session->set_flashdata("success", "Password successfully changed");
            }
            else
            {
                $this->session->set_flashdata("error", "Passwords you entered do not match");
            }
        }

        redirect(base_url('my-account'));
    }

    public function myAddresses()
    {
        $model = new Common_model();
        $user_id = $this->session->userdata['user_id'];

        if ($this->input->post())
        {
            $arr = $this->input->post();

            $location_data = parse_address_google($arr['location']);
            $address_array = array(
                'ua_user_id' => $user_id,
                'ua_line1' => addslashes($arr['address_line1']),
                'ua_line2' => addslashes($arr['address_line2']),
                'ua_landmark' => addslashes($arr['landmark']),
                'ua_location' => addslashes($arr['location']),
                'ua_postcode' => addslashes($arr['pincode']),
                'ua_city' => $location_data['city'],
                'ua_state' => $location_data['state'],
                'ua_country' => $location_data['country'],
                'ua_status' => '1',
                'ua_ipaddress' => USER_IP,
                'ua_useragent' => USER_AGENT
            );
            $model->insertData(TABLE_USER_ADDRESSES, $address_array);
            $this->session->set_flashdata("success", "Address successfully added");
            redirect(base_url('my-addresses'));
        }
        else
        {
            $records = $model->fetchSelectedData('*', TABLE_USER_ADDRESSES, array('ua_user_id' => $user_id, 'ua_deleted' => '0'), 'ua_id', 'DESC');

            $breadcrumbArray = array(
                'My Addresses' => base_url('my-addresses')
            );
            $data["breadcrumbArray"] = $breadcrumbArray;
            $data['records'] = $records;
            $data['meta_title'] = 'My addresses | ' . SITE_NAME;
            $this->template->write_view("content", "pages/user/my-addresses", $data);
            $this->template->render();
        }
    }

    public function removeAddress($ua_id)
    {
        $model = new Common_model();
        $user_id = $this->session->userdata['user_id'];
        $model->updateData(TABLE_USER_ADDRESSES, array('ua_deleted' => '1'), array('ua_id' => $ua_id, 'ua_user_id' => $user_id));
        $this->session->set_flashdata("success", "Address successfully removed");
        redirect(base_url('my-addresses'));
    }

}
