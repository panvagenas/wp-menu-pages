define(["jquery"],function(e){function t(e,t,n){this._currentData=[],this._valueSeparator=n.get("valueSeparator")||",",t.prop("type")==="hidden"&&n.get("debug")&&console&&console.warn&&console.warn("Select2: Using a hidden input with Select2 is no longer supported and may stop working in the future. It is recommended to use a `<select>` element instead."),e.call(this,t,n)}return t.prototype.current=function(t,n){function r(t,n){var i=[];return t.selected||e.inArray(t.id,n)!==-1?(t.selected=!0,i.push(t)):t.selected=!1,t.children&&i.push.apply(i,r(t.children,n)),i}var i=[];for(var s=0;s<this._currentData.length;s++){var o=this._currentData[s];i.push.apply(i,r(o,this.$element.val().split(this._valueSeparator)))}n(i)},t.prototype.select=function(t,n){if(!this.options.get("multiple"))this.current(function(t){e.map(t,function(e){e.selected=!1})}),this.$element.val(n.id),this.$element.trigger("change");else{var r=this.$element.val();r+=this._valueSeparator+n.id,this.$element.val(r),this.$element.trigger("change")}},t.prototype.unselect=function(e,t){var n=this;t.selected=!1,this.current(function(e){var r=[];for(var i=0;i<e.length;i++){var s=e[i];if(t.id==s.id)continue;r.push(s.id)}n.$element.val(r.join(n._valueSeparator)),n.$element.trigger("change")})},t.prototype.query=function(e,t,n){var r=[];for(var i=0;i<this._currentData.length;i++){var s=this._currentData[i],o=this.matches(t,s);o!==null&&r.push(o)}n({results:r})},t.prototype.addOptions=function(t,n){var r=e.map(n,function(t){return e.data(t[0],"data")});this._currentData.push.apply(this._currentData,r)},t});