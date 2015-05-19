
<?php

    $this->load->view('layout/admin/header');
    $this->load->view('layout/admin/sidebar');

    print $content;

    $this->load->view('layout/admin/footer');
?>