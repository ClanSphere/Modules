tinyMCEPopup.requireLangPack();

var dialog_threadlink = {

	init : function() {

		var f = document.forms[0];
	},

	insert : function() {

    if(document.forms[0].threadlink_id.value == '') {

  		alert(tinyMCEPopup.editor.getLang('clansphere_features.threadlink_error_id'));
  		return false;
    }
    else if(document.forms[0].threadlink_name.value == '') {

  		alert(tinyMCEPopup.editor.getLang('clansphere_features.threadlink_error_name'));
  		return false;
    }
    else {

      tinyMCEPopup.editor.execCommand('mceInsertContent', false, dialog_threadlink.output(document.forms[0].threadlink_id.value, document.forms[0].threadlink_name.value));
		  tinyMCEPopup.close();
    }
  },

  output: function(id, name) {

    id = id.replace(/</gi, "&lt;");
    id = id.replace(/>/gi, "&gt;");
    name = name.replace(/</gi, "&lt;");
    name = name.replace(/>/gi, "&gt;");

    return '[threadid=' + id + ']' + name + '[/threadid]';
  }
};

tinyMCEPopup.onInit.add(dialog_threadlink.init, dialog_threadlink);