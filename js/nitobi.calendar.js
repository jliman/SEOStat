/*
 * Nitobi Complete UI 1.0
 * Copyright(c) 2008, Nitobi
 * support@nitobi.com
 * 
 * http://www.nitobi.com/license
 */
if(typeof (nitobi)=="undefined"||typeof (nitobi.lang)=="undefined"){
alert("The Nitobi framework source could not be found. Is it included before any other Nitobi components?");
}
nitobi.lang.defineNs("nitobi.calendar");
nitobi.calendar.Calendar=function(_1){
nitobi.calendar.Calendar.baseConstructor.call(this,_1);
this.selectedDate;
this.renderer=new nitobi.calendar.CalRenderer();
this.onHide=new nitobi.base.Event();
this.eventMap["hide"]=this.onHide;
this.onShow=new nitobi.base.Event();
this.eventMap["show"]=this.onShow;
this.onDateClicked=new nitobi.base.Event();
this.eventMap["dateclicked"]=this.onDateClicked;
this.onMonthChanged=new nitobi.base.Event();
this.eventMap["monthchanged"]=this.onMonthChanged;
this.onYearChanged=new nitobi.base.Event();
this.eventMap["yearchanged"]=this.onYearChanged;
this.onRenderComplete=new nitobi.base.Event();
this.onSetVisible.subscribe(this.handleToggle,this);
this.showEffect=(this.isEffectEnabled()?nitobi.effects.families["shade"].show:null);
this.hideEffect=(this.isEffectEnabled()?nitobi.effects.families["shade"].hide:null);
this.htmlEvents={"body":[],"nav":[],"navconfirm":[],"navcancel":[],"navpanel":[],"nextmonth":[],"prevmonth":[]};
this.subscribeDeclarationEvents();
};
nitobi.lang.extend(nitobi.calendar.Calendar,nitobi.ui.Element);
nitobi.calendar.Calendar.profile=new nitobi.base.Profile("nitobi.calendar.Calendar",null,false,"ntb:calendar");
nitobi.base.Registry.getInstance().register(nitobi.calendar.Calendar.profile);
nitobi.calendar.Calendar.prototype.render=function(){
this.detachEvents();
this.setContainer(this.getHtmlNode());
nitobi.calendar.Calendar.base.render.call(this);
this.selectedDate=this.getParentObject().getSelectedDate();
var he=this.htmlEvents;
var H=nitobi.html;
var _4=this.getHtmlNode("body");
H.attachEvent(_4,"click",this.handleBodyClick,this);
H.attachEvent(_4,"mousedown",this.handleMouseDown,this);
he.body.push({type:"click",handler:this.handleBodyClick});
he.body.push({type:"mousedown",handle:this.handleMouseDown});
var _5=this.getHtmlNode("nav");
var _6=this.getHtmlNode("navconfirm");
var _7=this.getHtmlNode("navcancel");
H.attachEvent(_5,"click",this.showNav,this);
H.attachEvent(_7,"click",this.handleNavCancel,this);
H.attachEvent(_6,"click",this.handleNavConfirm,this);
H.attachEvent(this.getHtmlNode("navpanel"),"keypress",this.handleNavKey,this);
he.nav.push({type:"click",handler:this.showNav});
he.navcancel.push({type:"click",handler:this.handleNavCancel});
he.navconfirm.push({type:"click",handler:this.handleNavConfirm});
he.navpanel.push({type:"keypress",handler:this.handleNavKey});
H.attachEvent(this.getHtmlNode("nextmonth"),"click",this.nextMonth,this);
H.attachEvent(this.getHtmlNode("prevmonth"),"click",this.prevMonth,this);
he.nextmonth.push({type:"click",handler:this.nextMonth});
he.prevmonth.push({type:"click",handler:this.prevMonth});
var _8=this.getHtmlNode();
var _9=this.getHtmlNode("shim");
var _a=nitobi.html.Css;
if(_9){
var _b=_a.hasClass(_8,"nitobi-hide");
if(_b){
_a.removeClass(_8,"nitobi-hide");
_8.style.top="-1000px";
}
var _c=_8.offsetWidth;
var _d=_8.offsetHeight;
_9.style.height=_d+"px";
_9.style.width=_c-1+"px";
if(_b){
_a.addClass(_8,"nitobi-hide");
_8.style.top="";
}
}
this.onRenderComplete.notify(new nitobi.ui.ElementEventArgs(this,this.onRenderComplete));
};
nitobi.calendar.Calendar.prototype.detachEvents=function(){
var he=this.htmlEvents;
for(var _f in he){
var _10=he[_f];
var _11=this.getHtmlNode(_f);
nitobi.html.detachEvents(_11,_10);
}
};
nitobi.calendar.Calendar.prototype.handleMouseDown=function(_12){
var _13=this.getParentObject();
var _14=this.findActiveDate(_12.srcElement);
if(_14&&nitobi.html.Css.hasClass(_14,"ntb-calendar-thismonth")){
_13.blurInput=false;
}else{
_13.blurInput=true;
}
};
nitobi.calendar.Calendar.prototype.handleBodyClick=function(_15){
var _16=this.findActiveDate(_15.srcElement);
if(!_16||nitobi.html.Css.hasClass(_16,"ntb-calendar-lastmonth")||nitobi.html.Css.hasClass(_16,"ntb-calendar-nextmonth")){
return;
}
var _17=this.getParentObject();
var day=_16.getAttribute("ebadate");
var _19=_16.getAttribute("ebamonth");
var _1a=_16.getAttribute("ebayear");
var _1b=new Date(_1a,_19,day);
var _1c=_17.getEventsManager();
if(_1c.isDisabled(_1b)){
return;
}
_17._setSelectedDate(_1b);
this.onDateClicked.notify(new nitobi.ui.ElementEventArgs(this,this.onDateClicked));
this.toggle();
};
nitobi.calendar.Calendar.prototype.handleNavKey=function(e){
var _1e=e.keyCode;
if(_1e==27){
this.handleNavCancel();
}
if(_1e==13){
this.handleNavConfirm();
}
};
nitobi.calendar.Calendar.prototype.handleToggleClick=function(e){
this.toggle();
};
nitobi.calendar.Calendar.prototype.clearHighlight=function(){
if(this.selectedDate){
var _20=this.findDateElement(this.selectedDate);
if(_20){
nitobi.html.Css.removeClass(_20,"ntb-calendar-currentday");
}
this.selectedDate=null;
}
};
nitobi.calendar.Calendar.prototype.highlight=function(_21){
this.selectedDate=_21;
var _22=this.findDateElement(_21);
if(_22){
nitobi.html.Css.addClass(_22,"ntb-calendar-currentday");
}
};
nitobi.calendar.Calendar.prototype.findDateElement=function(_23){
var _24=this.getHtmlNode(_23.getMonth()+"."+_23.getFullYear());
var dm=nitobi.base.DateMath;
if(_24){
var _26=dm.getMonthStart(dm.clone(_23));
_26=dm.subtract(_26,"d",_26.getDay());
var _27=dm.getNumberOfDays(_26,_23)-1;
if(_27>=0&&_27<42){
var row=1+Math.floor(_27/7);
var col=_27%7;
var _2a=nitobi.html.getFirstChild(_24.rows[row].cells[col]);
return _2a;
}
}
return null;
};
nitobi.calendar.Calendar.prototype.showNav=function(){
var _2b=this.getParentObject();
var _2c=_2b.getStartDate();
var _2d=this.getHtmlNode("months");
_2d.selectedIndex=_2c.getMonth();
this.getHtmlNode("year").value=_2c.getFullYear();
this.getHtmlNode("warning").style.display="none";
var _2e=this.getHtmlNode("overlay");
var _2f=this.getHtmlNode("navpanel");
var _30=new nitobi.effects.BlindDown(_2f,{duration:0.3});
var _31=this.getHtmlNode("nav");
this.fitOverlay();
_2e.style.display="block";
var D=nitobi.drawing;
D.align(_2f,_31,D.align.ALIGNMIDDLEHORIZ);
D.align(_2f,this.getHtmlNode("body"),D.align.ALIGNTOP);
D.align(_2e,this.getHtmlNode("body"),D.align.ALIGNTOP|D.align.ALIGNLEFT);
_30.callback=function(){
_2d.focus();
};
_30.start();
};
nitobi.calendar.Calendar.prototype.hideNav=function(_33){
var _34=this.getHtmlNode("navpanel");
var _35=new nitobi.effects.BlindUp(_34,{duration:0.2});
_35.callback=_33||nitobi.lang.noop();
_35.start();
};
nitobi.calendar.Calendar.prototype.hideOverlay=function(){
var _36=this.getHtmlNode("overlay");
_36.style.display="none";
};
nitobi.calendar.Calendar.prototype.fitOverlay=function(){
var _37=this.getHtmlNode("body");
var _38=this.getHtmlNode("overlay");
var _39=_37.offsetWidth;
var _3a=_37.offsetHeight;
_38.style.height=_3a+"px";
_38.style.width=_39+"px";
};
nitobi.calendar.Calendar.prototype.handleNavConfirm=function(_3b){
var _3c=this.getParentObject();
var _3d=this.getHtmlNode("months");
var _3e=_3d.options[_3d.selectedIndex].value;
var _3f=this.getHtmlNode("year").value;
if(isNaN(_3f)){
var _40=this.getHtmlNode("warning");
_40.style.display="block";
_40.innerHTML=_3c.getNavInvalidYearText();
return;
}
_3f=parseInt(_3f);
var _41=new Date(_3f,_3e,1);
if(_3c.isOutOfRange(_41)){
var _40=this.getHtmlNode("warning");
_40.style.display="block";
_40.innerHTML=_3c.getNavOutOfRangeText();
return;
}
var _42=_3c.getStartDate();
var _43=false;
var _44=false;
if(_3f!=_42.getFullYear()){
_44=true;
}
if(parseInt(_3e)!=_42.getMonth()){
_43=true;
}
_3c.setStartDate(_41);
var _45=nitobi.lang.close(this,this.render);
this.onRenderComplete.subscribeOnce(nitobi.lang.close(this,function(){
if(_43){
this.onMonthChanged.notify(new nitobi.ui.ElementEventArgs(this,this.onMonthChanged));
}
if(_44){
this.onYearChanged.notify(new nitobi.ui.ElementEventArgs(this,this.onYearChanged));
}
}));
this.hideNav(_45);
};
nitobi.calendar.Calendar.prototype.handleNavCancel=function(_46){
var _47=nitobi.lang.close(this,this.hideOverlay);
this.hideNav(_47);
};
nitobi.calendar.Calendar.prototype.findActiveDate=function(_48){
var _49=5;
for(var i=0;i<_49&&_48.getAttribute;i++){
var t=_48.getAttribute("ebatype");
if(t=="date"){
return _48;
}
_48=_48.parentNode;
}
return null;
};
nitobi.calendar.Calendar.prototype.getState=function(){
return this;
};
nitobi.calendar.Calendar.prototype.nextMonth=function(){
var _4c=this.getParentObject();
if(!_4c.disNext){
var _4d=this.getMonthColumns()*this.getMonthRows();
this.changeMonth(_4d);
}
};
nitobi.calendar.Calendar.prototype.prevMonth=function(){
if(!this.getParentObject().disPrev){
var _4e=this.getMonthColumns()*this.getMonthRows();
this.changeMonth(0-_4e);
}
};
nitobi.calendar.Calendar.prototype.changeMonth=function(_4f){
var _50=this.getParentObject();
var _51=_50.getStartDate();
var dm=nitobi.base.DateMath;
_51=dm._add(dm.clone(_51),"m",_4f);
var _53=_50.getStartDate();
var _54=false;
if(_53.getFullYear()!=_51.getFullYear()){
_54=true;
}
_50.setStartDate(_51);
this.render();
this.onMonthChanged.notify(new nitobi.ui.ElementEventArgs(this,this.onMonthChanged));
if(_54){
this.onYearChanged.notify(new nitobi.ui.ElementEventArgs(this,this.onYearChanged));
}
};
nitobi.calendar.Calendar.prototype.toggle=function(_55){
var _56=this.getParentObject();
if(_56.getInput()){
this.setVisible(!this.isVisible(),(this.isVisible()?this.hideEffect:this.showEffect),_55,{duration:0.3});
}
};
nitobi.calendar.Calendar.prototype.show=function(_57){
var _58=this.getParentObject();
if(_58.getInput()){
this.setVisible(true,this.showEffect,_57,{duration:0.3});
}
};
nitobi.calendar.Calendar.prototype.hide=function(_59){
var _5a=this.getParentObject();
if(_5a.getInput()){
this.setVisible(false,this.hideEffect,_59,{duration:0.3});
}
};
nitobi.calendar.Calendar.prototype.handleToggle=function(){
if(this.isVisible()){
this.onShow.notify(new nitobi.ui.ElementEventArgs(this,this.onShow));
}else{
this.onHide.notify(new nitobi.ui.ElementEventArgs(this,this.onHide));
}
};
nitobi.calendar.Calendar.prototype.getMonthColumns=function(){
return this.getIntAttribute("monthcolumns",1);
};
nitobi.calendar.Calendar.prototype.setMonthColumns=function(_5b){
this.setAttribute("monthcolumns",_5b);
};
nitobi.calendar.Calendar.prototype.getMonthRows=function(){
return this.getIntAttribute("monthrows",1);
};
nitobi.calendar.Calendar.prototype.setMonthRows=function(_5c){
this.setAttribute("monthrows",_5c);
};
nitobi.calendar.Calendar.prototype.isEffectEnabled=function(){
return this.getBoolAttribute("effectenabled",true);
};
nitobi.calendar.Calendar.prototype.setEffectEnabled=function(_5d){
this.setAttribute("effectenabled",isEffectEnabled);
};
nitobi.lang.defineNs("nitobi.calendar");
if(false){
nitobi.calendar={};
}
nitobi.calendar.DatePicker=function(id){
nitobi.calendar.DatePicker.baseConstructor.call(this,id);
this.renderer.setTemplate(nitobi.calendar.datePickerTemplate);
this.blurInput=true;
this.onDateSelected=new nitobi.base.Event();
this.eventMap["dateselected"]=this.onDateSelected;
this.onSetInvalidDate=new nitobi.base.Event();
this.eventMap["setinvaliddate"]=this.onSetInvalidDate;
this.onSetDisabledDate=new nitobi.base.Event();
this.eventMap["setdisableddate"]=this.onSetDisabledDate;
this.onSetOutOfRangeDate=new nitobi.base.Event();
this.eventMap["setoutofrangedate"]=this.onSetOutOfRangeDate;
this.onEventDateSelected=new nitobi.base.Event();
this.eventMap["eventdateselected"]=this.onEventDateSelected;
this.eventsManager=new nitobi.calendar.EventsManager(this.getEventsUrl());
this.eventsManager.onDataReady.subscribe(this.renderChildren,this);
var _5f=this.getSelectedDate();
if(_5f&&!this.isOutOfRange(_5f)&&!nitobi.base.DateMath.invalid(_5f)){
this.setStartDate(nitobi.base.DateMath.getMonthStart(_5f));
}else{
this.setDateAttribute("selecteddate",null);
var _60=this.getMinDate();
var _61;
if(_60){
_61=_60;
}else{
_61=new Date();
}
this.setStartDate(nitobi.base.DateMath.getMonthStart(_61));
}
this.subscribeDeclarationEvents();
};
nitobi.lang.extend(nitobi.calendar.DatePicker,nitobi.ui.Element);
nitobi.base.Registry.getInstance().register(new nitobi.base.Profile("nitobi.calendar.DatePicker",null,false,"ntb:datepicker"));
nitobi.calendar.DatePicker.prototype.render=function(){
var _62=this.getInput();
if(_62){
_62.detachEvents();
}
nitobi.calendar.DatePicker.base.render.call(this);
if(_62){
_62.attachEvents();
}
if(nitobi.browser.IE&&_62){
var _63=_62.getHtmlNode("input");
var _64=nitobi.html.Css.getStyle(_63,"height");
nitobi.html.Css.setStyle(_63,"height",parseInt(_64)-2+"px");
}
if(this.eventsManager){
this.eventsManager.getFromServer();
}else{
this.renderChildren();
}
};
nitobi.calendar.DatePicker.prototype.renderChildren=function(){
var cal=this.getCalendar();
var _66=this.getInput();
if(cal){
cal.render();
if(!_66){
var C=nitobi.html.Css;
var _68=cal.getHtmlNode();
var _69=cal.getHtmlNode("body");
C.swapClass(_68,"nitobi-hide",NTB_CSS_SMALL);
cal.getHtmlNode().style.width=_69.offsetWidth+"px";
C.removeClass(_68,NTB_CSS_SMALL);
}
}
if(this.getSelectedDate()&&_66){
_66.setValue(this.formatDate(this.getSelectedDate(),_66.getDisplayMask()));
}
if(this.getSelectedDate()){
var _6a=this.getHtmlNode("value");
if(_6a){
_6a.value=this.formatDate(this.getSelectedDate(),this.getSubmitMask());
}
}
this.enableButton();
};
nitobi.calendar.DatePicker.prototype.getCalendar=function(){
return this.getObject(nitobi.calendar.Calendar.profile);
};
nitobi.calendar.DatePicker.prototype.getInput=function(){
return this.getObject(nitobi.calendar.DateInput.profile);
};
nitobi.calendar.DatePicker.prototype.getSelectedDate=function(){
return this.getDateAttr("selecteddate");
};
nitobi.calendar.DatePicker.prototype.getDateAttr=function(_6b){
var _6c=this.getAttribute(_6b,null);
if(_6c){
if(typeof (_6c)=="string"){
return this.parseLanguage(_6c);
}else{
return new Date(_6c);
}
}
return null;
};
nitobi.calendar.DatePicker.prototype.setSelectedDate=function(_6d){
if(typeof (_6d)!="object"){
_6d=new Date(_6d);
}
if(this.validate(_6d)){
this._setSelectedDate(_6d);
}
};
nitobi.calendar.DatePicker.prototype._setSelectedDate=function(_6e,_6f){
this.setDateAttribute("selecteddate",_6e);
var _70=this.getHtmlNode("value");
if(_70){
_70.value=this.formatDate(_6e,this.getSubmitMask());
}
var _71=this.getInput();
if(_71){
var _72=_71.getDisplayMask();
var _73=this.formatDate(_6e,_72);
_71.setValue(_73);
_71.setInvalidStyle(false);
}
var _74=this.getCalendar();
if(_74){
_74.clearHighlight(_6e);
var dm=nitobi.base.DateMath;
var _76=dm.getMonthStart(this.getStartDate());
var _77=_74.getMonthColumns()*_74.getMonthRows()-1;
var _78=dm.getMonthEnd(dm.add(dm.clone(_76),"m",_77));
if(dm.between(_6e,_76,_78)){
_74.highlight(_6e);
}
if(_6f){
this.setStartDate(dm.getMonthStart(dm.clone(_6e)));
_74.render();
}
}
var _79=this.getEventsManager();
if(_79.isEvent(_6e)){
var _76=_79.eventsCache[_6e.valueOf()];
var _7a=this.eventsManager.getEventInfo(_76);
this.onEventDateSelected.notify({events:_7a});
}
this.onDateSelected.notify(new nitobi.ui.ElementEventArgs(this,this.onDateSelected));
};
nitobi.calendar.DatePicker.prototype.validate=function(_7b){
var E=nitobi.ui.ElementEventArgs;
if(nitobi.base.DateMath.invalid(_7b)){
this.onSetInvalidDate.notify(new E(this,this.onSetInvalidDate));
return false;
}
if(this.isOutOfRange(_7b)){
this.onSetOutOfRangeDate.notify(new E(this,this.onSetOutOfRangeDate));
return false;
}
if(this.isDisabled(_7b)){
this.onSetDisabledDate.notify(new E(this,this.onSetDisabledDate));
return false;
}
return true;
};
nitobi.calendar.DatePicker.prototype.isDisabled=function(_7d){
return this.getEventsManager().isDisabled(_7d);
};
nitobi.calendar.DatePicker.prototype.disableButton=function(){
var _7e=this.getHtmlNode("button");
var cal=this.getCalendar();
if(_7e){
nitobi.html.Css.swapClass(_7e,"ntb-calendar-button","ntb-calendar-button-disabled");
nitobi.html.detachEvent(_7e,"click",cal.handleToggleClick,cal);
}
};
nitobi.calendar.DatePicker.prototype.enableButton=function(){
var _80=this.getHtmlNode("button");
var cal=this.getCalendar();
if(_80){
nitobi.html.Css.swapClass(_80,"ntb-calendar-button-disabled","ntb-calendar-button");
nitobi.html.attachEvent(_80,"click",cal.handleToggleClick,cal);
}
};
nitobi.calendar.DatePicker.prototype.isOutOfRange=function(_82){
var dm=nitobi.base.DateMath;
var _84=this.getMinDate();
var _85=this.getMaxDate();
var _86=false;
if(_84&&_85){
_86=!dm.between(_82,_84,_85);
}else{
if(_84&&_85==null){
_86=dm.before(_82,_84);
}else{
if(_84==null&&_85){
_86=dm.after(_82,_85);
}
}
}
return _86;
};
nitobi.calendar.DatePicker.prototype.clear=function(){
var _87=this.getHtmlNode("value");
if(_87){
_87.value="";
}
this.setDateAttribute("selecteddate",null);
};
nitobi.calendar.DatePicker.prototype.getTheme=function(){
return this.getAttribute("theme","");
};
nitobi.calendar.DatePicker.prototype.getSubmitMask=function(){
return this.getAttribute("submitmask","yyyy-MM-dd");
};
nitobi.calendar.DatePicker.prototype.setSubmitMask=function(_88){
this.setAttribute("submitmask",_88);
};
nitobi.calendar.DatePicker.prototype.getStartDate=function(){
return this.getDateAttribute("startdate");
};
nitobi.calendar.DatePicker.prototype.setStartDate=function(_89){
this.setDateAttribute("startdate",_89);
};
nitobi.calendar.DatePicker.prototype.getEventsUrl=function(){
return this.getAttribute("eventsurl","");
};
nitobi.calendar.DatePicker.prototype.setEventsUrl=function(url){
this.setAttribute("eventsurl",url);
};
nitobi.calendar.DatePicker.prototype.getEventsManager=function(){
return this.eventsManager;
};
nitobi.calendar.DatePicker.prototype.isShimEnabled=function(){
return this.getBoolAttribute("shimenabled",false);
};
nitobi.calendar.DatePicker.prototype.getMinDate=function(){
return this.getDateAttr("mindate");
};
nitobi.calendar.DatePicker.prototype.setMinDate=function(_8b){
this.setAttribute("mindate",_8b);
};
nitobi.calendar.DatePicker.prototype.getMaxDate=function(){
return this.getDateAttr("maxdate");
};
nitobi.calendar.DatePicker.prototype.setMaxDate=function(_8c){
this.setAttribute("maxdate",_8c);
};
nitobi.calendar.DatePicker.prototype.parseLanguage=function(_8d){
var dm=nitobi.base.DateMath;
var _8f=Date.parse(_8d);
if(_8f&&typeof (_8f)=="object"&&!isNaN(_8f)&&!dm.invalid(_8f)){
return _8f;
}
if(_8d==""||_8d==null){
return null;
}
_8d=_8d.toLowerCase();
var _90=dm.resetTime(new Date());
switch(_8d){
case "today":
_8d=_90;
break;
case "tomorrow":
_8d=dm.add(_90,"d",1);
break;
case "yesterday":
_8d=dm.subtract(_90,"d",1);
break;
case "last week":
_8d=dm.subtract(_90,"d",7);
break;
case "next week":
_8d=dm.add(_90,"d",7);
break;
case "last year":
_8d=dm.subtract(_90,"y",1);
break;
case "last month":
_8d=dm.subtract(_90,"m",1);
break;
case "next month":
_8d=dm.add(_90,"m",1);
break;
case "next year":
_8d=dm.add(_90,"y",1);
break;
default:
_8d=dm.resetTime(new Date(_8d));
break;
}
if(dm.invalid(_8d)){
return null;
}else{
return _8d;
}
};
nitobi.calendar.DatePicker.longDayNames=["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
nitobi.calendar.DatePicker.shortDayNames=["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];
nitobi.calendar.DatePicker.minDayNames=["S","M","T","W","T","F","S"];
nitobi.calendar.DatePicker.longMonthNames=["January","February","March","April","May","June","July","August","September","October","November","December"];
nitobi.calendar.DatePicker.shortMonthNames=["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
nitobi.calendar.DatePicker.navConfirmText="OK";
nitobi.calendar.DatePicker.navCancelText="Cancel";
nitobi.calendar.DatePicker.navOutOfRangeText="That date is out of range.";
nitobi.calendar.DatePicker.navInvalidYearText="You must enter a valid year.";
nitobi.calendar.DatePicker.quickNavTooltip="Click to change month and/or year";
nitobi.calendar.DatePicker.navSelectMonthText="Choose Month";
nitobi.calendar.DatePicker.navSelectYearText="Enter Year";
nitobi.calendar.DatePicker.prototype.getQuickNavTooltip=function(){
return this.initLocaleAttr("quickNavTooltip");
};
nitobi.calendar.DatePicker.prototype.getMinDayNames=function(){
return this.initJsAttr("minDayNames");
};
nitobi.calendar.DatePicker.prototype.getLongDayNames=function(){
return this.initJsAttr("longDayNames");
};
nitobi.calendar.DatePicker.prototype.getShortDayNames=function(){
return this.initJsAttr("shortDayNames");
};
nitobi.calendar.DatePicker.prototype.getLongMonthNames=function(){
return this.initJsAttr("longMonthNames");
};
nitobi.calendar.DatePicker.prototype.getShortMonthNames=function(){
return this.initJsAttr("shortMonthNames");
};
nitobi.calendar.DatePicker.prototype.getNavConfirmText=function(){
return this.initLocaleAttr("navConfirmText");
};
nitobi.calendar.DatePicker.prototype.getNavCancelText=function(){
return this.initLocaleAttr("navCancelText");
};
nitobi.calendar.DatePicker.prototype.getNavOutOfRangeText=function(){
return this.initLocaleAttr("navOutOfRangeText");
};
nitobi.calendar.DatePicker.prototype.getNavInvalidYearText=function(){
return this.initLocaleAttr("navInvalidYearText");
};
nitobi.calendar.DatePicker.prototype.getNavSelectMonthText=function(){
return this.initLocaleAttr("navSelectMonthText");
};
nitobi.calendar.DatePicker.prototype.getNavSelectYearText=function(){
return this.initLocaleAttr("navSelectYearText");
};
nitobi.calendar.DatePicker.prototype.initJsAttr=function(_91){
if(this[_91]){
return this[_91];
}
var _92=this.getAttribute(_91.toLowerCase(),"");
if(_92!=""){
_92=eval("("+_92+")");
return this[_91]=_92;
}
return this[_91]=nitobi.calendar.DatePicker[_91];
};
nitobi.calendar.DatePicker.prototype.initLocaleAttr=function(_93){
if(this[_93]){
return this[_93];
}
var _94=this.getAttribute(_93.toLowerCase(),"");
if(_94!=""){
return this[_93]=_94;
}else{
return this[_93]=nitobi.calendar.DatePicker[_93];
}
};
nitobi.calendar.DatePicker.prototype.parseDate=function(_95,_96){
var _97={};
while(_96.length>0){
var c=_96.charAt(0);
var _99=new RegExp(c+"+");
var _9a=_99.exec(_96)[0];
if(c!="d"&&c!="y"&&c!="M"&&c!="N"&&c!="E"){
_96=_96.substring(_9a.length);
_95=_95.substring(_9a.length);
}else{
var _9b=_96.charAt(_9a.length);
var _9c=(_9b==""?_95:_95.substring(0,_95.indexOf(_9b)));
var _9d=this.validateFormat(_9c,_9a);
if(_9d.valid){
_97[_9d.unit]=_9d.value;
}else{
return null;
}
_96=_96.substring(_9a.length);
_95=_95.substring(_9c.length);
}
}
var _95=new Date(_97.y,_97.m,_97.d);
return _95;
};
nitobi.calendar.DatePicker.prototype.validateFormat=function(_9e,_9f){
var _a0={valid:false,unit:"",value:""};
switch(_9f){
case "d":
case "dd":
var _a1=parseInt(_9e);
var _a2;
if(_9f=="d"){
_a2=!isNaN(_9e)&&_9e.charAt(0)!="0"&&_9e.length<=2;
}else{
_a2=!isNaN(_9e)&&_9e.length==2;
}
if(_a2){
_a0.valid=true;
_a0.unit="d";
_a0.value=_9e;
}else{
_a0.valid=false;
}
break;
case "y":
case "yyyy":
if(isNaN(_9e)){
_a0.valid=false;
}else{
_a0.valid=true;
_a0.unit="y";
_a0.value=_9e;
}
break;
case "M":
case "MM":
var _a1=parseInt(_9e,10);
var _a2;
if(_9f=="M"){
_a2=!isNaN(_9e)&&_9e.charAt(0)!="0"&&_9e.length<=2&&_a1>=1&&_a1<=12;
}else{
_a2=!isNaN(_9e)&_9e.length==2&&_a1>=1&&_a1<=12;
}
if(_a2){
_a0.valid=true;
_a0.unit="m";
_a0.value=_a1-1;
}else{
_a0.valid=false;
}
break;
case "MMM":
case "NNN":
case "E":
case "EE":
var _a3;
if(_9f=="MMM"){
_a3=this.getLongMonthNames();
}else{
if(_9f=="NNN"){
_a3=this.getShortMonthNames();
}else{
if(_9f=="E"){
_a3=this.getShortDayNames();
}else{
_a3=this.getLongDayNames();
}
}
}
var i;
for(i=0;i<_a3.length;i++){
var _a5=_a3[i];
if(_9e.toLowerCase()==_a5.toLowerCase()){
break;
}
}
if(i<_a3.length){
_a0.valid=true;
if(_9f=="MMM"||_9f=="NNN"){
_a0.unit="m";
}else{
_a0.unit="dl";
}
_a0.value=i;
}else{
_a0.valid=false;
}
break;
}
return _a0;
};
nitobi.calendar.DatePicker.prototype.formatDate=function(_a6,_a7){
var _a8={};
var _a9=_a6.getFullYear()+"";
var _aa=_a6.getMonth()+1+"";
var _ab=_a6.getDate()+"";
var day=_a6.getDay();
_a8["y"]=_a8["yyyy"]=_a9;
_a8["yy"]=_a9.substring(2,4);
_a8["M"]=_aa+"";
_a8["MM"]=nitobi.lang.padZeros(_aa,2);
_a8["MMM"]=this.getLongMonthNames()[_aa-1];
_a8["NNN"]=this.getShortMonthNames()[_aa-1];
_a8["d"]=_ab;
_a8["dd"]=nitobi.lang.padZeros(_ab,2);
_a8["EE"]=this.getLongDayNames()[day];
_a8["E"]=this.getShortDayNames()[day];
var _ad="";
while(_a7.length>0){
var c=_a7.charAt(0);
var _af=new RegExp(c+"+");
var _b0=_af.exec(_a7)[0];
_ad+=_a8[_b0]||_b0;
_a7=_a7.substring(_b0.length);
}
return _ad;
};
nitobi.lang.defineNs("nitobi.calendar");
nitobi.calendar.DateInput=function(_b1){
nitobi.calendar.DateInput.baseConstructor.call(this,_b1);
this.onBlur=new nitobi.base.Event();
this.eventMap["blur"]=this.onBlur;
this.onFocus=new nitobi.base.Event();
this.eventMap["focus"]=this.onFocus;
this.htmlEvents=[];
this.subscribeDeclarationEvents();
};
nitobi.lang.extend(nitobi.calendar.DateInput,nitobi.ui.Element);
nitobi.calendar.DateInput.profile=new nitobi.base.Profile("nitobi.calendar.DateInput",null,false,"ntb:dateinput");
nitobi.base.Registry.getInstance().register(nitobi.calendar.DateInput.profile);
nitobi.calendar.DateInput.prototype.attachEvents=function(){
var he=this.htmlEvents;
he.push({type:"focus",handler:this.handleOnFocus});
he.push({type:"blur",handler:this.handleOnBlur});
he.push({type:"keydown",handler:this.handleOnKeyDown});
nitobi.html.attachEvents(this.getHtmlNode("input"),he,this);
};
nitobi.calendar.DateInput.prototype.detachEvents=function(){
nitobi.html.detachEvents(this.getHtmlNode("input"),this.htmlEvents);
};
nitobi.calendar.DateInput.prototype.setValue=function(_b3){
var _b4=this.getHtmlNode("input");
_b4.value=_b3;
};
nitobi.calendar.DateInput.prototype.getValue=function(){
var _b5=this.getHtmlNode("input");
return _b5.value;
};
nitobi.calendar.DateInput.prototype.handleOnFocus=function(){
var _b6=this.getEditMask();
var _b7=this.getParentObject();
var _b8=_b7.getSelectedDate();
if(_b8){
var _b9=_b7.formatDate(_b8,_b6);
this.setValue(_b9);
var _b7=this.getParentObject();
_b7.blurInput=true;
}
this.onFocus.notify(new nitobi.ui.ElementEventArgs(this,this.onFocus));
};
nitobi.calendar.DateInput.prototype.handleOnBlur=function(){
var _ba=this.getParentObject();
var _bb=_ba.getCalendar();
if(_ba.blurInput){
var _bc=this.getEditMask();
var _bd=this.getValue();
_bd=_ba.parseDate(_bd,_bc);
if(_ba.validate(_bd)){
_ba._setSelectedDate(_bd,true);
if(_bb){
_bb.hide();
}
}else{
if(_bb){
_bb.clearHighlight();
}
_ba.clear();
this.setInvalidStyle(true);
}
}
this.onBlur.notify(new nitobi.ui.ElementEventArgs(this,this.onBlur));
};
nitobi.calendar.DateInput.prototype.handleOnKeyDown=function(_be){
var key=_be.keyCode;
if(key==13){
this.getHtmlNode("input").blur();
}
};
nitobi.calendar.DateInput.prototype.setInvalidStyle=function(_c0){
var Css=nitobi.html.Css;
var _c2=this.getHtmlNode("container");
if(_c0){
Css.swapClass(_c2,"ntb-inputcontainer","ntb-invalid");
}else{
Css.swapClass(this.getHtmlNode("container"),"ntb-invalid","ntb-inputcontainer");
}
var _c3=Css.getStyle(_c2,"backgroundColor");
var _c4=this.getHtmlNode("input");
Css.setStyle(_c4,"backgroundColor",_c3);
};
nitobi.calendar.DateInput.prototype.getEditMask=function(){
return this.getAttribute("editmask",this.getDisplayMask());
};
nitobi.calendar.DateInput.prototype.setEditMask=function(_c5){
this.setAttribute("editmask",_c5);
};
nitobi.calendar.DateInput.prototype.getDisplayMask=function(){
return this.getAttribute("displaymask","MMM dd yyyy");
};
nitobi.calendar.DateInput.prototype.setDisplayMask=function(_c6){
this.setAttribute("displaymask",_c6);
};
nitobi.calendar.DateInput.prototype.isEditable=function(){
this.getBoolAttribute("editable",true);
};
nitobi.calendar.DateInput.prototype.setEditable=function(dis){
this.setBoolAttribute("editable",dis);
this.getHtmlNode("input").disabled=dis;
};
nitobi.calendar.DateInput.prototype.getWidth=function(){
this.getIntAttribute("width");
};
nitobi.calendar.DateInput.prototype.setWidth=function(_c8){
this.setAttribute("width",_c8);
};
nitobi.lang.defineNs("nitobi.calendar");
nitobi.calendar.CalRenderer=function(){
nitobi.html.IRenderer.call(this);
};
nitobi.lang.implement(nitobi.calendar.CalRenderer,nitobi.html.IRenderer);
nitobi.calendar.CalRenderer.prototype.renderToString=function(_c9){
var _ca=_c9.getParentObject();
var _cb=_ca.getEventsManager();
var dm=nitobi.base.DateMath;
var sb=new nitobi.lang.StringBuilder();
var id=_c9.getId();
var _cf=_c9.getMonthColumns();
var _d0=_c9.getMonthRows();
var _d1=_cf>1||_d0>1;
var _d2=dm.resetTime(dm.clone(_ca.getStartDate()));
var _d3=_ca.getSelectedDate();
if(_d3!=null){
_d3=dm.resetTime(_ca.getSelectedDate());
}
var _d4=dm.resetTime(new Date());
var _d5=_ca.getMinDate();
var _d6=_ca.getMaxDate();
var _d7=dm.subtract(dm.clone(_d2),"d",1);
var _d8=dm.add(dm.clone(_d2),"m",_cf*_d0);
_ca.disPrev=(_d5&&dm.before(_d7,_d5)?true:false);
_ca.disNext=(_d6&&dm.after(_d8,_d6)?true:false);
var _d9=_ca.getLongMonthNames();
var _da=_ca.getLongDayNames();
var _db=_ca.getMinDayNames();
var _dc=_ca.getQuickNavTooltip();
var _dd=(((nitobi.browser.MOZ&&!document.getElementsByClassName&&navigator.platform.indexOf("Mac")>=0)||nitobi.browser.IE6)&&_ca.isShimEnabled())?true:false;
if(_dd){
sb.append("<iframe id=\""+id+".shim\" style='position:absolute;top:0px;z-index:19999;'><!-- dummy --></iframe>");
}
sb.append("<div id=\""+id+".calendar\" style=\""+(_dd?"position:relative;z-index:20000;":"")+"\">");
sb.append("<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tbody>");
if(_d1){
sb.append("<tr id=\""+id+".header\"><td>");
var _de=_d9[_d2.getMonth()];
var _df=_d2.getFullYear();
var _e0=dm.add(dm.clone(_d2),"m",(_cf*_d0)-1);
var _e1=_d9[_e0.getMonth()];
var _e2=_e0.getFullYear();
sb.append("<div class=\"ntb-calendar-header\">");
sb.append("<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" style=\"height:100%;width:100%;\"><tbody>");
sb.append("<tr><td><a id=\""+id+".prevmonth\" onclick=\"return false;\" href=\"#\" class=\"ntb-calendar-prev"+(_ca.disPrev?" ntb-calendar-prevdis":"")+"\"></a</td>");
sb.append("<td style=\"width:70%;\"><span class=\"ntb-calendar-title\" title=\""+_dc+"\" id=\""+id+".nav\">"+_de+" "+_df+" - "+_e1+" "+_e2+"</span></td>");
sb.append("<td><a id=\""+id+".nextmonth\" onclick=\"return false;\" href=\"#\" class=\"ntb-calendar-next"+(_ca.disNext?" ntb-calendar-nextdis":"")+"\"></a></td></tr>");
sb.append("</tbody></table></div></td></tr>");
}
sb.append("<tr id=\""+id+".body\"><td>");
sb.append("<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\"><tbody>");
for(var i=0;i<_d0;i++){
sb.append("<tr>");
for(var j=0;j<_cf;j++){
var _e5=dm.subtract(dm.clone(_d2),"d",_d2.getDay());
var _e6=_d2.getMonth();
var _e7=_d2.getFullYear();
sb.append("<td>");
sb.append("<div class=\"ntb-calendar\">");
sb.append("<div><table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" style=\"width:100%;\"><tbody>");
sb.append("<tr class=\"ntb-calendar-monthheader\">");
if(!_d1){
sb.append("<td><a id=\""+id+".prevmonth\" onclick=\"return false;\" href=\"#\" class=\"ntb-calendar-prev"+(_ca.disPrev?" ntb-calendar-prevdis":"")+"\"></a></td>");
}
sb.append("<td style=\"width:70%;\"><span title=\""+_dc+"\" "+(!_d1?"id=\""+id+".nav\"":"")+"><a onclick=\"return false;\" href=\"#\" style=\""+(_d1?"cursor:default;":"")+"\" class=\"ntb-calendar-month\">"+_d9[_e6]+"</a>");
sb.append("<a onclick=\"return false;\" href=\"#\" style=\""+(_d1?"cursor:default;":"")+"\" class=\"ntb-calendar-year\">"+" "+_e7+"</a></span></td>");
if(!_d1){
sb.append("<td><a id=\""+id+".nextmonth\" onclick=\"return false;\" href=\"#\" class=\"ntb-calendar-next"+(_ca.disNext?" ntb-calendar-nextdis":"")+"\"></a></td>");
}
sb.append("</tbody></table></div>");
sb.append("<div><table id=\""+id+"."+_e6+"."+_e7+"\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" style=\"width: 100%;\"><tbody>");
sb.append("<tr>");
for(var k=0;k<7;k++){
sb.append("<th class=\"ntb-calendar-dayheader\">"+_db[k]+"</th>");
}
sb.append("</tr>");
for(var m=0;m<6;m++){
sb.append("<tr>");
for(var n=0;n<7;n++){
sb.append("<td>");
var _eb=_da[_e5.getDay()]+", "+_d9[_e5.getMonth()]+" "+_e5.getDate()+", "+_e5.getFullYear();
var _ec=null;
var _ed="";
if(_cb&&_e5.getMonth()==_d2.getMonth()){
var _ec=_cb.dates.events[_e5.valueOf()];
if(_ec!=null){
var nt="";
for(var p=0;p<_ec.length;p++){
if(_ec[p].tooltip!=null){
nt+=_ec[p].tooltip+"\n";
}else{
if(_ec[p].location!=null){
nt+=_ec[p].location+"\n";
if(_ec[p].description!=null){
nt+=_ec[p].description;
}
}
}
if(_ec[p].cssStyle!=null){
_ed+=_ec[p].cssStyle;
}
}
if(nt.length!=0){
_eb=nt;
}
}
}
sb.append("<a ebatype=\"date\" ebamonth=\""+_e5.getMonth()+"\" ebadate=\""+_e5.getDate()+"\" ebayear=\""+_e5.getFullYear()+"\" title=\""+_eb+"\" href=\"#\" onclick=\"return false;\" style=\"display:block;text-decoration:none;"+_ed+"\" class=\"");
if(_d3&&_e5.valueOf()==_d3.valueOf()&&_e5.getMonth()==_d2.getMonth()){
sb.append("ntb-calendar-currentday ");
}
if(_e5.getMonth()<_d2.getMonth()||(_d5&&_e5.valueOf()<_d5.valueOf())){
sb.append("ntb-calendar-lastmonth ");
}else{
if(_e5.getMonth()>_d2.getMonth()||(_d6&&_e5.valueOf()>_d6.valueOf())){
sb.append("ntb-calendar-nextmonth ");
}else{
if(_e5.getMonth()==_d2.getMonth()){
sb.append("ntb-calendar-thismonth ");
}
}
}
if(_cb&&_cb.isDisabled(_e5)&&_e5.getMonth()==_d2.getMonth()){
sb.append("ntb-calendar-disabled ");
}else{
if(_cb&&_cb.isEvent(_e5)&&_e5.getMonth()==_d2.getMonth()){
sb.append("ntb-calendar-event ");
}
}
if(_d4.valueOf()==_e5.valueOf()){
sb.append("ntb-calendar-today");
}
sb.append(" ntb-calendar-day");
if(_ec!=null){
for(var p=0;p<_ec.length;p++){
if(_ec[p].cssClass!=null){
sb.append(" "+_ec[p].cssClass+" ");
}
}
}
sb.append("\">"+_e5.getDate()+"</a></td>");
_e5=dm.add(_e5,"d",1);
}
sb.append("</tr>");
}
sb.append("</tbody></table></div></div></td>");
_d2=dm.resetTime(dm.add(_d2,"m",1));
}
sb.append("</tr>");
}
sb.append("</tbody></table></td></tr></tbody></table></div></div>");
sb.append("</tbody><colgroup span=\"7\" style=\"width:17%\"></colgroup></table></div>");
sb.append("<div id=\""+id+".overlay\" class=\"ntb-calendar-overlay\" style=\""+(_dd?"z-index:20001;":"")+"top:0px;left:0px;display:none;position:absolute;background-color:gray;filter:alpha(opacity=40);-moz-opacity:.50;opacity:.50;\"></div>");
sb.append(this.renderNavPanel(_c9));
sb.append("</div></div>");
return sb.toString();
};
nitobi.calendar.CalRenderer.prototype.renderNavPanel=function(_f0){
var sb=new nitobi.lang.StringBuilder();
var _f2=_f0.getParentObject();
var _f3=_f2.getLongMonthNames();
var id=_f0.getId();
var _f5=(nitobi.browser.MOZ&&!nitobi.browser.MOZ3)||(nitobi.browser.IE6&&!nitobi.browser.IE7)?true:false;
sb.append("<div id=\""+id+".navpanel\" style=\""+(_f5?"z-index:20002;":"")+"position:absolute;top:0px;left:0px;overflow:hidden;\" class=\"ntb-calendar-navcontainer nitobi-hide\">");
sb.append("<div class=\"ntb-calendar-monthcontainer\">");
sb.append("<label style=\"display:block;\" for=\""+id+".months\">"+_f2.getNavSelectMonthText()+"</label>");
sb.append("<select id=\""+id+".months\" class=\"ntb-calendar-navms\" style=\"\" tabindex=\"1\">");
for(var i=0;i<_f3.length;i++){
sb.append("<option value=\""+i+"\">"+_f3[i]+"</option>");
}
sb.append("</select>");
sb.append("</div>");
sb.append("<div class=\"ntb-calendar-yearcontainer\">");
sb.append("<label style=\"display:block;\" for=\""+id+".year\">"+_f2.getNavSelectYearText()+"</label>");
sb.append("<input size=\"4\" maxlength=\"4\" id=\""+id+".year\" class=\"ntb-calendar-navinput\" style=\"-moz-user-select: normal;\" tabindex=\"2\"/>");
sb.append("</div>");
sb.append("<div class=\"ntb-calendar-controls\">");
sb.append("<button id=\""+id+".navconfirm\" type=\"button\">"+_f2.getNavConfirmText()+"</button>");
sb.append("<button id=\""+id+".navcancel\" type=\"button\">"+_f2.getNavCancelText()+"</button>");
sb.append("</div>");
sb.append("<div id=\""+id+".warning\" style=\"display:none;\" class=\"ntb-calendar-navwarning\">You must enter a valid year.</div>");
sb.append("</div>");
return sb.toString();
};
nitobi.lang.defineNs("nitobi.calendar");
nitobi.calendar.EventsManager=function(url){
this.connector=new nitobi.data.UrlConnector(url);
this.onDataReady=new nitobi.base.Event();
this.dates={events:{},disabled:{}};
this.eventsCache={};
this.disabledCache={};
};
nitobi.calendar.EventsManager.prototype.isEvent=function(_f8){
return (this.eventsCache[_f8.valueOf()]?true:false);
};
nitobi.calendar.EventsManager.prototype.isDisabled=function(_f9){
return (this.disabledCache[_f9.valueOf()]?true:false);
};
nitobi.calendar.EventsManager.prototype.getFromServer=function(){
if(this.connector.url!=null){
this.connector.get({},nitobi.lang.close(this,this.getComplete));
}else{
this.onDataReady.notify();
}
};
nitobi.calendar.EventsManager.prototype.getComplete=function(_fa){
var _fb=_fa.result;
var dm=nitobi.base.DateMath;
var _fd=_fb.documentElement;
var _fe=nitobi.xml.getChildNodes(_fd);
for(var i=0;i<_fe.length;i++){
var _100=_fe[i];
var type=_100.getAttribute("e");
var _102={};
if(type=="event"){
var _103=_100.getAttribute("a");
_103=dm.parseIso8601(_103);
_102.startDate=_103;
var _104=_100.getAttribute("b");
if(_104){
_104=dm.parseIso8601(_104);
}else{
_104=null;
}
_102.endDate=_104;
_102.location=_100.getAttribute("c");
_102.description=_100.getAttribute("d");
_102.tooltip=_100.getAttribute("f");
_102.cssClass=_100.getAttribute("g");
_102.cssStyle=_100.getAttribute("h");
var _105=this.dates.events[dm.resetTime(dm.clone(_103)).valueOf()];
if(_105){
_105.push(_102);
}else{
_105=[_102];
this.dates.events[dm.resetTime(dm.clone(_103)).valueOf()]=_105;
}
this.addEventDate(_103,_104);
}else{
var _103=dm.parseIso8601(_100.getAttribute("a"));
_102.date=_103;
this.addDisabledDate(dm.clone(_103));
}
}
this.onDataReady.notify();
};
nitobi.calendar.EventsManager.prototype.addEventDate=function(_106,end){
var dm=nitobi.base.DateMath;
var _109=dm.clone(_106);
_109=dm.resetTime(_109);
if(!end){
return this.eventsCache[_109.valueOf()]=_106;
}
end=dm.clone(end);
end=dm.resetTime(end);
while(_109.valueOf()<=end.valueOf()){
this.eventsCache[_109.valueOf()]=_106;
_109=dm.add(_109,"d",1);
}
};
nitobi.calendar.EventsManager.prototype.addDisabledDate=function(date){
date=nitobi.base.DateMath.resetTime(date);
return this.disabledCache[date.valueOf()]=true;
};
nitobi.calendar.EventsManager.prototype.getEventInfo=function(date){
var dm=nitobi.base.DateMath;
var _10d=this.dates.events;
date=dm.resetTime(date);
return _10d[date.valueOf()];
};


var temp_ntb_datePickerTemplate='<?xml version="1.0"?><xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:ntb="http://www.nitobi.com"> <xsl:output method="xml" omit-xml-declaration="yes" /> <xsl:strip-space elements="*"/> <x:t- match="ntb:datepicker"> <div id="{@id}"> <x:a-x:n-class"> ntb-calendar-reset <x:v-x:s-@theme"/> </x:a-> <x:at-x:s-ntb:dateinput"/> <xsl:if test="ntb:calendar and ntb:dateinput"> <div id="{@id}.button" style="float:left;" class="ntb-calendar-button"> <x:ct-x:n-dummy"></x:ct-> </div> </xsl:if> <div style="display:block;clear:both;float:none;height:0px;width:auto;overflow:hidden;"><xsl:comment>dummy</xsl:comment></div> <x:at-x:s-ntb:calendar"/> <input id="{@id}.value" type="hidden" value=""x:n-{@id}"/> </div> </x:t-> <x:t- match="ntb:dateinput"> <x:va-x:n-width"> <x:c-> <x:wh- test="contains(@width, \'px\')"> <x:v-x:s-substring-before(@width, \'px\')"/> </x:wh-> <x:o-> <x:v-x:s-@width" /> </x:o-> </x:c-> </x:va-> <div id="{@id}" style="float:left;"> <div id="{@id}.container" class="ntb-inputcontainer"> <x:a-x:n-style"> <xsl:if test="@width">width:<x:v-x:s-$width"/>px;</xsl:if> </x:a-> <input id="{@id}.input" type="text" class="ntb-dateinput"> <x:a-x:n-style"> font-size:100%;<xsl:if test="@cssstyle"><x:v-x:s-@cssstyle"/></xsl:if>; <xsl:if test="@width">width: <x:v-x:s-number($width) - 10"/>px;</xsl:if> </x:a-> <xsl:if test="@editable = \'false\'"> <x:a-x:n-disabled">true</x:a-> </xsl:if> </input> </div> </div> </x:t-> <x:t- match="ntb:calendar"> <div id="{@id}" onselectstart="return false;"> <x:a-x:n-style"> <xsl:if test="../ntb:dateinput">position:absolute;z-index:1000;</xsl:if>overflow:hidden; </x:a-> <x:a-x:n-class"> ntb-calendar-container nitobi-hide </x:a-> <x:ct-x:n-dummy"/> </div> </x:t-> <x:t-x:n-dummy"> <xsl:comment>dummy</xsl:comment> </x:t-></xsl:stylesheet>';
nitobi.lang.defineNs("nitobi.calendar");
nitobi.calendar.datePickerTemplate = nitobi.xml.createXslProcessor(nitobiXmlDecodeXslt(temp_ntb_datePickerTemplate));


