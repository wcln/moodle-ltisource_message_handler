# LTI Message Handler
by Western Canadian Learning Network.  

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
```
// Send message to LMS to resize the iframe.
window.parent.postMessage(JSON.stringify({subject: 'lti.frameResize', height: height}), '*');
```
Possible message subjects:  
- lti.frameResize  
- lti.scrollToTop  

I should be adding more subjects as I continue development.

Created by Colin Bernard (colinjbernard@hotmail.com) for [Western Canada Learning Network](https://wcln.ca).  
