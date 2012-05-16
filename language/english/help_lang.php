<?php defined('BASEPATH') OR exit('No direct script access allowed');

// inline help html. Only 'help_body' is used.
$lang['help_body'] = "
<h4> Download Module Info </h4>

<h5>Add Download Item</h5>
<p>You can add items by clicking the 'add Download Item' and then fill in the form provided. <br />

<h5>Install Download Link</h5>
<p>You can install the download button wherever you like by adding the plugin code, with the syntax:<br />
<code>{{ download:link slug=\"download_item_slug\" }}</code><br />
You can also add class and id attribute in download link, like this:<br />
<code>{{ download:link slug=\"download_item_slug\" class=\"your_atribut_class\" id=\"your_atribut_id\" target=\"_blank\" }}</code></p>

<p>Besides that, You can install download link with custom appearance,<br />
ie. you want to add some tag inside anchor tag, then use this code:
<code>{{ download:advance_link slug=\"download_item_slug\" }}<br />
&nbsp;&nbsp;&nbsp; &lt;a href=\"{{ href }}\" class=\"your_class\" id=\"your_id\" target=\"_blank\"&gt;<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &lt;span class=\"icon-download\"&gt;&lt;/span&gt; {{ title }}<br />
&nbsp;&nbsp;&nbsp; &lt;/a&gt;<br />
{{ /download:advance_link }}</code></p>

<br />
<h5>Show Total Download</h5>
<p>You can show total downloads by adding plugin code:<br />
<code>{{ download:count slug=\"download_item_slug\" }}</code></p>";
