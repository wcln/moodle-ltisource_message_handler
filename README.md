# Moodle LTI Source plugin  
## by Western Canada Learning Network.  
  
This plugin is required to receive Western Canada Learning Network (WCLN) LTI courses. The purpose of this plugin is to implement a function which is called before a WCLN LTI book is launched. This plugin writes a script to the consumer page to allow dynamic iFrame resizing and other cross origin requests.  
  
Installation:  
- Download this repository.  
- Extract the ZIP to 'mod/lti/source/'.  
- The folder name within the source directory should be "wcln".  
- If neccessary, edit 'wcln/lib.php' to set the value of the constant 'WCLN_ENDPOINT' to the endpoint URL of your LTI provider.  

or  

- Login to your Moodle site as an admin and go to Administration -> Site administration -> Plugins -> Install plugins.  
- Upload the ZIP file.  


Created by Colin Bernard (colinjbernard@hotmail.com) for Western Canada Learning Network (wcln.ca).  
