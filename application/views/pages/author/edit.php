<?php $this->load->view('pages/author/_form', ['submitText' => 'Éditer']) ?>
<a href="<?php echo site_url('author/show/' . xss_clean($author->id)) ?>">Retour</a>
