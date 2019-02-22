# LTI Message Handler
**by Western Canadian Learning Network.**  

This Moodle LTI Source plugin allows communication between an LTI tool and a consumer site. It is meant to replicate message handling functions implemented in Canvas. Thus, if an LTI provider makes use of Canvas' functions, this plugin will work similarly.   

The main purpose of this plugin is to allow iFrame resizing. The LTI iFrames in Moodle are laughably small and impossible to view course content in. With this plugin installed, an LTI tool provider may send messages to the tool consumer instructing it to resize the iFrame.  

### Installation:  
- Download this repository.  
- Extract the ZIP to 'mod/lti/source/'.  
- The folder name within the source directory should be "message_handler".  
- Login to your Moodle site as an administrator and install the plugin.

**or**  

- Login to your Moodle site as an admin and go to Administration -> Site administration -> Plugins -> Install plugins.  
- Upload the ZIP file.  

**or (Recommended)**  

- Download this plugin from the [Moodle Plugin Directory](https://moodle.org/plugins/ltisource_message_handler).  

### Usage:  
Once the plugin is installed on the tool consumer site, the tool provider may communicate with it as follows.  
```
// Send a message to the tool consumer to resize the iframe. Height will be accepted as an integer or a string.
window.parent.postMessage(JSON.stringify({subject: 'lti.frameResize', height: 1000}), '*');

// Send a message to the tool consumer to resize the iframe.
window.parent.postMessage(JSON.stringify({subject: 'lti.scrollToTop'}), '*');

// Send a message to the tool consumer to remove the iframe border.
window.parent.postMessage(JSON.stringify({subject: 'lti.removeBorder'}), '*');
```
For example, if a tool provider is returning a page 'index.html' to be displayed in the iframe, they should add a JavaScript file similar to above.  

**Note:** While you can install this plugin on your site receiving LTI content, the LTI provider must implement one of the above to actually use the functions.

Possible message subjects:  
- lti.frameResize  
- lti.scrollToTop  
- lti.removeBorder

I should be adding more subjects as I continue development.  

### Screenshots:
**An LTI lesson WITHOUT using this plugin:**  
![LTI lesson without plugin](https://moodle.org/pluginfile.php/50/local_plugins/plugin_screenshots/2242/Screenshot_10.png)

**An LTI lesson that utilizes this plugin:**  
![LTI lesson with plugin](https://moodle.org/pluginfile.php/50/local_plugins/plugin_screenshots/2242/Screenshot_1.png)


Created by Colin Bernard (colinjbernard@hotmail.com) for [Western Canadian Learning Network](https://wcln.ca).  
