<?php defined('BASEPATH') OR exit('No direct script access allowed');

// inline help html. Only 'help_body' is used.
$lang['help_body'] = "
<h4> Modul Unduhan </h4>

<h5>Menambahkan Item Unduhan</h5>
<p>Anda dapat menambahkan item unduhan dengan mengklik tombol 'Tambah Item Unduhan' dan kemudian mengisikan form yang tersedia.</p>

<h5>Memasang Link Unduhan</h5>
<p>Anda dapat memasang tombol Unduh dimanapun dengan menambahkan kode plugin unduh, dengan sintaks:<br />
<code>{{ download:link slug=\"slug_item_unduhan\" }}</code><br />
Anda juga dapat menambahkan atribut class dan id pada tautan unduhan seperti ini:<br />
<code>{{ download:link slug=\"slug_item_unduhan\" class=\"atribut_class_anda\" id=\"atribut_id_anda\" target=\"_blank\" }}</code></p>

<p>Selain itu, Anda juga dapat memasang tautan unduhan dengan tampilan yang disesuaikan dengan keinginan Anda,<br />
misalnya dengan menambahkan komponen lain di dalam tag anchor, maka gunakan kode plugin ini:
<code>{{ download:advance_link slug=\"slug_item_unduhan\" }}<br />
&nbsp;&nbsp;&nbsp; &lt;a href=\"{{ href }}\" class=\"class_saya\" id=\"id_saya\" target=\"_blank\"&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;span class=\"icon-download\"&gt;&lt;/span&gt; {{ title }}<br />
&nbsp;&nbsp;&nbsp; &lt;/a&gt;<br />
{{ /download:advance_link }}</code></p>

<br />
<h5>Memasang Total Unduhan</h5>
<p>Anda dapat menampilkan total unduhan dengan kode plugin berikut:<br />
<code>{{ download:count slug=\"slug_item_unduhan\" }}</code></p>";
