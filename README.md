<h3>LTI Message Handler</h3>
<p><span><b><i>by Western Canadian Learning Network.&nbsp;&nbsp;</i></b></span></p>
<p><br></p>
<p>This Moodle LTI Source plugin allows communication between an LTI tool and a consumer site. It is meant to replicate message handling functions implemented in Canvas. Thus, if an LTI provider makes use of Canvas' functions, this plugin will work similarly.&nbsp;
    &nbsp;&nbsp;</p>
<p>The main purpose of this plugin is to allow iFrame resizing. The LTI iFrames in Moodle are laughably small and impossible to view course content in. With this plugin installed, an LTI tool provider may send messages to the tool consumer instructing it
    to resize the iFrame.&nbsp;&nbsp;</p>
<p>See the screenshots which show an LTI book with and without this plugin installed.&nbsp;&nbsp;</p>
<p><br></p>
<h4>Installation:&nbsp;&nbsp;</h4>
<p>This plugin should be installed on the tool consumer site. See "Usage" for how to make use of this plugin as a tool provider.</p>
<p></p>
<ul>
    <li>Download this repository.&nbsp;&nbsp;</li>
    <li>Extract the ZIP to 'mod/lti/source/'.&nbsp;&nbsp;</li>
    <li>The folder name within the source directory should be "message_handler".&nbsp;&nbsp;</li>
    <li>Login to your Moodle site as an administrator and install the plugin.</li>
</ul>
<p><b>or</b></p>
<p></p>
<ul>
    <li>Login to your Moodle site as an admin and go to Administration -&gt; Site administration -&gt; Plugins -&gt; Install plugins.&nbsp;&nbsp;</li>
    <li>Upload the ZIP file.&nbsp;&nbsp;</li>
</ul>
<p><br></p>
<h4>Usage:&nbsp;&nbsp;</h4>
<p>Once the plugin is installed on the tool consumer site, the tool provider may communicate with it as follows.</p>
<pre>// Send message to the tool consumer to resize the iframe. Height will be accepted as an integer or a string.<br>window.parent.postMessage(JSON.stringify({subject: 'lti.frameResize', height: 1000}), '*');<br>
// Send message to the tool consumer to resize the iframe.<br>window.parent.postMessage(JSON.stringify({subject: 'lti.scrollToTop'}), '*');
</pre>
<p>For example, if a tool provider is returning a page 'index.html' to be displayed in the iframe, they should add a JavaScript file similar to above.</p>
<p><b>Note:</b>&nbsp;While you can install this plugin on your site receiving LTI content, the LTI provider must implement one of the above to actually <i>use</i>&nbsp;the functions.</p>
<p>Possible message subjects:&nbsp;&nbsp;</p>
<p></p>
<ul>
    <li>lti.frameResize&nbsp;&nbsp;</li>
    <li>lti.scrollToTop&nbsp;&nbsp;</li>
</ul>
<p>I should be adding more subjects as I continue development.</p>
<p><br></p>
<p>Created by Colin Bernard (colinjbernard@hotmail.com) for <a href="https://wcln.ca">Western Canada Learning Network</a>.</p>
