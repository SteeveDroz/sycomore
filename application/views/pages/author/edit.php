<?php $this->load->view('pages/author/_form', ['submit_text' => 'Éditer']) ?>
<a href="<?php echo site_url('author/show/' . xss_clean($author->id)) ?>">Retour</a>
