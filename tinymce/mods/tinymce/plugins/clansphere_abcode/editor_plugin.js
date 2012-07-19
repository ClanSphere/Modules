/**
 * BASED ON BBCODE PLUGIN
 * @author Moxiecode
 * @copyright Copyright © 2004-2008, Moxiecode Systems AB, All rights reserved.
 */

(function() {
	tinymce.create('tinymce.plugins.clansphere_abcodePlugin', {
		init : function(ed, url) {
			var t = this, dialect = ed.getParam('bbcode_dialect', 'punbb').toLowerCase();

			ed.onBeforeSetContent.add(function(ed, o) {
				o.content = t['_' + dialect + '_bbcode2html'](o.content);
			});

			ed.onPostProcess.add(function(ed, o) {
				if (o.set)
					o.content = t['_' + dialect + '_bbcode2html'](o.content);

				if (o.get)
					o.content = t['_' + dialect + '_html2bbcode'](o.content);
			});
		},

		getInfo : function() {
			return {
				longname : 'clansphere_abcode plugin',
				author : 'clansphere team',
				authorurl : 'http://www.clansphere.net',
				infourl : 'http://www.clansphere.net',
				version : "0.4"
			};
		},

		// Private methods

		// HTML -> BBCode in PunBB dialect
		_punbb_html2bbcode : function(s) {
			s = tinymce.trim(s);

			function rep(re, str) {
				s = s.replace(re, str);
			};

// clansphere
			rep(/<ol>(.*?)<\/ol>/gi, "[list=1]$1[/list]");
			rep(/<ul>(.*?)<\/ul>/gi, "[list]$1[/list]");
			rep(/<li>(.*?)<\/li>/gi, "[*]$1");
			rep(/<font.*?color=\"(.*?)\".*?>(.*?)<\/font>/gi,"[color=$1]$2[/color]");
      rep(/<(p|span|div)\s*(.*?)style=\"(.*?)color:\s*(.*?);(.*?)\"(.*?)>(.*?)<\/\1>/gi, "<$1 $2style=\"$3$5\"$6>[color=$4]$7[/color]<\/$1>");
      rep(/<(p|span|div)\s*(.*?)style=\"(.*?)padding-left:\s*(\d+).*?;(.*?)\"(.*?)>(.*?)<\/\1>/gi, "<$1 $2style=\"$3$5\"$6>[indent=$4]$7[/indent]<\/$1>");
      rep(/<(p|span|div)\s*(.*?)style=\"(.*?)text-align:\s*(left|center|right|justify);(.*?)\"(.*?)>(.*?)<\/\1>/gi, "<$1 $2style=\"$3$5\"$6>[$4]$7[/$4]<\/$1>");
      rep(/<(p|span|div)\s*(.*?)style=\"(.*?)font-size:.*?(\d+).*?;(.*?)\"(.*?)>(.*?)<\/\1>/gi, "<$1 $2style=\"$3$5\"$6>[size=$4]$7[/size]<\/$1>");
      rep(/<(p|span|div)\s*(.*?)style=\"(.*?)text-decoration:\s*(underline);(.*?)\"(.*?)>(.*?)<\/\1>/gi, "<$1 $2style=\"$3$5\"$6>[u]$7[/u]<\/$1>");
      rep(/<(p|span|div)\s*(.*?)style=\"(.*?)text-decoration:\s*(line-through);(.*?)\"(.*?)>(.*?)<\/\1>/gi, "<$1 $2style=\"$3$5\"$6>[s]$7[/s]<\/$1>");
			rep(/<a.*?href=\"(.*?)\".*?>(.*?)<\/a>/gi, "[url=$1]$2[/url]");
			rep(/<img.*?src=\"(.*?)\".*?\/>/gi,"[img]$1[/img]");
			rep(/<\/(strong|b)>/gi,"[/b]");
			rep(/<(strong|b)>/gi,"[b]");
			rep(/<\/(em|i)>/gi,"[/i]");
			rep(/<(em|i)>/gi,"[i]");
			rep(/<\/u>/gi,"[/u]");
			rep(/<u>/gi,"[u]");
			rep(/<h(\d+).*?>(.*?)<\/h(\d+)>/gi, "[h=$1]$2[/h]");
			rep(/<(p|p.*?|span|span.*?|font|font.*?|div|div.*?|li|li.*?|code|code.*?|blockquote|blockquote.*?)>/gi,"");
			rep(/<\/(span|font|div|li|code|blockquote)>/gi,"");
			rep(/<\/p>/gi,"\n\n");
			rep(/<hr.*?>/gi,"[hr]");
			rep(/<br.*?>/gi,"\n");
			rep(/&nbsp;/gi," ");
			rep(/&quot;/gi,"\"");
			rep(/&lt;/gi,"<");
			rep(/&gt;/gi,">");
			rep(/&amp;/gi,"&");
// end clansphere

			return s; 
		},

		// BBCode -> HTML from PunBB dialect
		_punbb_bbcode2html : function(s) {
			s = tinymce.trim(s);

			function rep(re, str) {
				s = s.replace(re, str);
			};

// clansphere
			rep(/\n/gi,"<br />");
			rep(/\[b\]/gi,"<strong>");
			rep(/\[\/b\]/gi,"</strong>");
			rep(/\[i\]/gi,"<em>");
			rep(/\[\/i\]/gi,"</em>");
			rep(/\[u\]/gi,"<u>");
			rep(/\[\/u\]/gi,"</u>");
			rep(/\[hr\]/gi,"<hr />");
			rep(/\[img\](.*?)\[\/img\]/gi,"<img src=\"$1\" />");
			rep(/\[url=(.*?)\](.*?)\[\/url\]/gi,"<a href=\"$1\">$2</a>");
			rep(/\[url\](.*?)\[\/url\]/gi,"<a href=\"$1\">$1</a>");
			rep(/\[php\](.*?)\[\/php\]/gi,"<code>[php]$1[/php]</code>");
			rep(/\[quote\](.*?)\[\/quote\]/gi,"<blockquote>[quote]$1[/quote]</blockquote>");
			rep(/\[quote=(.*?)\](.*?)\[\/quote\]/gi,"<blockquote>[quote=$1]$2[/quote]</blockquote>");
			rep(/\[h=(\d+)\](.*?)\[\/h\]/gi,"<h$1>$2</h$1>");
			rep(/\[color=(.*?)\](.*?)\[\/color\]/gi,"<font color=\"$1\">$2</font>");
			rep(/\[(left|center|right|justify)\](.*?)\[\/\1\]/gi,"<div style=\"text-align: $1;\">$2</div>");
			rep(/\[s\](.*?)\[\/s\]/gi,"<span style=\"text-decoration: line-through;\">$1</span>");
			rep(/\[indent=(.*?)\](.*?)\[\/indent\]/gi,"<div style=\"padding-left: $1px;\">$2</div>");
			rep(/\[size=(.*?)\](.*?)\[\/size\]/gi,"<span style=\"font-size: $1;\">$2</span>");
			rep(/\[\*\]/gi,"[*end][*]");
			rep(/\[\*\](.*?)\[\*end\]/gi,"<li>$1</li>");
			rep(/\[\*\](.*?)\[\/list\]/gi,"<li>$1</li>[/list]");
			rep(/\[list=(.*?)\](.*?)\[\/list\]/gi,"<ol>$2</ol>");
			rep(/\[list\](.*?)\[\/list\]/gi,"<ul>$1</ul>");
			rep(/\[\*end\]/gi,"");
// end clansphere

			return s; 
		}
	});

	// Register plugin
	tinymce.PluginManager.add('clansphere_abcode', tinymce.plugins.clansphere_abcodePlugin);
})();