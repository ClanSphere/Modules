tinyMCEPopup.requireLangPack();

var dialog_clipbox = {

	init : function() {

		var f = document.forms[0];
	},

	insert : function() {

    if(document.forms[0].clipbox_name.value == '') {

  		alert(tinyMCEPopup.editor.getLang('clansphere_features.clipbox_error'));
  		return false;
    }
    else {

      tinyMCEPopup.editor.execCommand('mceInsertContent', false, dialog_clipbox.output(document.forms[0].clipbox_name.value, document.forms[0].clipbox_content.value));
		  tinyMCEPopup.close();
    }
  },

  output: function(name, content) {

    content = content.replace(/</gi, "&lt;");
    content = content.replace(/>/gi, "&gt;");
    name = name.replace(/</gi, "&lt;");
    name = name.replace(/>/gi, "&gt;");

    return '[clip=' + name + ']' + content + '[/clip]';
  }
};

tinyMCEPopup.onInit.add(dialog_clipbox.init, dialog_clipbox);