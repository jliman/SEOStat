/*
 * Nitobi Complete UI 1.0
 * Copyright(c) 2008, Nitobi
 * support@nitobi.com
 * 
 * http://www.nitobi.com/license
 */
if(typeof (nitobi)=="undefined"){
nitobi=function(){
};
}
if(false){
nitobi.lang=function(){
};
}
if(typeof (nitobi.lang)=="undefined"){
nitobi.lang={};
}
nitobi.lang.defineNs=function(_1){
var _2=_1.split(".");
var _3="";
var _4="";
for(var i=0;i<_2.length;i++){
_3+=_4+_2[i];
_4=".";
if(eval("typeof("+_3+")")=="undefined"){
eval(_3+"={}");
}
}
};
nitobi.lang.extend=function(_6,_7){
function inheritance(){
}
inheritance.prototype=_7.prototype;
_6.prototype=new inheritance();
_6.prototype.constructor=_6;
_6.baseConstructor=_7;
if(_7.base){
_7.prototype.base=_7.base;
}
_6.base=_7.prototype;
};
nitobi.lang.implement=function(_8,_9){
for(var _a in _9.prototype){
if(typeof (_8.prototype[_a])=="undefined"||_8.prototype[_a]==null){
_8.prototype[_a]=_9.prototype[_a];
}
}
};
nitobi.lang.setJsProps=function(p,_c){
for(var i=0;i<_c.length;i++){
var _e=_c[i];
p["set"+_e.n]=this.jSET;
p["get"+_e.n]=this.jGET;
p[_e.n]=_e.d;
}
};
nitobi.lang.setXmlProps=function(p,_10){
for(var i=0;i<_10.length;i++){
var _12=_10[i];
var s,g;
switch(_12.t){
case "i":
s=this.xSET;
g=this.xiGET;
break;
case "b":
s=this.xbSET;
g=this.xbGET;
break;
default:
s=this.xSET;
g=this.xGET;
}
p["set"+_12.n]=s;
p["get"+_12.n]=g;
p["sModel"]+=_12.n+"\""+_12.d+"\" ";
}
};
nitobi.lang.setEvents=function(p,_16){
for(var i=0;i<_16.length;i++){
var n=_16[i];
p["set"+n]=this.eSET;
p["get"+n]=this.eGET;
var nn=n.substring(0,n.length-5);
p["set"+nn]=this.eSET;
p["get"+nn]=this.eGET;
p["o"+n.substring(1)]=new nitobi.base.Event();
}
};
nitobi.lang.isDefined=function(a){
return (typeof (a)!="undefined");
};
nitobi.lang.getBool=function(a){
if(null==a){
return null;
}
if(typeof (a)=="boolean"){
return a;
}
return a.toLowerCase()=="true";
};
nitobi.lang.type={XMLNODE:0,HTMLNODE:1,ARRAY:2,XMLDOC:3};
nitobi.lang.typeOf=function(obj){
var t=typeof (obj);
if(t=="object"){
if(obj.blur&&obj.innerHTML){
return nitobi.lang.type.HTMLNODE;
}
if(obj.nodeName&&obj.nodeName.toLowerCase()==="#document"){
return nitobi.lang.type.XMLDOC;
}
if(obj.nodeName){
return nitobi.lang.type.XMLNODE;
}
if(obj instanceof Array){
return nitobi.lang.type.ARRAY;
}
}
return t;
};
nitobi.lang.toBool=function(_1e,_1f){
if(typeof (_1f)!="undefined"){
if((typeof (_1e)=="undefined")||(_1e=="")||(_1e==null)){
_1e=_1f;
}
}
_1e=_1e.toString()||"";
_1e=_1e.toUpperCase();
if((_1e=="Y")||(_1e=="1")||(_1e=="TRUE")){
return true;
}else{
return false;
}
};
nitobi.lang.boolToStr=function(_20){
if((typeof (_20)=="boolean"&&_20)||(typeof (_20)=="string"&&(_20.toLowerCase()=="true"||_20=="1"))){
return "1";
}else{
return "0";
}
return _20;
};
nitobi.lang.formatNumber=function(_21,_22,_23,_24){
var n=nitobi.form.numberXslProc;
n.addParameter("number",_21,"");
n.addParameter("mask",_22,"");
n.addParameter("group",_23,"");
n.addParameter("decimal",_24,"");
return nitobi.xml.transformToString(nitobi.xml.Empty,nitobi.form.numberXslProc);
};
nitobi.lang.close=function(_26,_27,_28){
if(null==_28){
return function(){
return _27.apply(_26,arguments);
};
}else{
return function(){
return _27.apply(_26,_28);
};
}
};
nitobi.lang.after=function(_29,_2a,_2b,_2c){
var _2d=_29[_2a];
var _2e=_2b[_2c];
if(_2c instanceof Function){
_2e=_2c;
}
_29[_2a]=function(){
_2d.apply(_29,arguments);
_2e.apply(_2b,arguments);
};
_29[_2a].orig=_2d;
};
nitobi.lang.before=function(_2f,_30,_31,_32){
var _33=_2f[_30];
var _34=function(){
};
if(_31!=null){
_34=_31[_32];
}
if(_32 instanceof Function){
_34=_32;
}
_2f[_30]=function(){
_34.apply(_31,arguments);
_33.apply(_2f,arguments);
};
_2f[_30].orig=_33;
};
nitobi.lang.forEach=function(arr,_36){
var len=arr.length;
for(var i=0;i<len;i++){
_36.call(this,arr[i],i);
}
_36=null;
};
nitobi.lang.throwError=function(_39,_3a){
var msg=_39;
if(_3a!=null){
msg+="\n - because "+nitobi.lang.getErrorDescription(_3a);
}
throw msg;
};
nitobi.lang.getErrorDescription=function(_3c){
var _3d=(typeof (_3c.description)=="undefined")?_3c:_3c.description;
return _3d;
};
nitobi.lang.newObject=function(_3e,_3f,_40){
var a=_3f;
if(null==_40){
_40=0;
}
var e="new "+_3e+"(";
var _43="";
for(var i=_40;i<a.length;i++){
e+=_43+"a["+i+"]";
_43=",";
}
e+=")";
return eval(e);
};
nitobi.lang.getLastFunctionArgs=function(_45,_46){
var a=new Array(_45.length-_46);
for(var i=_46;i<_45.length;i++){
a[i-_46]=_45[i];
}
return a;
};
nitobi.lang.getFirstHashKey=function(_49){
for(var x in _49){
return x;
}
};
nitobi.lang.getFirstFunction=function(obj){
for(var x in obj){
if(obj[x]!=null&&typeof (obj[x])=="function"&&typeof (obj[x].prototype)!="undefined"){
return {name:x,value:obj[x]};
}
}
return null;
};
nitobi.lang.copy=function(obj){
var _4e={};
for(var _4f in obj){
_4e[_4f]=obj[_4f];
}
return _4e;
};
nitobi.lang.dispose=function(_50,_51){
try{
if(_51!=null){
var _52=_51.length;
for(var i=0;i<_52;i++){
if(typeof (_51[i].dispose)=="function"){
_51[i].dispose();
}
if(typeof (_51[i])=="function"){
_51[i].call(_50);
}
_51[i]=null;
}
}
for(var _54 in _50){
if(_50[_54]!=null&&_50[_54].dispose instanceof Function){
_50[_54].dispose();
}
_50[_54]=null;
}
}
catch(e){
}
};
nitobi.lang.parseNumber=function(val){
var num=parseInt(val);
return (isNaN(num)?0:num);
};
nitobi.lang.numToAlpha=function(num){
if(typeof (nitobi.lang.numAlphaCache[num])==="string"){
return nitobi.lang.numAlphaCache[num];
}
var ck1=num%26;
var ck2=Math.floor(num/26);
var _5a=(ck2>0?String.fromCharCode(96+ck2):"")+String.fromCharCode(97+ck1);
nitobi.lang.alphaNumCache[_5a]=num;
nitobi.lang.numAlphaCache[num]=_5a;
return _5a;
};
nitobi.lang.alphaToNum=function(_5b){
if(typeof (nitobi.lang.alphaNumCache[_5b])==="number"){
return nitobi.lang.alphaNumCache[_5b];
}
var j=0;
var num=0;
for(var i=_5b.length-1;i>=0;i--){
num+=(_5b.charCodeAt(i)-96)*Math.pow(26,j++);
}
num=num-1;
nitobi.lang.alphaNumCache[_5b]=num;
nitobi.lang.numAlphaCache[num]=_5b;
return num;
};
nitobi.lang.alphaNumCache={};
nitobi.lang.numAlphaCache={};
nitobi.lang.toArray=function(obj,_60){
return Array.prototype.splice.call(obj,_60||0);
};
nitobi.lang.merge=function(_61,_62){
var r={};
for(var i=0;i<arguments.length;i++){
var a=arguments[i];
for(var x in arguments[i]){
r[x]=a[x];
}
}
return r;
};
nitobi.lang.xor=function(){
var b=false;
for(var j=0;j<arguments.length;j++){
if(arguments[j]&&!b){
b=true;
}else{
if(arguments[j]&&b){
return false;
}
}
}
return b;
};
nitobi.lang.zeros="00000000000000000000000000000000000000000000000000000000000000000000";
nitobi.lang.padZeros=function(num,_6a){
_6a=_6a||2;
num=num+"";
return nitobi.lang.zeros.substr(0,Math.max(_6a-num.length,0))+num;
};
nitobi.lang.noop=function(){
};
nitobi.lang.isStandards=function(){
var s=(document.compatMode=="CSS1Compat");
if(nitobi.browser.SAFARI||nitobi.browser.CHROME){
var _6c=document.createElement("div");
_6c.style.cssText="width:0px;width:1";
s=(parseInt(_6c.style.width)!=1);
}
return s;
};
nitobi.lang.defineNs("nitobi.lang");
nitobi.lang.Math=function(){
};
nitobi.lang.Math.sinTable=Array();
nitobi.lang.Math.cosTable=Array();
nitobi.lang.Math.rotateCoords=function(_6d,_6e,_6f){
var _70=_6f*0.01745329277777778;
if(nitobi.lang.Math.sinTable[_70]==null){
nitobi.lang.Math.sinTable[_70]=Math.sin(_70);
nitobi.lang.Math.cosTable[_70]=Math.cos(_70);
}
var cR=nitobi.lang.Math.cosTable[_70];
var sR=nitobi.lang.Math.sinTable[_70];
var x=_6d*cR-_6e*sR;
var y=_6e*cR+_6d*sR;
return {x:x,y:y};
};
nitobi.lang.Math.returnAngle=function(_75,_76,_77,_78){
return Math.atan2(_78-_76,_77-_75)/0.01745329277777778;
};
nitobi.lang.Math.returnDistance=function(x1,y1,x2,y2){
return Math.sqrt(((x2-x1)*(x2-x1))+((y2-y1)*(y2-y1)));
};
nitobi.lang.defineNs("nitobi");
nitobi.Object=function(){
this.disposal=new Array();
this.modelNodes={};
};
nitobi.Object.prototype.setValues=function(_7d){
for(var _7e in _7d){
if(this[_7e]!=null){
if(this[_7e].subscribe!=null){
}else{
this[_7e]=_7d[_7e];
}
}else{
if(this[_7e] instanceof Function){
this[_7e](_7d[_7e]);
}else{
if(this["set"+_7e] instanceof Function){
this["set"+_7e](_7d[_7e]);
}else{
this[_7e]=_7d[_7e];
}
}
}
}
};
nitobi.Object.prototype.xGET=function(){
var _7f=null,_80="@"+arguments[0],val="";
var _82=this.modelNodes[_80];
if(_82!=null){
_7f=_82;
}else{
_7f=this.modelNodes[_80]=this.modelNode.selectSingleNode(_80);
}
if(_7f!=null){
val=_7f.nodeValue;
}
return val;
};
nitobi.Object.prototype.xSET=function(){
var _83=null,_84="@"+arguments[0];
var _85=this.modelNodes[_84];
if(_85!=null){
_83=_85;
}else{
_83=this.modelNodes[_84]=this.modelNode.selectSingleNode(_84);
}
if(_83==null){
this.modelNode.setAttribute(arguments[0],"");
}
if(arguments[1][0]!=null&&_83!=null){
if(typeof (arguments[1][0])=="boolean"){
_83.nodeValue=nitobi.lang.boolToStr(arguments[1][0]);
}else{
_83.nodeValue=arguments[1][0];
}
}
};
nitobi.Object.prototype.eSET=function(_86,_87){
var _88=_87[0];
var _89=_88;
var _8a=_86.substr(2);
_8a=_8a.substr(0,_8a.length-5);
if(typeof (_88)=="string"){
_89=function(){
return nitobi.event.evaluate(_88,arguments[0]);
};
}
if(this[_86]!=null){
this.unsubscribe(_8a,this[_86]);
}
var _8b=this.subscribe(_8a,_89);
this.jSET(_86,[_8b]);
return _8b;
};
nitobi.Object.prototype.eGET=function(){
};
nitobi.Object.prototype.jSET=function(_8c,val){
this[_8c]=val[0];
};
nitobi.Object.prototype.jGET=function(_8e){
return this[_8e];
};
nitobi.Object.prototype.xsGET=nitobi.Object.prototype.xGET;
nitobi.Object.prototype.xsSET=nitobi.Object.prototype.xSET;
nitobi.Object.prototype.xbGET=function(){
return nitobi.lang.toBool(this.xGET.apply(this,arguments),false);
};
nitobi.Object.prototype.xiGET=function(){
return parseInt(this.xGET.apply(this,arguments));
};
nitobi.Object.prototype.xiSET=nitobi.Object.prototype.xSET;
nitobi.Object.prototype.xdGET=function(){
};
nitobi.Object.prototype.xnGET=function(){
return parseFloat(this.xGET.apply(this,arguments));
};
nitobi.Object.prototype.xbSET=function(){
this.xSET.call(this,arguments[0],[nitobi.lang.boolToStr(arguments[1][0])]);
};
nitobi.Object.prototype.fire=function(evt,_90){
return nitobi.event.notify(evt+this.uid,_90);
};
nitobi.Object.prototype.subscribe=function(evt,_92,_93){
if(this.subscribedEvents==null){
this.subscribedEvents={};
}
if(typeof (_93)=="undefined"){
_93=this;
}
var _94=nitobi.event.subscribe(evt+this.uid,nitobi.lang.close(_93,_92));
this.subscribedEvents[_94]=evt+this.uid;
return _94;
};
nitobi.Object.prototype.subscribeOnce=function(evt,_96,_97,_98){
var _99=this;
var _9a=function(){
_96.apply(_97||this,_98||arguments);
_99.unsubscribe(evt,_9b);
};
var _9b=this.subscribe(evt,_9a);
return _9b;
};
nitobi.Object.prototype.unsubscribe=function(evt,_9d){
return nitobi.event.unsubscribe(evt+this.uid,_9d);
};
nitobi.Object.prototype.dispose=function(){
if(this.disposing){
return;
}
this.disposing=true;
var _9e=this.disposal.length;
for(var i=0;i<_9e;i++){
if(disposal[i] instanceof Function){
disposal[i].call(context);
}
disposal[i]=null;
}
for(var _a0 in this){
if(this[_a0].dispose instanceof Function){
this[_a0].dispose.call(this[_a0]);
}
this[_a0]=null;
}
};
if(false){
nitobi.base=function(){
};
}
nitobi.lang.defineNs("nitobi.base");
nitobi.base.uid=1;
nitobi.base.getUid=function(){
return "ntb__"+(nitobi.base.uid++);
};
nitobi.lang.defineNs("nitobi.browser");
if(false){
nitobi.browser=function(){
};
}
nitobi.browser.UNKNOWN=true;
nitobi.browser.IE=false;
nitobi.browser.IE6=false;
nitobi.browser.IE7=false;
nitobi.browser.IE8=false;
nitobi.browser.MOZ=false;
nitobi.browser.FF3=false;
nitobi.browser.SAFARI=false;
nitobi.browser.OPERA=false;
nitobi.browser.AIR=false;
nitobi.browser.CHROME=false;
nitobi.browser.XHR_ENABLED;
nitobi.browser.detect=function(){
var _a1=[{string:navigator.vendor,subString:"Adobe",identity:"AIR"},{string:navigator.vendor,subString:"Google",identity:"Chrome"},{string:navigator.vendor,subString:"Apple",identity:"Safari"},{prop:window.opera,identity:"Opera"},{string:navigator.vendor,subString:"iCab",identity:"iCab"},{string:navigator.vendor,subString:"KDE",identity:"Konqueror"},{string:navigator.userAgent,subString:"Firefox",identity:"Firefox"},{string:navigator.userAgent,subString:"Netscape",identity:"Netscape"},{string:navigator.userAgent,subString:"MSIE",identity:"Explorer",versionSearch:"MSIE"},{string:navigator.userAgent,subString:"Gecko",identity:"Mozilla",versionSearch:"rv"},{string:navigator.userAgent,subString:"Mozilla",identity:"Netscape",versionSearch:"Mozilla"},{string:navigator.vendor,subString:"Camino",identity:"Camino"}];
var _a2="Unknown";
for(var i=0;i<_a1.length;i++){
var _a4=_a1[i].string;
var _a5=_a1[i].prop;
if(_a4){
if(_a4.indexOf(_a1[i].subString)!=-1){
_a2=_a1[i].identity;
break;
}
}else{
if(_a5){
_a2=_a1[i].identity;
break;
}
}
}
nitobi.browser.IE=(_a2=="Explorer");
nitobi.browser.IE6=(nitobi.browser.IE&&!window.XMLHttpRequest);
nitobi.browser.IE7=(nitobi.browser.IE&&window.XMLHttpRequest);
nitobi.browser.MOZ=(_a2=="Netscape"||_a2=="Firefox"||_a2=="Camino");
nitobi.browser.FF3=(_a2=="Firefox"&&parseInt(navigator.userAgent.substr(navigator.userAgent.indexOf("Firefox/")+8,3))==3);
nitobi.browser.SAFARI=(_a2=="Safari");
nitobi.browser.OPERA=(_a2=="Opera");
nitobi.browser.AIR=(_a2=="AIR");
nitobi.browser.CHROME=(_a2=="Chrome");
if(nitobi.browser.SAFARI){
nitobi.browser.OPERA=true;
}
if(nitobi.browser.AIR){
nitobi.browser.SAFARI=true;
}
nitobi.browser.XHR_ENABLED=nitobi.browser.OPERA||nitobi.browser.SAFARI||nitobi.browser.MOZ||nitobi.browser.IE||nitobi.browser.CHROME;
nitobi.browser.UNKNOWN=!(nitobi.browser.IE||nitobi.browser.MOZ||nitobi.browser.SAFARI||nitobi.browser.CHROME);
};
nitobi.browser.detect();
if(nitobi.browser.IE6){
try{
document.execCommand("BackgroundImageCache",false,true);
}
catch(e){
}
}
nitobi.lang.defineNs("nitobi.browser");
nitobi.browser.Cookies=function(){
};
nitobi.lang.extend(nitobi.browser.Cookies,nitobi.Object);
nitobi.browser.Cookies.get=function(id){
var _a7,end;
if(document.cookie.length>0){
_a7=document.cookie.indexOf(id+"=");
if(_a7!=-1){
_a7+=id.length+1;
end=document.cookie.indexOf(";",_a7);
if(end==-1){
end=document.cookie.length;
}
return unescape(document.cookie.substring(_a7,end));
}
}
return null;
};
nitobi.browser.Cookies.set=function(id,_aa,_ab){
var _ac=new Date();
_ac.setTime(_ac.getTime()+(_ab*24*3600*1000));
document.cookie=id+"="+escape(_aa)+((_ab==null)?"":"; expires="+_ac.toGMTString());
};
nitobi.browser.Cookies.remove=function(id){
if(nitobi.browser.Cookies.get(id)){
document.cookie=id+"="+"; expires=Thu, 01-Jan-70 00:00:01 GMT";
}
};
nitobi.lang.defineNs("nitobi.browser");
nitobi.browser.History=function(){
this.lastPage="";
this.currentPage="";
this.onChange=new nitobi.base.Event();
this.iframeObject=nitobi.html.createElement("iframe",{"name":"ntb_history","id":"ntb_history"},{"display":"none"});
document.body.appendChild(nitobi.xml.importNode(document,this.iframeObject,true));
this.iframe=frames["ntb_history"];
this.monitor();
};
nitobi.browser.History.prototype.add=function(_ae){
this.lastPage=this.currentPage=_ae.substr(_ae.indexOf("#")+1);
this.iframe.location.href=_ae;
};
nitobi.browser.History.prototype.monitor=function(){
var _af=this.iframe.location.href.split("#");
this.currentPage=_af[1];
if(this.currentPage!=this.lastPage){
this.onChange.notify(_af[0].substring(_af[0].lastIndexOf("/")+1),this.currentPage);
this.lastPage=this.currentPage;
}
window.setTimeout(nitobi.lang.close(this,this.monitor),1500);
};
nitobi.lang.defineNs("nitobi.xml");
nitobi.xml=function(){
};
nitobi.xml.nsPrefix="ntb:";
nitobi.xml.nsDecl="xmlns:ntb=\"http://www.nitobi.com\"";
if(nitobi.browser.IE){
var inUse=false;
nitobi.xml.XslTemplate=new ActiveXObject("MSXML2.XSLTemplate.3.0");
}
if(typeof XMLSerializer!="undefined"&&typeof DOMParser!="undefined"){
nitobi.xml.Serializer=new XMLSerializer();
nitobi.xml.DOMParser=new DOMParser();
}
nitobi.xml.getChildNodes=function(_b0){
if(nitobi.browser.IE){
return _b0.childNodes;
}else{
return _b0.selectNodes("./*");
}
};
nitobi.xml.indexOfChildNode=function(_b1,_b2){
var _b3=nitobi.xml.getChildNodes(_b1);
for(var i=0;i<_b3.length;i++){
if(_b3[i]==_b2){
return i;
}
}
return -1;
};
nitobi.xml.createXmlDoc=function(xml){
if(xml!=null){
xml=xml.substring(xml.indexOf("<?xml"));
}
if(xml!=null&&xml.documentElement!=null){
return xml;
}
var doc=null;
if(nitobi.browser.IE){
doc=new ActiveXObject("Msxml2.DOMDocument.3.0");
doc.setProperty("SelectionNamespaces","xmlns:ntb='http://www.nitobi.com'");
}else{
if(document.implementation&&document.implementation.createDocument){
doc=document.implementation.createDocument("","",null);
}
}
if(xml!=null&&typeof xml=="string"){
doc=nitobi.xml.loadXml(doc,xml);
}
return doc;
};
nitobi.xml.loadXml=function(doc,xml,_b9){
doc.async=false;
if(nitobi.browser.IE){
doc.loadXML(xml);
}else{
var _ba=nitobi.xml.DOMParser.parseFromString((xml.xml!=null?xml.xml:xml),"text/xml");
if(_b9){
while(doc.hasChildNodes()){
doc.removeChild(doc.firstChild);
}
for(var i=0;i<_ba.childNodes.length;i++){
doc.appendChild(doc.importNode(_ba.childNodes[i],true));
}
}else{
doc=_ba;
}
_ba=null;
}
return doc;
};
nitobi.xml.hasParseError=function(_bc){
if(nitobi.browser.IE){
return (_bc.parseError!=0);
}else{
if(_bc==null||_bc.documentElement==null){
return true;
}
var _bd=_bc.documentElement;
if((_bd.tagName=="parserError")||(_bd.namespaceURI=="http://www.mozilla.org/newlayout/xml/parsererror.xml")){
return true;
}
return false;
}
};
nitobi.xml.getParseErrorReason=function(_be){
if(!nitobi.xml.hasParseError(_be)){
return "";
}
if(nitobi.browser.IE){
return (_be.parseError.reason);
}else{
return (new XMLSerializer().serializeToString(_be));
}
};
nitobi.xml.createXslDoc=function(xsl){
var doc=null;
if(nitobi.browser.IE){
doc=new ActiveXObject("MSXML2.FreeThreadedDOMDocument.3.0");
}else{
doc=nitobi.xml.createXmlDoc();
}
doc=nitobi.xml.loadXml(doc,xsl||"<xsl:stylesheet version=\"1.0\" xmlns:xsl=\"http://www.w3.org/1999/XSL/Transform\" xmlns:ntb=\"http://www.nitobi.com\" />");
return doc;
};
nitobi.xml.createXslProcessor=function(xsl){
var _c2=null;
var xt=null;
if(typeof (xsl)!="string"){
xsl=nitobi.xml.serialize(xsl);
}
if(nitobi.browser.IE){
_c2=new ActiveXObject("MSXML2.FreeThreadedDOMDocument.3.0");
xt=new ActiveXObject("MSXML2.XSLTemplate.3.0");
_c2.async=false;
_c2.loadXML(xsl);
xt.stylesheet=_c2;
return xt.createProcessor();
}else{
if(XSLTProcessor){
_c2=nitobi.xml.createXmlDoc(xsl);
xt=new XSLTProcessor();
xt.importStylesheet(_c2);
xt.stylesheet=_c2;
return xt;
}
}
};
nitobi.xml.parseHtml=function(_c4){
if(typeof (_c4)=="string"){
_c4=document.getElementById(_c4);
}
var _c5=nitobi.html.getOuterHtml(_c4);
var _c6="";
if(nitobi.browser.IE){
var _c7=new RegExp("(\\s+.[^=]*)='(.*?)'","g");
_c5=_c5.replace(_c7,function(m,_1,_2){
return _1+"=\""+_2.replace(/"/g,"&quot;")+"\"";
});
_c6=(_c5.substring(_c5.indexOf("/>")+2).replace(/(\s+.[^\=]*)\=\s*([^\"^\s^\>]+)/g,"$1=\"$2\" ")).replace(/\n/gi,"").replace(/(.*?:.*?\s)/i,"$1  ");
var _cb=new RegExp("=\"([^\"]*)(<)(.*?)\"","gi");
var _cc=new RegExp("=\"([^\"]*)(>)(.*?)\"","gi");
while(true){
_c6=_c6.replace(_cb,"=\"$1&lt;$3\" ");
_c6=_c6.replace(_cc,"=\"$1&gt;$3\" ");
var x=(_cb.test(_c6));
if(!_cb.test(_c6)){
break;
}
}
}else{
_c6=_c5;
_c6=_c6.replace(/\n/gi,"").replace(/\>\s*\</gi,"><").replace(/(.*?:.*?\s)/i,"$1  ");
_c6=_c6.replace(/\&/g,"&amp;");
_c6=_c6.replace(/\&amp;gt;/g,"&gt;").replace(/\&amp;lt;/g,"&lt;").replace(/\&amp;apos;/g,"&apos;").replace(/\&amp;quot;/g,"&quot;").replace(/\&amp;amp;/g,"&amp;").replace(/\&amp;eq;/g,"&eq;");
}
if(_c6.indexOf("xmlns:ntb=\"http://www.nitobi.com\"")<1){
_c6=_c6.replace(/\<(.*?)(\s|\>|\\)/,"<$1 xmlns:ntb=\"http://www.nitobi.com\"$2");
}
_c6=_c6.replace(/\&nbsp\;/gi," ");
return nitobi.xml.createXmlDoc(_c6);
};
nitobi.xml.transform=function(xml,xsl,_d0){
if(xsl.documentElement){
xsl=nitobi.xml.createXslProcessor(xsl);
}
if(nitobi.browser.IE){
xsl.input=xml;
xsl.transform();
return xsl.output;
}else{
if(XSLTProcessor){
var doc=xsl.transformToDocument(xml);
var _d2=doc.documentlement;
if(_d2&&_d2.nodeName.indexOf("ntb:")==0){
_d2.setAttributeNS("http://www.w3.org/2000/xmlns/","xmlns:ntb","http://www.nitobi.com");
}
return doc;
}
}
};
nitobi.xml.transformToString=function(xml,xsl,_d5){
var _d6=nitobi.xml.transform(xml,xsl,"text");
if(nitobi.browser.MOZ){
if(_d5=="xml"){
_d6=nitobi.xml.Serializer.serializeToString(_d6);
}else{
if(_d6.documentElement.childNodes[0]==null){
nitobi.lang.throwError("The transformToString fn could not find any valid output");
}
if(_d6.documentElement.childNodes[0].data!=null){
_d6=_d6.documentElement.childNodes[0].data;
}else{
if(_d6.documentElement.childNodes[0].textContent!=null){
_d6=_d6.documentElement.childNodes[0].textContent;
}else{
nitobi.lang.throwError("The transformToString fn could not find any valid output");
}
}
}
}else{
if(nitobi.browser.SAFARI||nitobi.browser.CHROME){
if(_d5=="xml"){
_d6=nitobi.xml.Serializer.serializeToString(_d6);
}else{
var _d7=_d6.documentElement;
if(_d7.nodeName!="transformiix:result"){
_d7=_d7.getElementsByTagName("pre")[0];
}
try{
_d6=_d7.childNodes[0].data;
}
catch(e){
_d6=(_d7.data);
}
}
}
}
return _d6;
};
nitobi.xml.transformToXml=function(xml,xsl){
var _da=nitobi.xml.transform(xml,xsl,"xml");
if(typeof _da=="string"){
_da=nitobi.xml.createXmlDoc(_da);
}else{
if(_da.documentElement.nodeName=="transformiix:result"){
_da=nitobi.xml.createXmlDoc(_da.documentElement.firstChild.data);
}
}
return _da;
};
nitobi.xml.serialize=function(xml){
if(nitobi.browser.IE){
return xml.xml;
}else{
return (new XMLSerializer()).serializeToString(xml);
}
};
nitobi.xml.createXmlHttp=function(){
if(nitobi.browser.IE){
var _dc=null;
try{
_dc=new ActiveXObject("Msxml2.XMLHTTP");
}
catch(e){
try{
_dc=new ActiveXObject("Microsoft.XMLHTTP");
}
catch(ee){
}
}
return _dc;
}else{
return new XMLHttpRequest();
}
};
nitobi.xml.createElement=function(_dd,_de,ns){
ns=ns||"http://www.nitobi.com";
var _e0=null;
if(nitobi.browser.IE){
_e0=_dd.createNode(1,nitobi.xml.nsPrefix+_de,ns);
}else{
if(_dd.createElementNS){
_e0=_dd.createElementNS(ns,nitobi.xml.nsPrefix+_de);
}
}
return _e0;
};
function nitobiXmlDecodeXslt(xsl){
return xsl.replace(/x:c-/g,"xsl:choose").replace(/x\:wh\-/g,"xsl:when").replace(/x\:o\-/g,"xsl:otherwise").replace(/x\:n\-/g," name=\"").replace(/x\:s\-/g," select=\"").replace(/x\:va\-/g,"xsl:variable").replace(/x\:v\-/g,"xsl:value-of").replace(/x\:ct\-/g,"xsl:call-template").replace(/x\:w\-/g,"xsl:with-param").replace(/x\:p\-/g,"xsl:param").replace(/x\:t\-/g,"xsl:template").replace(/x\:at\-/g,"xsl:apply-templates").replace(/x\:a\-/g,"xsl:attribute");
}
if(!nitobi.browser.IE){
Document.prototype.loadXML=function(_e2){
changeReadyState(this,1);
var p=new DOMParser();
var d=p.parseFromString(_e2,"text/xml");
while(this.hasChildNodes()){
this.removeChild(this.lastChild);
}
for(var i=0;i<d.childNodes.length;i++){
this.appendChild(this.importNode(d.childNodes[i],true));
}
changeReadyState(this,4);
};
Document.prototype.__defineGetter__("xml",function(){
return (new XMLSerializer()).serializeToString(this);
});
Node.prototype.__defineGetter__("xml",function(){
return (new XMLSerializer()).serializeToString(this);
});
XPathResult.prototype.__defineGetter__("length",function(){
return this.snapshotLength;
});
if(XSLTProcessor){
XSLTProcessor.prototype.addParameter=function(_e6,_e7,_e8){
if(_e7==null){
this.removeParameter(_e8,_e6);
}else{
this.setParameter(_e8,_e6,_e7);
}
};
}
XMLDocument.prototype.selectNodes=function(_e9,_ea){
try{
if(this.nsResolver==null){
this.nsResolver=this.createNSResolver(this.documentElement);
}
var _eb=this.evaluate(_e9,(_ea?_ea:this),new MyNSResolver(),XPathResult.ORDERED_NODE_SNAPSHOT_TYPE,null);
var _ec=new Array(_eb.snapshotLength);
_ec.expr=_e9;
var j=0;
for(i=0;i<_eb.snapshotLength;i++){
var _ee=_eb.snapshotItem(i);
if(_ee.nodeType!=3){
_ec[j++]=_ee;
}
}
return _ec;
}
catch(e){
}
};
Document.prototype.selectNodes=XMLDocument.prototype.selectNodes;
function MyNSResolver(){
}
MyNSResolver.prototype.lookupNamespaceURI=function(_ef){
switch(_ef){
case "xsl":
return "http://www.w3.org/1999/XSL/Transform";
break;
case "ntb":
return "http://www.nitobi.com";
break;
case "d":
return "http://exslt.org/dates-and-times";
break;
case "n":
return "http://www.nitobi.com/exslt/numbers";
break;
default:
return null;
break;
}
};
XMLDocument.prototype.selectSingleNode=function(_f0,_f1){
var _f2=_f0.match(/\[\d+\]/ig);
if(_f2!=null){
var x=_f2[_f2.length-1];
if(_f0.lastIndexOf(x)+x.length!=_f0.length){
_f0+="[1]";
}
}
var _f4=this.selectNodes(_f0,_f1||null);
return ((_f4!=null&&_f4.length>0)?_f4[0]:null);
};
Document.prototype.selectSingleNode=XMLDocument.prototype.selectSingleNode;
Element.prototype.selectNodes=function(_f5){
var doc=this.ownerDocument;
return doc.selectNodes(_f5,this);
};
Element.prototype.selectSingleNode=function(_f7){
var doc=this.ownerDocument;
return doc.selectSingleNode(_f7,this);
};
}
nitobi.xml.getLocalName=function(_f9){
var _fa=_f9.indexOf(":");
if(_fa==-1){
return _f9;
}else{
return _f9.substr(_fa+1);
}
};
nitobi.xml.importNode=function(doc,_fc,_fd){
if(_fd==null){
_fd=true;
}
return (doc.importNode?doc.importNode(_fc,_fd):_fc);
};
nitobi.xml.encode=function(str){
str+="";
str=str.replace(/&/g,"&amp;");
str=str.replace(/'/g,"&apos;");
str=str.replace(/\"/g,"&quot;");
str=str.replace(/</g,"&lt;");
str=str.replace(/>/g,"&gt;");
str=str.replace(/\n/g,"&#xa;");
return str;
};
nitobi.xml.constructValidXpathQuery=function(_ff,_100){
var _101=_ff.match(/(\"|\')/g);
if(_101!=null){
var _102="concat(";
var _103="";
var _104;
for(var i=0;i<_ff.length;i++){
if(_ff.substr(i,1)=="\""){
_104="&apos;";
}else{
_104="&quot;";
}
_102+=_103+_104+nitobi.xml.encode(_ff.substr(i,1))+_104;
_103=",";
}
_102+=_103+"&apos;&apos;";
_102+=")";
_ff=_102;
}else{
var quot=(_100?"'":"");
_ff=quot+nitobi.xml.encode(_ff)+quot;
}
return _ff;
};
nitobi.xml.removeChildren=function(_107){
while(_107.firstChild){
_107.removeChild(_107.firstChild);
}
};
nitobi.xml.Empty=nitobi.xml.createXmlDoc("<root></root>");
nitobi.lang.defineNs("nitobi.html");
nitobi.html.Url=function(){
};
nitobi.html.Url.setParameter=function(url,key,_10a){
var reg=new RegExp("(\\?|&)("+encodeURIComponent(key)+")=(.*?)(&|$)");
if(url.match(reg)){
return url.replace(reg,"$1$2="+encodeURIComponent(_10a)+"$4");
}
if(url.match(/\?/)){
url=url+"&";
}else{
url=url+"?";
}
return url+encodeURIComponent(key)+"="+encodeURIComponent(_10a);
};
nitobi.html.Url.removeParameter=function(url,key){
var reg=new RegExp("(\\?|&)("+encodeURIComponent(key)+")=(.*?)(&|$)");
return url.replace(reg,function(str,p1,p2,p3,p4,_114,s){
if(((p1)=="?")&&(p4!="&")){
return "";
}else{
return p1;
}
});
};
nitobi.html.Url.normalize=function(url,file){
if(file){
if(file.indexOf("http://")==0||file.indexOf("https://")==0||file.indexOf("/")==0){
return file;
}
}
var href=(url.match(/.*\//)||"")+"";
if(file){
return href+file;
}
return href;
};
nitobi.html.Url.randomize=function(url){
return nitobi.html.Url.setParameter(url,"ntb-random",(new Date).getTime());
};
nitobi.lang.defineNs("nitobi.base");
nitobi.base.Event=function(type){
this.type=type;
this.handlers={};
this.guid=0;
this.setEnabled(true);
};
nitobi.base.Event.prototype.subscribe=function(_11b,_11c,guid){
if(_11b==null){
return;
}
var func=_11b;
if(typeof (_11b)=="string"){
var s=_11b;
s=s.replace(/\#\&lt\;\#/g,"<").replace(/\#\&gt\;\#/g,">").replace(/\#\&amp;lt\;\#/g,"<").replace(/\#\&amp;gt\;\#/g,">").replace(/\/\*EQ\*\//g,"=").replace(/\#\Q\#/g,"\"").replace(/\#\&amp\;\#/g,"&");
s=s.replace(/eventArgs/g,"arguments[0]");
_11b=nitobi.lang.close(_11c,function(){
eval(s);
});
}
if(typeof _11c=="object"&&_11b instanceof Function){
func=nitobi.lang.close(_11c,_11b);
}
guid=guid||func.observer_guid||_11b.observer_guid||this.guid++;
func.observer_guid=guid;
_11b.observer_guid=guid;
this.handlers[guid]=func;
return guid;
};
nitobi.base.Event.prototype.subscribeOnce=function(_120,_121){
var guid=null;
var _123=this;
var _124=function(){
_120.apply(_121||null,arguments);
_123.unSubscribe(guid);
};
guid=this.subscribe(_124);
return guid;
};
nitobi.base.Event.prototype.unSubscribe=function(guid){
if(guid instanceof Function){
guid=guid.observer_guid;
}
this.handlers[guid]=null;
delete this.handlers[guid];
};
nitobi.base.Event.prototype.notify=function(_126){
if(this.enabled){
if(arguments.length==0){
arguments=new Array();
arguments[0]=new nitobi.base.EventArgs(null,this);
arguments[0].event=this;
arguments[0].source=null;
}else{
if(typeof (arguments[0].event)!="undefined"&&arguments[0].event==null){
arguments[0].event=this;
}
}
var fail=false;
for(var item in this.handlers){
var _129=this.handlers[item];
if(_129 instanceof Function){
var rv=(_129.apply(this,arguments)==false);
fail=fail||rv;
}
}
return !fail;
}
return true;
};
nitobi.base.Event.prototype.dispose=function(){
for(var _12b in this.handlers){
this.handlers[_12b]=null;
}
this.handlers={};
};
nitobi.base.Event.prototype.setEnabled=function(_12c){
this.enabled=_12c;
};
nitobi.base.Event.prototype.isEnabled=function(){
return this.enabled;
};
nitobi.lang.defineNs("nitobi.html");
nitobi.html.Css=function(){
};
nitobi.html.Css.onPrecached=new nitobi.base.Event();
nitobi.html.Css.swapClass=function(_12d,_12e,_12f){
if(_12d.className){
var reg=new RegExp("(\\s|^)"+_12e+"(\\s|$)");
_12d.className=_12d.className.replace(reg,"$1"+_12f+"$2");
}
};
nitobi.html.Css.replaceOrAppend=function(_131,_132,_133){
if(nitobi.html.Css.hasClass(_131,_132)){
nitobi.html.Css.swapClass(_131,_132,_133);
}else{
nitobi.html.Css.addClass(_131,_133);
}
};
nitobi.html.Css.hasClass=function(_134,_135){
if(!_135||_135===""){
return false;
}
return (new RegExp("(\\s|^)"+_135+"(\\s|$)")).test(_134.className);
};
nitobi.html.Css.addClass=function(_136,_137,_138){
if(_138==true||!nitobi.html.Css.hasClass(_136,_137)){
_136.className=_136.className?_136.className+" "+_137:_137;
}
};
nitobi.html.Css.removeClass=function(_139,_13a,_13b){
if(typeof _13a=="array"){
for(var i=0;i<_13a.length;i++){
this.removeClass(_139,_13a[i],_13b);
}
}
if(_13b==true||nitobi.html.Css.hasClass(_139,_13a)){
var reg=new RegExp("(\\s|^)"+_13a+"(\\s|$)");
_139.className=_139.className.replace(reg,"$2");
}
};
nitobi.html.Css.addRule=function(_13e,_13f,_140){
if(_13e.cssRules){
var _141=_13e.insertRule(_13f+"{"+(_140||"")+"}",_13e.cssRules.length);
return _13e.cssRules[_141];
}else{
_13e.addRule(_13f,_140||"nitobi:placeholder;");
return _13e.rules[_13e.rules.length-1];
}
};
nitobi.html.Css.getRules=function(_142){
var _143=null;
if(typeof (_142)=="number"){
_143=document.styleSheets[_142];
}else{
_143=_142;
}
if(_143==null){
return null;
}
try{
if(_143.cssRules){
return _143.cssRules;
}
if(_143.rules){
return _143.rules;
}
}
catch(e){
}
return null;
};
nitobi.html.Css.getStyleSheetsByName=function(_144){
var arr=new Array();
var ss=document.styleSheets;
var _147=new RegExp(_144.replace(".",".")+"($|\\?)");
for(var i=0;i<ss.length;i++){
arr=nitobi.html.Css._getStyleSheetsByName(_147,ss[i],arr);
}
return arr;
};
nitobi.html.Css._getStyleSheetsByName=function(_149,_14a,arr){
if(_149.test(_14a.href)){
arr=arr.concat([_14a]);
}
var _14c=nitobi.html.Css.getRules(_14a);
if(_14a.href!=""&&_14a.imports){
for(var i=0;i<_14a.imports.length;i++){
arr=nitobi.html.Css._getStyleSheetsByName(_149,_14a.imports[i],arr);
}
}else{
for(var i=0;i<_14c.length;i++){
var s=_14c[i].styleSheet;
if(s){
arr=nitobi.html.Css._getStyleSheetsByName(_149,s,arr);
}
}
}
return arr;
};
nitobi.html.Css.imageCache={};
nitobi.html.Css.imageCacheDidNotify=false;
nitobi.html.Css.trackPrecache=function(_14f){
nitobi.html.Css.precacheArray[_14f]=true;
var _150=false;
for(var i in nitobi.html.Css.precacheArray){
if(!nitobi.html.Css.precacheArray[i]){
_150=true;
}
}
if((!nitobi.html.Css.imageCacheDidNotify)&&(!_150)){
nitobi.html.Css.imageCacheDidNotify=true;
nitobi.html.Css.isPrecaching=false;
nitobi.html.Css.onPrecached.notify();
}
};
nitobi.html.Css.precacheArray={};
nitobi.html.Css.isPrecaching=false;
nitobi.html.Css.precacheImages=function(_152){
nitobi.html.Css.isPrecaching=true;
if(!_152){
var ss=document.styleSheets;
for(var i=0;i<ss.length;i++){
nitobi.html.Css.precacheImages(ss[i]);
}
return;
}
var _155=/.*?url\((.*?)\).*?/;
var _156=nitobi.html.Css.getRules(_152);
var url=nitobi.html.Css.getPath(_152);
for(var i=0;i<_156.length;i++){
var rule=_156[i];
if(rule.styleSheet){
nitobi.html.Css.precacheImages(rule.styleSheet);
}else{
var s=rule.style;
var _15a=s?s.backgroundImage:null;
if(_15a){
_15a=_15a.replace(_155,"$1");
_15a=nitobi.html.Url.normalize(url,_15a);
if(!nitobi.html.Css.imageCache[_15a]){
var _15b=new Image();
_15b.src=_15a;
nitobi.html.Css.precacheArray[_15a]=false;
var _15c=nitobi.lang.close({},nitobi.html.Css.trackPrecache,[_15a]);
_15b.onload=_15c;
_15b.onerror=_15c;
_15b.onabort=_15c;
nitobi.html.Css.imageCache[_15a]=_15b;
try{
if(_15b.width>0){
nitobi.html.Css.precacheArray[_15a]=true;
}
}
catch(e){
}
}
}
}
}
if(_152.href!=""&&_152.imports){
for(var i=0;i<_152.imports.length;i++){
nitobi.html.Css.precacheImages(_152.imports[i]);
}
}
};
nitobi.html.Css.getPath=function(_15d){
var href=_15d.href;
href=nitobi.html.Url.normalize(href);
if(_15d.parentStyleSheet&&href.indexOf("/")!=0&&href.indexOf("http://")!=0&&href.indexOf("https://")!=0){
href=nitobi.html.Css.getPath(_15d.parentStyleSheet)+href;
}
return href;
};
nitobi.html.Css.getSheetUrl=nitobi.html.Css.getPath;
nitobi.html.Css.findParentStylesheet=function(_15f){
var rule=nitobi.html.Css.getRule(_15f);
if(rule){
return rule.parentStyleSheet;
}
return null;
};
nitobi.html.Css.findInSheet=function(_161,_162,_163){
if(nitobi.browser.IE6&&typeof _163=="undefined"){
_163=0;
}else{
if(_163>4){
return null;
}
}
_163++;
var _164=nitobi.html.Css.getRules(_162);
for(var rule=0;rule<_164.length;rule++){
var _166=_164[rule];
var ss=_166.styleSheet;
var _168=_166.selectorText;
if(ss){
var _169=nitobi.html.Css.findInSheet(_161,ss,_163);
if(_169){
return _169;
}
}else{
if(_168!=null&&_168.toLowerCase().indexOf(_161)>-1){
if(nitobi.browser.IE){
_166={selectorText:_168,style:_166.style,readOnly:_166.readOnly,parentStyleSheet:_162};
}
return _166;
}
}
}
var _16a=_162.imports;
if(_162.href!=""&&_16a){
var _16b=_16a.length;
for(var i=0;i<_16b;i++){
var _169=nitobi.html.Css.findInSheet(_161,_16a[i],_163);
if(_169){
return _169;
}
}
}
return null;
};
nitobi.html.Css.getClass=function(_16d,_16e){
_16d=_16d.toLowerCase();
if(_16d.indexOf(".")!==0){
_16d="."+_16d;
}
if(_16e){
var rule=nitobi.html.Css.getRule(_16d);
if(rule!=null){
return rule.style;
}
}else{
if(nitobi.html.Css.classCache[_16d]==null){
var rule=nitobi.html.Css.getRule(_16d);
if(rule!=null){
nitobi.html.Css.classCache[_16d]=rule.style;
}else{
return null;
}
}
return nitobi.html.Css.classCache[_16d];
}
};
nitobi.html.Css.classCache={};
nitobi.html.Css.getStyleBySelector=function(_170){
var rule=nitobi.html.Css.getRule(_170);
if(rule!=null){
return rule.style;
}
return null;
};
nitobi.html.Css.getRule=function(_172){
_172=_172.toLowerCase();
if(_172.indexOf(".")!==0){
_172="."+_172;
}
var _173=document.styleSheets;
for(var ss=0;ss<_173.length;ss++){
try{
var _175=nitobi.html.Css.findInSheet(_172,_173[ss]);
if(_175){
return _175;
}
}
catch(err){
}
}
return null;
};
nitobi.html.Css.getClassStyle=function(_176,_177){
var _178=nitobi.html.Css.getClass(_176);
if(_178!=null){
return _178[_177];
}else{
return null;
}
};
nitobi.html.Css.setStyle=function(el,rule,_17b){
rule=rule.replace(/\-(\w)/g,function(_17c,p1){
return p1.toUpperCase();
});
el.style[rule]=_17b;
};
nitobi.html.Css.getStyle=function(oElm,_17f){
var _180="";
if(document.defaultView&&document.defaultView.getComputedStyle){
_17f=_17f.replace(/([A-Z])/g,function($1){
return "-"+$1.toLowerCase();
});
strStyle=document.defaultView.getComputedStyle(oElm,null);
_180=strStyle.getPropertyValue(_17f);
}else{
if(oElm.currentStyle){
_17f=_17f.replace(/\-(\w)/g,function(_182,p1){
return p1.toUpperCase();
});
_180=oElm.currentStyle[_17f];
}
}
return _180;
};
nitobi.html.Css.setOpacities=function(_184,_185){
if(_184.length){
for(var i=0;i<_184.length;i++){
nitobi.html.Css.setOpacity(_184[i],_185);
}
}else{
nitobi.html.Css.setOpacity(_184,_185);
}
};
nitobi.html.Css.setOpacity=function(_187,_188){
var s=_187.style;
if(_188>100){
_188=100;
}
if(_188<0){
_188=0;
}
if(s.filter!=null){
var _18a=s.filter.match(/alpha\(opacity=[\d\.]*?\)/ig);
if(_18a!=null&&_18a.length>0){
s.filter=s.filter.replace(/alpha\(opacity=[\d\.]*?\)/ig,"alpha(opacity="+_188+")");
}else{
s.filter+="alpha(opacity="+_188+")";
}
}else{
s.opacity=(_188/100);
}
};
nitobi.html.Css.getOpacity=function(_18b){
if(_18b==null){
nitobi.lang.throwError(nitobi.error.ArgExpected+" for nitobi.html.Css.getOpacity");
}
if(nitobi.browser.IE){
if(_18b.style.filter==""){
return 100;
}
var s=_18b.style.filter;
s.match(/opacity=([\d\.]*?)\)/ig);
if(RegExp.$1==""){
return 100;
}
return parseInt(RegExp.$1);
}else{
return Math.abs(_18b.style.opacity?_18b.style.opacity*100:100);
}
};
nitobi.html.Css.getCustomStyle=function(_18d,_18e){
if(nitobi.browser.IE){
return nitobi.html.getClassStyle(_18d,_18e);
}else{
var rule=nitobi.html.Css.getRule(_18d);
var re=new RegExp("(.*?)({)(.*?)(})","gi");
var _191=rule.cssText.match(re);
re=new RegExp("("+_18e+")(:)(.*?)(;)","gi");
_191=re.exec(RegExp.$3);
}
};
nitobi.html.Css.createStyleSheet=function(_192){
var ss;
if(nitobi.browser.IE){
ss=document.createStyleSheet();
}else{
ss=document.createElement("style");
ss.setAttribute("type","text/css");
document.body.appendChild(ss);
ss.appendChild(document.createTextNode(""));
}
if(_192!=null){
nitobi.html.Css.setStyleSheetValue(ss,_192);
}
return ss;
};
nitobi.html.Css.setStyleSheetValue=function(ss,_195){
if(nitobi.browser.IE){
ss.cssText=_195;
}else{
ss.replaceChild(document.createTextNode(_195),ss.firstChild);
}
return ss;
};
if(nitobi.browser.MOZ){
HTMLStyleElement.prototype.__defineSetter__("cssText",function(_196){
this.innerHTML=_196;
});
HTMLStyleElement.prototype.__defineGetter__("cssText",function(){
return this.innerHTML;
});
}
nitobi.lang.defineNs("nitobi.drawing");
if(false){
nitobi.drawing=function(){
};
}
nitobi.drawing.Point=function(x,y){
this.x=x;
this.y=y;
};
nitobi.drawing.Point.prototype.toString=function(){
return "("+this.x+","+this.y+")";
};
nitobi.drawing.rgb=function(r,g,b){
return "#"+((r*65536)+(g*256)+b).toString(16);
};
nitobi.drawing.align=function(_19c,_19d,_19e,oh,ow,oy,ox){
oh=oh||0;
ow=ow||0;
oy=oy||0;
ox=ox||0;
var a=_19e;
var td,sd,tt,tb,tl,tr,th,tw,st,sb,sl,sr,sh,sw;
if(_19d.getBoundingClientRect){
td=_19d.getBoundingClientRect();
sd=_19c.getBoundingClientRect();
tt=td.top;
tb=td.bottom;
tl=td.left;
tr=td.right;
th=Math.abs(tb-tt);
tw=Math.abs(tr-tl);
st=sd.top;
sb=sd.bottom;
sl=sd.left;
sr=sd.right;
sh=Math.abs(sb-st);
sw=Math.abs(sr-sl);
}else{
if(document.getBoxObjectFor){
td=document.getBoxObjectFor(_19d);
sd=document.getBoxObjectFor(_19c);
tt=td.y;
tl=td.x;
tw=td.width;
th=td.height;
st=sd.y;
sl=sd.x;
sw=sd.width;
sh=sd.height;
}else{
td=nitobi.html.getCoords(_19d);
sd=nitobi.html.getCoords(_19c);
tt=td.y;
tl=td.x;
tw=td.width;
th=td.height;
st=sd.y;
sl=sd.x;
sw=sd.width;
sh=sd.height;
}
}
var s=_19c.style;
if(a&268435456){
s.height=(th+oh)+"px";
}
if(a&16777216){
s.width=(tw+ow)+"px";
}
if(a&1048576){
s.top=(nitobi.html.getStyleTop(_19c)+tt-st+oy)+"px";
}
if(a&65536){
s.top=(nitobi.html.getStyleTop(_19c)+tt-st+th-sh+oy)+"px";
}
if(a&4096){
s.left=(nitobi.html.getStyleLeft(_19c)-sl+tl+ox)+"px";
}
if(a&256){
s.left=(nitobi.html.getStyleLeft(_19c)-sl+tl+tw-sw+ox)+"px";
}
if(a&16){
s.top=(nitobi.html.getStyleTop(_19c)+tt-st+oy+Math.floor((th-sh)/2))+"px";
}
if(a&1){
s.left=(nitobi.html.getStyleLeft(_19c)-sl+tl+ox+Math.floor((tw-sw)/2))+"px";
}
};
nitobi.drawing.align.SAMEHEIGHT=268435456;
nitobi.drawing.align.SAMEWIDTH=16777216;
nitobi.drawing.align.ALIGNTOP=1048576;
nitobi.drawing.align.ALIGNBOTTOM=65536;
nitobi.drawing.align.ALIGNLEFT=4096;
nitobi.drawing.align.ALIGNRIGHT=256;
nitobi.drawing.align.ALIGNMIDDLEVERT=16;
nitobi.drawing.align.ALIGNMIDDLEHORIZ=1;
nitobi.drawing.alignOuterBox=function(_1b3,_1b4,_1b5,oh,ow,oy,ox,show){
oh=oh||0;
ow=ow||0;
oy=oy||0;
ox=ox||0;
if(nitobi.browser.moz){
td=document.getBoxObjectFor(_1b4);
sd=document.getBoxObjectFor(_1b3);
var _1bb=parseInt(document.defaultView.getComputedStyle(_1b4,"").getPropertyValue("border-left-width"));
var _1bc=parseInt(document.defaultView.getComputedStyle(_1b4,"").getPropertyValue("border-top-width"));
var _1bd=parseInt(document.defaultView.getComputedStyle(_1b3,"").getPropertyValue("border-top-width"));
var _1be=parseInt(document.defaultView.getComputedStyle(_1b3,"").getPropertyValue("border-bottom-width"));
var _1bf=parseInt(document.defaultView.getComputedStyle(_1b3,"").getPropertyValue("border-left-width"));
var _1c0=parseInt(document.defaultView.getComputedStyle(_1b3,"").getPropertyValue("border-right-width"));
oy=oy+_1bd-_1bc;
ox=ox+_1bf-_1bb;
}
nitobi.drawing.align(_1b3,_1b4,_1b5,oh,ow,oy,ox,show);
};
nitobi.lang.defineNs("nitobi.html");
if(false){
nitobi.html=function(){
};
}
nitobi.html.createElement=function(_1c1,_1c2,_1c3){
var elem=document.createElement(_1c1);
for(var attr in _1c2){
if(attr.toLowerCase().substring(0,5)=="class"){
elem.className=_1c2[attr];
}else{
elem.setAttribute(attr,_1c2[attr]);
}
}
for(var _1c6 in _1c3){
elem.style[_1c6]=_1c3[_1c6];
}
return elem;
};
nitobi.html.createTable=function(_1c7,_1c8){
var _1c9=nitobi.html.createElement("table",_1c7,_1c8);
var _1ca=document.createElement("tbody");
var _1cb=document.createElement("tr");
var _1cc=document.createElement("td");
_1c9.appendChild(_1ca);
_1ca.appendChild(_1cb);
_1cb.appendChild(_1cc);
return _1c9;
};
nitobi.html.setBgImage=function(elem,src){
var s=nitobi.html.Css.getStyle(elem,"background-image");
if(s!=""&&nitobi.browser.IE){
s=s.replace(/(^url\(")(.*?)("\))/,"$2");
}
};
nitobi.html.fitWidth=function(_1d0,_1d1){
var w;
var C=nitobi.html.Css;
if(nitobi.browser.IE&&!nitobi.lang.isStandards()){
var _1d4=(parseInt(C.getStyle(_1d0,"width"))-parseInt(C.getStyle(_1d0,"paddingLeft"))-parseInt(C.getStyle(_1d0,"paddingRight"))-parseInt(C.getStyle(_1d0,"borderLeftWidth"))-parseInt(C.getStyle(_1d0,"borderRightWidth")));
if(_1d4<0){
_1d4=0;
}
w=_1d4+"px";
}else{
if(nitobi.lang.isStandards()){
if(nitobi.browser.IE){
var _1d4=(parseInt(C.getStyle(_1d0,"width"))-(_1d1.offsetWidth-parseInt(C.getStyle(_1d1,"width"))));
}else{
var _1d4=(parseInt(_1d0.style.width)-(_1d1.offsetWidth-parseInt(_1d0.style.width)));
}
if(_1d4<0){
_1d4=0;
}
w=_1d4+"px";
}else{
w=parseInt(_1d0.style.width)+"px";
}
}
_1d1.style.width=w;
};
nitobi.html.getDomNodeByPath=function(Node,Path){
if(nitobi.browser.IE){
}
var _1d7=Node;
var _1d8=Path.split("/");
var len=_1d8.length;
for(var i=0;i<len;i++){
if(_1d7.childNodes[Number(_1d8[i])]!=null){
_1d7=_1d7.childNodes[Number(_1d8[i])];
}else{
alert("Path expression failed."+Path);
}
var s="";
}
return _1d7;
};
nitobi.html.indexOfChildNode=function(_1dc,_1dd){
var _1de=_1dc.childNodes;
for(var i=0;i<_1de.length;i++){
if(_1de[i]==_1dd){
return i;
}
}
return -1;
};
nitobi.html.evalScriptBlocks=function(node){
for(var i=0;i<node.childNodes.length;i++){
var _1e2=node.childNodes[i];
if(_1e2.nodeName.toLowerCase()=="script"){
eval(_1e2.text);
}else{
nitobi.html.evalScriptBlocks(_1e2);
}
}
};
nitobi.html.position=function(node){
var pos=nitobi.html.getStyle($ntb(node),"position");
if(pos=="static"){
node.style.position="relative";
}
};
nitobi.html.setOpacity=function(_1e5,_1e6){
var _1e7=_1e5.style;
_1e7.opacity=(_1e6/100);
_1e7.MozOpacity=(_1e6/100);
_1e7.KhtmlOpacity=(_1e6/100);
_1e7.filter="alpha(opacity="+_1e6+")";
};
nitobi.html.highlight=function(o,x,end){
end=end||o.value.length;
if(o.createTextRange){
o.focus();
var r=o.createTextRange();
r.move("character",0-end);
r.move("character",x);
r.moveEnd("textedit",1);
r.select();
}else{
if(o.setSelectionRange){
o.focus();
o.setSelectionRange(x,end);
}
}
};
nitobi.html.setCursor=function(o,x){
if(o.createTextRange){
o.focus();
var r=o.createTextRange();
r.move("character",0-o.value.length);
r.move("character",x);
r.select();
}else{
if(o.setSelectionRange){
o.setSelectionRange(x,x);
}
}
};
nitobi.html.getCursor=function(o){
if(o.createTextRange){
o.focus();
var r=document.selection.createRange().duplicate();
r.moveEnd("textedit",1);
return o.value.length-r.text.length;
}else{
if(o.setSelectionRange){
return o.selectionStart;
}
}
return -1;
};
nitobi.html.encode=function(str){
str+="";
str=str.replace(/&/g,"&amp;");
str=str.replace(/\"/g,"&quot;");
str=str.replace(/'/g,"&apos;");
str=str.replace(/</g,"&lt;");
str=str.replace(/>/g,"&gt;");
str=str.replace(/\n/g,"<br>");
return str;
};
nitobi.html.getElement=function(_1f2){
if(typeof (_1f2)=="string"){
return document.getElementById(_1f2);
}
return _1f2;
};
if(typeof ($)=="undefined"){
$=nitobi.html.getElement;
}
if(typeof ($ntb)=="undefined"){
$ntb=nitobi.html.getElement;
}
if(typeof ($F)=="undefined"){
$F=function(id){
var _1f4=$ntb(id);
if(_1f4!=null){
return _1f4.value;
}
return "";
};
}
nitobi.html.getTagName=function(elem){
if(nitobi.browser.IE&&elem.scopeName!=""){
return (elem.scopeName+":"+elem.nodeName).toLowerCase();
}else{
return elem.nodeName.toLowerCase();
}
};
nitobi.html.getStyleTop=function(elem){
var top=elem.style.top;
if(top==""){
top=nitobi.html.Css.getStyle(elem,"top");
}
return nitobi.lang.parseNumber(top);
};
nitobi.html.getStyleLeft=function(elem){
var left=elem.style.left;
if(left==""){
left=nitobi.html.Css.getStyle(elem,"left");
}
return nitobi.lang.parseNumber(left);
};
nitobi.html.getHeight=function(elem){
return elem.offsetHeight;
};
nitobi.html.getWidth=function(elem){
return elem.offsetWidth;
};
if(nitobi.browser.IE){
nitobi.html.getBox=function(elem){
var _1fd=nitobi.lang.parseNumber(nitobi.html.getStyle(document.body,"border-top-width"));
var _1fe=nitobi.lang.parseNumber(nitobi.html.getStyle(document.body,"border-left-width"));
var _1ff=nitobi.lang.parseNumber(document.body.scrollTop)-(_1fd==0?2:_1fd);
var _200=nitobi.lang.parseNumber(document.body.scrollLeft)-(_1fe==0?2:_1fe);
var rect=nitobi.html.getBoundingClientRect(elem);
return {top:rect.top+_1ff,left:rect.left+_200,bottom:rect.bottom,right:rect.right,height:rect.bottom-rect.top,width:rect.right-rect.left};
};
}else{
if(nitobi.browser.MOZ){
nitobi.html.getBox=function(elem){
var _203=0;
var _204=0;
var _205=elem.parentNode;
while(_205.nodeType==1&&_205!=document.body){
_203+=nitobi.lang.parseNumber(_205.scrollTop)-(nitobi.html.getStyle(_205,"overflow")=="auto"?nitobi.lang.parseNumber(nitobi.html.getStyle(_205,"border-top-width")):0);
_204+=nitobi.lang.parseNumber(_205.scrollLeft)-(nitobi.html.getStyle(_205,"overflow")=="auto"?nitobi.lang.parseNumber(nitobi.html.getStyle(_205,"border-left-width")):0);
_205=_205.parentNode;
}
var _206=elem.ownerDocument.getBoxObjectFor(elem);
var _207=nitobi.lang.parseNumber(nitobi.html.getStyle(elem,"border-left-width"));
var _208=nitobi.lang.parseNumber(nitobi.html.getStyle(elem,"border-right-width"));
var _209=nitobi.lang.parseNumber(nitobi.html.getStyle(elem,"border-top-width"));
var top=nitobi.lang.parseNumber(_206.y)-_203-_209;
var left=nitobi.lang.parseNumber(_206.x)-_204-_207;
var _20c=left+nitobi.lang.parseNumber(_206.width);
var _20d=top+_206.height;
var _20e=nitobi.lang.parseNumber(_206.height);
var _20f=nitobi.lang.parseNumber(_206.width);
return {top:top,left:left,bottom:_20d,right:_20c,height:_20e,width:_20f};
};
nitobi.html.getBox.cache={};
}else{
if(nitobi.browser.SAFARI||nitobi.browser.CHROME){
nitobi.html.getBox=function(elem){
var _211=nitobi.html.getCoords(elem);
return {top:_211.y,left:_211.x,bottom:_211.y+_211.height,right:_211.x+_211.width,height:_211.height,width:_211.width};
};
}
}
}
nitobi.html.getBox2=nitobi.html.getBox;
nitobi.html.getUniqueId=function(elem){
if(elem.uniqueID){
return elem.uniqueID;
}else{
var t=(new Date()).getTime();
elem.uniqueID=t;
return t;
}
};
nitobi.html.getChildNodeById=function(elem,_215,_216){
return nitobi.html.getChildNodeByAttribute(elem,"id",_215,_216);
};
nitobi.html.getChildNodeByAttribute=function(elem,_218,_219,_21a){
for(var i=0;i<elem.childNodes.length;i++){
if(elem.nodeType!=3&&Boolean(elem.childNodes[i].getAttribute)){
if(elem.childNodes[i].getAttribute(_218)==_219){
return elem.childNodes[i];
}
}
}
if(_21a){
for(var i=0;i<elem.childNodes.length;i++){
var _21c=nitobi.html.getChildNodeByAttribute(elem.childNodes[i],_218,_219,_21a);
if(_21c!=null){
return _21c;
}
}
}
return null;
};
nitobi.html.getParentNodeById=function(elem,_21e){
return nitobi.html.getParentNodeByAtt(elem,"id",_21e);
};
nitobi.html.getParentNodeByAtt=function(elem,att,_221){
while(elem.parentNode!=null){
if(elem.parentNode.getAttribute(att)==_221){
return elem.parentNode;
}
elem=elem.parentNode;
}
return null;
};
if(nitobi.browser.IE){
nitobi.html.getFirstChild=function(node){
return node.firstChild;
};
}else{
nitobi.html.getFirstChild=function(node){
var i=0;
while(i<node.childNodes.length&&node.childNodes[i].nodeType==3){
i++;
}
return node.childNodes[i];
};
}
nitobi.html.getScroll=function(){
var _225,_226=0;
if((nitobi.browser.OPERA==false)&&(document.documentElement.scrollTop>0)){
_225=document.documentElement.scrollTop;
_226=document.documentElement.scrollLeft;
}else{
_225=document.body.scrollTop;
_226=document.body.scrollLeft;
}
if(((_225==0)&&(document.documentElement.scrollTop>0))||((_226==0)&&(document.documentElement.scrollLeft>0))){
_225=document.documentElement.scrollTop;
_226=document.documentElement.scrollLeft;
}
return {"left":_226,"top":_225};
};
nitobi.html.getCoords=function(_227){
var ew,eh;
try{
var _22a=_227;
ew=_227.offsetWidth;
eh=_227.offsetHeight;
for(var lx=0,ly=0;_227!=null;lx+=_227.offsetLeft,ly+=_227.offsetTop,_227=_227.offsetParent){
}
for(;_22a!=document.body;lx-=_22a.scrollLeft,ly-=_22a.scrollTop,_22a=_22a.parentNode){
}
}
catch(e){
}
return {"x":lx,"y":ly,"height":eh,"width":ew};
};
nitobi.html.scrollBarWidth=0;
nitobi.html.getScrollBarWidth=function(_22d){
if(nitobi.html.scrollBarWidth){
return nitobi.html.scrollBarWidth;
}
try{
if(null==_22d){
var _22e="ntb-scrollbar-width";
var d=document.getElementById(_22e);
if(null==d){
d=nitobi.html.createElement("div",{"id":_22e},{width:"100px",height:"100px",overflow:"auto",position:"absolute",top:"-200px",left:"-5000px"});
d.innerHTML="<div style='height:200px;'></div>";
document.body.appendChild(d);
}
_22d=d;
}
if(nitobi.browser.IE){
nitobi.html.scrollBarWidth=Math.abs(_22d.offsetWidth-_22d.clientWidth-(_22d.clientLeft?_22d.clientLeft*2:0));
}else{
if(nitobi.browser.MOZ){
var b=document.getBoxObjectFor(_22d);
nitobi.html.scrollBarWidth=Math.abs((b.width-_22d.clientWidth));
}else{
if(nitobi.browser.SAFARI||nitobi.browser.CHROME){
var b=nitobi.html.getBox(_22d);
nitobi.html.scrollBarWidth=Math.abs((b.width-_22d.clientWidth));
}
}
}
}
catch(err){
}
return nitobi.html.scrollBarWidth;
};
nitobi.html.align=nitobi.drawing.align;
nitobi.html.emptyElements={HR:true,BR:true,IMG:true,INPUT:true};
nitobi.html.specialElements={TEXTAREA:true};
nitobi.html.permHeight=0;
nitobi.html.permWidth=0;
nitobi.html.getBodyArea=function(){
var _231,_232,_233,_234;
var x,y;
var _237=false;
if(nitobi.lang.isStandards()){
_237=true;
}
var de=document.documentElement;
var db=document.body;
if(self.innerHeight){
x=self.innerWidth;
y=self.innerHeight;
}else{
if(de&&de.clientHeight){
x=de.clientWidth;
y=de.clientHeight;
}else{
if(db){
x=db.clientWidth;
y=db.clientHeight;
}
}
}
_233=x;
_234=y;
if(self.pageYOffset){
x=self.pageXOffset;
y=self.pageYOffset;
}else{
if(de&&de.scrollTop){
x=de.scrollLeft;
y=de.scrollTop;
}else{
if(db){
x=db.scrollLeft;
y=db.scrollTop;
}
}
}
_231=x;
_232=y;
var _23a=db.scrollHeight;
var _23b=db.offsetHeight;
if(_23a>_23b){
x=db.scrollWidth;
y=db.scrollHeight;
}else{
x=db.offsetWidth;
y=db.offsetHeight;
}
nitobi.html.permHeight=y;
nitobi.html.permWidth=x;
if(nitobi.html.permHeight<_234){
nitobi.html.permHeight=_234;
if(nitobi.browser.IE&&_237){
_233+=20;
}
}
if(_233<nitobi.html.permWidth){
_233=nitobi.html.permWidth;
}
if(nitobi.html.permHeight>_234){
_233+=20;
}
var _23c,_23d;
_23c=de.scrollHeight;
_23d=de.scrollWidth;
return {scrollWidth:_23d,scrollHeight:_23c,scrollLeft:_231,scrollTop:_232,clientWidth:_233,clientHeight:_234,bodyWidth:nitobi.html.permWidth,bodyHeight:nitobi.html.PermHeight};
};
nitobi.html.getOuterHtml=function(node){
if(nitobi.browser.IE){
return node.outerHTML;
}else{
var html="";
switch(node.nodeType){
case Node.ELEMENT_NODE:
html+="<";
html+=node.nodeName.toLowerCase();
if(!nitobi.html.specialElements[node.nodeName]){
for(var a=0;a<node.attributes.length;a++){
if(node.attributes[a].nodeName.toLowerCase()!="_moz-userdefined"){
html+=" "+node.attributes[a].nodeName.toLowerCase()+"=\""+node.attributes[a].nodeValue+"\"";
}
}
html+=">";
if(!nitobi.html.emptyElements[node.nodeName]){
html+=node.innerHTML;
html+="</"+node.nodeName.toLowerCase()+">";
}
}else{
switch(node.nodeName){
case "TEXTAREA":
for(var a=0;a<node.attributes.length;a++){
if(node.attributes[a].nodeName.toLowerCase()!="value"){
html+=" "+node.attributes[a].nodeName.toUpperCase()+"=\""+node.attributes[a].nodeValue+"\"";
}else{
var _241=node.attributes[a].nodeValue;
}
}
html+=">";
html+=_241;
html+="</"+node.nodeName+">";
break;
}
}
break;
case Node.TEXT_NODE:
html+=node.nodeValue;
break;
case Node.COMMENT_NODE:
html+="<!"+"--"+node.nodeValue+"--"+">";
break;
}
return html;
}
};
nitobi.html.insertAdjacentText=function(_242,pos,s){
if(nitobi.browser.IE){
return _242.insertAdjacentText(pos,s);
}
var node=document.createTextNode(s);
nitobi.html.insertAdjacentElement(_242,pos,node);
};
nitobi.html.insertAdjacentHTML=function(_246,_247,_248,_249){
if(nitobi.browser.IE){
return _246.insertAdjacentHTML(_247,_248,_249);
}
var df;
var r=_246.ownerDocument.createRange();
switch(String(_247).toLowerCase()){
case "beforebegin":
r.setStartBefore(_246);
df=r.createContextualFragment(_248);
_246.parentNode.insertBefore(df,_246);
break;
case "afterbegin":
r.selectNodeContents(_246);
r.collapse(true);
df=r.createContextualFragment(_248);
_246.insertBefore(df,_246.firstChild);
break;
case "beforeend":
if(_249==true){
_246.innerHTML=_246.innerHTML+_248;
}else{
r.selectNodeContents(_246);
r.collapse(false);
df=r.createContextualFragment(_248);
_246.appendChild(df);
}
break;
case "afterend":
r.setStartAfter(_246);
df=r.createContextualFragment(_248);
_246.parentNode.insertBefore(df,_246.nextSibling);
break;
}
};
nitobi.html.insertAdjacentElement=function(_24c,pos,node){
if(nitobi.browser.IE){
return _24c.insertAdjacentElement(pos,node);
}
switch(pos){
case "beforeBegin":
_24c.parentNode.insertBefore(node,_24c);
break;
case "afterBegin":
_24c.insertBefore(node,_24c.firstChild);
break;
case "beforeEnd":
_24c.appendChild(node);
break;
case "afterEnd":
if(_24c.nextSibling){
_24c.parentNode.insertBefore(node,_24c.nextSibling);
}else{
_24c.parentNode.appendChild(node);
}
break;
}
};
nitobi.html.getClientRects=function(node,_250,_251){
if(nitobi.browser.IE){
return node.getClientRects();
}
_250=_250||0;
_251=_251||0;
var td;
if(nitobi.browser.SAFARI||nitobi.browser.CHROME){
td=nitobi.html.getCoords(node);
_250=0;
_251=0;
}else{
var td=document.getBoxObjectFor(node);
}
return new Array({top:(td.y-_250),left:(td.x-_251),bottom:(td.y+td.height-_250),right:(td.x+td.width-_251)});
};
nitobi.html.getBoundingClientRect=function(node,_254,_255){
if(nitobi.browser.IE){
return node.getBoundingClientRect();
}
_254=_254||0;
_255=_255||0;
var td;
if(nitobi.browser.SAFARI||nitobi.browser.CHROME){
td=nitobi.html.getCoords(node);
_254=0;
_255=0;
}else{
td=document.getBoxObjectFor(node);
}
var top=td.y-_254;
var left=td.x-_255;
return {top:top,left:left,bottom:(top+td.height),right:(left+td.width)};
};
nitobi.html.Event=function(){
this.srcElement=null;
this.fromElement=null;
this.toElement=null;
this.eventSrc=null;
};
nitobi.html.handlerId=0;
nitobi.html.elementId=0;
nitobi.html.elements=[];
nitobi.html.unload=[];
nitobi.html.unloadCalled=false;
nitobi.html.attachEvents=function(_259,_25a,_25b){
var _25c=[];
for(var i=0;i<_25a.length;i++){
var e=_25a[i];
_25c.push(nitobi.html.attachEvent(_259,e.type,e.handler,_25b,e.capture||false));
}
return _25c;
};
nitobi.html.attachEvent=function(_25f,type,_261,_262,_263,_264){
if(type=="anyclick"){
if(nitobi.browser.IE){
nitobi.html.attachEvent(_25f,"dblclick",_261,_262,_263,_264);
}
type="click";
}
if(!(_261 instanceof Function)){
nitobi.lang.throwError("Event handler needs to be a Function");
}
_25f=$ntb(_25f);
if(type.toLowerCase()=="unload"&&_264!=true){
var _265=_261;
if(_262!=null){
_265=function(){
_261.call(_262);
};
}
return this.addUnload(_265);
}
var _266=this.handlerId++;
var _267=this.elementId++;
if(typeof (_261.ebaguid)!="undefined"){
_266=_261.ebaguid;
}else{
_261.ebaguid=_266;
}
if(typeof (_25f.ebaguid)=="undefined"){
_25f.ebaguid=_267;
nitobi.html.elements[_267]=_25f;
}
if(typeof (_25f.eba_events)=="undefined"){
_25f.eba_events={};
}
if(_25f.eba_events[type]==null){
_25f.eba_events[type]={};
if(_25f.attachEvent){
_25f["eba_event_"+type]=function(){
nitobi.html.notify.call(_25f,window.event);
};
_25f.attachEvent("on"+type,_25f["eba_event_"+type]);
if(_263&&_25f.setCapture!=null){
_25f.setCapture(true);
}
}else{
if(_25f.addEventListener){
_25f["eba_event_"+type]=function(){
nitobi.html.notify.call(_25f,arguments[0]);
};
_25f.addEventListener(type,_25f["eba_event_"+type],_263);
}
}
}
_25f.eba_events[type][_266]={handler:_261,context:_262};
return _266;
};
nitobi.html.notify=function(e){
if(!nitobi.browser.IE){
e.srcElement=e.target;
e.fromElement=e.relatedTarget;
e.toElement=e.relatedTarget;
}
var _269=this;
e.eventSrc=_269;
nitobi.html.Event=e;
for(var _26a in _269.eba_events[e.type]){
var _26b=_269.eba_events[e.type][_26a];
if(typeof (_26b.context)=="object"){
_26b.handler.call(_26b.context,e,_269);
}else{
_26b.handler.call(_269,e,_269);
}
}
};
nitobi.html.detachEvents=function(_26c,_26d){
for(var i=0;i<_26d.length;i++){
var e=_26d[i];
nitobi.html.detachEvent(_26c,e.type,e.handler);
}
};
nitobi.html.detachEvent=function(_270,type,_272){
_270=$ntb(_270);
var _273=_272;
if(_272 instanceof Function){
_273=_272.ebaguid;
}
if(type=="unload"){
this.unload.splice(ebaguid,1);
}
if(_270!=null&&_270.eba_events!=null&&_270.eba_events[type]!=null&&_270.eba_events[type][_273]!=null){
var _274=_270.eba_events[type];
_274[_273]=null;
delete _274[_273];
if(nitobi.collections.isHashEmpty(_274)){
this.m_detach(_270,type,_270["eba_event_"+type]);
_270["eba_event_"+type]=null;
_270.eba_events[type]=null;
_274=null;
if(_270.nodeType==1){
_270.removeAttribute("eba_event_"+type);
}
}
}
return true;
};
nitobi.html.m_detach=function(_275,type,_277){
if(_277!=null&&_277 instanceof Function){
if(_275.detachEvent){
_275.detachEvent("on"+type,_277);
}else{
if(_275.removeEventListener){
_275.removeEventListener(type,_277,false);
}
}
_275["on"+type]=null;
if(type=="unload"){
for(var i=0;i<this.unload.length;i++){
this.unload[i].call(this);
this.unload[i]=null;
}
}
}
};
nitobi.html.detachAllEvents=function(evt){
for(var i=0;i<nitobi.html.elements.length;i++){
if(typeof (nitobi.html.elements[i])!="undefined"){
for(var _27b in nitobi.html.elements[i].eba_events){
nitobi.html.m_detach(nitobi.html.elements[i],_27b,nitobi.html.elements[i]["eba_event_"+_27b]);
if(typeof (nitobi.html.elements[i])!="undefined"&&nitobi.html.elements[i].eba_events[_27b]!=null){
for(var _27c in nitobi.html.elements[i].eba_events[_27b]){
nitobi.html.elements[i].eba_events[_27b][_27c]=null;
}
}
nitobi.html.elements[i]["eba_event_"+_27b]=null;
}
}
}
nitobi.html.elements=null;
};
nitobi.html.addUnload=function(_27d){
this.unload.push(_27d);
return this.unload.length-1;
};
nitobi.html.cancelEvent=function(evt){
nitobi.html.stopPropagation(evt);
nitobi.html.preventDefault(evt);
};
nitobi.html.stopPropagation=function(evt){
if(evt==null){
return;
}
if(nitobi.browser.IE){
evt.cancelBubble=true;
}else{
evt.stopPropagation();
}
};
nitobi.html.preventDefault=function(evt,v){
if(evt==null){
return;
}
if(nitobi.browser.IE){
evt.returnValue=false;
}else{
evt.preventDefault();
}
if(v!=null){
e.keyCode=v;
}
};
nitobi.html.getEventCoords=function(evt){
var _283={"x":evt.clientX,"y":evt.clientY};
if(nitobi.browser.IE){
_283.x+=document.documentElement.scrollLeft+document.body.scrollLeft;
_283.y+=document.documentElement.scrollTop+document.body.scrollTop;
}else{
_283.x+=window.scrollX;
_283.y+=window.scrollY;
}
return _283;
};
nitobi.html.getEvent=function(_284){
if(nitobi.browser.IE){
return window.event;
}else{
_284.srcElement=_284.target;
_284.fromElement=_284.relatedTarget;
_284.toElement=_284.relatedTarget;
return _284;
}
};
nitobi.html.createEvent=function(_285,_286,_287,_288){
if(nitobi.browser.IE){
_287.target.fireEvent("on"+_286);
}else{
var _289=document.createEvent(_285);
_289.initKeyEvent(_286,true,true,document.defaultView,_287.ctrlKey,_287.altKey,_287.shiftKey,_287.metaKey,_288.keyCode,_288.charCode);
_287.target.dispatchEvent(_289);
}
};
nitobi.html.unloadEventId=nitobi.html.attachEvent(window,"unload",nitobi.html.detachAllEvents,nitobi.html,false,true);
nitobi.lang.defineNs("nitobi.event");
nitobi.event=function(){
};
nitobi.event.keys={};
nitobi.event.guid=0;
nitobi.event.subscribe=function(key,_28b){
ntbAssert(key.indexOf("undefined")==-1,"Something used nitobi.event with an invalid key. The key was "+key);
nitobi.event.publish(key);
var guid=this.guid++;
this.keys[key].add(_28b,guid);
return guid;
};
nitobi.event.unsubscribe=function(key,guid){
ntbAssert(key.indexOf("undefined")==-1,"Something used nitobi.event with an invalid key. The key was "+key);
if(this.keys[key]==null){
return true;
}
if(this.keys[key].remove(guid)){
this.keys[key]=null;
delete this.keys[key];
}
};
nitobi.event.evaluate=function(func,_290){
var _291=true;
if(typeof func=="string"){
func=func.replace(/eventArgs/gi,"arguments[1]");
var _292=eval(func);
_291=(typeof (_292)=="undefined"?true:_292);
}
return _291;
};
nitobi.event.publish=function(key){
ntbAssert(key.indexOf("undefined")==-1,"Something used nitobi.event with an invalid key. The key was "+key);
if(this.keys[key]==null){
this.keys[key]=new nitobi.event.Key();
}
};
nitobi.event.notify=function(key,_295){
ntbAssert(key.indexOf("undefined")==-1,"Something used nitobi.event with an invalid key. The key was "+key);
if(this.keys[key]!=null){
return this.keys[key].notify(_295);
}else{
return true;
}
};
nitobi.event.dispose=function(){
for(var key in this.keys){
if(typeof (this.keys[key])=="function"){
this.keys[key].dispose();
}
}
this.keys=null;
};
nitobi.event.Key=function(){
this.handlers={};
};
nitobi.event.Key.prototype.add=function(_297,guid){
ntbAssert(_297 instanceof Function,"EventKey.add requires a JavaScript function pointer as a parameter.","",EBA_THROW);
this.handlers[guid]=_297;
};
nitobi.event.Key.prototype.remove=function(guid){
this.handlers[guid]=null;
delete this.handlers[guid];
var i=true;
for(var item in this.handlers){
i=false;
break;
}
return i;
};
nitobi.event.Key.prototype.notify=function(_29c){
var fail=false;
for(var item in this.handlers){
var _29f=this.handlers[item];
if(_29f instanceof Function){
var rv=(_29f.apply(this,arguments)==false);
fail=fail||rv;
}else{
}
}
return !fail;
};
nitobi.event.Key.prototype.dispose=function(){
for(var _2a1 in this.handlers){
this.handlers[_2a1]=null;
}
};
nitobi.event.Args=function(src){
this.source=src;
};
nitobi.event.Args.prototype.callback=function(){
};
nitobi.html.cancelBubble=nitobi.html.cancelEvent;
nitobi.html.getCssRules=nitobi.html.Css.getRules;
nitobi.html.findParentStylesheet=nitobi.html.Css.findParentStylesheet;
nitobi.html.getClass=nitobi.html.Css.getClass;
nitobi.html.getStyle=nitobi.html.Css.getStyle;
nitobi.html.addClass=nitobi.html.Css.addClass;
nitobi.html.removeClass=nitobi.html.Css.removeClass;
nitobi.html.getClassStyle=nitobi.html.Css.getClassStyle;
nitobi.html.normalizeUrl=nitobi.html.Url.normalize;
nitobi.html.setUrlParameter=nitobi.html.Url.setParameter;
nitobi.lang.defineNs("nitobi.base.XmlNamespace");
nitobi.base.XmlNamespace.prefix="ntb";
nitobi.base.XmlNamespace.uri="http://www.nitobi.com";
nitobi.lang.defineNs("nitobi.collections");
if(false){
nitobi.collections=function(){
};
}
nitobi.collections.IEnumerable=function(){
this.list=new Array();
this.length=0;
};
nitobi.collections.IEnumerable.prototype.add=function(obj){
this.list[this.getLength()]=obj;
this.length++;
};
nitobi.collections.IEnumerable.prototype.insert=function(_2a4,obj){
this.list.splice(_2a4,0,obj);
this.length++;
};
nitobi.collections.IEnumerable.createNewArray=function(obj,_2a7){
var _2a8;
_2a7=_2a7||0;
if(obj.count){
_2a8=obj.count;
}
if(obj.length){
_2a8=obj.length;
}
var x=new Array(_2a8-_2a7);
for(var i=_2a7;i<_2a8;i++){
x[i-_2a7]=obj[i];
}
return x;
};
nitobi.collections.IEnumerable.prototype.get=function(_2ab){
if(_2ab<0||_2ab>=this.getLength()){
nitobi.lang.throwError(nitobi.error.OutOfBounds);
}
return this.list[_2ab];
};
nitobi.collections.IEnumerable.prototype.set=function(_2ac,_2ad){
if(_2ac<0||_2ac>=this.getLength()){
nitobi.lang.throwError(nitobi.error.OutOfBounds);
}
this.list[_2ac]=_2ad;
};
nitobi.collections.IEnumerable.prototype.indexOf=function(obj){
for(var i=0;i<this.getLength();i++){
if(this.list[i]===obj){
return i;
}
}
return -1;
};
nitobi.collections.IEnumerable.prototype.remove=function(_2b0){
var i;
if(typeof (_2b0)!="number"){
i=this.indexOf(_2b0);
}else{
i=_2b0;
}
if(-1==i||i<0||i>=this.getLength()){
nitobi.lang.throwError(nitobi.error.OutOfBounds);
}
this.list[i]=null;
this.list.splice(i,1);
this.length--;
};
nitobi.collections.IEnumerable.prototype.getLength=function(){
return this.length;
};
nitobi.collections.IEnumerable.prototype.each=function(func){
var l=this.length;
var list=this.list;
for(var i=0;i<l;i++){
func(list[i]);
}
};
nitobi.lang.defineNs("nitobi.base");
nitobi.base.ISerializable=function(_2b6,id,xml,_2b9){
nitobi.Object.call(this);
if(typeof (this.ISerializableInitialized)=="undefined"){
this.ISerializableInitialized=true;
}else{
return;
}
this.xmlNode=null;
this.setXmlNode(_2b6);
if(_2b6!=null){
this.profile=nitobi.base.Registry.getInstance().getCompleteProfile({idField:null,tagName:_2b6.nodeName});
}else{
this.profile=nitobi.base.Registry.getInstance().getProfileByInstance(this);
}
this.onDeserialize=new nitobi.base.Event();
this.onSetParentObject=new nitobi.base.Event();
this.factory=nitobi.base.Factory.getInstance();
this.objectHash={};
this.onCreateObject=new nitobi.base.Event();
if(_2b6!=null){
this.deserializeFromXmlNode(this.getXmlNode());
}else{
if(this.factory!=null&&this.profile.tagName!=null){
this.createByProfile(this.profile,this.getXmlNode());
}else{
if(xml!=null&&_2b6!=null){
this.createByXml(xml);
}
}
}
this.disposal.push(this.xmlNode);
};
nitobi.lang.extend(nitobi.base.ISerializable,nitobi.Object);
nitobi.base.ISerializable.guidMap={};
nitobi.base.ISerializable.prototype.ISerializableImplemented=true;
nitobi.base.ISerializable.prototype.getProfile=function(){
return this.profile;
};
nitobi.base.ISerializable.prototype.createByProfile=function(_2ba,_2bb){
if(_2bb==null){
var xml="<"+_2ba.tagName+" xmlns:"+nitobi.base.XmlNamespace.prefix+"=\""+nitobi.base.XmlNamespace.uri+"\" />";
var _2bd=nitobi.xml.createXmlDoc(xml);
this.setXmlNode(_2bd.firstChild);
this.deserializeFromXmlNode(this.xmlNode);
}else{
this.deserializeFromXmlNode(_2bb);
this.setXmlNode(_2bb);
}
};
nitobi.base.ISerializable.prototype.createByXml=function(xml){
this.deserializeFromXml(xml);
};
nitobi.base.ISerializable.prototype.getParentObject=function(){
return this.parentObj;
};
nitobi.base.ISerializable.prototype.setParentObject=function(_2bf){
this.parentObj=_2bf;
this.onSetParentObject.notify();
};
nitobi.base.ISerializable.prototype.addChildObject=function(_2c0){
this.addToCache(_2c0);
_2c0.setParentObject(this);
var _2c1=_2c0.getXmlNode();
if(!this.areGuidsGenerated(_2c1)){
_2c1=this.generateGuids(_2c1);
_2c0.setXmlNode(_2c1);
}
_2c0.setXmlNode(this.xmlNode.appendChild(nitobi.xml.importNode(this.xmlNode.ownerDocument,_2c1,true)));
};
nitobi.base.ISerializable.prototype.insertBeforeChildObject=function(obj,_2c3){
_2c3=_2c3?_2c3.getXmlNode():null;
this.addToCache(obj);
obj.setParentObject(this);
var _2c4=obj.getXmlNode();
if(!this.areGuidsGenerated(_2c4)){
_2c4=this.generateGuids(_2c4);
obj.setXmlNode(_2c4);
}
_2c4=nitobi.xml.importNode(this.xmlNode.ownerDocument,_2c4,true);
this.xmlNode.insertBefore(_2c4,_2c3);
};
nitobi.base.ISerializable.prototype.createElement=function(name){
var _2c6;
if(this.xmlNode==null||this.xmlNode.ownerDocument==null){
_2c6=nitobi.xml.createXmlDoc();
}else{
_2c6=this.xmlNode.ownerDocument;
}
if(nitobi.browser.IE){
return _2c6.createNode(1,name,nitobi.base.XmlNamespace.uri);
}else{
if(_2c6.createElementNS){
return _2c6.createElementNS(nitobi.base.XmlNamespace.uri,name);
}else{
nitobi.lang.throwError("Unable to create a new xml node on this browser.");
}
}
};
nitobi.base.ISerializable.prototype.deleteChildObject=function(id){
this.removeFromCache(id);
var e=this.getElement(id);
if(e!=null){
e.parentNode.removeChild(e);
}
};
nitobi.base.ISerializable.prototype.addToCache=function(obj){
this.objectHash[obj.getId()]=obj;
};
nitobi.base.ISerializable.prototype.removeFromCache=function(id){
this.objectHash[id]=null;
};
nitobi.base.ISerializable.prototype.inCache=function(id){
return (this.objectHash[id]!=null);
};
nitobi.base.ISerializable.prototype.flushCache=function(){
this.objectHash={};
};
nitobi.base.ISerializable.prototype.areGuidsGenerated=function(_2cc){
if(_2cc==null||_2cc.ownerDocument==null){
return false;
}
if(nitobi.browser.IE){
var node=_2cc.ownerDocument.documentElement;
if(node==null){
return false;
}else{
var id=node.getAttribute("id");
if(id==null||id==""){
return false;
}else{
return (nitobi.base.ISerializable.guidMap[id]!=null);
}
}
}else{
return (_2cc.ownerDocument.generatedGuids==true);
}
};
nitobi.base.ISerializable.prototype.setGuidsGenerated=function(_2cf,_2d0){
if(_2cf==null||_2cf.ownerDocument==null){
return;
}
if(nitobi.browser.IE){
var node=_2cf.ownerDocument.documentElement;
if(node!=null){
var id=node.getAttribute("id");
if(id!=null&&id!=""){
nitobi.base.ISerializable.guidMap[id]=true;
}
}
}else{
_2cf.ownerDocument.generatedGuids=true;
}
};
nitobi.base.ISerializable.prototype.generateGuids=function(_2d3){
nitobi.base.uniqueIdGeneratorProc.addParameter("guid",nitobi.component.getUniqueId(),"");
var doc=nitobi.xml.transformToXml(_2d3,nitobi.base.uniqueIdGeneratorProc);
this.saveDocument=doc;
this.setGuidsGenerated(doc.documentElement,true);
return doc.documentElement;
};
nitobi.base.ISerializable.prototype.deserializeFromXmlNode=function(_2d5){
if(!this.areGuidsGenerated(_2d5)){
_2d5=this.generateGuids(_2d5);
}
this.setXmlNode(_2d5);
this.flushCache();
if(this.profile==null){
this.profile=nitobi.base.Registry.getInstance().getCompleteProfile({idField:null,tagName:_2d5.nodeName});
}
this.onDeserialize.notify();
};
nitobi.base.ISerializable.prototype.deserializeFromXml=function(xml){
var doc=nitobi.xml.createXmlDoc(xml);
var node=this.generateGuids(doc.firstChild);
this.setXmlNode(node);
this.onDeserialize.notify();
};
nitobi.base.ISerializable.prototype.getChildObject=function(id){
var obj=null;
obj=this.objectHash[id];
if(obj==null){
var _2db=this.getElement(id);
if(_2db==null){
return null;
}else{
obj=this.factory.createByNode(_2db);
this.onCreateObject.notify(obj);
this.addToCache(obj);
}
obj.setParentObject(this);
}
return obj;
};
nitobi.base.ISerializable.prototype.getChildObjectById=function(id){
return this.getChildObject(id);
};
nitobi.base.ISerializable.prototype.getElement=function(id){
try{
var node=this.xmlNode.selectSingleNode("*[@id='"+id+"']");
return node;
}
catch(err){
nitobi.lang.throwError(nitobi.error.Unexpected,err);
}
};
nitobi.base.ISerializable.prototype.getFactory=function(){
return this.factory;
};
nitobi.base.ISerializable.prototype.setFactory=function(_2df){
this.factory=factory;
};
nitobi.base.ISerializable.prototype.getXmlNode=function(){
return this.xmlNode;
};
nitobi.base.ISerializable.prototype.setXmlNode=function(_2e0){
if(nitobi.lang.typeOf(_2e0)==nitobi.lang.type.XMLDOC&&_2e0!=null){
this.ownerDocument=_2e0;
_2e0=nitobi.html.getFirstChild(_2e0);
}else{
if(_2e0!=null){
this.ownerDocument=_2e0.ownerDocument;
}
}
if(_2e0!=null&&nitobi.browser.MOZ&&_2e0.ownerDocument==null){
nitobi.lang.throwError(nitobi.error.OrphanXmlNode+" ISerializable.setXmlNode");
}
this.xmlNode=_2e0;
};
nitobi.base.ISerializable.prototype.serializeToXml=function(){
return nitobi.xml.serialize(this.xmlNode);
};
nitobi.base.ISerializable.prototype.getAttribute=function(name,_2e2){
if(this[name]!=null){
return this[name];
}
var _2e3=this.xmlNode.getAttribute(name);
return _2e3===null?_2e2:_2e3;
};
nitobi.base.ISerializable.prototype.setAttribute=function(name,_2e5){
this[name]=_2e5;
this.xmlNode.setAttribute(name.toLowerCase(),_2e5!=null?_2e5.toString():"");
};
nitobi.base.ISerializable.prototype.setIntAttribute=function(name,_2e7){
var n=parseInt(_2e7);
if(_2e7!=null&&(typeof (n)!="number"||isNaN(n))){
nitobi.lang.throwError(name+" is not an integer and therefore cannot be set. It's value was "+_2e7);
}
this.setAttribute(name,_2e7);
};
nitobi.base.ISerializable.prototype.getIntAttribute=function(name,_2ea){
var x=this.getAttribute(name,_2ea);
if(x==null||x==""){
return 0;
}
var tx=parseInt(x);
if(isNaN(tx)){
nitobi.lang.throwError("ISerializable attempting to get "+name+" which was supposed to be an int but was actually NaN");
}
return tx;
};
nitobi.base.ISerializable.prototype.setBoolAttribute=function(name,_2ee){
_2ee=nitobi.lang.getBool(_2ee);
if(_2ee!=null&&typeof (_2ee)!="boolean"){
nitobi.lang.throwError(name+" is not an boolean and therefore cannot be set. It's value was "+_2ee);
}
this.setAttribute(name,(_2ee?"true":"false"));
};
nitobi.base.ISerializable.prototype.getBoolAttribute=function(name,_2f0){
var x=this.getAttribute(name,_2f0);
if(typeof (x)=="string"&&x==""){
return null;
}
var tx=nitobi.lang.getBool(x);
if(tx==null){
nitobi.lang.throwError("ISerializable attempting to get "+name+" which was supposed to be a bool but was actually "+x);
}
return tx;
};
nitobi.base.ISerializable.prototype.setDateAttribute=function(name,_2f4){
this.setAttribute(name,_2f4);
};
nitobi.base.ISerializable.prototype.getDateAttribute=function(name,_2f6){
if(this[name]){
return this[name];
}
var _2f7=this.getAttribute(name,_2f6);
return _2f7?new Date(_2f7):null;
};
nitobi.base.ISerializable.prototype.getId=function(){
return this.getAttribute("id");
};
nitobi.base.ISerializable.prototype.getChildObjectId=function(_2f8,_2f9){
var _2fa=(typeof (_2f8.className)=="string"?_2f8.tagName:_2f8.getXmlNode().nodeName);
var _2fb=_2fa;
if(_2f9){
_2fb+="[@instancename='"+_2f9+"']";
}
var node=this.getXmlNode().selectSingleNode(_2fb);
if(null==node){
return null;
}else{
return node.getAttribute("id");
}
};
nitobi.base.ISerializable.prototype.setObject=function(_2fd,_2fe){
if(_2fd.ISerializableImplemented!=true){
nitobi.lang.throwError(nitobi.error.ExpectedInterfaceNotFound+" ISerializable");
}
var id=this.getChildObjectId(_2fd,_2fe);
if(null!=id){
this.deleteChildObject(id);
}
if(_2fe){
_2fd.setAttribute("instancename",_2fe);
}
this.addChildObject(_2fd);
};
nitobi.base.ISerializable.prototype.getObject=function(_300,_301){
var id=this.getChildObjectId(_300,_301);
if(null==id){
return id;
}
return this.getChildObject(id);
};
nitobi.base.ISerializable.prototype.getObjectById=function(id){
return this.getChildObject(id);
};
nitobi.base.ISerializable.prototype.isDescendantExists=function(id){
var node=this.getXmlNode();
var _306=node.selectSingleNode("//*[@id='"+id+"']");
return (_306!=null);
};
nitobi.base.ISerializable.prototype.getPathToLeaf=function(id){
var node=this.getXmlNode();
var _309=node.selectSingleNode("//*[@id='"+id+"']");
if(nitobi.browser.IE){
_309.ownerDocument.setProperty("SelectionLanguage","XPath");
}
var _30a=_309.selectNodes("./ancestor-or-self::*");
var _30b=this.getId();
var _30c=0;
for(var i=0;i<_30a.length;i++){
if(_30a[i].getAttribute("id")==_30b){
_30c=i+1;
break;
}
}
var arr=nitobi.collections.IEnumerable.createNewArray(_30a,_30c);
return arr.reverse();
};
nitobi.base.ISerializable.prototype.isDescendantInstantiated=function(id){
var node=this.getXmlNode();
var _311=node.selectSingleNode("//*[@id='"+id+"']");
if(nitobi.browser.IE){
_311.ownerDocument.setProperty("SelectionLanguage","XPath");
}
var _312=_311.selectNodes("ancestor::*");
var _313=false;
var obj=this;
for(var i=0;i<_312.length;i++){
if(_313){
var _316=_312[i].getAttribute("id");
instantiated=obj.inCache(_316);
if(!instantiated){
return false;
}
obj=this.getObjectById(_316);
}
if(_312[i].getAttribute("id")==this.getId()){
_313=true;
}
}
return obj.inCache(id);
};
nitobi.lang.defineNs("nitobi.base");
if(!nitobi.base.Registry){
nitobi.base.Registry=function(){
this.classMap={};
this.tagMap={};
};
if(!nitobi.base.Registry.instance){
nitobi.base.Registry.instance=null;
}
nitobi.base.Registry.getInstance=function(){
if(nitobi.base.Registry.instance==null){
nitobi.base.Registry.instance=new nitobi.base.Registry();
}
return nitobi.base.Registry.instance;
};
nitobi.base.Registry.prototype.getProfileByClass=function(_317){
return this.classMap[_317];
};
nitobi.base.Registry.prototype.getProfileByInstance=function(_318){
var _319=nitobi.lang.getFirstFunction(_318);
var p=_319.value.prototype;
var _31b=null;
var _31c=0;
for(var _31d in this.classMap){
var _31e=this.classMap[_31d].classObject;
var _31f=0;
while(_31e&&_318 instanceof _31e){
_31e=_31e.baseConstructor;
_31f++;
}
if(_31f>_31c){
_31c=_31f;
_31b=_31d;
}
}
if(_31b){
return this.getProfileByClass(_31b);
}else{
return null;
}
};
nitobi.base.Registry.prototype.getProfileByTag=function(_320){
return this.tagMap[_320];
};
nitobi.base.Registry.prototype.getCompleteProfile=function(_321){
if(nitobi.lang.isDefined(_321.className)&&_321.className!=null){
return this.classMap[_321.className];
}
if(nitobi.lang.isDefined(_321.tagName)&&_321.tagName!=null){
return this.tagMap[_321.tagName];
}
nitobi.lang.throwError("A complete class profile could not be found. Insufficient information was provided.");
};
nitobi.base.Registry.prototype.register=function(_322){
if(!nitobi.lang.isDefined(_322.tagName)||null==_322.tagName){
nitobi.lang.throwError("Illegal to register a class without a tagName.");
}
if(!nitobi.lang.isDefined(_322.className)||null==_322.className){
nitobi.lang.throwError("Illegal to register a class without a className.");
}
this.tagMap[_322.tagName]=_322;
this.classMap[_322.className]=_322;
};
}
nitobi.lang.defineNs("nitobi.base");
nitobi.base.Factory=function(){
this.registry=nitobi.base.Registry.getInstance();
};
nitobi.lang.extend(nitobi.base.Factory,nitobi.Object);
nitobi.base.Factory.instance=null;
nitobi.base.Factory.prototype.createByClass=function(_323){
try{
return nitobi.lang.newObject(_323,arguments,1);
}
catch(err){
nitobi.lang.throwError("The Factory (createByClass) could not create the class "+_323+".",err);
}
};
nitobi.base.Factory.prototype.createByNode=function(_324){
try{
if(null==_324){
nitobi.lang.throwError(nitobi.error.ArgExpected);
}
if(nitobi.lang.typeOf(_324)==nitobi.lang.type.XMLDOC){
_324=nitobi.xml.getChildNodes(_324)[0];
}
var _325=this.registry.getProfileByTag(_324.nodeName).className;
var _326=_324.ownerDocument;
var _327=Array.prototype.slice.call(arguments,0);
var obj=nitobi.lang.newObject(_325,_327,0);
return obj;
}
catch(err){
nitobi.lang.throwError("The Factory (createByNode) could not create the class "+_325+".",err);
}
};
nitobi.base.Factory.prototype.createByProfile=function(_329){
try{
return nitobi.lang.newObject(_329.className,arguments,1);
}
catch(err){
nitobi.lang.throwError("The Factory (createByProfile) could not create the class "+_329.className+".",err);
}
};
nitobi.base.Factory.prototype.createByTag=function(_32a){
var _32b=this.registry.getProfileByTag(_32a).className;
var _32c=Array.prototype.slice.call(arguments,0);
return nitobi.lang.newObject(_32b,_32c,1);
};
nitobi.base.Factory.getInstance=function(){
if(nitobi.base.Factory.instance==null){
nitobi.base.Factory.instance=new nitobi.base.Factory();
}
return nitobi.base.Factory.instance;
};
nitobi.lang.defineNs("nitobi.base");
nitobi.base.Profile=function(_32d,_32e,_32f,_330,_331){
this.className=_32d;
this.classObject=eval(_32d);
this.schema=_32e;
this.singleton=_32f;
this.tagName=_330;
this.idField=_331||"id";
};
nitobi.lang.defineNs("nitobi.base");
nitobi.base.Declaration=function(){
nitobi.base.Declaration.baseConstructor.call(this);
this.xmlDoc=null;
};
nitobi.lang.extend(nitobi.base.Declaration,nitobi.Object);
nitobi.base.Declaration.prototype.loadHtml=function(_332){
try{
_332=$ntb(_332);
this.xmlDoc=nitobi.xml.parseHtml(_332);
return this.xmlDoc;
}
catch(err){
nitobi.lang.throwError(nitobi.error.DeclarationParseError,err);
}
};
nitobi.base.Declaration.prototype.getXmlDoc=function(){
return this.xmlDoc;
};
nitobi.base.Declaration.prototype.serializeToXml=function(){
return nitobi.xml.serialize(this.xmlDoc);
};
nitobi.lang.defineNs("nitobi.base");
nitobi.base.DateMath={DAY:"d",WEEK:"w",MONTH:"m",YEAR:"y",ONE_DAY_MS:86400000};
nitobi.base.DateMath._add=function(date,unit,_335){
if(unit==this.DAY){
date.setDate(date.getDate()+_335);
}else{
if(unit==this.WEEK){
date.setDate(date.getDate()+7*_335);
}else{
if(unit==this.MONTH){
date.setMonth(date.getMonth()+_335);
}else{
if(unit==this.YEAR){
date.setFullYear(date.getFullYear()+_335);
}
}
}
}
return date;
};
nitobi.base.DateMath.add=function(date,unit,_338){
return this._add(date,unit,_338);
};
nitobi.base.DateMath.subtract=function(date,unit,_33b){
return this._add(date,unit,-1*_33b);
};
nitobi.base.DateMath.after=function(date,_33d){
return (date-_33d)>0;
};
nitobi.base.DateMath.between=function(date,_33f,end){
return (date-_33f)>=0&&(end-date)>=0;
};
nitobi.base.DateMath.before=function(date,_342){
return (date-_342)<0;
};
nitobi.base.DateMath.clone=function(date){
var n=new Date(date.toString());
return n;
};
nitobi.base.DateMath.isLeapYear=function(date){
var y=date.getFullYear();
var _1=String(y/4).indexOf(".")==-1;
var _2=String(y/100).indexOf(".")==-1;
var _3=String(y/400).indexOf(".")==-1;
return (_3)?true:(_1&&!_2)?true:false;
};
nitobi.base.DateMath.getMonthDays=function(date){
return [31,(this.isLeapYear(date))?29:28,31,30,31,30,31,31,30,31,30,31][date.getMonth()];
};
nitobi.base.DateMath.getMonthEnd=function(date){
return new Date(date.getFullYear(),date.getMonth(),this.getMonthDays(date));
};
nitobi.base.DateMath.getMonthStart=function(date){
return new Date(date.getFullYear(),date.getMonth(),1);
};
nitobi.base.DateMath.isToday=function(date){
var _34e=this.resetTime(new Date());
var end=this.add(this.clone(_34e),this.DAY,1);
return this.between(date,_34e,end);
};
nitobi.base.DateMath.isSameDay=function(date,_351){
date=this.resetTime(this.clone(date));
_351=this.resetTime(this.clone(_351));
return date.valueOf()==_351.valueOf();
};
nitobi.base.DateMath.parse=function(str){
};
nitobi.base.DateMath.getWeekNumber=function(date){
var _354=this.getJanuary1st(date);
return Math.ceil(this.getNumberOfDays(_354,date)/7);
};
nitobi.base.DateMath.getNumberOfDays=function(_355,end){
var _357=this.resetTime(this.clone(end)).getTime()-this.resetTime(this.clone(_355)).getTime();
return Math.round(_357/this.ONE_DAY_MS)+1;
};
nitobi.base.DateMath.getJanuary1st=function(date){
return new Date(date.getFullYear(),0,1);
};
nitobi.base.DateMath.resetTime=function(date){
if(nitobi.base.DateMath.invalid(date)){
return date;
}
date.setHours(0);
date.setMinutes(0);
date.setSeconds(0);
date.setMilliseconds(0);
return date;
};
nitobi.base.DateMath.parseIso8601=function(date){
return new Date(date.replace(/^(....).(..).(..)(.*)$/,"$1/$2/$3$4"));
};
nitobi.base.DateMath.toIso8601=function(date){
if(nitobi.base.DateMath.invalid(date)){
return "";
}
var pz=nitobi.lang.padZeros;
return date.getFullYear()+"-"+pz(date.getMonth()+1)+"-"+pz(date.getDate())+" "+pz(date.getHours())+":"+pz(date.getMinutes())+":"+pz(date.getSeconds());
};
nitobi.base.DateMath.invalid=function(date){
return (!date)||(date.toString()=="Invalid Date");
};
nitobi.lang.defineNs("nitobi.base");
nitobi.base.EventArgs=function(_35e,_35f){
this.source=_35e;
this.event=_35f||nitobi.html.Event;
};
nitobi.base.EventArgs.prototype.getSource=function(){
return this.source;
};
nitobi.base.EventArgs.prototype.getEvent=function(){
return this.event;
};
nitobi.lang.defineNs("nitobi.collections");
nitobi.collections.IList=function(){
nitobi.base.ISerializable.call(this);
nitobi.collections.IEnumerable.call(this);
};
nitobi.lang.implement(nitobi.collections.IList,nitobi.base.ISerializable);
nitobi.lang.implement(nitobi.collections.IList,nitobi.collections.IEnumerable);
nitobi.collections.IList.prototype.IListImplemented=true;
nitobi.collections.IList.prototype.add=function(obj){
nitobi.collections.IEnumerable.prototype.add.call(this,obj);
if(obj.ISerializableImplemented==true&&obj.profile!=null){
this.addChildObject(obj);
}
};
nitobi.collections.IList.prototype.insert=function(_361,obj){
var _363=this.get(_361);
nitobi.collections.IEnumerable.prototype.insert.call(this,_361,obj);
if(obj.ISerializableImplemented==true&&obj.profile!=null){
this.insertBeforeChildObject(obj,_363);
}
};
nitobi.collections.IList.prototype.addToCache=function(obj,_365){
nitobi.base.ISerializable.prototype.addToCache.call(this,obj);
this.list[_365]=obj;
};
nitobi.collections.IList.prototype.removeFromCache=function(_366){
nitobi.base.ISerializable.prototype.removeFromCache.call(this,this.list[_366].getId());
};
nitobi.collections.IList.prototype.flushCache=function(){
nitobi.base.ISerializable.prototype.flushCache.call(this);
this.list=new Array();
};
nitobi.collections.IList.prototype.get=function(_367){
if(typeof (_367)=="object"){
return _367;
}
if(_367<0||_367>=this.getLength()){
nitobi.lang.throwError(nitobi.error.OutOfBounds);
}
var obj=null;
if(this.list[_367]!=null){
obj=this.list[_367];
}
if(obj==null){
var _369=nitobi.xml.getChildNodes(this.xmlNode)[_367];
if(_369==null){
return null;
}else{
obj=this.factory.createByNode(_369);
this.onCreateObject.notify(obj);
nitobi.collections.IList.prototype.addToCache.call(this,obj,_367);
}
obj.setParentObject(this);
}
return obj;
};
nitobi.collections.IList.prototype.getById=function(id){
var node=this.xmlNode.selectSingleNode("*[@id='"+id+"']");
var _36c=nitobi.xml.indexOfChildNode(node.parentNode,node);
return this.get(_36c);
};
nitobi.collections.IList.prototype.set=function(_36d,_36e){
if(_36d<0||_36d>=this.getLength()){
nitobi.lang.throwError(nitobi.error.OutOfBounds);
}
try{
if(_36e.ISerializableImplemented==true){
var obj=this.get(_36d);
if(obj.getXmlNode()!=_36e.getXmlNode()){
var _370=this.xmlNode.insertBefore(_36e.getXmlNode(),obj.getXmlNode());
this.xmlNode.removeChild(obj.getXmlNode());
obj.setXmlNode(_370);
}
}
_36e.setParentObject(this);
nitobi.collections.IList.prototype.addToCache.call(this,_36e,_36d);
}
catch(err){
nitobi.lang.throwError(nitobi.error.Unexpected,err);
}
};
nitobi.collections.IList.prototype.remove=function(_371){
var i;
if(typeof (_371)!="number"){
i=this.indexOf(_371);
}else{
i=_371;
}
var obj=this.get(i);
nitobi.collections.IEnumerable.prototype.remove.call(this,_371);
this.xmlNode.removeChild(obj.getXmlNode());
};
nitobi.collections.IList.prototype.getLength=function(){
return nitobi.xml.getChildNodes(this.xmlNode).length;
};
nitobi.lang.defineNs("nitobi.collections");
nitobi.collections.List=function(_374){
nitobi.collections.List.baseConstructor.call(this);
nitobi.collections.IList.call(this);
};
nitobi.lang.extend(nitobi.collections.List,nitobi.Object);
nitobi.lang.implement(nitobi.collections.List,nitobi.collections.IList);
nitobi.base.Registry.getInstance().register(new nitobi.base.Profile("nitobi.collections.List",null,false,"ntb:list"));
nitobi.lang.defineNs("nitobi.collections");
nitobi.collections.isHashEmpty=function(hash){
var _376=true;
for(var item in hash){
if(hash[item]!=null&&hash[item]!=""){
_376=false;
break;
}
}
return _376;
};
nitobi.collections.hashLength=function(hash){
var _379=0;
for(var item in hash){
_379++;
}
return _379;
};
nitobi.collections.serialize=function(hash){
var s="";
for(var item in hash){
var _37e=hash[item];
var type=typeof (_37e);
if(type=="string"||type=="number"){
s+="'"+item+"':'"+_37e+"',";
}
}
s=s.substring(0,s.length-1);
return "{"+s+"}";
};
nitobi.lang.defineNs("nitobi.ui");
if(false){
nitobi.ui=function(){
};
}
nitobi.ui.setWaitScreen=function(_380){
if(_380){
var sc=nitobi.html.getBodyArea();
var me=nitobi.html.createElement("div",{"id":"NTB_waitDiv"},{"verticalAlign":"middle","color":"#000000","font":"12px Trebuchet MS, Georgia, Verdana","textAlign":"center","background":"#ffffff","border":"1px solid #000000","padding":"0px","position":"absolute","top":(sc.clientHeight/2)+sc.scrollTop-30+"px","left":(sc.clientWidth/2)+sc.scrollLeft-100+"px","width":"200px","height":"60px"});
me.innerHTML="<table height=60 width=200><tr><td valign=center height=60 align=center>Please wait..</td></tr></table>";
document.getElementsByTagName("body").item(0).appendChild(me);
}else{
var me=$ntb("NTB_waitDiv");
try{
document.getElementsByTagName("body").item(0).removeChild(me);
}
catch(e){
}
}
};
nitobi.lang.defineNs("nitobi.ui");
nitobi.ui.IStyleable=function(_383){
this.htmlNode=_383||null;
this.onBeforeSetStyle=new nitobi.base.Event();
this.onSetStyle=new nitobi.base.Event();
};
nitobi.ui.IStyleable.prototype.getHtmlNode=function(){
return this.htmlNode;
};
nitobi.ui.IStyleable.prototype.setHtmlNode=function(node){
this.htmlNode=node;
};
nitobi.ui.IStyleable.prototype.setStyle=function(name,_386){
if(this.onBeforeSetStyle.notify(new nitobi.ui.StyleEventArgs(this,this.onBeforeSetStyle,name,_386))&&this.getHtmlNode()!=null){
nitobi.html.Css.setStyle(this.getHtmlNode(),name,_386);
this.onSetStyle.notify(new nitobi.ui.StyleEventArgs(this,this.onSetStyle,name,_386));
}
};
nitobi.ui.IStyleable.prototype.getStyle=function(name){
return nitobi.html.Css.getStyle(this.getHtmlNode(),name);
};
nitobi.lang.defineNs("nitobi.ui");
nitobi.ui.StyleEventArgs=function(_388,_389,_38a,_38b){
nitobi.ui.ElementEventArgs.baseConstructor.apply(this,arguments);
this.property=_38a||null;
this.value=_38b||null;
};
nitobi.lang.extend(nitobi.ui.StyleEventArgs,nitobi.base.EventArgs);
nitobi.lang.defineNs("nitobi.ui");
nitobi.ui.IScrollable=function(_38c){
this.scrollableElement=_38c;
};
nitobi.ui.IScrollable.prototype.setScrollableElement=function(el){
this.scrollableElement=el;
};
nitobi.ui.IScrollable.prototype.getScrollableElement=function(){
return this.scrollableElement;
};
nitobi.ui.IScrollable.prototype.getScrollLeft=function(){
return this.scrollableElement.scrollLeft;
};
nitobi.ui.IScrollable.prototype.setScrollLeft=function(left){
this.scrollableElement.scrollLeft=left;
};
nitobi.ui.IScrollable.prototype.scrollLeft=function(_38f){
_38f=_38f||25;
this.scrollableElement.scrollLeft-=_38f;
};
nitobi.ui.IScrollable.prototype.scrollRight=function(_390){
_390=_390||25;
this.scrollableElement.scrollLeft+=_390;
};
nitobi.ui.IScrollable.prototype.isOverflowed=function(_391){
_391=_391||this.scrollableElement.childNodes[0];
return !(parseInt(nitobi.html.getBox(this.scrollableElement).width)>=parseInt(nitobi.html.getBox(_391).width));
};
nitobi.lang.defineNs("nitobi.ui");
if(false){
nitobi.ui=function(){
};
}
nitobi.ui.startDragOperation=function(_392,_393,_394,_395,_396,_397){
var ddo=new nitobi.ui.DragDrop(_392,_394,_395);
ddo.onDragStop.subscribe(_397,_396);
ddo.startDrag(_393);
};
nitobi.ui.DragDrop=function(_399,_39a,_39b){
this.allowVertDrag=(_39a!=null?_39a:true);
this.allowHorizDrag=(_39b!=null?_39b:true);
if(nitobi.browser.IE){
this.surface=document.getElementById("ebadragdropsurface_");
if(this.surface==null){
this.surface=nitobi.html.createElement("div",{"id":"ebadragdropsurface_"},{"filter":"alpha(opacity=1)","backgroundColor":"white","position":"absolute","display":"none","top":"0px","left":"0px","width":"100px","height":"100px","zIndex":"899"});
document.body.appendChild(this.surface);
}
}
if(_399.nodeType==3){
alert("Text node not supported. Use parent element");
}
this.element=_399;
this.zIndex=this.element.style.zIndex;
this.element.style.zIndex=900;
this.onMouseMove=new nitobi.base.Event();
this.onDragStart=new nitobi.base.Event();
this.onDragStop=new nitobi.base.Event();
this.events=[{"type":"mouseup","handler":this.handleMouseUp,"capture":true},{"type":"mousemove","handler":this.handleMouseMove,"capture":true}];
};
nitobi.ui.DragDrop.prototype.startDrag=function(_39c){
this.elementOriginTop=parseInt(this.element.style.top,10);
this.elementOriginLeft=parseInt(this.element.style.left,10);
if(isNaN(this.elementOriginLeft)){
this.elementOriginLeft=0;
}
if(isNaN(this.elementOriginTop)){
this.elementOriginTop=0;
}
var _39d=nitobi.html.getEventCoords(_39c);
x=_39d.x;
y=_39d.y;
this.originX=x;
this.originY=y;
nitobi.html.attachEvents(document,this.events,this);
nitobi.html.cancelEvent(_39c);
this.onDragStart.notify();
};
nitobi.ui.DragDrop.prototype.handleMouseMove=function(_39e){
var x,y;
var _3a1=nitobi.html.getEventCoords(_39e);
x=_3a1.x;
y=_3a1.y;
if(nitobi.browser.IE){
this.surface.style.display="block";
if(document.compat=="CSS1Compat"){
var _3a2=nitobi.html.getBodyArea();
var _3a3=0;
if(document.compatMode=="CSS1Compat"){
_3a3=25;
}
this.surface.style.width=(_3a2.clientWidth-_3a3)+"px";
this.surface.style.height=(_3a2.clientHeight)+"px";
}else{
this.surface.style.width=document.body.clientWidth;
this.surface.style.height=document.body.clientHeight;
}
}
if(this.allowHorizDrag){
this.element.style.left=(this.elementOriginLeft+x-this.originX)+"px";
}
if(this.allowVertDrag){
this.element.style.top=(this.elementOriginTop+y-this.originY)+"px";
}
this.x=x;
this.y=y;
this.onMouseMove.notify(this);
nitobi.html.cancelEvent(_39e);
};
nitobi.ui.DragDrop.prototype.handleMouseUp=function(_3a4){
this.onDragStop.notify({"event":_3a4,"x":this.x,"y":this.y});
nitobi.html.detachEvents(document,this.events);
if(nitobi.browser.IE){
this.surface.style.display="none";
}
this.element.style.zIndex=this.zIndex;
this.element.object=null;
this.element=null;
};
if(typeof (nitobi.ajax)=="undefined"){
nitobi.ajax=function(){
};
}
nitobi.ajax.createXmlHttp=function(){
if(nitobi.browser.IE){
var _3a5=null;
try{
_3a5=new ActiveXObject("Msxml2.XMLHTTP");
}
catch(e){
try{
_3a5=new ActiveXObject("Microsoft.XMLHTTP");
}
catch(ee){
}
}
return _3a5;
}else{
if(nitobi.browser.XHR_ENABLED){
return new XMLHttpRequest();
}
}
};
nitobi.lang.defineNs("nitobi.ajax");
nitobi.ajax.HttpRequest=function(){
this.handler="";
this.async=true;
this.responseType=null;
this.httpObj=nitobi.ajax.createXmlHttp();
this.onPostComplete=new nitobi.base.Event();
this.onGetComplete=new nitobi.base.Event();
this.onRequestComplete=new nitobi.base.Event();
this.onError=new nitobi.base.Event();
this.timeout=0;
this.timeoutId=null;
this.params=null;
this.data="";
this.completeCallback=null;
this.status="complete";
this.preventCache=true;
this.username="";
this.password="";
this.requestMethod="get";
this.requestHeaders={};
};
nitobi.lang.extend(nitobi.ajax.HttpRequest,nitobi.Object);
nitobi.ajax.HttpRequestPool_MAXCONNECTIONS=64;
nitobi.ajax.HttpRequest.prototype.handleResponse=function(){
var _3a6=null;
var _3a7=null;
if((this.httpObj.responseXML!=null&&this.httpObj.responseXML.documentElement!=null)&&this.responseType!="text"){
_3a6=this.httpObj.responseXML;
}else{
if(this.responseType=="xml"){
_3a6=nitobi.xml.createXmlDoc(this.httpObj.responseText);
}else{
_3a6=this.httpObj.responseText;
}
}
if(this.httpObj.status!=200){
this.onError.notify({"source":this,"status":this.httpObj.status,"message":"An error occured retrieving the data from the server. "+"Expected response type was '"+this.responseType+"'."});
}
return _3a6;
};
nitobi.ajax.HttpRequest.prototype.post=function(data,url){
this.data=data;
return this._send("POST",url,data,this.postComplete);
};
nitobi.ajax.HttpRequest.prototype.get=function(url){
return this._send("GET",url,null,this.getComplete);
};
nitobi.ajax.HttpRequest.prototype.postComplete=function(){
if(this.httpObj.readyState==4){
this.status="complete";
var _3ab={"response":this.handleResponse(),"params":this.params};
this.responseXml=this.responseText=_3ab.response;
this.onPostComplete.notify(_3ab);
this.onRequestComplete.notify(_3ab);
if(this.completeCallback){
this.completeCallback.call(this,_3ab);
}
}
};
nitobi.ajax.HttpRequest.prototype.postXml=function(_3ac){
this.setTimeout();
if(("undefined"==typeof (_3ac.documentElement))||(null==_3ac.documentElement)||("undefined"==typeof (_3ac.documentElement.childNodes))||(1>_3ac.documentElement.childNodes.length)){
ebaErrorReport("updategram is empty. No request sent. xmlData["+_3ac+"]\nxmlData.xml["+_3ac.xml+"]");
return;
}
if(null==_3ac.xml){
var _3ad=new XMLSerializer();
_3ac.xml=_3ad.serializeToString(_3ac);
}
return this.post(_3ac.xml);
};
nitobi.ajax.HttpRequest.prototype._send=function(_3ae,url,data,_3b1){
this.handler=url||this.handler;
this.setTimeout();
this.status="pending";
this.httpObj.open(_3ae,(this.preventCache?this.cacheBust(this.handler):this.handler),this.async,this.username,this.password);
if(this.async){
this.httpObj.onreadystatechange=nitobi.lang.close(this,_3b1);
}
for(var item in this.requestHeaders){
this.httpObj.setRequestHeader(item,this.requestHeaders[item]);
}
if(this.responseType=="xml"){
this.httpObj.setRequestHeader("Content-Type","text/xml");
}else{
if(_3ae.toLowerCase()=="post"){
this.httpObj.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
}
}
this.httpObj.send(data);
if(!this.async){
return this.handleResponse();
}
return this.httpObj;
};
nitobi.ajax.HttpRequest.prototype.open=function(_3b3,url,_3b5,_3b6,_3b7){
this.requestMethod=_3b3;
this.async=_3b5;
this.username=_3b6;
this.password=_3b7;
this.handler=url;
};
nitobi.ajax.HttpRequest.prototype.send=function(data){
var _3b9=null;
switch(this.requestMethod.toUpperCase()){
case "POST":
_3b9=this.post(data);
break;
default:
_3b9=this.get();
break;
}
this.responseXml=this.responseText=_3b9;
};
nitobi.ajax.HttpRequest.prototype.setTimeout=function(){
if(this.timeout>0){
this.timeoutId=window.setTimeout(nitobi.lang.close(this,this.abort),this.timeout);
}
};
nitobi.ajax.HttpRequest.prototype.getComplete=function(){
if(this.httpObj.readyState==4){
this.status="complete";
var _3ba={"response":this.handleResponse(),"params":this.params,"status":this.httpObj.status,"statusText":this.httpObj.statusText};
this.responseXml=this.responseText=_3ba.response;
this.onGetComplete.notify(_3ba);
this.onRequestComplete.notify(_3ba);
if(this.completeCallback){
this.completeCallback.call(this,_3ba);
}
}
};
nitobi.ajax.HttpRequest.prototype.setRequestHeader=function(_3bb,val){
this.requestHeaders[_3bb]=val;
};
nitobi.ajax.HttpRequest.prototype.isError=function(code){
return (code>=400&&code<600);
};
nitobi.ajax.HttpRequest.prototype.abort=function(){
this.httpObj.onreadystatechange=function(){
};
this.httpObj.abort();
};
nitobi.ajax.HttpRequest.prototype.clear=function(){
this.handler="";
this.async=true;
this.onPostComplete.dispose();
this.onGetComplete.dispose();
this.params=null;
};
nitobi.ajax.HttpRequest.prototype.cacheBust=function(url){
var _3bf=url.split("?");
var _3c0="nitobi_cachebust="+(new Date().getTime());
if(_3bf.length==1){
url+="?"+_3c0;
}else{
url+="&"+_3c0;
}
return url;
};
nitobi.ajax.HttpRequestPool=function(_3c1){
this.inUse=new Array();
this.free=new Array();
this.max=_3c1||nitobi.ajax.HttpRequestPool_MAXCONNECTIONS;
this.locked=false;
this.context=null;
};
nitobi.ajax.HttpRequestPool.prototype.reserve=function(){
this.locked=true;
var _3c2;
if(this.free.length){
_3c2=this.free.pop();
_3c2.clear();
this.inUse.push(_3c2);
}else{
if(this.inUse.length<this.max){
try{
_3c2=new nitobi.ajax.HttpRequest();
}
catch(e){
_3c2=null;
}
this.inUse.push(_3c2);
}else{
throw "No request objects available";
}
}
this.locked=false;
return _3c2;
};
nitobi.ajax.HttpRequestPool.prototype.release=function(_3c3){
var _3c4=false;
this.locked=true;
if(null!=_3c3){
for(var i=0;i<this.inUse.length;i++){
if(_3c3==this.inUse[i]){
this.free.push(this.inUse[i]);
this.inUse.splice(i,1);
_3c4=true;
break;
}
}
}
this.locked=false;
return null;
};
nitobi.ajax.HttpRequestPool.prototype.dispose=function(){
for(var i=0;i<this.inUse.length;i++){
this.inUse[i].dispose();
}
this.inUse=null;
for(var j=0;j<this.free.length;j++){
this.free[i].dispose();
}
this.free=null;
};
nitobi.ajax.HttpRequestPool.instance=null;
nitobi.ajax.HttpRequestPool.getInstance=function(){
if(nitobi.ajax.HttpRequestPool.instance==null){
nitobi.ajax.HttpRequestPool.instance=new nitobi.ajax.HttpRequestPool();
}
return nitobi.ajax.HttpRequestPool.instance;
};
nitobi.lang.defineNs("nitobi.data");
nitobi.data.UrlConnector=function(url,_3c9){
this.url=url||null;
this.transformer=_3c9||null;
this.async=true;
};
nitobi.data.UrlConnector.prototype.get=function(_3ca,_3cb){
this.request=nitobi.data.UrlConnector.requestPool.reserve();
var _3cc=this.url;
for(var p in _3ca){
_3cc=nitobi.html.Url.setParameter(_3cc,p,_3ca[p]);
}
this.request.handler=_3cc;
this.request.async=this.async;
this.request.responseType="xml";
this.request.params={dataReadyCallback:_3cb};
this.request.completeCallback=nitobi.lang.close(this,this.getComplete);
this.request.get();
};
nitobi.data.UrlConnector.prototype.getComplete=function(_3ce){
if(_3ce.params.dataReadyCallback){
var _3cf=_3ce.response;
var _3d0=_3ce.params.dataReadyCallback;
var _3d1=_3cf;
if(this.transformer){
if(typeof (this.transformer)==="function"){
_3d1=this.transformer.call(null,_3cf);
}else{
_3d1=nitobi.xml.transform(_3cf,this.transformer,"xml");
}
}
if(_3d0){
_3d0.call(null,{result:_3d1,response:_3ce.response});
}
}
nitobi.data.UrlConnector.requestPool.release(this.request);
};
nitobi.data.UrlConnector.requestPool=new nitobi.ajax.HttpRequestPool();
function ntbAssert(_3d2,_3d3,_3d4,_3d5){
}
nitobi.lang.defineNs("console");
nitobi.lang.defineNs("nitobi.debug");
if(typeof (console.log)=="undefined"){
console.log=function(s){
nitobi.debug.addDebugTools();
var t=$ntb("nitobi.log");
t.value=s+"\n"+t.value;
};
console.evalCode=function(){
var _3d8=(eval($ntb("nitobi.consoleEntry").value));
};
}
nitobi.debug.addDebugTools=function(){
var sId="nitobi_debug_panel";
var div=document.getElementById(sId);
var html="<table width=100%><tr><td width=50%><textarea style='width:100%' cols=125 rows=25 id='nitobi.log'></textarea></td><td width=50%><textarea style='width:100%' cols=125 rows=25 id='nitobi.consoleEntry'></textarea><br/><button onclick='console.evalCode()'>Eval</button></td></tr></table>";
if(div==null){
var div=document.createElement("div");
div.setAttribute("id",sId);
div.innerHTML=html;
document.body.appendChild(div);
}else{
if(div.innerHTML==""){
div.innerHTML=html;
}
}
};
nitobi.debug.assert=function(){
};
EBA_EM_ATTRIBUTE_ERROR=1;
EBA_XHR_RESPONSE_ERROR=2;
EBA_DEBUG="debug";
EBA_WARN="warn";
EBA_ERROR="error";
EBA_THROW="throw";
EBA_DEBUG_MODE=false;
EBA_ON_ERROR="";
EBA_LAST_ERROR="";
_ebaDebug=false;
NTB_EM_ATTRIBUTE_ERROR=1;
NTB_XHR_RESPONSE_ERROR=2;
NTB_DEBUG="debug";
NTB_WARN="warn";
NTB_ERROR="error";
NTB_THROW="throw";
NTB_DEBUG_MODE=false;
NTB_ON_ERROR="";
NTB_LAST_ERROR="";
_ebaDebug=false;
function _ntbAssert(_3dc,_3dd){
ntbAssert(_3dc,_3dd,"",DEBUG);
}
function ebaSetOnErrorEvent(_3de){
nitobi.debug.setOnErrorEvent.apply(this,arguments);
}
nitobi.debug.setOnErrorEvent=function(_3df){
NTB_ON_ERROR=_3df;
};
function ebaReportError(_3e0,_3e1,_3e2){
nitobi.debug.errorReport("dude stop calling this method it is now called nitobi.debug.errorReport","");
nitobi.debug.errorReport(_3e0,_3e1,_3e2);
}
function ebaErrorReport(_3e3,_3e4,_3e5){
nitobi.debug.errorReport.apply(this,arguments);
}
nitobi.debug.errorReport=function(_3e6,_3e7,_3e8){
_3e8=(_3e8)?_3e8:NTB_DEBUG;
if(NTB_DEBUG==_3e8&&!NTB_DEBUG_MODE){
return;
}
var _3e9=_3e6+"\nerror code    ["+_3e7+"]\nerror Severity["+_3e8+"]";
LastError=_3e9;
if(eval(NTB_ON_ERROR||"true")){
switch(_3e7){
case NTB_EM_ATTRIBUTE_ERROR:
confirm(_3e6);
break;
case NTB_XHR_RESPONSE_ERROR:
confirm(_3e6);
break;
default:
window.status=_3e6;
break;
}
}
if(NTB_THROW==_3e8){
throw (_3e9);
}
};
if(false){
nitobi.error=function(){
};
}
nitobi.lang.defineNs("nitobi.error");
nitobi.error.onError=new nitobi.base.Event();
if(nitobi){
if(nitobi.testframework){
if(nitobi.testframework.initEventError){
nitobi.testframework.initEventError();
}
}
}
nitobi.error.ErrorEventArgs=function(_3ea,_3eb,type){
nitobi.error.ErrorEventArgs.baseConstructor.call(this,_3ea);
this.description=_3eb;
this.type=type;
};
nitobi.lang.extend(nitobi.error.ErrorEventArgs,nitobi.base.EventArgs);
nitobi.error.isError=function(err,_3ee){
return (err.indexOf(_3ee)>-1);
};
nitobi.error.OutOfBounds="Array index out of bounds.";
nitobi.error.Unexpected="An unexpected error occurred.";
nitobi.error.ArgExpected="The argument is null and not optional.";
nitobi.error.BadArgType="The argument is not of the correct type.";
nitobi.error.BadArg="The argument is not a valid value.";
nitobi.error.XmlParseError="The XML did not parse correctly.";
nitobi.error.DeclarationParseError="The HTML declaration could not be parsed.";
nitobi.error.ExpectedInterfaceNotFound="The object does not support the properties or methods of the expected interface. Its class must implement the required interface.";
nitobi.error.NoHtmlNode="No HTML node found with id.";
nitobi.error.OrphanXmlNode="The XML node has no owner document.";
nitobi.error.HttpRequestError="The HTML page could not be loaded.";
nitobi.lang.defineNs("nitobi.html");
nitobi.html.IRenderer=function(_3ef){
this.setTemplate(_3ef);
this.parameters={};
};
nitobi.html.IRenderer.prototype.renderAfter=function(_3f0,data){
_3f0=$ntb(_3f0);
var _3f2=_3f0.parentNode;
_3f0=_3f0.nextSibling;
return this._renderBefore(_3f2,_3f0,data);
};
nitobi.html.IRenderer.prototype.renderBefore=function(_3f3,data){
_3f3=$ntb(_3f3);
return this._renderBefore(_3f3.parentNode,_3f3,data);
};
nitobi.html.IRenderer.prototype._renderBefore=function(_3f5,_3f6,data){
var s=this.renderToString(data);
var _3f9=document.createElement("div");
_3f9.innerHTML=s;
var _3fa=new Array();
if(_3f9.childNodes){
var i=0;
while(_3f9.childNodes.length){
_3fa[i++]=_3f9.firstChild;
_3f5.insertBefore(_3f9.firstChild,_3f6);
}
}else{
}
return _3fa;
};
nitobi.html.IRenderer.prototype.renderIn=function(_3fc,data){
_3fc=$ntb(_3fc);
var s=this.renderToString(data);
_3fc.innerHTML=s;
return _3fc.childNodes;
};
nitobi.html.IRenderer.prototype.renderToString=function(data){
};
nitobi.html.IRenderer.prototype.setTemplate=function(_400){
this.template=_400;
};
nitobi.html.IRenderer.prototype.getTemplate=function(){
return this.template;
};
nitobi.html.IRenderer.prototype.setParameters=function(_401){
for(var p in _401){
this.parameters[p]=_401[p];
}
};
nitobi.html.IRenderer.prototype.getParameters=function(){
return this.parameters;
};
nitobi.lang.defineNs("nitobi.html");
nitobi.html.XslRenderer=function(_403){
nitobi.html.IRenderer.call(this,_403);
};
nitobi.lang.implement(nitobi.html.XslRenderer,nitobi.html.IRenderer);
nitobi.html.XslRenderer.prototype.setTemplate=function(_404){
if(typeof (_404)==="string"){
_404=nitobi.xml.createXslProcessor(_404);
}
this.template=_404;
};
nitobi.html.XslRenderer.prototype.renderToString=function(data){
if(typeof (data)==="string"){
data=nitobi.xml.createXmlDoc(data);
}
if(nitobi.lang.typeOf(data)===nitobi.lang.type.XMLNODE){
data=nitobi.xml.createXmlDoc(nitobi.xml.serialize(data));
}
var _406=this.getTemplate();
var _407=this.getParameters();
for(var p in _407){
_406.addParameter(p,_407[p],"");
}
var s=nitobi.xml.transformToString(data,_406,"xml");
for(var p in _407){
_406.addParameter(p,"","");
}
return s;
};
nitobi.lang.defineNs("nitobi.ui");
NTB_CSS_HIDE="nitobi-hide";
nitobi.ui.Element=function(id){
nitobi.ui.Element.baseConstructor.call(this);
nitobi.ui.IStyleable.call(this);
if(id!=null){
if(nitobi.lang.typeOf(id)==nitobi.lang.type.XMLNODE){
nitobi.base.ISerializable.call(this,id);
}else{
if($ntb(id)!=null){
var decl=new nitobi.base.Declaration();
var _40c=decl.loadHtml($ntb(id));
var _40d=$ntb(id);
var _40e=_40d.parentNode;
var _40f=_40e.ownerDocument.createElement("ntb:component");
_40e.insertBefore(_40f,_40d);
_40e.removeChild(_40d);
this.setContainer(_40f);
nitobi.base.ISerializable.call(this,_40c);
}else{
nitobi.base.ISerializable.call(this);
this.setId(id);
}
}
}else{
nitobi.base.ISerializable.call(this);
}
this.eventMap={};
this.onCreated=new nitobi.base.Event("created");
this.eventMap["created"]=this.onCreated;
this.onBeforeRender=new nitobi.base.Event("beforerender");
this.eventMap["beforerender"]=this.onBeforeRender;
this.onRender=new nitobi.base.Event("render");
this.eventMap["render"]=this.onRender;
this.onBeforeSetVisible=new nitobi.base.Event("beforesetvisible");
this.eventMap["beforesetvisible"]=this.onBeforeSetVisible;
this.onSetVisible=new nitobi.base.Event("setvisible");
this.eventMap["setvisible"]=this.onSetVisible;
this.onBeforePropagate=new nitobi.base.Event("beforepropagate");
this.onEventNotify=new nitobi.base.Event("eventnotify");
this.onBeforeEventNotify=new nitobi.base.Event("beforeeventnotify");
this.onBeforePropagateToChild=new nitobi.base.Event("beforepropogatetochild");
this.subscribeDeclarationEvents();
this.setEnabled(true);
this.renderer=new nitobi.html.XslRenderer();
};
nitobi.lang.extend(nitobi.ui.Element,nitobi.Object);
nitobi.lang.implement(nitobi.ui.Element,nitobi.base.ISerializable);
nitobi.lang.implement(nitobi.ui.Element,nitobi.ui.IStyleable);
nitobi.ui.Element.htmlNodeCache={};
nitobi.ui.Element.prototype.setHtmlNode=function(_410){
var node=$ntb(_410);
this.htmlNode=node;
};
nitobi.ui.Element.prototype.getRootId=function(){
var _412=this.getParentObject();
if(_412==null){
return this.getId();
}else{
return _412.getRootId();
}
};
nitobi.ui.Element.prototype.getId=function(){
return this.getAttribute("id");
};
nitobi.ui.Element.parseId=function(id){
var ids=id.split(".");
if(ids.length<=2){
return {localName:ids[1],id:ids[0]};
}
return {localName:ids.pop(),id:ids.join(".")};
};
nitobi.ui.Element.prototype.setId=function(id){
this.setAttribute("id",id);
};
nitobi.ui.Element.prototype.notify=function(_416,id,_418,_419){
try{
_416=nitobi.html.getEvent(_416);
if(_419!==false){
nitobi.html.cancelEvent(_416);
}
var _41a=nitobi.ui.Element.parseId(id).id;
if(!this.isDescendantExists(_41a)){
return false;
}
var _41b=!(_41a==this.getId());
var _41c=new nitobi.ui.ElementEventArgs(this,null,id);
var _41d=new nitobi.ui.EventNotificationEventArgs(this,null,id,_416);
_41b=_41b&&this.onBeforePropagate.notify(_41d);
var _41e=true;
if(_41b){
if(_418==null){
_418=this.getPathToLeaf(_41a);
}
var _41f=this.onBeforeEventNotify.notify(_41d);
var _420=(_41f?this.onEventNotify.notify(_41d):true);
var _421=_418.pop().getAttribute("id");
var _422=this.getObjectById(_421);
var _41e=this.onBeforePropagateToChild.notify(_41d);
if(_422.notify&&_41e&&_420){
_41e=_422.notify(_416,id,_418,_419);
}
}else{
_41e=this.onEventNotify.notify(_41d);
}
var _423=this.eventMap[_416.type];
if(_423!=null&&_41e){
_423.notify(this.getEventArgs(_416,id));
}
return _41e;
}
catch(err){
nitobi.lang.throwError(nitobi.error.Unexpected+" Element.notify encountered a problem.",err);
}
};
nitobi.ui.Element.prototype.getEventArgs=function(_424,_425){
var _426=new nitobi.ui.ElementEventArgs(this,null,_425);
return _426;
};
nitobi.ui.Element.prototype.subscribeDeclarationEvents=function(){
for(var name in this.eventMap){
var ev=this.getAttribute("on"+name);
if(ev!=null&&ev!=""){
this.eventMap[name].subscribe(ev,this,name);
}
}
};
nitobi.ui.Element.prototype.getHtmlNode=function(name){
var id=this.getId();
id=(name!=null?id+"."+name:id);
var node=nitobi.ui.Element.htmlNodeCache[name];
if(node==null){
node=$ntb(id);
nitobi.ui.Element.htmlNodeCache[id]=node;
}
return node;
};
nitobi.ui.Element.prototype.flushHtmlNodeCache=function(){
nitobi.ui.Element.htmlNodeCache={};
};
nitobi.ui.Element.prototype.hide=function(_42c,_42d,_42e){
this.setVisible(false,_42c,_42d,_42e);
};
nitobi.ui.Element.prototype.show=function(_42f,_430,_431){
this.setVisible(true,_42f,_430,_431);
};
nitobi.ui.Element.prototype.isVisible=function(){
var node=this.getHtmlNode();
return node&&!nitobi.html.Css.hasClass(node,NTB_CSS_HIDE);
};
nitobi.ui.Element.prototype.setVisible=function(_433,_434,_435,_436){
var _437=this.getHtmlNode();
if(_437&&this.isVisible()!=_433&&this.onBeforeSetVisible.notify({source:this,event:this.onBeforeSetVisible,args:arguments})!==false){
if(this.effect){
this.effect.end();
}
if(_433){
if(_434){
var _438=new _434(_437,_436);
_438.callback=nitobi.lang.close(this,this.handleSetVisible,[_435]);
this.effect=_438;
_438.onFinish.subscribeOnce(nitobi.lang.close(this,function(){
this.effect=null;
}));
_438.start();
}else{
nitobi.html.Css.removeClass(_437,NTB_CSS_HIDE);
this.handleSetVisible(_435);
}
}else{
if(_434){
var _438=new _434(_437,_436);
_438.callback=nitobi.lang.close(this,this.handleSetVisible,[_435]);
this.effect=_438;
_438.onFinish.subscribeOnce(nitobi.lang.close(this,function(){
this.effect=null;
}));
_438.start();
}else{
nitobi.html.Css.addClass(this.getHtmlNode(),NTB_CSS_HIDE);
this.handleSetVisible(_435);
}
}
}
};
nitobi.ui.Element.prototype.handleSetVisible=function(_439){
if(_439){
_439();
}
this.onSetVisible.notify(new nitobi.ui.ElementEventArgs(this,this.onSetVisible));
};
nitobi.ui.Element.prototype.setEnabled=function(_43a){
this.enabled=_43a;
};
nitobi.ui.Element.prototype.isEnabled=function(){
return this.enabled;
};
nitobi.ui.Element.prototype.render=function(_43b,_43c){
this.flushHtmlNodeCache();
_43c=_43c||this.getState();
_43b=$ntb(_43b)||this.getContainer();
if(_43b==null){
var _43b=document.createElement("span");
document.body.appendChild(_43b);
this.setContainer(_43b);
}
this.htmlNode=this.renderer.renderIn(_43b,_43c)[0];
this.htmlNode.jsObject=this;
};
nitobi.ui.Element.prototype.getContainer=function(){
return this.container;
};
nitobi.ui.Element.prototype.setContainer=function(_43d){
this.container=$ntb(_43d);
};
nitobi.ui.Element.prototype.getState=function(){
return this.getXmlNode();
};
nitobi.lang.defineNs("nitobi.ui");
nitobi.ui.ElementEventArgs=function(_43e,_43f,_440){
nitobi.ui.ElementEventArgs.baseConstructor.apply(this,arguments);
this.targetId=_440||null;
};
nitobi.lang.extend(nitobi.ui.ElementEventArgs,nitobi.base.EventArgs);
nitobi.lang.defineNs("nitobi.ui");
nitobi.ui.EventNotificationEventArgs=function(_441,_442,_443,_444){
nitobi.ui.EventNotificationEventArgs.baseConstructor.apply(this,arguments);
this.htmlEvent=_444||null;
};
nitobi.lang.extend(nitobi.ui.EventNotificationEventArgs,nitobi.ui.ElementEventArgs);
nitobi.lang.defineNs("nitobi.ui");
nitobi.ui.Container=function(id){
nitobi.ui.Container.baseConstructor.call(this,id);
nitobi.collections.IList.call(this);
};
nitobi.lang.extend(nitobi.ui.Container,nitobi.ui.Element);
nitobi.lang.implement(nitobi.ui.Container,nitobi.collections.IList);
nitobi.base.Registry.getInstance().register(new nitobi.base.Profile("nitobi.ui.Container",null,false,"ntb:container"));
nitobi.lang.defineNs("nitobi.ui");
NTB_CSS_SMALL="ntb-effects-small";
NTB_CSS_HIDE="nitobi-hide";
if(false){
nitobi.ui.Effects=function(){
};
}
nitobi.ui.Effects={};
nitobi.ui.Effects.setVisible=function(_446,_447,_448,_449,_44a){
_449=(_44a?nitobi.lang.close(_44a,_449):_449)||nitobi.lang.noop;
_446=$ntb(_446);
if(typeof _448=="string"){
_448=nitobi.effects.families[_448];
}
if(!_448){
_448=nitobi.effects.families["none"];
}
if(_447){
var _44b=_448.show;
}else{
var _44b=_448.hide;
}
if(_44b){
var _44c=new _44b(_446);
_44c.callback=_449;
_44c.start();
}else{
if(_447){
nitobi.html.Css.removeClass(_446,NTB_CSS_HIDE);
}else{
nitobi.html.Css.addClass(_446,NTB_CSS_HIDE);
}
_449();
}
};
nitobi.ui.Effects.shrink=function(_44d,_44e,_44f,_450){
var rect=nitobi.html.getClientRects(_44e)[0];
_44d.deltaHeight_Doctype=0-parseInt("0"+nitobi.html.getStyle(_44e,"border-top-width"))-parseInt("0"+nitobi.html.getStyle(_44e,"border-bottom-width"))-parseInt("0"+nitobi.html.getStyle(_44e,"padding-top"))-parseInt("0"+nitobi.html.getStyle(_44e,"padding-bottom"));
_44d.deltaWidth_Doctype=0-parseInt("0"+nitobi.html.getStyle(_44e,"border-left-width"))-parseInt("0"+nitobi.html.getStyle(_44e,"border-right-width"))-parseInt("0"+nitobi.html.getStyle(_44e,"padding-left"))-parseInt("0"+nitobi.html.getStyle(_44e,"padding-right"));
_44d.oldHeight=Math.abs(rect.top-rect.bottom)+_44d.deltaHeight_Doctype;
_44d.oldWidth=Math.abs(rect.right-rect.left)+_44d.deltaWidth_Doctype;
if(!(typeof (_44d.width)=="undefined")){
_44d.deltaWidth=Math.floor(Math.ceil(_44d.width-_44d.oldWidth)/(_44f/nitobi.ui.Effects.ANIMATION_INTERVAL));
}else{
_44d.width=_44d.oldWidth;
_44d.deltaWidth=0;
}
if(!(typeof (_44d.height)=="undefined")){
_44d.deltaHeight=Math.floor(Math.ceil(_44d.height-_44d.oldHeight)/(_44f/nitobi.ui.Effects.ANIMATION_INTERVAL));
}else{
_44d.height=_44d.oldHeight;
_44d.deltaHeight=0;
}
nitobi.ui.Effects.resize(_44d,_44e,_44f,_450);
};
nitobi.ui.Effects.resize=function(_452,_453,_454,_455){
var rect=nitobi.html.getClientRects(_453)[0];
var _457=Math.abs(rect.top-rect.bottom);
var _458=Math.max(_457+_452.deltaHeight+_452.deltaHeight_Doctype,0);
if(Math.abs(_457-_452.height)<Math.abs(_452.deltaHeight)){
_458=_452.height;
_452.deltaHeight=0;
}
var _459=Math.abs(rect.right-rect.left);
var _45a=Math.max(_459+_452.deltaWidth+_452.deltaWidth_Doctype,0);
_45a=(_45a>=0)?_45a:0;
if(Math.abs(_459-_452.width)<Math.abs(_452.deltaWidth)){
_45a=_452.width;
_452.deltaWidth=0;
}
_454-=nitobi.ui.Effects.ANIMATION_INTERVAL;
if(_454>0){
window.setTimeout(nitobi.lang.closeLater(this,nitobi.ui.Effects.resize,[_452,_453,_454,_455]),nitobi.ui.Effects.ANIMATION_INTERVAL);
}
var _45b=function(){
_453.height=_458+"px";
_453.style.height=_458+"px";
_453.width=_45a+"px";
_453.style.width=_45a+"px";
if(_454<=0){
if(_455){
window.setTimeout(_455,0);
}
}
};
nitobi.ui.Effects.executeNextPulse.push(_45b);
};
nitobi.ui.Effects.executeNextPulse=new Array();
nitobi.ui.Effects.pulse=function(){
var p;
while(p=nitobi.ui.Effects.executeNextPulse.pop()){
p.call();
}
};
nitobi.ui.Effects.PULSE_INTERVAL=20;
nitobi.ui.Effects.ANIMATION_INTERVAL=40;
window.setInterval(nitobi.ui.Effects.pulse,nitobi.ui.Effects.PULSE_INTERVAL);
window.setTimeout(nitobi.ui.Effects.pulse,nitobi.ui.Effects.PULSE_INTERVAL);
nitobi.ui.Effects.fadeIntervalId={};
nitobi.ui.Effects.fadeIntervalTime=10;
nitobi.ui.Effects.cube=function(_45d){
return _45d*_45d*_45d;
};
nitobi.ui.Effects.cubeRoot=function(_45e){
var T=0;
var N=parseFloat(_45e);
if(N<0){
N=-N;
T=1;
}
var M=Math.sqrt(N);
var ctr=1;
while(ctr<101){
var M=M*N;
var M=Math.sqrt(Math.sqrt(M));
ctr++;
}
return M;
};
nitobi.ui.Effects.linear=function(_463){
return _463;
};
nitobi.ui.Effects.fade=function(_464,_465,time,_467,_468){
_468=_468||nitobi.ui.Effects.linear;
var _469=(new Date()).getTime()+time;
var id=nitobi.component.getUniqueId();
var _46b=(new Date()).getTime();
var el=_464;
if(_464.length){
el=_464[0];
}
var _46d=nitobi.html.Css.getOpacity(el);
var _46e=(_465-_46d<0?-1:0);
nitobi.ui.Effects.fadeIntervalId[id]=window.setInterval(function(){
nitobi.ui.Effects.stepFade(_464,_465,_46b,_469,id,_467,_468,_46e);
},nitobi.ui.Effects.fadeIntervalTime);
};
nitobi.ui.Effects.stepFade=function(_46f,_470,_471,_472,id,_474,_475,_476){
var ct=(new Date()).getTime();
var _478=_472-_471;
var nct=((ct-_471)/(_472-_471));
if(nct<=0||nct>=1){
nitobi.html.Css.setOpacities(_46f,_470);
window.clearInterval(nitobi.ui.Effects.fadeIntervalId[id]);
_474();
return;
}else{
nct=Math.abs(nct+_476);
}
var no=_475(nct);
nitobi.html.Css.setOpacities(_46f,no*100);
};
nitobi.lang.defineNs("nitobi.component");
if(false){
nitobi.component=function(){
};
}
nitobi.loadComponent=function(el){
var id=el;
el=$ntb(el);
if(el==null){
nitobi.lang.throwError("nitobi.loadComponent could not load the component because it could not be found on the page. The component may not have a declaration, node, or it may have a duplicated id. Id: "+id);
}
if(el.jsObject!=null){
return el.jsObject;
}
var _47d;
var _47e=nitobi.html.getTagName(el);
if(_47e=="ntb:grid"){
_47d=nitobi.initGrid(el.id);
}else{
if(_47e==="ntb:combo"){
_47d=nitobi.initCombo(el.id);
}else{
if(_47e=="ntb:treegrid"){
_47d=nitobi.initTreeGrid(el.id);
}else{
if(el.jsObject==null){
_47d=nitobi.base.Factory.getInstance().createByTag(_47e,el.id,nitobi.component.renderComponent);
if(_47d.render&&!_47d.onLoadCallback){
_47d.render();
}
}else{
_47d=el.jsObject;
}
}
}
}
return _47d;
};
nitobi.component.renderComponent=function(_47f){
_47f.source.render();
};
nitobi.getComponent=function(id){
var el=$ntb(id);
if(el==null){
return null;
}
return el.jsObject;
};
nitobi.component.uniqueId=0;
nitobi.component.getUniqueId=function(){
return "ntbcmp_"+(nitobi.component.uniqueId++);
};
nitobi.getComponents=function(_482,_483){
if(_483==null){
_483=[];
}
if(nitobi.component.isNitobiElement(_482)){
_483.push(_482);
return;
}
var _484=_482.childNodes;
for(var i=0;i<_484.length;i++){
nitobi.getComponents(_484[i],_483);
}
return _483;
};
nitobi.component.isNitobiElement=function(_486){
var _487=nitobi.html.getTagName(_486);
if(_487.substr(0,3)=="ntb"){
return true;
}else{
return false;
}
};
nitobi.component.loadComponentsFromNode=function(_488){
var _489=new Array();
nitobi.getComponents(_488,_489);
for(var i=0;i<_489.length;i++){
nitobi.loadComponent(_489[i].getAttribute("id"));
}
};
nitobi.lang.defineNs("nitobi.effects");
if(false){
nitobi.effects=function(){
};
}
nitobi.effects.Effect=function(_48b,_48c){
this.element=$ntb(_48b);
this.transition=_48c.transition||nitobi.effects.Transition.sinoidal;
this.duration=_48c.duration||1;
this.fps=_48c.fps||50;
this.from=typeof (_48c.from)==="number"?_48c.from:0;
this.to=typeof (_48c.from)==="number"?_48c.to:1;
this.delay=_48c.delay||0;
this.callback=typeof (_48c.callback)==="function"?_48c.callback:nitobi.lang.noop;
this.queue=_48c.queue||nitobi.effects.EffectQueue.globalQueue;
this.onBeforeFinish=new nitobi.base.Event();
this.onFinish=new nitobi.base.Event();
this.onBeforeStart=new nitobi.base.Event();
};
nitobi.effects.Effect.prototype.start=function(){
var now=new Date().getTime();
this.startOn=now+this.delay*1000;
this.finishOn=this.startOn+this.duration*1000;
this.deltaTime=this.duration*1000;
this.totalFrames=this.duration*this.fps;
this.frame=0;
this.delta=this.from-this.to;
this.queue.add(this);
};
nitobi.effects.Effect.prototype.render=function(pos){
if(!this.running){
this.onBeforeStart.notify(new nitobi.base.EventArgs(this,this.onBeforeStart));
this.setup();
this.running=true;
}
this.update(this.transition(pos*this.delta+this.from));
};
nitobi.effects.Effect.prototype.step=function(now){
if(this.startOn<=now){
if(now>=this.finishOn){
this.end();
return;
}
var pos=(now-this.startOn)/(this.deltaTime);
var _491=Math.floor(pos*this.totalFrames);
if(this.frame<_491){
this.render(pos);
this.frame=_491;
}
}
};
nitobi.effects.Effect.prototype.setup=function(){
};
nitobi.effects.Effect.prototype.update=function(pos){
};
nitobi.effects.Effect.prototype.finish=function(){
};
nitobi.effects.Effect.prototype.end=function(){
this.onBeforeFinish.notify(new nitobi.base.EventArgs(this,this.onBeforeFinish));
this.cancel();
this.render(1);
this.running=false;
this.finish();
this.callback();
this.onFinish.notify(new nitobi.base.EventArgs(this,this.onAfterFinish));
};
nitobi.effects.Effect.prototype.cancel=function(){
this.queue.remove(this);
};
nitobi.effects.factory=function(_493,_494,etc){
var args=nitobi.lang.toArray(arguments,2);
return function(_497){
var f=function(){
_493.apply(this,[_497,_494].concat(args));
};
nitobi.lang.extend(f,_493);
return new f();
};
};
nitobi.effects.families={none:{show:null,hide:null}};
nitobi.lang.defineNs("nitobi.effects");
if(false){
nitobi.effects.Transition=function(){
};
}
nitobi.effects.Transition={};
nitobi.effects.Transition.sinoidal=function(x){
return (-Math.cos(x*Math.PI)/2)+0.5;
};
nitobi.effects.Transition.linear=function(x){
return x;
};
nitobi.effects.Transition.reverse=function(x){
return 1-x;
};
nitobi.lang.defineNs("nitobi.effects");
nitobi.effects.Scale=function(_49c,_49d,_49e){
nitobi.effects.Scale.baseConstructor.call(this,_49c,_49d);
this.scaleX=typeof (_49d.scaleX)=="boolean"?_49d.scaleX:true;
this.scaleY=typeof (_49d.scaleY)=="boolean"?_49d.scaleY:true;
this.scaleFrom=typeof (_49d.scaleFrom)=="number"?_49d.scaleFrom:100;
this.scaleTo=_49e;
};
nitobi.lang.extend(nitobi.effects.Scale,nitobi.effects.Effect);
nitobi.effects.Scale.prototype.setup=function(){
var _49f=this.element.style;
var Css=nitobi.html.Css;
this.originalStyle={"top":_49f.top,"left":_49f.left,"width":_49f.width,"height":_49f.height,"overflow":Css.getStyle(this.element,"overflow")};
this.factor=(this.scaleTo-this.scaleFrom)/100;
this.dims=[this.element.scrollWidth,this.element.scrollHeight];
_49f.width=this.dims[0]+"px";
_49f.height=this.dims[1]+"px";
Css.setStyle(this.element,"overflow","hidden");
};
nitobi.effects.Scale.prototype.finish=function(){
for(var s in this.originalStyle){
this.element.style[s]=this.originalStyle[s];
}
};
nitobi.effects.Scale.prototype.update=function(pos){
var _4a3=(this.scaleFrom/100)+(this.factor*pos);
this.setDimensions(Math.floor(_4a3*this.dims[0])||1,Math.floor(_4a3*this.dims[1])||1);
};
nitobi.effects.Scale.prototype.setDimensions=function(x,y){
if(this.scaleX){
this.element.style.width=x+"px";
}
if(this.scaleY){
this.element.style.height=y+"px";
}
};
nitobi.lang.defineNs("nitobi.effects");
nitobi.effects.EffectQueue=function(){
nitobi.effects.EffectQueue.baseConstructor.call(this);
nitobi.collections.IEnumerable.call(this);
this.intervalId=0;
};
nitobi.lang.extend(nitobi.effects.EffectQueue,nitobi.Object);
nitobi.lang.implement(nitobi.effects.EffectQueue,nitobi.collections.IEnumerable);
nitobi.effects.EffectQueue.prototype.add=function(_4a6){
nitobi.collections.IEnumerable.prototype.add.call(this,_4a6);
if(!this.intervalId){
this.intervalId=window.setInterval(nitobi.lang.close(this,this.step),15);
}
};
nitobi.effects.EffectQueue.prototype.step=function(){
var now=new Date().getTime();
this.each(function(e){
e.step(now);
});
};
nitobi.effects.EffectQueue.globalQueue=new nitobi.effects.EffectQueue();
nitobi.lang.defineNs("nitobi.effects");
nitobi.effects.BlindUp=function(_4a9,_4aa){
_4aa=nitobi.lang.merge({scaleX:false,duration:Math.min(0.2*(_4a9.scrollHeight/100),0.5)},_4aa||{});
nitobi.effects.BlindUp.baseConstructor.call(this,_4a9,_4aa,0);
};
nitobi.lang.extend(nitobi.effects.BlindUp,nitobi.effects.Scale);
nitobi.effects.BlindUp.prototype.setup=function(){
nitobi.effects.BlindUp.base.setup.call(this);
};
nitobi.effects.BlindUp.prototype.finish=function(){
nitobi.html.Css.addClass(this.element,NTB_CSS_HIDE);
nitobi.effects.BlindUp.base.finish.call(this);
this.element.style.height="";
};
nitobi.effects.BlindDown=function(_4ab,_4ac){
nitobi.html.Css.swapClass(_4ab,NTB_CSS_HIDE,NTB_CSS_SMALL);
_4ac=nitobi.lang.merge({scaleX:false,scaleFrom:0,duration:Math.min(0.2*(_4ab.scrollHeight/100),0.5)},_4ac||{});
nitobi.effects.BlindDown.baseConstructor.call(this,_4ab,_4ac,100);
};
nitobi.lang.extend(nitobi.effects.BlindDown,nitobi.effects.Scale);
nitobi.effects.BlindDown.prototype.setup=function(){
nitobi.effects.BlindDown.base.setup.call(this);
this.element.style.height="1px";
nitobi.html.Css.removeClass(this.element,NTB_CSS_SMALL);
};
nitobi.effects.BlindDown.prototype.finish=function(){
nitobi.effects.BlindDown.base.finish.call(this);
this.element.style.height="";
};
nitobi.effects.families.blind={show:nitobi.effects.BlindDown,hide:nitobi.effects.BlindUp};
nitobi.lang.defineNs("nitobi.effects");
nitobi.effects.ShadeUp=function(_4ad,_4ae){
_4ae=nitobi.lang.merge({scaleX:false,duration:Math.min(0.2*(_4ad.scrollHeight/100),0.3)},_4ae||{});
nitobi.effects.ShadeUp.baseConstructor.call(this,_4ad,_4ae,0);
};
nitobi.lang.extend(nitobi.effects.ShadeUp,nitobi.effects.Scale);
nitobi.effects.ShadeUp.prototype.setup=function(){
nitobi.effects.ShadeUp.base.setup.call(this);
var _4af=nitobi.html.getFirstChild(this.element);
this.originalStyle.position=this.element.style.position;
nitobi.html.position(this.element);
if(_4af){
var _4b0=_4af.style;
this.fnodeStyle={position:_4b0.position,bottom:_4b0.bottom,left:_4b0.left};
this.fnode=_4af;
_4b0.position="absolute";
_4b0.bottom="0px";
_4b0.left="0px";
_4b0.top="";
}
};
nitobi.effects.ShadeUp.prototype.finish=function(){
nitobi.effects.ShadeUp.base.finish.call(this);
nitobi.html.Css.addClass(this.element,NTB_CSS_HIDE);
this.element.style.height="";
this.element.style.position=this.originalStyle.position;
this.element.style.overflow=this.originalStyle.overflow;
for(var x in this.fnodeStyle){
this.fnode.style[x]=this.fnodeStyle[x];
}
};
nitobi.effects.ShadeDown=function(_4b2,_4b3){
nitobi.html.Css.swapClass(_4b2,NTB_CSS_HIDE,NTB_CSS_SMALL);
_4b3=nitobi.lang.merge({scaleX:false,scaleFrom:0,duration:Math.min(0.2*(_4b2.scrollHeight/100),0.3)},_4b3||{});
nitobi.effects.ShadeDown.baseConstructor.call(this,_4b2,_4b3,100);
};
nitobi.lang.extend(nitobi.effects.ShadeDown,nitobi.effects.Scale);
nitobi.effects.ShadeDown.prototype.setup=function(){
nitobi.effects.ShadeDown.base.setup.call(this);
this.element.style.height="1px";
nitobi.html.Css.removeClass(this.element,NTB_CSS_SMALL);
var _4b4=nitobi.html.getFirstChild(this.element);
this.originalStyle.position=this.element.style.position;
nitobi.html.position(this.element);
if(_4b4){
var _4b5=_4b4.style;
this.fnodeStyle={position:_4b5.position,bottom:_4b5.bottom,left:_4b5.left,right:_4b5.right,top:_4b5.top};
this.fnode=_4b4;
_4b5.position="absolute";
_4b5.top="";
_4b5.right="";
_4b5.bottom="0px";
_4b5.left="0px";
}
};
nitobi.effects.ShadeDown.prototype.finish=function(){
nitobi.effects.ShadeDown.base.finish.call(this);
this.element.style.height="";
this.element.style.position=this.originalStyle.position;
this.element.style.overflow=this.originalStyle.overflow;
for(var x in this.fnodeStyle){
this.fnode.style[x]=this.fnodeStyle[x];
}
this.fnode.style.top="0px";
this.fnode.style.left="0px";
this.fnode.style.bottom="";
this.fnode.style.right="";
return;
this.fnode.style["position"]="";
};
nitobi.effects.families.shade={show:nitobi.effects.ShadeDown,hide:nitobi.effects.ShadeUp};
nitobi.lang.defineNs("nitobi.lang");
nitobi.lang.StringBuilder=function(_4b7){
if(_4b7){
if(typeof (_4b7)==="string"){
this.strings=[_4b7];
}else{
this.strings=_4b7;
}
}else{
this.strings=new Array();
}
};
nitobi.lang.StringBuilder.prototype.append=function(_4b8){
if(_4b8){
this.strings.push(_4b8);
}
return this;
};
nitobi.lang.StringBuilder.prototype.clear=function(){
this.strings.length=0;
};
nitobi.lang.StringBuilder.prototype.toString=function(){
return this.strings.join("");
};


var temp_ntb_uniqueIdGeneratorProc='<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:ntb="http://www.nitobi.com"> <xsl:output method="xml" /> <x:p-x:n-guid"x:s-0"/><x:t- match="/"> <x:at-/></x:t-><x:t- match="node()|@*"> <xsl:copy> <xsl:if test="not(@id)"> <x:a-x:n-id" ><x:v-x:s-generate-id(.)"/><x:v-x:s-position()"/><x:v-x:s-$guid"/></x:a-> </xsl:if> <x:at-x:s-./* | text() | @*"> </x:at-> </xsl:copy></x:t-> <x:t- match="text()"> <x:v-x:s-."/></x:t-></xsl:stylesheet>';
nitobi.lang.defineNs("nitobi.base");
nitobi.base.uniqueIdGeneratorProc = nitobi.xml.createXslProcessor(nitobiXmlDecodeXslt(temp_ntb_uniqueIdGeneratorProc));


