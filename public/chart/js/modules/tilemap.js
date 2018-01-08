/*
  Highcharts JS v6.0.4 (2017-12-15)
 Tilemap module

 (c) 2010-2017 Highsoft AS

 License: www.highcharts.com/license
*/
(function(g){"object"===typeof module&&module.exports?module.exports=g:g(Highcharts)})(function(g){(function(d){var g=d.defined,v=d.each,y=d.noop;d.colorPointMixin={isValid:function(){return null!==this.value&&Infinity!==this.value&&-Infinity!==this.value},setVisible:function(d){var e=this,r=d?"show":"hide";v(["graphic","dataLabel"],function(a){if(e[a])e[a][r]()})},setState:function(r){d.Point.prototype.setState.call(this,r);this.graphic&&this.graphic.attr({zIndex:"hover"===r?1:0})}};d.colorSeriesMixin=
{pointArrayMap:["value"],axisTypes:["xAxis","yAxis","colorAxis"],optionalAxis:"colorAxis",trackerGroups:["group","markerGroup","dataLabelsGroup"],getSymbol:y,parallelArrays:["x","y","value"],colorKey:"value",translateColors:function(){var d=this,e=this.options.nullColor,w=this.colorAxis,a=this.colorKey;v(this.data,function(b){var c=b[a];if(c=b.options.color||(b.isNull?e:w&&void 0!==c?w.toColor(c,b):b.color||d.color))b.color=c})},colorAttribs:function(d){var e={};g(d.color)&&(e[this.colorProp||"fill"]=
d.color);return e}}})(g);(function(d){var g=d.colorPointMixin,v=d.each,y=d.merge,r=d.noop,e=d.pick,w=d.Series,a=d.seriesType,b=d.seriesTypes;a("heatmap","scatter",{animation:!1,borderWidth:0,dataLabels:{formatter:function(){return this.point.value},inside:!0,verticalAlign:"middle",crop:!1,overflow:!1,padding:0},marker:null,pointRange:null,tooltip:{pointFormat:"{point.x}, {point.y}: {point.value}\x3cbr/\x3e"},states:{normal:{animation:!0},hover:{halo:!1,brightness:.2}}},y(d.colorSeriesMixin,{pointArrayMap:["y",
"value"],hasPointSpecificOptions:!0,getExtremesFromAll:!0,directTouch:!0,init:function(){var c;b.scatter.prototype.init.apply(this,arguments);c=this.options;c.pointRange=e(c.pointRange,c.colsize||1);this.yAxis.axisPointRange=c.rowsize||1},translate:function(){var b=this.options,a=this.xAxis,d=this.yAxis,x=b.pointPadding||0,k=function(b,a,c){return Math.min(Math.max(a,b),c)};this.generatePoints();v(this.points,function(c){var f=(b.colsize||1)/2,h=(b.rowsize||1)/2,l=k(Math.round(a.len-a.translate(c.x-
f,0,1,0,1)),-a.len,2*a.len),f=k(Math.round(a.len-a.translate(c.x+f,0,1,0,1)),-a.len,2*a.len),t=k(Math.round(d.translate(c.y-h,0,1,0,1)),-d.len,2*d.len),h=k(Math.round(d.translate(c.y+h,0,1,0,1)),-d.len,2*d.len),m=e(c.pointPadding,x);c.plotX=c.clientX=(l+f)/2;c.plotY=(t+h)/2;c.shapeType="rect";c.shapeArgs={x:Math.min(l,f)+m,y:Math.min(t,h)+m,width:Math.abs(f-l)-2*m,height:Math.abs(h-t)-2*m}});this.translateColors()},drawPoints:function(){b.column.prototype.drawPoints.call(this);v(this.points,function(b){b.graphic.css(this.colorAttribs(b))},
this)},animate:r,getBox:r,drawLegendSymbol:d.LegendSymbolMixin.drawRectangle,alignDataLabel:b.column.prototype.alignDataLabel,getExtremes:function(){w.prototype.getExtremes.call(this,this.valueData);this.valueMin=this.dataMin;this.valueMax=this.dataMax;w.prototype.getExtremes.call(this)}}),d.extend({haloPath:function(b){if(!b)return[];var a=this.shapeArgs;return["M",a.x-b,a.y-b,"L",a.x-b,a.y+a.height+b,a.x+a.width+b,a.y+a.height+b,a.x+a.width+b,a.y-b,"Z"]}},g))})(g);(function(d){var g=d.seriesType,
v=d.each,y=d.reduce,r=d.pick,e=function(a,b,c){return Math.min(Math.max(b,a),c)},w=function(a,b,c){a=a.options;return{xPad:(a.colsize||1)/-b,yPad:(a.rowsize||1)/-c}};d.tileShapeTypes={hexagon:{alignDataLabel:d.seriesTypes.scatter.prototype.alignDataLabel,getSeriesPadding:function(a){return w(a,3,2)},haloPath:function(a){if(!a)return[];var b=this.tileEdges;return["M",b.x2-a,b.y1+a,"L",b.x3+a,b.y1+a,b.x4+1.5*a,b.y2,b.x3+a,b.y3-a,b.x2-a,b.y3-a,b.x1-1.5*a,b.y2,"Z"]},translate:function(){var a=this.options,
b=this.xAxis,c=this.yAxis,d=a.pointPadding||0,z=(a.colsize||1)/3,x=(a.rowsize||1)/2,k;this.generatePoints();v(this.points,function(a){var f=e(Math.floor(b.len-b.translate(a.x-2*z,0,1,0,1)),-b.len,2*b.len),u=e(Math.floor(b.len-b.translate(a.x-z,0,1,0,1)),-b.len,2*b.len),l=e(Math.floor(b.len-b.translate(a.x+z,0,1,0,1)),-b.len,2*b.len),t=e(Math.floor(b.len-b.translate(a.x+2*z,0,1,0,1)),-b.len,2*b.len),m=e(Math.floor(c.translate(a.y-x,0,1,0,1)),-c.len,2*c.len),n=e(Math.floor(c.translate(a.y,0,1,0,1)),
-c.len,2*c.len),p=e(Math.floor(c.translate(a.y+x,0,1,0,1)),-c.len,2*c.len),q=r(a.pointPadding,d),h=q*Math.abs(u-f)/Math.abs(p-n),h=b.reversed?-h:h,g=b.reversed?-q:q,q=c.reversed?-q:q;a.x%2&&(k=k||Math.round(Math.abs(p-m)/2)*(c.reversed?-1:1),m+=k,n+=k,p+=k);a.plotX=a.clientX=(u+l)/2;a.plotY=n;f+=h+g;u+=g;l-=g;t-=h+g;m-=q;p+=q;a.tileEdges={x1:f,x2:u,x3:l,x4:t,y1:m,y2:n,y3:p};a.shapeType="path";a.shapeArgs={d:["M",u,m,"L",l,m,t,n,l,p,u,p,f,n,"Z"]}});this.translateColors()}},diamond:{alignDataLabel:d.seriesTypes.scatter.prototype.alignDataLabel,
getSeriesPadding:function(a){return w(a,2,2)},haloPath:function(a){if(!a)return[];var b=this.tileEdges;return["M",b.x2,b.y1+a,"L",b.x3+a,b.y2,b.x2,b.y3-a,b.x1-a,b.y2,"Z"]},translate:function(){var a=this.options,b=this.xAxis,c=this.yAxis,d=a.pointPadding||0,g=a.colsize||1,x=(a.rowsize||1)/2,k;this.generatePoints();v(this.points,function(a){var h=e(Math.round(b.len-b.translate(a.x-g,0,1,0,0)),-b.len,2*b.len),f=e(Math.round(b.len-b.translate(a.x,0,1,0,0)),-b.len,2*b.len),l=e(Math.round(b.len-b.translate(a.x+
g,0,1,0,0)),-b.len,2*b.len),t=e(Math.round(c.translate(a.y-x,0,1,0,0)),-c.len,2*c.len),m=e(Math.round(c.translate(a.y,0,1,0,0)),-c.len,2*c.len),n=e(Math.round(c.translate(a.y+x,0,1,0,0)),-c.len,2*c.len),p=r(a.pointPadding,d),q=p*Math.abs(f-h)/Math.abs(n-m),q=b.reversed?-q:q,p=c.reversed?-p:p;a.x%2&&(k=Math.abs(n-t)/2*(c.reversed?-1:1),t+=k,m+=k,n+=k);a.plotX=a.clientX=f;a.plotY=m;h+=q;l-=q;t-=p;n+=p;a.tileEdges={x1:h,x2:f,x3:l,y1:t,y2:m,y3:n};a.shapeType="path";a.shapeArgs={d:["M",f,t,"L",l,m,f,n,
h,m,"Z"]}});this.translateColors()}},circle:{alignDataLabel:d.seriesTypes.scatter.prototype.alignDataLabel,getSeriesPadding:function(a){return w(a,2,2)},haloPath:function(a){return d.seriesTypes.scatter.prototype.pointClass.prototype.haloPath.call(this,a+(a&&this.radius))},translate:function(){var a=this.options,b=this.xAxis,c=this.yAxis,d=a.pointPadding||0,g=(a.rowsize||1)/2,x=a.colsize||1,k,f,r,u,l=!1;this.generatePoints();v(this.points,function(a){var h=e(Math.round(b.len-b.translate(a.x,0,1,0,
0)),-b.len,2*b.len),n=e(Math.round(c.translate(a.y,0,1,0,0)),-c.len,2*c.len),p=d,q=!1;void 0!==a.pointPadding&&(p=a.pointPadding,l=q=!0);if(!u||l)k=Math.abs(e(Math.floor(b.len-b.translate(a.x+x,0,1,0,0)),-b.len,2*b.len)-h),f=Math.abs(e(Math.floor(c.translate(a.y+g,0,1,0,0)),-c.len,2*c.len)-n),r=Math.floor(Math.sqrt(k*k+f*f)/2),u=Math.min(k,r,f)-p,l&&!q&&(l=!1);a.x%2&&(n+=f*(c.reversed?-1:1));a.plotX=a.clientX=h;a.plotY=n;a.radius=u;a.shapeType="circle";a.shapeArgs={x:h,y:n,r:u}});this.translateColors()}},
square:{alignDataLabel:d.seriesTypes.heatmap.prototype.alignDataLabel,translate:d.seriesTypes.heatmap.prototype.translate,getSeriesPadding:function(){},haloPath:d.seriesTypes.heatmap.prototype.pointClass.prototype.haloPath}};d.wrap(d.Axis.prototype,"setAxisTranslation",function(a){a.apply(this,Array.prototype.slice.call(arguments,1));var b=this,c=y(d.map(b.series,function(a){return a.getSeriesPixelPadding&&a.getSeriesPixelPadding(b)}),function(a,b){return(a&&a.padding)>(b&&b.padding)?a:b})||{padding:0,
axisLengthFactor:1},e=Math.round(c.padding*c.axisLengthFactor);c.padding&&(b.len-=e,a.apply(b,Array.prototype.slice.call(arguments,1)),b.minPixelPadding+=c.padding,b.len+=e)});g("tilemap","heatmap",{states:{hover:{halo:{enabled:!0,size:2,opacity:.5,attributes:{zIndex:3}}}},pointPadding:2,tileShape:"hexagon"},{setOptions:function(){var a=d.seriesTypes.heatmap.prototype.setOptions.apply(this,Array.prototype.slice.call(arguments));this.tileShape=d.tileShapeTypes[a.tileShape];return a},alignDataLabel:function(){return this.tileShape.alignDataLabel.apply(this,
Array.prototype.slice.call(arguments))},getSeriesPixelPadding:function(a){var b=a.isXAxis,c=this.tileShape.getSeriesPadding(this),d;if(!c)return{padding:0,axisLengthFactor:1};d=Math.round(a.translate(b?2*c.xPad:c.yPad,0,1,0,1));a=Math.round(a.translate(b?c.xPad:0,0,1,0,1));return{padding:Math.abs(d-a)||0,axisLengthFactor:b?2:1.1}},translate:function(){return this.tileShape.translate.apply(this,Array.prototype.slice.call(arguments))}},d.extend({haloPath:function(){return this.series.tileShape.haloPath.apply(this,
Array.prototype.slice.call(arguments))}},d.colorPointMixin))})(g)});
