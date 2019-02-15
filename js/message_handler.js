
var messageHandlerScript = window.parent.document.createElement('script');
messageHandlerScript.type = 'text/javascript';
messageHandlerScript.innerHTML = 'monitorLtiMessages();' + ltiMessageHandler.toString() + monitorLtiMessages.toString();
window.parent.document.body.appendChild(messageHandlerScript);

function ltiMessageHandler(e) {

  try {
    var message = JSON.parse(e.data);
    switch (message.subject) {
      case 'lti.frameResize':
        let height = message.height;
        if (height <= 0) height = 1;

        let iframe = document.getElementById('contentframe');
        if (iframe) {
          if (typeof height === 'number') {
            height = height + 'px';
          }
          iframe.height = height;
          iframe.style.height = height;
          iframe.style.border = 'none';
        }
        break;

      case 'lti.scrollToTop':
        $('html, body').animate({
          scrollTop: $('#contentframe').offset().top
         }, 'fast');
        break;
    }
  } catch (err) {
    (console.error || console.log).call(console, 'invalid message received from');
  }
}

function monitorLtiMessages() {
  window.addEventListener('message', function(e) {
    ltiMessageHandler(e);
  });
}
