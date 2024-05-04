/*!
 * jquery.base64.js 0.0.3 - https://github.com/yckart/jquery.base64.js
 * Makes Base64 en & -decoding simpler as it is.
 *
 * Based upon: https://gist.github.com/Yaffle/1284012
 *
 * Copyright (c) 2012 Yannick Albert (http://yckart.com)
 * Licensed under the MIT license (http://www.opensource.org/licenses/mit-license.php).
 * 2013/02/10
 **/
;(function(f){var b="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/",l="",j=[256],e=[256],g=0;var d={encode:function(c){var i=c.replace(/[\u0080-\u07ff]/g,function(n){var m=n.charCodeAt(0);return String.fromCharCode(192|m>>6,128|m&63)}).replace(/[\u0800-\uffff]/g,function(n){var m=n.charCodeAt(0);return String.fromCharCode(224|m>>12,128|m>>6&63,128|m&63)});return i},decode:function(i){var c=i.replace(/[\u00e0-\u00ef][\u0080-\u00bf][\u0080-\u00bf]/g,function(n){var m=((n.charCodeAt(0)&15)<<12)|((n.charCodeAt(1)&63)<<6)|(n.charCodeAt(2)&63);return String.fromCharCode(m)}).replace(/[\u00c0-\u00df][\u0080-\u00bf]/g,function(n){var m=(n.charCodeAt(0)&31)<<6|n.charCodeAt(1)&63;return String.fromCharCode(m)});return c}};while(g<256){var h=String.fromCharCode(g);l+=h;e[g]=g;j[g]=b.indexOf(h);++g}function a(z,u,n,x,t,r){z=String(z);var o=0,q=0,m=z.length,y="",w=0;while(q<m){var v=z.charCodeAt(q);v=v<256?n[v]:-1;o=(o<<t)+v;w+=t;while(w>=r){w-=r;var p=o>>w;y+=x.charAt(p);o^=p<<w}++q}if(!u&&w>0){y+=x.charAt(o<<(r-w))}return y}var k=f.base64=function(i,c,m){return c?k[i](c,m):i?null:this};k.btoa=k.encode=function(c,i){c=k.raw===false||k.utf8encode||i?d.encode(c):c;c=a(c,false,e,b,8,6);return c+"====".slice((c.length%4)||4)};k.atob=k.decode=function(n,c){n=n.replace(/[^A-Za-z0-9\+\/\=]/g,"");n=String(n).split("=");var m=n.length;do{--m;n[m]=a(n[m],true,j,l,6,8)}while(m>0);n=n.join("");return k.raw===false||k.utf8decode||c?d.decode(n):n}}(jQuery));

if ($.base64) {
	$.base64.utf8encode = true;
	$.base64.utf8decode = true;
}